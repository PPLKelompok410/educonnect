<h3>Edit Comment</h3>
<form action="{{ route('comments.update', $comment->id) }}" method="POST">
    @csrf
    @method('PUT')
    <textarea name="comment" required>{{ $comment->comment }}</textarea>
    <button type="submit">Update Comment</button>
</form>
