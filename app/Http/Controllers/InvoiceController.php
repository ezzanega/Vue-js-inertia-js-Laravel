<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Invoice;


class InvoiceController extends Controller
{
    public function preview(Request $request, $id): Response
    {
        $invoice = Invoice::where('id', $id)->with(['movingJob.client', 'movingJob.client.clientOrganization'])->first();
        return Inertia::render('6dem/PreviewInvoice', [
            'invoice' => $invoice,
        ]);
    }

    /**
     * Handle an incoming search request.
     */
    public function search(Request $request)
    {
        $search_text = $request->input('search_text');
        $invoice = Invoice::where('organization_id', auth()->user()->organization->id)
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

        return $invoice;
    }

    /**
     * Handle an incoming filter request.
     */
    public function sort(Request $request)
    {
        $number = $request->input('number') ?? "";
        $type = $request->input('type') ?? "";
        $date = $request->input('date') ?? "";
        $status = $request->input('status') ?? "";
        $amountHT = $request->input('amountHT') ?? "";

        $query = Invoice::with(['movingJob' => function ($movingJobQuery) use ($amountHT, $date) {
            if ($amountHT) {
                $movingJobQuery->orderBy('discount_amount_ht', $amountHT);
            }
            if ($date) {
                $movingJobQuery->orderBy('loading_date', $date);
            }
            $movingJobQuery->with('client');
        }])
        ->where('organization_id', auth()->user()->organization->id);
        if ($type) {
            $query->orderBy('type', $type);
        }

        if ($number) {
            $query->orderBy('number', $number);
        }
        if ($status) {
            $query->orderBy('status', $status);
        }

        $invoice = $query->get();

        return $invoice;
    }
}
