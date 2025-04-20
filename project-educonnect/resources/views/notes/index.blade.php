@extends('layouts.app')

@section('content')
<div class="container px-3 px-md-5 my-5">

    {{-- Judul Halaman --}}
    <h2 class="mb-4 text-success">
        <i class="fas fa-folder-open"></i> Daftar Catatan – <span class="text-dark">{{ $matkul->nama }}</span>
    </h2>

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
                            <a href="{{ route('notes.show', $note->id) }}" class="btn btn-outline-primary btn-sm mt-auto">
                                <i class="fas fa-eye"></i> Lihat Catatan
                            </a>
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
