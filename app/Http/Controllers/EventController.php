<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pengguna;

class EventController extends Controller
{
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->route('auth.login');
        }

        $events = Event::orderBy('event_date', 'asc')->get();
        $user = Pengguna::find(session('user_id'));

        return view('events', compact('events', 'user'));
    }

    public function show(Event $event)
    {
        $user = Pengguna::find(session('user_id'));
        return view('event-detail', compact('event', 'user'));
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
