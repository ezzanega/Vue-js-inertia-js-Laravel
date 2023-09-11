<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Option;
use App\Models\Invoice;
use App\Models\Waybill;
use App\Mail\MailHandler;
use App\Models\Insurance;
use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Models\EmailTemplates;
use App\Models\MovingJobFormula;
use App\Models\Enums\InsuranceType;
use Illuminate\Support\Facades\Mail;
use App\Models\MovingJobFormulaOption;

class PdfGeneratorController extends Controller
{
    public function quotation(Request $request, $id)
    {
        $organization = $request->user()->organization;
        $quotation = Quotation::where('id', $id)->with(['movingJob.client', 'movingJob.client.address', 'movingJob.client.clientOrganization'])->first();
        $options = Option::where('moving_job_id', $quotation->movingJob->id)->get();
        $insurance = Insurance::where(['organization_id' => $organization->id, 'type' => InsuranceType::CONTRACTUAL])->first();
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
            'insurance' => $insurance,
            'movingJobFormula' => [
                "client-side"  => $movingJobFormulaOptionsClientSide,
                "organization-side"   => $movingJobFormulaOptionsOrganizationSide,
            ],
            'settings' => $organization->settings,
            'organization' => $organization
        ]);
        $clientName = $quotation->movingJob->client->type === 'individual' ?  $quotation->movingJob->client->getFullName() : $quotation->movingJob->client->clientOrganization?->name;
        $filename = 'Devis N°' . $quotation->number . ' - ' . $clientName . '.pdf';
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
        $clientName = $waybill->movingJob->client->type === 'individual' ?  $waybill->movingJob->client->getFullName() : $waybill->movingJob->client->clientOrganization?->name;
        $filename = 'Lettre de voiture N°' . $waybill->number . ' - ' . $clientName . '.pdf';
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
        $clientName = $invoice->movingJob->client->type === 'individual' ?  $invoice->movingJob->client->getFullName() : $invoice->movingJob->client->clientOrganization?->name;
        $filename = 'Facture N°' . $invoice->number . ' - ' . $clientName . '.pdf';
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
        $clientName = $quotation->movingJob->client->type === 'individual' ?  $quotation->movingJob->client->getFullName() : $quotation->movingJob->client->clientOrganization?->name;
        $filename = 'Devis N°' . $quotation->number . ' - ' . $clientName . '.pdf';
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
        $clientName = $waybill->movingJob->client->type === 'individual' ?  $waybill->movingJob->client->getFullName() : $waybill->movingJob->client->clientOrganization?->name;
        $filename = 'Lettre de voiture N°' . $waybill->number . ' - ' . $clientName . '.pdf';
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
        $clientName = $invoice->movingJob->client->type === 'individual' ?  $invoice->movingJob->client->getFullName() : $invoice->movingJob->client->clientOrganization?->name;
        $filename = 'Facture N°' . $invoice->number . ' - ' . $clientName . '.pdf';
        return $pdf->download($filename);
    }

    public function sendQuotationToClient(Request $request, $id)
    {
        $organization = $request->user()->organization;
        $quotation = Quotation::where('id', $id)->with(['movingJob.client', 'movingJob.client.address', 'movingJob.client.clientOrganization'])->first();
        $options = Option::where('moving_job_id', $quotation->movingJob->id)->get();
        $insurance = Insurance::where(['organization_id' => $organization->id, 'type' => InsuranceType::CONTRACTUAL])->first();
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
            'organization' => $organization,
            'insurance' => $insurance
        ]);
        $clientName = $quotation->movingJob->client->type === 'individual' ?  $quotation->movingJob->client->getFullName() : $quotation->movingJob->client->clientOrganization?->name;
        $filename = 'Devis N°' . $quotation->number . ' - ' . $clientName . '.pdf';

        $tempFile = tempnam(sys_get_temp_dir(), $quotation->number);
        $pdf->save($tempFile);

        $client = $quotation->movingJob->client;
        $data = [
            'client_name' => $client->getFullName(),
            'organization' => $organization->name,
        ];
        $attachment = [
            'path' => $tempFile,
            'name' => $filename,
            'mime' => 'application/pdf',
        ];

        $emailTemplate = EmailTemplates::find(3);
        Mail::to($client->email)->send(new MailHandler($emailTemplate, $data, $attachment));

        unlink($tempFile);
        return back()->with('toast', 'Le devis a bien été envoyé au client!');
    }

    public function sendWaybillToClient(Request $request, $id)
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
        $clientName = $waybill->movingJob->client->type === 'individual' ?  $waybill->movingJob->client->getFullName() : $waybill->movingJob->client->clientOrganization?->name;
        $filename = 'Lettre de voiture N°' . $waybill->number . ' - ' . $clientName . '.pdf';
        $tempFile = tempnam(sys_get_temp_dir(), $waybill->number);
        $pdf->save($tempFile);

        $client = $waybill->movingJob->client;
        $data = [
            'client_name' => $client->getFullName(),
            'organization' => $organization->name,
        ];
        $attachment = [
            'path' => $tempFile,
            'name' => $filename,
            'mime' => 'application/pdf',
        ];

        $emailTemplate = EmailTemplates::find(3);
        Mail::to($client->email)->send(new MailHandler($emailTemplate, $data, $attachment));

        unlink($tempFile);
        return back()->with('toast', 'La lettre de voiture a bien été envoyé au client!');
    }

    public function sendInvoiceToClient(Request $request, $id)
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
        $clientName = $invoice->movingJob->client->type === 'individual' ?  $invoice->movingJob->client->getFullName() : $invoice->movingJob->client->clientOrganization?->name;
        $filename = 'Facture N°' . $invoice->number . ' - ' . $clientName . '.pdf';
        $tempFile = tempnam(sys_get_temp_dir(), $invoice->number);
        $pdf->save($tempFile);

        $client = $invoice->movingJob->client;
        $data = [
            'client_name' => $client->getFullName(),
            'organization' => $organization->name,
        ];
        $attachment = [
            'path' => $tempFile,
            'name' => $filename,
            'mime' => 'application/pdf',
        ];

        $emailTemplate = EmailTemplates::find(3);
        Mail::to($client->email)->send(new MailHandler($emailTemplate, $data, $attachment));

        unlink($tempFile);
        return back()->with('toast', 'La facture a bien été envoyé au client!');
    }
}
