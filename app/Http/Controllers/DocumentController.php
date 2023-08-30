<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Invoice;
use App\Models\Waybill;
use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Models\MovingJobFormula;
use App\Models\MovingJobFormulaOption;
use App\Models\ExecutingCompany;

class DocumentController extends Controller
{
    public function index(Request $request): Response
    {
        $organization = $request->user()->organization;
        $quotations = Quotation::where('organization_id', $organization->id)->with(['movingJob.client', 'movingJob.client.clientOrganization'])->latest()->get();
        $waybills = Waybill::where('organization_id', $organization->id)->with(['movingJob.client', 'movingJob.client.clientOrganization'])->latest()->get();
        $invoices = Invoice::where('organization_id', $organization->id)->with(['movingJob.client', 'movingJob.client.clientOrganization'])->latest()->get();
        $movingJobFormulas = MovingJobFormula::where('organization_id', $organization->id)->with('options')->get();
        $executingCompanies = ExecutingCompany::where(['organization_id' => $organization->id])->get();

        return Inertia::render('6dem/Documents', [
            'executingCompanies' => $executingCompanies,
            'quotations' => $quotations,
            'waybills' => $waybills,
            'invoices' => $invoices,
            'movingJobFormulas' => $movingJobFormulas,
        ]);
    }
}
