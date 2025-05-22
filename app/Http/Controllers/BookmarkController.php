<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Note;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarks = Bookmark::with(['note.user', 'note.matkul'])
            ->where('user_id', session('user')->id)
            ->latest()
            ->get();

        return view('bookmarks.index', compact('bookmarks'));
    }

    public function store(Note $note)
    {
        $userId = session('user')->id;
        
        $bookmark = Bookmark::firstOrCreate([
            'user_id' => $userId,
            'note_id' => $note->id
        ]);

        return redirect()->back()->with('success', 'Note berhasil ditambahkan ke bookmark.');
    }

    public function destroy(Bookmark $bookmark)
    {
        if ($bookmark->user_id !== session('user')->id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $bookmark->delete();
        return redirect()->back()->with('success', 'Note berhasil dihapus dari bookmark.');
    }
}