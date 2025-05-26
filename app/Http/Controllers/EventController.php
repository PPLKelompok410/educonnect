<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('event_date', 'asc')->get();

        return view('events', compact('events'));
    }

    public function show(Event $event)
    {
        return view('event-detail', compact('event'));
    }

    public function getUpcomingEvents($limit = 6)
    {
        $upcomingEvents = Event::where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->limit($limit)
            ->get();

        return response()->json($upcomingEvents);
    }

}