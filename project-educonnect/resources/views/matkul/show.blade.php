<h3>Comments</h3>
@foreach($matkul->comments as $comment)
    <div>
        <p>{{ $comment->comment }}</p>
        <small>by {{ $comment->user->name }} at {{ $comment->created_at }}</small>
        
        <!-- Hanya pengguna yang membuat komentar yang bisa mengedit atau menghapusnya -->
        @if(Auth::id() == $comment->user_id)
            <a href="{{ route('comments.edit', $comment->id) }}">Edit</a>
            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        @endif
    </div>
@endforeach

<h3>Add a Comment</h3>
<form action="{{ route('comments.store', $matkul->id) }}" method="POST">
    @csrf
    <textarea name="comment" required></textarea>
    <button type="submit">Post Comment</button>
</form>
