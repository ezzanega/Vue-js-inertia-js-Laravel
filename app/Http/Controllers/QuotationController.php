<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Quotation;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                $movingJobQuery->orderBy('discount_amount_ht', $amountHT);
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
}
