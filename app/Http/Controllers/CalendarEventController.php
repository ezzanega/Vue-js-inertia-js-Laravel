<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Models\CalendarEvent;

class CalendarEventController extends Controller
{
    public function index(Request $request)
    {
        $organization = $request->user()->organization;
        $settings = Settings::where('organization_id', $organization->id)->first();
        return Inertia::render('6dem/Calendar', [
            'settings' => $settings,
        ]);
    }

    public function events(Request $request)
    {
        $organization = $request->user()->organization;
        $start = $request->get('start');
        $end = $request->get('end');

        $events = CalendarEvent::where('organization_id', $organization->id)->whereBetween('start', [$start, $end])->get();

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $organization = $request->user()->organization;
        $eventData = $request->all();
        $eventData['organization_id'] = $organization->id;
        $event = CalendarEvent::create($eventData);
        return response()->json($event, 201);
    }
}
