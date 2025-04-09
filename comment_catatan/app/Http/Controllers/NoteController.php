<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::with('user')->latest()->get();
        return view('notes.index', compact('notes'));
    }

    public function show($id)
    {
        $note = Note::with('comments')->findOrFail($id);

        return view('notes.show', compact('note'));
    }
}
