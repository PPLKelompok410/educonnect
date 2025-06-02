<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\MataKuliah;
use App\Models\NoteRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class NoteController
{
    public function index(MataKuliah $matkul)
    {
        $notes = Note::with('user')
            ->where('matkul_id', $matkul->id)
            ->where('type', 'galeri')
            ->latest()
            ->get();

        return view('notes.index', compact('notes', 'matkul'));
    }

    public function create(MataKuliah $matkul)
    {
        return view('notes.create', compact('matkul'));
    }

    public function store(Request $request, MataKuliah $matkul)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file_path' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $filePath = $request->file('file_path')->store('catatan', 'public');

        Note::create([
            'user_id' => session('user')->id,
            'judul' => $request->judul,
            'file_path' => $filePath,
            'matkul_id' => $matkul->id,
            'type' => 'galeri',
        ]);

        return redirect()->route('notes.index', $matkul)->with('success', 'Gambar berhasil ditambahkan.');
    }

    public function show($id)
    {
        $note = Note::findOrFail($id);
        return view('notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($note->file_path);
            $filePath = $request->file('file')->store('catatan', 'public');
            $note->file_path = $filePath;
        }

        $note->judul = $request->judul;
        $note->save();

        return redirect()->route('notes.index', $note->matkul_id)->with('success', 'Gambar berhasil diperbarui.');
    }

    public function destroy(Note $note)
    {
        // Hapus file catatan jika ada
        if ($note->file_path && Storage::disk('public')->exists($note->file_path)) {
            Storage::disk('public')->delete($note->file_path);
        }

        // Hapus catatan dari database
        $note->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('notes.index', $note->matkul_id)->with('success', 'Catatan berhasil dihapus.');
    }

    public function rate(Request $request, Note $note)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);
        $userId = session('user')->id;

        // Update or create rating
        NoteRating::updateOrCreate(
            ['note_id' => $note->id, 'user_id' => $userId],
            ['rating' => $request->rating]
        );

        // Optional: update average rating in notes table
        $note->rating = $note->averageRating();
        $note->save();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'rating' => $note->rating]);
        }

        return redirect()->back()->with('success', 'Rating berhasil diberikan.');
    }
}
