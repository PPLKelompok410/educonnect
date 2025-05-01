@extends('layouts.app')

@section('content')
<div class="container px-3 px-md-5 my-5">

    {{-- Judul Halaman --}}
    <h2 class="mb-4 text-success">
        <i class="fas fa-folder-open"></i> Daftar Catatan – <span class="text-dark">{{ $matkul->nama }}</span>
    </h2>

    {{-- Tombol Tambah Catatan & Forum Diskusi --}}
    <div class="d-flex gap-2 mb-4">
        <a href="{{ route('notes.create', $matkul->id) }}" class="btn btn-success">
            Tambah Catatan
        </a>
        <a href="{{ route('matkul.discussion', $matkul->id) }}" class="btn btn-outline-secondary">
            <i class="fas fa-comments"></i> Forum Diskusi
        </a>
    </div>


    @if ($notes->count() > 0)
        <div class="row">
            @foreach ($notes as $note)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">{{ $note->judul }}</h5>
                                <p class="card-text mb-2">
                                    Dibagikan oleh: <strong>{{ $note->user->full_name }}</strong><br>
                                    <small class="text-muted">{{ $note->created_at->format('d M Y') }}</small>
                                </p>
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="mt-auto">
                                <a href="{{ route('notes.show', $note->id) }}" class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>

                                @if(optional(auth()->user())->id == $note->user_id)
                                    <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-warning btn-sm me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('notes.destroy', $note->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">Belum ada catatan yang dibagikan.</p>
    @endif

</div>
@endsection
