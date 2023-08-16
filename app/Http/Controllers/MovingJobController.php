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
use App\Models\Enums\OptionType;
use App\Models\ExecutingCompany;
use App\Models\MovingJobFormula;
use App\Models\Enums\InvoiceStatus;
use App\Models\Enums\WaybillStatus;
use Illuminate\Support\Facades\Http;
use App\Models\Enums\QuotationStatus;
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
            'status' => QuotationStatus::NOTSIGNED
        ]);
        $option = Option::create([
            'type' => OptionType::OTHER,
            'designation' => '',
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

    public function quotation(Request $request, $movingjobId, $clientId, $quotationId): Response
    {
        $organization = $request->user()->organization->with('billingAddress')->first();
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

        return Inertia::render('6dem/Invoice', [
            'executingCompanies' => $executingCompanies,
            'organization' => $organization,
            'invoice' => $invoice->only(
                'id',
                'number',
                'type',
                'executing_company'
            ),
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
        $quotation = Quotation::where(['id' => $id])->first();
        $movingjob = MovingJob::where(['id' => $quotation->moving_job_id])->first();

        $request->validate([
            $field =>  'required|string|max:125',
        ]);

        if ($field === "validity_duratation") {
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

    public function updateInvoice(Request $request, $id, $field)
    {
        $invoice = Invoice::where(['id' => $id])->first();
        $movingjob = MovingJob::where(['id' => $invoice->moving_job_id])->first();

        $request->validate([
            $field =>  'required|string|max:125',
        ]);

        if ($field == "type") {
            $invoice->update([
                $field => $request->$field,
            ]);
        } else if ($field == "amount_ht") {
            $invoice->update([
                $field => $request->$field,
            ]);
        } else if ($field == "executing_company") {
            $invoice->update([
                $field => $request->$field,
            ]);
        } else {
            $movingjob->update([
                $field => $request->$field,
            ]);
        }
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
