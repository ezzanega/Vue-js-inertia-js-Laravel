<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Client;
use App\Models\Option;
use App\Models\Invoice;
use App\Models\Waybill;
use App\Models\Settings;
use App\Models\Insurance;
use App\Models\MovingJob;
use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Models\AdditionalField;
use App\Models\Enums\ClientType;
use App\Models\Enums\OptionType;
use App\Models\ExecutingCompany;
use App\Models\MovingJobFormula;
use App\Models\Enums\InsuranceType;
use App\Models\Enums\InvoiceStatus;
use App\Models\Enums\InvoiceType;
use App\Models\Enums\WaybillStatus;
use Illuminate\Support\Facades\Http;
use App\Models\Enums\QuotationStatus;
use App\Models\Organization;
use Illuminate\Support\Facades\Redirect;

class MovingJobController extends Controller
{
    public function index(Request $request): Response
    {
        $quotations = Quotation::with(['movingJob.client', 'movingJob.client.clientOrganization'])->latest()->get();
        $waybills = Waybill::with('movingJob')->latest()->get();

        return Inertia::render('6dem/Documents', [
            'quotations' => $quotations,
            'waybills' => $waybills
        ]);
    }

    public function initQuotation(Request $request, $clientId)
    {
        $organization = $request->user()->organization;
        $client = Client::find($clientId);
        $movingjob = MovingJob::create([]);
        $quotation = Quotation::create([
            'organization_id' => $organization->id,
            'status' => QuotationStatus::DRAFTED
        ]);
        $insurance = Insurance::where(['organization_id' => $organization->id, 'type' => InsuranceType::CONTRACTUAL])->first();

        $option = Option::create([
            'type' => OptionType::MOVING,
            'designation' => 'Déménagement Forfaitaire',
            'quantity' => 1,
            'unit' => 1,
            'unit_price_ht' => 0,
            'total_price_ht' => 0
        ]);


        $option->movingJob()->associate($movingjob);
        $option->save();

        $quotation->movingJob()->associate($movingjob);
        $quotation->save();

        $movingjob->client()->associate($client);
        $movingjob->save();

        return Redirect::route('6dem.documents.quotation', [
            'movingjobId' => $movingjob->id,
            'clientId' => $client->id,
            'quotationId' => $quotation->id,
            'optionId' => $option->id,
        ]);
    }

    public function initWaybill(Request $request, $quotationId)
    {
        $organization = $request->user()->organization;
        $quotation = Quotation::find($quotationId);
        $movingjob = MovingJob::where('id', $quotation->moving_job_id)->first();
        $client = Client::find($movingjob->client_id);
        $waybill = Waybill::create([
            'organization_id' => $organization->id,
            'status' => WaybillStatus::NOTSIGNED
        ]);

        $waybill->movingJob()->associate($movingjob);
        $waybill->save();

        $movingjob->client()->associate($client);
        $movingjob->save();

        return Redirect::route('6dem.documents.waybill', [
            'movingjobId' => $movingjob->id,
            'clientId' => $client->id,
            'waybillId' => $waybill->id,
        ]);
    }

    public function initWaybillPreview(Request $request, $quotationId)
    {
        $organization = $request->user()->organization;
        $quotation = Quotation::find($quotationId);
        $executingCompany = ExecutingCompany::find($request->executingCompany);
        $movingjob = MovingJob::where('id', $quotation->moving_job_id)->first();
        $waybill = Waybill::where('moving_job_id', $movingjob->id)->first();
        if($waybill){
            $waybill = Waybill::where('id', $waybill->id)->with(['movingJob.client', 'movingJob.client.clientOrganization'])->first();
            return Inertia::render('6dem/PreviewWaybill', [
                'waybill' => $waybill,
            ]);
        }else{
            $waybill = Waybill::create([
                'executing_company' => $executingCompany->name,
                'organization_id' => $organization->id,
                'status' => WaybillStatus::NOTSIGNED
            ]);
    
            $quotation->update([
                'status' => QuotationStatus::ACCEPTED,
            ]);
    
            $waybill->movingJob()->associate($movingjob);
            $waybill->save();
    
            $waybill->executingCompany()->associate($executingCompany);
            $waybill->save();
    
            $waybill = Waybill::where('id', $waybill->id)->with(['movingJob.client', 'movingJob.client.clientOrganization'])->first();
            return Inertia::render('6dem/PreviewWaybill', [
                'waybill' => $waybill,
            ]);
        }
    }

    public function initInvoice(Request $request, $quotationId)
    {
        $organization = $request->user()->organization;
        $quotation = Quotation::find($quotationId);
        $movingjob = MovingJob::where('id', $quotation->moving_job_id)->first();
        $client = Client::find($movingjob->client_id);
        $invoice = Invoice::create([
            'organization_id' => $organization->id,
            'status' => InvoiceStatus::ONHOLD
        ]);

        $invoice->movingJob()->associate($movingjob);
        $invoice->save();

        $movingjob->client()->associate($client);
        $movingjob->save();

        return Redirect::route('6dem.documents.invoice', [
            'movingjobId' => $movingjob->id,
            'clientId' => $client->id,
            'invoiceId' => $invoice->id,
        ]);
    }

    public function initInvoicePreview(Request $request, $quotationId)
    {
        $organization = $request->user()->organization;
        $quotation = Quotation::find($quotationId);
        $settings = Settings::where('organization_id', $organization->id)->first();
        $movingjob = MovingJob::where('id', $quotation->moving_job_id)->first();
        $invoice = Invoice::create([
            'type' => $request->type,
            'amount_ht' => $request->amount,
            'amount_ttc' => $request->amount + ($request->amount * $settings->vat) / 100,
            'amount_tva' => ($request->amount * $settings->vat) / 100,
            'organization_id' => $organization->id,
            'status' => InvoiceStatus::ONHOLD
        ]);

        $quotation->update([
            'status' => QuotationStatus::ACCEPTED,
        ]);
        
        $invoice->movingJob()->associate($movingjob);
        $invoice->save();

        $invoice = Invoice::where('id', $invoice->id)->with(['movingJob.client', 'movingJob.client.clientOrganization'])->first();
        return Inertia::render('6dem/PreviewInvoice', [
            'invoice' => $invoice,
        ]);
    }

    public function quotation(Request $request, $movingjobId, $clientId, $quotationId): Response
    {
        $organization = Organization::where('id', $request->user()->organization->id)->with(['billingAddress'])->first();
        $client = Client::where('id', $clientId)->with(['address', 'clientOrganization'])->first();
        $movingjob = MovingJob::where('id', $movingjobId)->with(['loadingLocation', 'shippingLocation'])->first();
        $quotation = Quotation::find($quotationId);
        $options = Option::where('moving_job_id', $movingjobId)->get();
        $insurances = Insurance::where(['organization_id' => $organization->id])->get();
        $settings = Settings::where('organization_id', $organization->id)->first();
        $movingJobFormulas = MovingJobFormula::where('organization_id', $organization->id)->with('options')->get();
        return Inertia::render('6dem/Devis', [
            'organization' => $organization,
            'additionalFields' => [],
            'movingJobFormulas' => $movingJobFormulas,
            'quotation' => $quotation->only(
                'id',
                'number',
                'validity_duratation'
            ),
            'insurances' => $insurances,
            'settings' => $settings,
            'movingJob' => $movingjob,
            'options' => $options,
            'client' => $client,
            'status' => session('status'),
        ]);
    }

    public function waybill(Request $request, $movingjobId, $clientId, $waybillId): Response
    {
        $organization = $request->user()->organization->with('billingAddress')->first();
        $client = Client::where('id', $clientId)->with(['address', 'clientOrganization'])->first();
        $movingjob = MovingJob::find($movingjobId);
        $additionalFields = AdditionalField::where('moving_job_id', $movingjobId)->get();
        $options = Option::where('moving_job_id', $movingjobId)->get();
        $waybill = Waybill::where('id', $waybillId)->with(['executingCompany'])->first();
        $executingCompanies = ExecutingCompany::where(['organization_id' => $organization->id])->get();
        $insurance = Insurance::where(['organization_id' => $organization->id])->get();
        $settings = Settings::where('organization_id', $organization->id)->first();
        $movingJobFormulas = MovingJobFormula::where('organization_id', $organization->id)->get();

        return Inertia::render('6dem/Lettre de voiture', [
            'executingCompanies' => $executingCompanies,
            'organization' => $organization,
            'waybill' => $waybill,
            'movingjob' => $movingjob,
            'additionalFields' => $additionalFields,
            'movingJobFormulas' => $movingJobFormulas,
            'insurances' => $insurance,
            'settings' => $settings,
            'options' => $options,
            'client' => $client,
            'status' => session('status'),
        ]);
    }

    public function invoice(Request $request, $movingjobId, $clientId, $invoiceId): Response
    {
        $organization = $request->user()->organization->with('billingAddress')->first();
        $client = Client::where('id', $clientId)->with(['address', 'clientOrganization'])->first();
        $movingjob = MovingJob::find($movingjobId);
        $additionalFields = AdditionalField::where('moving_job_id', $movingjobId)->get();
        $options = Option::where('moving_job_id', $movingjobId)->get();
        $invoice = Invoice::find($invoiceId);
        $executingCompanies = ExecutingCompany::where(['organization_id' => $organization->id])->get();
        $insurance = Insurance::where(['organization_id' => $organization->id])->get();
        $settings = Settings::where('organization_id', $organization->id)->first();
        $movingJobFormulas = MovingJobFormula::where('organization_id', $organization->id)->get();
        $quotation = Quotation::where('moving_job_id', $movingjobId)->first();

        return Inertia::render('6dem/Invoice', [
            'executingCompanies' => $executingCompanies,
            'organization' => $organization,
            'quotation' => $quotation,
            'invoice' => $invoice,
            'additionalFields' => $additionalFields,
            'movingJobFormulas' => $movingJobFormulas,
            'insurances' => $insurance,
            'settings' => $settings,
            'options' => $options,
            'movingJob' => $movingjob,
            'client' => $client,
            'status' => session('status'),
        ]);
    }

    public function updateQuotation(Request $request, $id, $field)
    {
        $quotation = Quotation::find($id);
        $movingjob = MovingJob::find($quotation->moving_job_id);

        $request->validate([
            $field =>  'required|string|max:125',
        ]);

        if ($field === "validity_duratation") {
            $quotation->update([
                $field => $request->$field,
            ]);
        } else if ($field === "status") {
            $quotation->update([
                $field => $request->$field,
            ]);
        } else {
            $movingjob->update([
                $field => $request->$field,
            ]);
        }
        return back();
    }


    public function updateMovingJob(Request $request, $id)
    {
        $movingjob = MovingJob::find($id);
        $movingJobData = [
            'capacity'  => $request->capacity,
            'formula'  => $request->formula,
            'loading_address'  => $request->loading_address,
            'loading_date'  => $request->loading_date,
            'loading_floor'  => $request->loading_floor,
            'loading_elevator'  => $request->loading_elevator,
            'loading_portaging'  => $request->loading_portaging,
            'loading_details'  => $request->loading_details,
            'shipping_address'  => $request->shipping_address,
            'shipping_date'  => $request->shipping_date,
            'shipping_floor'  => $request->shipping_floor,
            'shipping_elevator'  => $request->shipping_elevator,
            'shipping_portaging'  => $request->shipping_portaging,
            'shipping_details'  => $request->shipping_details,
            'discount'  => $request->discount,
            'amount_ht'  => $request->amount_ht,
            'amount_ttc'  => $request->amount_ttc,
            'amount_tva'  => $request->amount_tva,
            'advance'  => $request->advance,
            'balance'  => $request->balance,
            'distance'  => $request->distance,
            'payment_process'  => $request->payment_process,
        ];

        $filledMovingJobData = array_filter($movingJobData, function ($value) {
            return $value !== null;
        });

        $movingjob->update($filledMovingJobData);
        return back();
    }

    public function createUpdateLocation(Request $request, $id, $from)
    {
        if ($from == 'quotation') {
            $quotation = Quotation::where(['id' => $id])->first();
            $movingjob = MovingJob::where(['id' => $quotation->moving_job_id])->first();
        } else {
            $waybill = Waybill::where(['id' => $id])->first();
            $movingjob = MovingJob::where(['id' => $waybill->moving_job_id])->first();
        }

        if ($request->type == 'loading') {
            $movingjob->update(['loading_address' => $request->fullAddress]);
            $movingjob->loadingLocation()->updateOrCreate([], [
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postalCode,
                'country' => $request->country,
                'full_address' => $request->fullAddress,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'google_map_url' => $request->googleMapUrl,
            ]);
        } else {
            $movingjob->update(['shipping_address' => $request->fullAddress]);
            $movingjob->shippingLocation()->updateOrCreate([], [
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postalCode,
                'country' => $request->country,
                'full_address' => $request->fullAddress,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'google_map_url' => $request->googleMapUrl,
            ]);
        }

        $movingjob->refresh();

        if ($movingjob->loadingLocation && $movingjob->shippingLocation) {
            $distance = $this->calculateDistance(
                $movingjob->loadingLocation->lat,
                $movingjob->loadingLocation->lng,
                $movingjob->shippingLocation->lat,
                $movingjob->shippingLocation->lng
            );
            $movingjob->update(['distance' => $distance]);
            return back()->with('distance', $distance);
        }
        return back();
    }

    public function updateWaybill(Request $request, $id, $field)
    {
        $waybill = Waybill::where(['id' => $id])->first();
        $movingjob = MovingJob::where(['id' => $waybill->moving_job_id])->first();

        $request->validate([
            $field =>  'required|max:125',
        ]);

        if ($field == "validity_duration") {
            $waybill->update([
                $field => $request->$field,
            ]);
        } else if ($field == "executing_company_id") {
            $executingCompany = ExecutingCompany::where(['id' => $request->$field])->first();
            $waybill->executingCompany()->associate($executingCompany);
            $waybill->save();
        } else {
            $movingjob->update([
                $field => $request->$field,
            ]);
        }
    }

    public function updateInvoice(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $invoiceData = [
            'type' => $request->type,
            'amount_ht' => $request->amount_ht,
            'amount_ttc' => $request->amount_ttc,
            'amount_tva' => $request->amount_tva,
            'status' => $request->status,
        ];
        $filledInvoiceData = array_filter($invoiceData, function ($value) {
            return $value !== null;
        });

        $invoice->update($filledInvoiceData);
        return back();
    }


    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $Google_Maps_API_Key = 'AIzaSyC7TOs-73yQEUsNqVchkrvTr6I5gxYF5kE';

        $response = Http::get("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$lat1,$lng1&destinations=$lat2,$lng2&key=$Google_Maps_API_Key");

        if ($response->successful()) {
            $data = $response->json();
            $distance = $data['rows'][0]['elements'][0]['distance']['text'];
            return $distance;
        }
        return null;
    }
}
