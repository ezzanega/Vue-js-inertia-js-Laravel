<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\MovingJob;
use App\Models\Quotation;
use App\Models\Insurance;
use App\Models\Option;
use App\Models\Enums\OptionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MovingJobController extends Controller
{
    public function initQuotation(Request $request, $clientId)
    {
        $organization = $request->user()->organization;
        $client = Client::find($clientId);
        $movingjob = MovingJob::create([]);
        $quotation = Quotation::create(['organization_id' => $organization->id]);
        $insurance = Insurance::where(['organization_id' => $organization->id])->get();
        $option = Option::create([
            'type' => OptionType::OTHER,
            'designation' => '',
            'quantity' => '',
            'unit' => '',
            'price_ht' => '',
            'moving_job_id' => $movingjob->id,
        ]);
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


    public function quotation(Request $request, $movingjobId, $clientId, $quotationId, $optionId): Response
    {
        $organization = $request->user()->organization;
        $client = Client::where('id', $clientId)->with('clientOrganization')->first();
        $movingjob = MovingJob::find($movingjobId);
        $quotation = Quotation::find($quotationId);
        $quotation = Quotation::find($quotationId);
        $option = Option::find($optionId);

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
            'quotation' => $quotation->only(
                'id',
                'number',
                'validity_duratation'
            ),
            'insurances' => $insurance,
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
            'option' => $option->only(
                'id'
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

        if ($field == "validity_duration") {
            $quotation->update([
                $field => $request->$field,
            ]);
        } else {
            $movingjob->update([
                $field => $request->$field,
            ]);
        }
    }
}
