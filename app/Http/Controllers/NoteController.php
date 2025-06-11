<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\MataKuliah;
use App\Models\NoteRating;
use App\Models\NoteFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class NoteController
{
    public function index(MataKuliah $matkul)
    {
        if (!session()->has('user')) {
            return redirect()->route('auth.login');
        }

        $notes = Note::with(['user', 'bookmarks'])
            ->where('matkul_id', $matkul->id)
            ->where('type', 'galeri')
            ->latest()
            ->get();

        return view('notes.index', compact('notes', 'matkul'));
    }

    public function create(MataKuliah $matkul)
    {
        if (!session()->has('user')) {
            return redirect()->route('auth.login');
        }

        return view('notes.create', compact('matkul'));
    }

    public function store(Request $request, MataKuliah $matkul)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'files.*' => 'required|file|mimes:jpeg,png,jpg,gif,pdf|max:10240', // max 10MB
        ]);

        // Buat Note dulu
        $note = Note::create([
            'user_id' => session('user')->id,
            'judul' => $request->judul,
            'matkul_id' => $matkul->id,
            'deskripsi' => $request->deskripsi,
        ]);

        foreach ($request->file('files') as $file) {
            // Buat nama unik
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Pindahkan file ke public/uploads/catatan
            $file->move(public_path('uploads/catatan'), $filename);

            // Simpan path relatif ke DB
            $note->files()->create([
                'file_path' => 'uploads/catatan/' . $filename
            ]);
        }

        return redirect()->route('notes.index', $note->matkul_id)->with('success', 'Catatan berhasil dibuat.');
    }


    public function show($id)
    {
        if (!session()->has('user')) {
            return redirect()->route('auth.login');
        }

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
            'deskripsi' => 'nullable|string|max:1000',
            'new_files.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:10240', // max 10MB
            'deleted_files' => 'nullable|json', // karena dikirim sebagai JSON string
        ]);

        // Proses file yang dihapus
        if ($request->filled('deleted_files')) {
            $deletedFileIds = json_decode($request->deleted_files, true);
            if (is_array($deletedFileIds) && !empty($deletedFileIds)) {
                $filesToDelete = $note->files()->whereIn('id', $deletedFileIds)->get();
                foreach ($filesToDelete as $file) {
                    // Hapus file dari storage
                    if (file_exists(public_path($file->file_path))) {
                        unlink(public_path($file->file_path));
                    }
                    $file->delete(); // Hapus dari DB
                }
            }
        }

        if ($request->hasFile('new_files')) {
            foreach ($request->file('new_files') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Pindahkan file ke public/uploads/catatan
                $file->move(public_path('uploads/catatan'), $filename);

                // Simpan path relatif ke DB
                $note->files()->create([
                    'file_path' => 'uploads/catatan/' . $filename
                ]);
            }
        }

        $note->judul = $request->judul;
        $note->deskripsi = $request->deskripsi;
        $note->save();

        return redirect()->route('notes.show', $note->id)->with('success', 'Gambar berhasil diperbarui.');
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
