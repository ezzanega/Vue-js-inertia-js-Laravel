<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


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
        $organization = $request->user()->organization;
        $search_text = $request->input('search_text');
        $invoice = Invoice::where('organization_id', $organization->id)
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

        $query = Invoice::where('organization_id', auth()->user()->organization->id)->with(['movingJob' => function ($movingJobQuery) use ($amountHT, $date) {
            if ($amountHT) {
                $movingJobQuery->orderBy('amount_ht', $amountHT);
            }
            if ($date) {
                $movingJobQuery->orderBy('loading_date', $date);
            }
            $movingJobQuery->with('client', 'client.clientOrganization');
        }]);

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

    public function deleteInvoice($id)
    {
        try {
            $invoice = Invoice::find($id);

            if (!$invoice) {
                return response()->json(['message' => 'Cette Facture n\'existe pas'], 404);
            }
            $invoice->delete();
            return back()->with('toast', 'La Facture a Bien été supprimé!');
        } catch (\Exception $e) {

            return response()->json(['message' => 'Une erreur s\'est produite lors de la suppression'], 500);
        }
    }

    public function updateStatutInvoice(Request $request, $id, $field)
    {
        $invoice = Invoice::where('id', $id)->with(['movingJob.client', 'movingJob.client.clientOrganization'])->first();

        $request->validate([
            $field =>  'required|string|max:125',
        ]);

        if ($field === "validity_duratation") {
            $invoice->update([
                $field => $request->$field,
            ]);
        } else if ($field === "status") {
            $invoice->update([
                $field => $request->$field,
            ]);
        }
        return back();
    }
    public function updateAmountsInvoice(Request $request, $id)
    {
        $invoice = Invoice::where('id', $id)->with(['movingJob.client', 'movingJob.client.clientOrganization'])->first();

        $request->validate([
            'type' => 'required|string|max:255',
            'amount' => 'required',
            'amount_ttc' => 'required',
            'amount_tva' => 'required',
        ]);

        $invoice->update([
            'type' => $request->type,
            'amount_ht' => $request->amount,
            'amount_ttc' => $request->amount_ttc,
            'amount_tva' => $request->amount_tva,
        ]);

        return back()->with('toast', 'La Facture a Bien été modifier!');
    }

}
