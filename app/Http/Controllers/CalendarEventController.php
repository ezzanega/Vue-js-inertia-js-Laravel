<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalendarEvent;

class CalendarEventController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->get('start');
        $end = $request->get('end');

        $events = CalendarEvent::whereBetween('start', [$start, $end])->get();

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $event = CalendarEvent::create($request->all());
        return response()->json($event, 201);
    }
}
