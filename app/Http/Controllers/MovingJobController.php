<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class MovingJobController extends Controller
{
    //

    /*
     * Display the user's profile form.
     */
    public function quotation(Request $request): Response
    {
        return Inertia::render('6dem/Devis', [
            'organization' => $request->user()->organization,
            'status' => session('status'),
        ]);
    }
}
