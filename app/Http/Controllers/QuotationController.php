<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Client;
use App\Models\Option;
use App\Models\Payment;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\MovingJobFormula;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class QuotationController extends Controller
{

    public function index(Request $request): Response
    {
        $quotations = Quotation::with(['movingJob.client', 'movingJob.client.clientOrganization'])->latest()->get();
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
        $number = $request->input('number') ?? "";
        $client = $request->input('client') ?? "";
        $date = $request->input('date') ?? "";
        $status = $request->input('status') ?? "";
        $amountHT = $request->input('amountHT') ?? "";
        $clientType = $request->input('clientType') ?? "";

        $query = Quotation::with(['movingJob' => function ($movingJobQuery) use ($amountHT, $date, $client, $clientType) {
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
        }])
            ->where('organization_id', auth()->user()->organization->id);

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

    public function duplicate($id, $id_formule)
    {
        // Retrieve the original quotation
        $originalQuotation = Quotation::where('id', $id)
            ->with(['movingJob.client', 'movingJob.client.clientOrganization'])
            ->first();

        // Retrieve the original movingJob
        $originalMovingJob = $originalQuotation->movingJob;

        // Retrieve the formula
        $formula = MovingJobFormula::where('id', $id_formule)->with('options')->first();

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
                $newOption->moving_job_id = $newMovingJob->id;
                $newOption->save();
            }
        }
        // // Duplicate the quotation and associate with the new movingJob
        $newQuotation = $originalQuotation->replicate();
        $newQuotation->movingJob()->associate($newMovingJob);  // Associate the new MovingJob
        $newQuotation->save();

        return Redirect::route('6dem.documents.quotation.preview', $newQuotation->id);
    }

    public function SavePayment(Request $request,$id)
    {
        $quotation = Quotation::where('id', $id)
            ->with(['movingJob.client', 'movingJob.client.clientOrganization'])
            ->first();
        $MovingJob = $quotation->movingJob;

        //return $request->all();
        // $request->all() = {"type":"accompte","montant":"10000.5","reference":"ER4356","moyen_payment":"carte-bancaire"}

        $payment = new Payment([
            'type' => $request->type,
            'amount' => $request->montant,
            'payment_channel' => $request->moyen_payment,
            'reference' => $request->reference,
        ]);
        $MovingJob->payments()->save($payment);
        // Update amount_ht and updated_at of MovingJob
        //$newAmountHt = $MovingJob->amount_ht + $request->montant;
        $newAmountHt = $request->montant;
        $currentDate = Carbon::now();

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
            $quotation->delete();
            return Redirect::route('6dem.documents');
        } catch (\Exception $e) {

            return response()->json(['message' => 'Une erreur s\'est produite lors de la suppression'], 500);
        }
    }
}
