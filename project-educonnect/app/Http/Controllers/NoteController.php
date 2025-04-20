<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Models\MataKuliah;

class NoteController extends Controller
{
    public function index(MataKuliah $matkul)
    {
        $notes = Note::with('user')
                    ->where('matkul_id', $matkul->id)
                    ->latest()
                    ->get();

        return view('notes.index', compact('notes', 'matkul'));
    }

    public function show($id)
    {
        $note = Note::findOrFail($id);  
        return view('notes.show', compact('note')); 
    }
}
