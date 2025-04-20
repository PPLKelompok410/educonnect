@extends('layouts.app')

@section('content')
<div class="container px-3 px-md-5 my-5">

    {{-- Section Catatan --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h2 class="mb-3">
                <i class="fas fa-sticky-note text-success"></i> Catatan KSI
            </h2>
            <p>
                <strong>File Catatan:</strong>
                <a href="{{ asset('storage/images/IMG_1053.jpg') }}" target="_blank">Lihat File</a>
            </p>

            {{-- Preview Gambar --}}
            <img src="{{ asset('storage/images/IMG_1053.jpg') }}" alt="Preview Catatan" class="img-fluid mb-3" style="max-width: 400px;">

            <p class="text-muted">
                🗓️ Dibagikan oleh: <strong>Anonymous</strong> | {{ now()->format('d M Y') }}
            </p>
        </div>
    </div>

    {{-- Section Komentar --}}
    <h4 class="mb-3">
        <i class="bi bi-chat-left-text"></i> Komentar
    </h4>

    <form method="POST" action="{{ route('note-comments.store', ['note' => $note->id]) }}" class="mb-4">
        @csrf
        <div class="mb-3">
            <textarea name="content" class="form-control" rows="3" placeholder="Tulis komentar..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-send"></i> Kirim
        </button>
    </form>

    @foreach($note->comments as $comment)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <strong>{{ $comment->user->name ?? 'Anonim' }}</strong>

                @if(request()->get('edit') == $comment->id)
                    <form method="POST" action="{{ route('note-comments.update', $comment->id) }}" class="mt-2">
                        @csrf
                        @method('PUT')
                        <textarea name="content" class="form-control mb-2" required>{{ $comment->content }}</textarea>
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        <a href="{{ route('notes.show', $note->id) }}" class="btn btn-sm btn-secondary">Batal</a>
                    </form>
                @else
                    <p class="mb-1 mt-2">{{ $comment->content }}</p>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>

                    <div class="mt-2">
                        <a href="{{ route('notes.show', [$note->id, 'edit' => $comment->id]) }}" class="btn btn-sm btn-warning me-2">
                            Edit
                        </a>

                        <form action="{{ route('note-comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus komentar ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    @endforeach

    @if($note->comments->isEmpty())
        <p class="text-muted">💬 Belum ada komentar. Jadilah yang pertama!</p>
    @endif

</div>
@endsection
