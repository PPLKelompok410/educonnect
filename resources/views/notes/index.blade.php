@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-dark">📚 {{ $matkul->nama }}</h1>
        <a href="{{ route('notes.create', $matkul->id) }}" class="btn btn-success rounded-pill px-4 shadow-sm">
            + Tambah Catatan
        </a>
    </div>

    {{-- Daftar Catatan --}}
    <div class="row">
        @foreach ($notes as $note)
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm rounded-4">
                    {{-- Preview Gambar --}}
                    @if ($note->image_path)
                        <img src="{{ asset('storage/' . $note->image_path) }}" class="card-img-top rounded-top-4" alt="Preview {{ $note->judul }}">
                    @else
                        <img src="{{ asset('images/default-note.png') }}" class="card-img-top rounded-top-4" alt="Default Preview">
                    @endif
                    <h5 class="fw-bold text-dark mb-2">{{ $note->judul }}</h5>
                        {{-- Tombol Tambah Catatan & Forum Diskusi --}}
                        <div class="d-flex gap-2 mb-4">
                            <a href="{{ route('notes.create', $matkul->id) }}" class="btn btn-success">
                                Tambah Catatan
                            </a>
                            <a href="{{ route('matkul.discussion', $matkul->id) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-comments"></i> Forum Diskusi
                            </a>
                        </div>

                        {{-- Informasi Dibagikan Oleh --}}
                        <p class="text-muted mb-1" style="font-size: 0.9rem;">
                            Dibagikan oleh: <strong>{{ $note->user->name }}</strong>
                        </p>

                        {{-- Tanggal --}}
                        <p class="text-muted mb-3" style="font-size: 0.85rem;">
                            {{ $note->created_at->format('d M Y') }}
                        </p>

                        {{-- Rating --}}
                        <div class="mb-3">
                            @if ($note->rating)
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $note->rating)
                                        <i class="fas fa-star text-warning"></i> {{-- Bintang penuh --}}
                                    @else
                                        <i class="far fa-star text-warning"></i> {{-- Bintang kosong --}}
                                    @endif
                                @endfor
                            @else
                                <span class="text-muted" style="font-size: 0.85rem;">Belum ada rating</span>
                            @endif
                        </div>

                        {{-- Tombol Lihat --}}
                        <a href="{{ route('notes.show', $note->id) }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
