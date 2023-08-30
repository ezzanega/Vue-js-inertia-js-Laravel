<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Client;
use App\Models\Option;
use App\Models\Payment;
use App\Models\Settings;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Enums\OptionType;
use App\Models\MovingJobFormula;
use Illuminate\Support\Facades\DB;
use App\Models\Enums\QuotationStatus;
use Illuminate\Http\RedirectResponse;
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
        $search_text = $request->input('search_text');
        $quotation = Quotation::where('organization_id', auth()->user()->organization->id)
            ->where(function ($query) use ($search_text) {
                $query->where('number', 'LIKE', "%{$search_text}%");
            })
            ->orWhereHas('movingJob.client', function ($query) use ($search_text) {
                $query->where('first_name', 'LIKE', "%{$search_text}%")
                    ->orWhere('last_name', 'LIKE', "%{$search_text}%");
            })
            ->with('movingJob.client')
            ->take(20)
            ->get();

        return $quotation;
    }

    /**
     * Handle an incoming filter request.
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
        $quotation = Quotation::where('id', $id)->with(['movingJob.client', 'movingJob.client.clientOrganization'])->first();
        return Inertia::render('6dem/PrewiewQuotation', [
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
        // Retrieve the original quotation
        $originalQuotation = Quotation::where('id', $id)
            ->with(['movingJob.client', 'movingJob.client.clientOrganization'])
            ->first();

        // Retrieve the original movingJob
        $originalMovingJob = $originalQuotation->movingJob;

        // Retrieve the formula
        $formula = MovingJobFormula::where('id', $request->formula)->with('options')->first();

        // // Duplicate the movingJob
        $newMovingJob = $originalMovingJob->replicate();
        $newMovingJob->formula = $formula->slug;
        $newMovingJob->save();  // Save the new MovingJob first

        // Duplicate the associated options and link them to the new MovingJob
        //$originalOptions = $originalMovingJob->options;
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
        // // Duplicate the quotation and associate with the new movingJob
        $newQuotation = $originalQuotation->replicate();
        $newQuotation->status = QuotationStatus::DRAFTED;
        $newQuotation->movingJob()->associate($newMovingJob);  // Associate the new MovingJob
        $newQuotation->save();

        return Redirect::route('6dem.documents.quotation.preview', $newQuotation->id);
    }

    public function SavePayment(Request $request, $id)
    {
        $quotation = Quotation::where('id', $id)
            ->with(['movingJob.client', 'movingJob.client.clientOrganization'])
            ->first();
        $MovingJob = $quotation->movingJob;

        //return $request->all();

        $payment = new Payment([
            'type' => $request->type,
            'amount' => $request->montant,
            'payment_channel' => $request->moyen_payment,
            'reference' => $request->reference,
        ]);
        $MovingJob->payments()->save($payment);
        //update amount_ht & loading_date for the MovingJob
        $newAmountHt = $request->montant;
        $currentDate = Carbon::today()->toDateString();
        $MovingJob->update([
            'amount_ht' => $newAmountHt,
            'loading_date' => $currentDate,
        ]);
        return Redirect::route('6dem.documents');
    }

    public function deleteQuotation($id)
    {
        try {
            $quotation = Quotation::find($id);

            if (!$quotation) {
                return response()->json(['message' => 'Ce devis n\'existe pas'], 404);
            }
            $movingJob = $quotation->movingJob; // Get the associated MovingJob
            if ($movingJob) {
                $movingJob->payments()->delete();  // Delete associated payments

                // Delete associated options
                $MovingOptions = Option::where('moving_job_id', $movingJob->id)->get();
                if ($MovingOptions) {
                    foreach ($MovingOptions as $option) {
                        $option->delete();
                    }
                }

                $movingJob->delete(); // Delete the MovingJob
            }
            $quotation->delete();
            return Redirect::route('6dem.documents');
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Une erreur s\'est produite lors de la suppression',
                'error' => $e->getMessage(),  // Include the exception message
                // You can include more details as needed, such as $e->getCode(), $e->getFile(), $e->getLine(), etc.
            ], 500);
        }
    }
}
