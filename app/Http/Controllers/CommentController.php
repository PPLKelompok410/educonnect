<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Auth;

class CommentController
{
    public function store(Request $request, $matkulId)
    {
        if (!session()->has('user_id')) {
            return redirect()->route('auth.login');
        }

        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $matkul = MataKuliah::findOrFail($matkulId);
        $user = Pengguna::find(session('user_id'));

        // Ambil user_id dari session
        $userId = session('user_id');

        // Menyimpan komentar baru
        $comment = new Comment();
        $comment->matkul_id = $matkul->id;
        $comment->user_id = $userId; // Gunakan user_id dari session
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->route('matkul.discussion', $matkulId)
            ->with('success', 'Comment added successfully');
    }

    public function edit($id) 
    {
        // Check if user is logged in
        if (!session()->has('user_id')) {
            return redirect()->route('auth.login');
        }

        $comment = Comment::findOrFail($id);
        $user = Pengguna::find(session('user_id'));

        // Validate comment ownership
        if ($comment->user_id !== session('user_id')) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengedit komentar ini');
        }

        return view('comments.edit', compact('comment', 'user'));
    }

    public function update(Request $request, $id)
    {
        // Check if user is logged in
        if (!session()->has('user_id')) {
            return redirect()->route('auth.login');
        }

        $comment = Comment::findOrFail($id);

        // Validate comment ownership
        if ($comment->user_id !== session('user_id')) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengedit komentar ini');
        }

        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->route('matkul.discussion', $comment->matkul_id)
            ->with('success', 'Komentar berhasil diperbarui');
    }

    public function destroy($id)
    {
        if (!session()->has('user_id')) {
            return redirect()->route('auth.login');
        }

        $comment = Comment::findOrFail($id);

        // Validasi kepemilikan komentar
        if ($comment->user_id !== session('user_id')) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $matkulId = $comment->matkul_id;
        $comment->delete();

        return redirect()->route('matkul.discussion', $matkulId)
            ->with('success', 'Comment deleted successfully');
    }
}
