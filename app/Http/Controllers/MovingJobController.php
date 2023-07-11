<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\MovingJob;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MovingJobController extends Controller
{
    //

    /*
     * Display the user's profile form.
     */
    public function quotation(Request $request): Response
    {
        $organization = $request->user()->organization;
        $movingjob = MovingJob::create([]);
        $quotation = Quotation::create(['organization_id' => $organization->id]);
        $quotation->movingJob()->associate($movingjob);
        $quotation->save();
        $organization = $request->user()->organization;

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

        if($field == "validity_duration"){
            $quotation->update([
                $field => $request->$field,
            ]);
        }else{
            $movingjob->update([
                $field => $request->$field,
            ]);
        }
    }

    /*public function updateMovingJob(Request $request, $id, $field)
    {
        $request->validate([
            $field =>  'required|string|max:125',
        ]);

        if($field == "validity_duration"){

        }else{
        
            $movingjob = MovingJob::where(['id' => $id])->first();

            $movingjob->update([
                $field => $request->$field,
            ]);
        }

        return Redirect::to('/');
    }*/
}
