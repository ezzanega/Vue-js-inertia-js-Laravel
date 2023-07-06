<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Models\MovingJob;
use App\Models\Quotation;

class MovingJobController extends Controller
{
    //

    /*
     * Display the user's profile form.
     */
    public function quotation(Request $request): Response
    {
        $movingjob = MovingJob::create(['organization_id' => $request->user()->organization->organization_id]);
        $quotation = Quotation::create(['moving_job_id' => $movingjob->id]);

        return Inertia::render('6dem/Devis', [
            'organization' => $request->user()->organization,
            'status' => session('status'),
        ]);
    }

    public function updateQuotation(Request $request, $id)
    {
        $quotation = Quotation::where(['id' => $id])->first();
        $movingjob = MovingJob::where(['id' => $quotation->moving_job_id])->first();

        $movingjob->capacity = $request->capacity;
        $movingjob->formula = $request->formula;
        $movingjob->volume = $request->volume;
        $movingjob->loading_address = $request->loading_address;
        $movingjob->loading_date = $request->loading_date;
        $movingjob->loading_floor = $request->loading_floor;
        $movingjob->loading_elevator = $request->rolloading_elevatoreName;
        $movingjob->loading_portaging = $request->loading_portaging;
        $movingjob->loading_details = $request->loading_details;
        $movingjob->shipping_address = $request->shipping_address;
        $movingjob->shipping_date = $request->shipping_date;
        $movingjob->shipping_floor = $request->shipping_floor;
        $movingjob->shipping_elevator = $request->shipping_elevator;
        $movingjob->shipping_portaging = $request->shipping_portaging;
        $movingjob->shipping_details = $request->shipping_details;
        $movingjob->discount_percentage = $request->discount_percentage;
        $movingjob->discount_amount_ht = $request->discount_amount_ht;
        $movingjob->advance = $request->advance;
        $movingjob->balance = $request->balance;

        $quotation->name = $request->validity_duratation;

        $movingjob->save();
        $quotation->save();
    }
}
