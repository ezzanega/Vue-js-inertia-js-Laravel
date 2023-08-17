<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function redirect(Request $request)
    {
        return Redirect::to('/6dem/dashboard ');
    }

    public function index(Request $request): Response
    {
        return Inertia::render('6dem/Dashboard', ['organization' => Organization::where('id', $request->user()->organization->id)->with('billingAddress')->first()]);
    }
}
