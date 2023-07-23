<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('6dem/Dashboard', ['organization' => Organization::where('id', $request->user()->organization->id)->with('billingAddress')->first()]);
    }
}
