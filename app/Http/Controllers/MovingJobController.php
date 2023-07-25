<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Client;
use App\Models\Option;
use App\Models\Waybill;
use App\Models\Settings;
use App\Models\Insurance;
use App\Models\MovingJob;
use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Models\AdditionalField;
use App\Models\Enums\OptionType;
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
        $quotation = Quotation::create(['organization_id' => $organization->id]);
        $option = Option::create([
            'type' => OptionType::OTHER,
            'designation' => '',
            'quantity' => '',
            'unit' => 0,
            'price_ht' => ''
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
        $waybill = Waybill::create(['organization_id' => $organization->id]);

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

    public function quotation(Request $request, $movingjobId, $clientId, $quotationId, $optionId): Response
    {
        $organization = $request->user()->organization;
        $client = Client::where('id', $clientId)->with('clientOrganization')->first();
        $movingjob = MovingJob::find($movingjobId);
        $quotation = Quotation::find($quotationId);
        $options = Option::where('moving_job_id', $movingjobId)->get();
        $insurance = Insurance::where(['organization_id' => $organization->id])->get();
        $settings = Settings::where('organization_id', $organization->id)->first();

        return Inertia::render('6dem/Devis', [
            'organization' => $organization->only(
                'id',
                'name',
                'siret',
                'siren',
                'address',
                'billing_address',
                'owner_id'
            ),
            'additionalFields' => [],
            'quotation' => $quotation->only(
                'id',
                'number',
                'validity_duratation'
            ),
            'insurances' => $insurance,
            'settings' => $settings,
            'movingJob' => $movingjob->only(
                'id',
                'capacity',
                'formula',
                'loading_address',
                'loading_date',
                'loading_floor',
                'loading_elevator',
                'loading_portaging',
                'loading_details',
                'shipping_address',
                'shipping_date',
                'shipping_floor',
                'shipping_elevator',
                'shipping_portaging',
                'shipping_details',
                'discount_percentage',
                'discount_amount_ht',
                'advance',
                'balance',
            ),
            'options' => $options,
            'client' => $client->only(
                'id',
                'type',
                'last_name',
                'first_name',
                'phone_number',
                'email',
                'address',
                'source',
                'client_organization'
            ),
            'status' => session('status'),
        ]);
    }

    public function waybill(Request $request, $movingjobId, $clientId, $waybillId): Response
    {
        $organization = $request->user()->organization;
        $client = Client::where('id', $clientId)->with('clientOrganization')->first();
        $movingjob = MovingJob::find($movingjobId);
        $additionalFields = AdditionalField::where('moving_job_id', $movingjobId)->get();
        $options = Option::where('moving_job_id', $movingjobId)->get();
        $waybill = Quotation::find($waybillId);
        $insurance = Insurance::where(['organization_id' => $organization->id])->get();
        $settings = Settings::where('organization_id', $organization->id)->first();

        return Inertia::render('6dem/Lettre de voiture', [
            'organization' => $organization->only(
                'id',
                'name',
                'siret',
                'siren',
                'address',
                'billing_address',
                'owner_id'
            ),
            'waybill' => $waybill->only(
                'id',
                'number',
                'executing_company'
            ),
            'additionalFields' => $additionalFields,
            'insurances' => $insurance,
            'settings' => $settings,
            'options' => $options,
            'movingJob' => $movingjob->only(
                'id',
                'capacity',
                'formula',
                'loading_address',
                'loading_date',
                'loading_floor',
                'loading_elevator',
                'loading_portaging',
                'loading_details',
                'shipping_address',
                'shipping_date',
                'shipping_floor',
                'shipping_elevator',
                'shipping_portaging',
                'shipping_details',
                'discount_percentage',
                'discount_amount_ht',
                'advance',
                'balance',
            ),
            'client' => $client->only(
                'id',
                'type',
                'last_name',
                'first_name',
                'phone_number',
                'email',
                'address',
                'source',
                'client_organization'
            ),
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

        if ($field === "validity_duration") {
            $quotation->update([
                $field => $request->$field,
            ]);
        } else {
            $movingjob->update([
                $field => $request->$field,
            ]);
        }
    }

    public function updateWaybill(Request $request, $id, $field)
    {
        $waybill = Waybill::where(['id' => $id])->first();
        $movingjob = MovingJob::where(['id' => $waybill->moving_job_id])->first();

        $request->validate([
            $field =>  'required|string|max:125',
        ]);

        if ($field == "validity_duration") {
            $waybill->update([
                $field => $request->$field,
            ]);
        } else {
            $movingjob->update([
                $field => $request->$field,
            ]);
        }
    }
}
