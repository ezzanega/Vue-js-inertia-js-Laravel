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
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function redirect(Request $request)
    {
        return Redirect::to('/6dem/dashboard ');
    }

    public function index(Request $request): Response
    {
        $organization = Organization::where('id', $request->user()->organization->id)->with('billingAddress')->first();
        $quotations = Quotation::where('organization_id', $organization->id)->with(['movingJob.client', 'movingJob.client.clientOrganization'])->latest()->take(4)->get();
        $waybills = Waybill::where('organization_id', $organization->id)->with(['movingJob.client', 'movingJob.client.clientOrganization'])->latest()->take(4)->get();
        $invoices = Invoice::where('organization_id', $organization->id)->with(['movingJob.client', 'movingJob.client.clientOrganization'])->latest()->take(4)->get();
        $now = Carbon::now();
        $nextMovings = CalendarEvent::where('type', EventType::MOVING)->where('start', '>=', $now)->orderBy('start', 'asc')->limit(4)->get();
        $nextMeetings = CalendarEvent::where('type', EventType::MEETING)->where('start', '>=', $now)->orderBy('start', 'asc')->limit(4)->get();
        return Inertia::render('6dem/Dashboard', [
            'organization' => $organization,
            'quotations' => $quotations,
            'waybills' => $waybills,
            'invoices' => $invoices,
            'nextMovings' => $nextMovings,
            'nextMeetings' => $nextMeetings,
        ]);
    }
}
