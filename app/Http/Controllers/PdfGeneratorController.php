<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Option;
use App\Models\Invoice;
use App\Models\Waybill;
use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Models\MovingJobFormula;
use App\Models\MovingJobFormulaOption;

class PdfGeneratorController extends Controller
{

    public function quotation(Request $request, $id)
    {
        $organization = $request->user()->organization;
        $quotation = Quotation::where('id', $id)->with(['movingJob.client', 'movingJob.client.address', 'movingJob.client.clientOrganization'])->first();
        $options = Option::where('moving_job_id', $quotation->movingJob->id)->get();
        $movingJobFormula = MovingJobFormula::where(['organization_id' => $organization->id, 'slug' => $quotation->movingJob->formula])->first();
        $movingJobFormulaOptionsClientSide = [];
        $movingJobFormulaOptionsOrganizationSide = [];
        if ($movingJobFormula) {
            $movingJobFormulaOptionsClientSide = MovingJobFormulaOption::where(['moving_job_formula_id' => $movingJobFormula->id, 'type' => 'client-side'])->get();
            $movingJobFormulaOptionsOrganizationSide = MovingJobFormulaOption::where(['moving_job_formula_id' => $movingJobFormula->id, 'type' => 'organization-side'])->get();
        }
        $pdf = PDF::loadView('documents.quotation-v1', [
            'quotation' => $quotation,
            'options' => $options,
            'advisor' => $request->user(),
            'movingJobFormula' => [
                "client-side"  => $movingJobFormulaOptionsClientSide,
                "organization-side"   => $movingJobFormulaOptionsOrganizationSide,
            ],
            'settings' => $organization->settings,
            'organization' => $organization
        ]);
        $filename = 'Devis N°' . $quotation->number . '.pdf';
        return $pdf->stream($filename);
    }

    public function waybill(Request $request, $id)
    {
        $organization = $request->user()->organization;
        $waybill = Waybill::where('id', $id)->with(['movingJob.client', 'movingJob.client.address', 'movingJob.client.clientOrganization'])->first();
        $options = Option::where('moving_job_id', $waybill->movingJob->id)->get();
        $pdf = PDF::loadView('documents.waybill-v1', [
            'waybill' => $waybill,
            'options' => $options,
            'settings' => $organization->settings,
            'organization' => $organization
        ]);
        $filename = 'Lettre de voiture N°' . $waybill->number . '.pdf';
        return $pdf->stream($filename);
    }

    public function invoice(Request $request, $id)
    {
        $organization = $request->user()->organization;
        $invoice = Invoice::where('id', $id)->with(['movingJob.client', 'movingJob.client.address', 'movingJob.client.clientOrganization'])->first();
        $options = Option::where('moving_job_id', $invoice->movingJob->id)->get();
        $pdf = PDF::loadView('documents.invoice-v1', [
            'invoice' => $invoice,
            'options' => $options,
            'settings' => $organization->settings,
            'organization' => $organization
        ]);
        $filename = 'Devis N°' . $invoice->number . '.pdf';
        return $pdf->stream($filename);
    }

    public function downloadQuotation(Request $request, $id)
    {
        $organization = $request->user()->organization;
        $quotation = Quotation::where('id', $id)->with(['movingJob.client', 'movingJob.client.address', 'movingJob.client.clientOrganization'])->first();
        $options = Option::where('moving_job_id', $quotation->movingJob->id)->get();
        $movingJobFormula = MovingJobFormula::where(['organization_id' => $organization->id, 'slug' => $quotation->movingJob->formula])->first();
        $movingJobFormulaOptionsClientSide = [];
        $movingJobFormulaOptionsOrganizationSide = [];
        if ($movingJobFormula) {
            $movingJobFormulaOptionsClientSide = MovingJobFormulaOption::where(['moving_job_formula_id' => $movingJobFormula->id, 'type' => 'client-side'])->get();
            $movingJobFormulaOptionsOrganizationSide = MovingJobFormulaOption::where(['moving_job_formula_id' => $movingJobFormula->id, 'type' => 'organization-side'])->get();
        }
        $pdf = PDF::loadView('documents.quotation-v1', [
            'quotation' => $quotation,
            'options' => $options,
            'advisor' => $request->user(),
            'movingJobFormula' => [
                "client-side"  => $movingJobFormulaOptionsClientSide,
                "organization-side"   => $movingJobFormulaOptionsOrganizationSide,
            ],
            'settings' => $organization->settings,
            'organization' => $organization
        ]);
        $filename = 'Devis N°' . $quotation->number . '.pdf';
        return $pdf->download($filename);
    }

    public function downloadWaybill(Request $request, $id)
    {
        $organization = $request->user()->organization;
        $waybill = Waybill::where('id', $id)->with(['movingJob.client', 'movingJob.client.address', 'movingJob.client.clientOrganization'])->first();
        $options = Option::where('moving_job_id', $waybill->movingJob->id)->get();
        $pdf = PDF::loadView('documents.waybill-v1', [
            'waybill' => $waybill,
            'options' => $options,
            'settings' => $organization->settings,
            'organization' => $organization
        ]);
        $filename = 'Lettre de voiture N°' . $waybill->number . '.pdf';
        return $pdf->download($filename);
    }

    public function downloadInvoice(Request $request, $id)
    {
        $organization = $request->user()->organization;
        $invoice = Invoice::where('id', $id)->with(['movingJob.client', 'movingJob.client.address', 'movingJob.client.clientOrganization'])->first();
        $options = Option::where('moving_job_id', $invoice->movingJob->id)->get();
        $pdf = PDF::loadView('documents.invoice-v1', [
            'invoice' => $invoice,
            'options' => $options,
            'settings' => $organization->settings,
            'organization' => $organization
        ]);
        $filename = 'Devis N°' . $invoice->number . '.pdf';
        return $pdf->download($filename);
    }
}
