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
}
