<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Invoice;
use App\Models\Waybill;
use App\Models\Quotation;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\CalendarEvent;
use Illuminate\Support\Carbon;
use App\Models\Enums\EventType;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
class AdminController extends Controller
{

    public function index(Request $request): Response
    {
        $usersWithOrganizations = User::with('organization','roles')->get();
        // $organization = Organization::where('id',$users->organization->id)->with('billingAddress')->first();
        return Inertia::render('6dem/Admin', [
            'usersWithOrganizations'=>$usersWithOrganizations,
        ]);
    }
}
