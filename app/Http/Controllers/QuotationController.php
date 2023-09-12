<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Option;
use App\Models\Payment;
use App\Models\Settings;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Enums\OptionType;
use App\Models\ExecutingCompany;
use App\Models\MovingJobFormula;
use App\Models\Enums\QuotationStatus;
use Illuminate\Support\Facades\Redirect;

class QuotationController extends Controller
{
    public function index(Request $request): Response
    {
        $organization = $request->user()->organization;
        $quotations = Quotation::where('organization_id', $organization->id)->with(['movingJob.client', 'movingJob.client.clientOrganization'])->latest()->get();
        return Inertia::render('6dem/Documents', [
            'quotations' => $quotations,
        ]);
    }

    /**
     * Handle an incoming search request.
     */
    public function search(Request $request)
    {
        $organization = $request->user()->organization;
        $search_text = $request->input('search_text');
        $quotations = Quotation::where('organization_id', $organization->id)
            ->where(function ($query) use ($search_text) {
                $query->where('number', 'LIKE', "%{$search_text}%")
                    ->orWhereHas('movingJob.client', function ($query) use ($search_text) {
                        $query->where('first_name', 'LIKE', "%{$search_text}%")
                            ->orWhere('last_name', 'LIKE', "%{$search_text}%");
                    });
            })
            ->with('movingJob.client')
            ->take(20)
            ->get();

        return $quotations;
    }

    /**
     * Handle an incoming filter requfest.
     */
    public function sort(Request $request)
    {
        $organization = $request->user()->organization;
        $number = $request->input('number') ?? "";
        $client = $request->input('client') ?? "";
        $date = $request->input('date') ?? "";
        $status = $request->input('status') ?? "";
        $amountHT = $request->input('amountHT') ?? "";
        $clientType = $request->input('clientType') ?? "";

        $query = Quotation::where('organization_id', $organization->id)->with(['movingJob' => function ($movingJobQuery) use ($amountHT, $date, $client, $clientType) {
            if ($amountHT) {
                $movingJobQuery->orderBy('amount_ht', $amountHT);
            }
            if ($date) {
                $movingJobQuery->orderBy('loading_date', $date);
            }
            $movingJobQuery->with(['client' => function ($clientQuery) use ($client, $clientType) {
                if ($client) {
                    $clientQuery->orderBy('last_name', $client);
                }
                if ($clientType) {
                    $clientQuery->orderBy('type', $clientType);
                }
                $clientQuery->with(['clientOrganization']);
            }]);
        }]);

        if ($number) {
            $query->orderBy('number', $number);
        }
        if ($status) {
            $query->orderBy('status', $status);
        }

        $quotation = $query->get();

        return $quotation;
    }

    public function preview(Request $request, $id): Response
    {
        $organization = $request->user()->organization;
        $quotation = Quotation::where('id', $id)->with(['movingJob.client', 'movingJob.client.clientOrganization'])->first();
        $executingCompanies = ExecutingCompany::where(['organization_id' => $organization->id])->get();
        $movingJobFormulas = MovingJobFormula::where('organization_id', $organization->id)->with('options')->get();
        return Inertia::render('6dem/PreviewQuotation', [
            'movingJobFormulas' => $movingJobFormulas,
            'executingCompanies' => $executingCompanies,
            'quotation' => $quotation,
        ]);
    }

    public function duplicate(Request $request, $id)
    {
        $request->validate([
            'formula' => 'required',
            'amount' => 'required',
        ]);
        $organization = $request->user()->organization;
        $settings = Settings::where('organization_id', $organization->id)->first();
        $originalQuotation = Quotation::where('id', $id)
            ->with(['movingJob.client', 'movingJob.client.clientOrganization'])
            ->first();

        $originalMovingJob = $originalQuotation->movingJob;

        $formula = MovingJobFormula::where('id', $request->formula)->with('options')->first();
        $newMovingJob = $originalMovingJob->replicate();
        $newMovingJob->formula = $formula->slug;
        $newMovingJob->save();

        $originalOptions = Option::where('moving_job_id', $originalMovingJob->id)->get();
        if ($originalOptions) {
            foreach ($originalOptions as $originalOption) {
                $newOption = $originalOption->replicate();
                if ($newOption->type === OptionType::MOVING) {
                    $newOption->unit_price_ht = floatval($request->amount);
                    $newOption->total_price_ht = floatval($request->amount);
                }
                $newOption->moving_job_id = $newMovingJob->id;
                $newOption->save();
            }
        }

        $newMovingJob->updateMovingJobPrice($settings->vat);
        $newQuotation = $originalQuotation->replicate();
        $newQuotation->status = QuotationStatus::DRAFTED;
        $newQuotation->movingJob()->associate($newMovingJob);
        $newQuotation->save();

        return Redirect::route('6dem.documents.quotation.preview', $newQuotation->id)->with('toast', 'Le devis a Bien été duppliquer!');
    }

    public function SavePayment(Request $request, $id)
    {
        $organization = $request->user()->organization;
        $request->validate([
            'type' => 'required',
            'montant' => 'required',
            'moyen_payment' => 'required',
            'reference' => 'required',
            'date' => 'required',
        ]);

        $quotation = Quotation::where('id', $id)
            ->with(['movingJob.client', 'movingJob.client.clientOrganization'])
            ->first();
        $MovingJob = $quotation->movingJob;

        $payment = Payment::create([
            'type' => $request->type,
            'amount' => $request->montant,
            'payment_channel' => $request->moyen_payment,
            'date' => $request->date,
            'reference' => $request->reference,
            'quotation_id' => $id,
        ]);

        $organization->payments()->save($payment);
        $MovingJob->payments()->save($payment);
        return back()->with('toast', 'Paiement bien enregistré!');
    }

    public function deleteQuotation($id)
    {
        try {
            $quotation = Quotation::find($id);

            if (!$quotation) {
                return response()->json(['message' => 'Ce devis n\'existe pas'], 404);
            }
            $movingJob = $quotation->movingJob;
            if ($movingJob) {
                $movingJob->payments()->delete();
                $MovingOptions = Option::where('moving_job_id', $movingJob->id)->get();
                if ($MovingOptions) {
                    foreach ($MovingOptions as $option) {
                        $option->delete();
                    }
                }

                $movingJob->delete();
            }
            $quotation->delete();
            return back()->with('toast', 'Le devis a été supprimé!');
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Une erreur s\'est produite lors de la suppression',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
