<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use PDF;
use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Models\MovingJobFormula;
use App\Models\MovingJobFormulaOption;
use App\Models\Waybill;

class PdfGeneratorController extends Controller
{

    public function quotation(Request $request, $id)
    {
        $organization = $request->user()->organization;
        $quotation = Quotation::where('id', $id)->with(['movingJob.client', 'movingJob.client.address', 'movingJob.client.clientOrganization'])->first();
        $movingJobFormula = MovingJobFormula::where(['organization_id' => $organization->id, 'slug' => $quotation->movingJob->formula])->first();
        $movingJobFormulaOptionsClientSide = [];
        $movingJobFormulaOptionsOrganizationSide = [];
        if ($movingJobFormula) {
            $movingJobFormulaOptionsClientSide = MovingJobFormulaOption::where(['moving_job_formula_id' => $movingJobFormula->id, 'type' => 'client-side'])->get();
            $movingJobFormulaOptionsOrganizationSide = MovingJobFormulaOption::where(['moving_job_formula_id' => $movingJobFormula->id, 'type' => 'organization-side'])->get();
        }
        $pdf = PDF::loadView('documents.quotation-v1', [
            'quotation' => $quotation,
            'advisor' => $request->user(),
            'movingJobFormula' => [
                "client-side"  => $movingJobFormulaOptionsClientSide,
                "organization-side"   => $movingJobFormulaOptionsOrganizationSide,
            ],
            'organization' => $organization
        ]);
        $filename = 'Devis N°' . $quotation->number . '.pdf';
        return $pdf->stream($filename);
    }


    public function waybill(Request $request, $id)
    {
        $organization = $request->user()->organization;
        $waybill = Waybill::where('id', $id)->with(['movingJob.client', 'movingJob.client.address', 'movingJob.client.clientOrganization'])->first();
        $pdf = PDF::loadView('documents.waybill-v1', [
            'waybill' => $waybill,
            'organization' => $organization
        ]);
        $filename = 'Lettre de voiture N°' . $waybill->number . '.pdf';
        return $pdf->stream($filename);
    }


    public function invoice(Request $request, $id)
    {
        $organization = $request->user()->organization;
        $invoice = Invoice::where('id', $id)->with(['movingJob.client', 'movingJob.client.address', 'movingJob.client.clientOrganization'])->first();
        $movingJobFormula = MovingJobFormula::where(['organization_id' => $organization->id, 'slug' => $invoice->movingJob->formula])->first();
        $movingJobFormulaOptionsClientSide = [];
        $movingJobFormulaOptionsOrganizationSide = [];
        if ($movingJobFormula) {
            $movingJobFormulaOptionsClientSide = MovingJobFormulaOption::where(['moving_job_formula_id' => $movingJobFormula->id, 'type' => 'client-side'])->get();
            $movingJobFormulaOptionsOrganizationSide = MovingJobFormulaOption::where(['moving_job_formula_id' => $movingJobFormula->id, 'type' => 'organization-side'])->get();
        }
        $pdf = PDF::loadView('documents.invoice-v1', [
            'invoice' => $invoice,
            'advisor' => $request->user(),
            'movingJobFormula' => [
                "client-side"  => $movingJobFormulaOptionsClientSide,
                "organization-side"   => $movingJobFormulaOptionsOrganizationSide,
            ],
            'organization' => $organization
        ]);
        $filename = 'Devis N°' . $invoice->number . '.pdf';
        return $pdf->stream($filename);
    }
}
