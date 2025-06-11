<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReplyController extends Controller
{
    use AuthorizesRequests;
    public function store(Request $request, $comment_id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        Reply::create([
            'comment_id' => $comment_id,
            'user_id' => session('user_id'),
            'reply' => $request->reply,
        ]);

        return back()->with('success', 'Balasan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $reply = Reply::findOrFail($id);
        $this->authorize('update', $reply); // optional policy
        return view('replies.edit', compact('reply'));
    }

    public function update(Request $request, $id)
    {
        $reply = Reply::findOrFail($id);
        $reply->update([
            'reply' => $request->reply,
        ]);
        return redirect()->back()->with('success', 'Balasan diperbarui.');
    }

    public function destroy($id)
    {
        $reply = Reply::findOrFail($id);
        $this->authorize('delete', $reply); // optional policy
        $reply->delete();
        return back()->with('success', 'Balasan dihapus.');
    }
}
