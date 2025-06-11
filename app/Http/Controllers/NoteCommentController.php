<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NoteComment;
use App\Models\Note;

class NoteCommentController
{
    public function store(Request $request, $noteId)
    {
        if (!session()->has('user_id')) {
            return redirect()->route('auth.login');
        }

        $request->validate([
            'content' => 'required|string',
        ]);

        NoteComment::create([
            'note_id' => $noteId,
            'user_id' => session('user_id'),
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function update(Request $request, NoteComment $comment)
    {
        $comment->update([
            'content' => $request->input('content')
        ]);

        return redirect()->route('notes.show', $comment->note_id)->with('success', 'Komentar diperbarui!');
    }

    public function destroy($id)
    {
        $comment = NoteComment::findOrFail($id);

        // Aktifin lagi kalau udah ada fitur login
        // if ($comment->user_id !== auth()->id()) {
        //     abort(403);
        // } 

        $comment->delete();

        return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }
}
