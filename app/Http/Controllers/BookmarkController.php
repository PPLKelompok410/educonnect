<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarks = Bookmark::with('note.user')
            ->where('user_id', session('user')->id)
            ->latest()
            ->get();

        return view('bookmarks.index', compact('bookmarks'));
    }

    public function toggle(Note $note)
    {
        $user_id = session('user')->id;
        $bookmark = Bookmark::where('user_id', $user_id)
            ->where('note_id', $note->id)
            ->first();

        if ($bookmark) {
            // Hapus bookmark
            $bookmark->delete();
            return response()->json(['status' => 'removed']);
        }

        // Tambah bookmark
        Bookmark::create([
            'user_id' => $user_id,
            'note_id' => $note->id
        ]);

        return response()->json(['status' => 'added']);
    }

}