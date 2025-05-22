@extends('layouts.app')

@section('title', 'Forum Diskusi (' . $matkul->nama . ')')

@section('content')
<div class="container px-3 px-md-5 mt-5">
    <div class="border rounded p-4 mb-4 bg-light shadow-sm">
        <h2 class="mb-2">
            <i class="bi bi-chat-dots"></i> Forum Diskusi: 
            <span class="text-primary">{{ $matkul->nama }}</span>
        </h2>
        <p class="mb-0 text-muted">
            <i class="bi bi-journal-code"></i> Kode: {{ $matkul->kode }} | 
            <i class="bi bi-building"></i> Prodi: {{ $matkul->prodi }}
        </p>
    </div>

    <h4 class="mb-3"><i class="bi bi-chat-left-text"></i> Komentar</h4>

    @forelse($matkul->comments as $comment)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <p class="card-text">{{ $comment->comment }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        oleh <strong>{{ $comment->user->name }}</strong> pada {{ $comment->created_at->format('d M Y, H:i') }}
                    </small>

                    {{-- @if(Auth::id() === $comment->user_id) --}}
                        <div>
                            <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-outline-primary me-2">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus komentar ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">💬 Belum ada komentar. Jadilah yang pertama!</p>
    @endforelse

    <hr>

    <div class="mt-4">
        <h4><i class="bi bi-plus-circle"></i> Tambah Komentar</h4>
        <form action="{{ route('comments.store', $matkul->id) }}" method="POST" class="mt-3">
            @csrf
            <div class="mb-3">
                <label for="comment" class="form-label">Komentar</label>
                <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Tulis komentarmu..." required></textarea>
            </div>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-send"></i> Kirim Komentar
            </button>
        </form>
    </div>
</div>
@endsection
