<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();

        foreach ($events as $event) {
            $event->image_url = $event->image ? url('storage/' . $event->image) : null;
        }

        return view('admin.index', compact('events'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date|after:now',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = $request->only(['title', 'description', 'event_date']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('events', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        Event::create($data);

        return redirect()->route('admin.index')->with('success', 'Event berhasil dibuat!');
    }

    public function show(Event $event)
    {
        $event->image_url = $event->image ? url('storage/' . $event->image) : null;

        return view('admin.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $event->image_url = $event->image ? url('storage/' . $event->image) : null;

        return view('admin.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date|after:now',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = $request->only(['title', 'description', 'event_date']);

        if ($request->hasFile('image')) {
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('events', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        $event->update($data);

        return redirect()->route('admin.index')->with('success', 'Event berhasil diupdate!');
    }

    public function destroy(Event $event)
    {
        if ($event->image && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('admin.index')->with('success', 'Event berhasil dihapus!');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout(); // Logout user dari sistem
        request()->session()->invalidate(); // Hapus session
        request()->session()->regenerateToken(); // Regenerasi CSRF token

        return redirect('/login')->with('status', 'You have been logged out.');
    }
}
