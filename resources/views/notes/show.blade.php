@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">
            <i class="fas fa-sticky-note text-success"></i> {{ $note->judul }}
        </h2>
        <div>
            <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-warning rounded-pill px-4 shadow-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('notes.destroy', $note->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger rounded-pill px-4 shadow-sm">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    {{-- Informasi Catatan --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body">
            <p class="mb-3">
                <strong>File Catatan:</strong>
                <a href="{{ asset('storage/' . $note->file_path) }}" target="_blank" class="text-decoration-underline">Lihat File</a>
            </p>

            {{-- Preview Gambar --}}
            <div class="text-center mb-3">
                <img src="{{ asset('storage/' . $note->file_path) }}" alt="Preview Catatan" class="img-fluid rounded shadow-sm" style="max-width: 100%; height: auto;">
            </div>

            <p class="text-muted">
                🗓️ Dibagikan oleh: <strong>{{ $note->user->full_name ?? 'Anonymous' }}</strong> | {{ $note->created_at->format('d M Y') }}
            </p>
        </div>
    </div>

    {{-- Form Give Rating --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body">
            <h5 class="fw-bold text-dark">Berikan Rating</h5>
            <form action="{{ route('notes.rate', $note->id) }}" method="POST">
                @csrf
                <div class="d-flex align-items-center gap-2">
                    <select name="rating" class="form-select w-auto" required>
                        <option value="" disabled selected>Pilih Rating</option>
                        <option value="1">1 - Sangat Buruk</option>
                        <option value="2">2 - Buruk</option>
                        <option value="3">3 - Cukup</option>
                        <option value="4">4 - Baik</option>
                        <option value="5">5 - Sangat Baik</option>
                    </select>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Kirim</button>
                </div>
            </form>

            {{-- Tampilkan Rating Saat Ini --}}
            @if ($note->rating)
                <div class="mt-3">
                    <p class="text-muted">Rating saat ini: 
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $note->rating)
                                <i class="fas fa-star text-warning"></i>
                            @else
                                <i class="far fa-star text-warning"></i>
                            @endif
                        @endfor
                    </p>
                </div>
            @endif
        </div>
    </div>

    {{-- Komentar --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-bold text-dark mb-3">
                <i class="bi bi-chat-left-text"></i> Komentar
            </h5>

            {{-- Form Tambah Komentar --}}
            <form method="POST" action="{{ route('note-comments.store', ['note' => $note->id]) }}" class="mb-4">
                @csrf
                <div class="mb-3">
                    <textarea name="content" class="form-control rounded-4 shadow-sm" rows="3" placeholder="Tulis komentar..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                    <i class="bi bi-send"></i> Kirim
                </button>
            </form>

            {{-- Daftar Komentar --}}
            @foreach($note->comments as $comment)
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body">
                        <strong>{{ $comment->user->name ?? 'Anonim' }}</strong>
                        <p class="text-muted mb-1" style="font-size: 0.85rem;">{{ $comment->created_at->diffForHumans() }}</p>
                        <p>{{ $comment->content }}</p>
                    </div>
                </div>
            @endforeach

            @if($note->comments->isEmpty())
                <p class="text-muted">💬 Belum ada komentar. Jadilah yang pertama!</p>
            @endif
        </div>
    </div>
</div>
@endsection
