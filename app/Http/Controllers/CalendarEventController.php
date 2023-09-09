<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalendarEvent;

class CalendarEventController extends Controller
{
    public function index(Request $request)
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
