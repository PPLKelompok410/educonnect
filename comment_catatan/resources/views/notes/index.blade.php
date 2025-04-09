@extends('layouts.app')

@section('content')
    <div class="my-5">
        <h2 class="text-success mb-4"><i class="fas fa-folder-open"></i> Daftar Catatan</h2>

        @if ($notes->count() > 0)
            <div class="row">
                @foreach ($notes as $note)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $note->judul }}</h5>
                                <p class="card-text">
                                    Dibagikan oleh: <strong>{{ $note->user->full_name }}</strong><br>
                                    <small class="text-muted">{{ $note->created_at->format('d M Y') }}</small>
                                </p>
                                <a href="{{ route('notes.show', $note->id) }}" class="btn btn-outline-primary btn-sm">
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
