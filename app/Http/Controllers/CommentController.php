<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $matkulId)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $matkul = MataKuliah::findOrFail($matkulId);

        // Menyimpan komentar baru
        $comment = new Comment();
        $comment->matkul_id = $matkul->id;
        $comment->user_id = 1;  // tunggu fitur login baru pakai Auth::id();
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->route('matkul.discussion', $matkulId)->with('success', 'Comment added successfully');
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->route('matkul.discussion', $comment->matkul_id)->with('success', 'Comment updated successfully');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $matkulId = $comment->matkul_id;
        $comment->delete();

        return redirect()->route('matkul.discussion', $matkulId)->with('success', 'Comment deleted successfully');
    }
}
