<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\Waybill;
use App\Models\Invoice;
use App\Models\ExecutingCompany;
use Inertia\Response;

class DocumentController extends Controller
{
    public function index(Request $request): Response
    {
        $organization = $request->user()->organization;
        $quotations = Quotation::with(['movingJob.client', 'movingJob.client.clientOrganization'])->latest()->get();
        $waybills = Waybill::with(['movingJob.client', 'movingJob.client.clientOrganization'])->latest()->get();
        $invoices = Invoice::with(['movingJob.client', 'movingJob.client.clientOrganization'])->latest()->get();
        $executingCompanies = ExecutingCompany::where(['organization_id' => $organization->id])->get();

        return Inertia::render('6dem/Documents', [
            'executingCompanies' => $executingCompanies,
            'quotations' => $quotations,
            'waybills' => $waybills,
            'invoices' => $invoices
        ]);
    }
}
