@extends('layouts.app')

@section('title', 'Edit Komentar')

@section('content')

<div class="container d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <h3 class="text-center mb-4">Edit Comment</h3>
        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea name="comment" id="comment" class="form-control" rows="4" required>{{ $comment->comment }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Comment</button>
        </form>
    </div>
</div>

@endsection
