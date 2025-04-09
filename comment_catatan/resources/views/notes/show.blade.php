@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2><i class="fas fa-sticky-note text-success"></i> Catatan KSI</h2>
            <p>File Catatan: <a href="{{ asset('storage/images/IMG_1053.jpg') }}" target="_blank">Lihat File</a></p>

            {{-- Preview Gambar --}}
            <img src="{{ asset('storage/images/IMG_1053.jpg') }}" alt="Preview Catatan" class="img-fluid mb-3" style="max-width: 400px;">

            <p>🗓️ Dibagikan oleh: Anonymous | {{ now()->format('d M Y') }}</p>

            <hr>

            {{-- Komentar --}}
            <h5>Komentar</h5>
            <form method="POST" action="{{ route('note-comments.store', ['note' => $note->id]) }}">
                @csrf
                <div class="mb-3">
                    <textarea name="content" class="form-control" rows="3" placeholder="Tulis komentar..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>

            <hr>

            @foreach($note->comments as $comment)
                <div class="border rounded p-2 mb-2">
                    <strong>{{ $comment->user->name ?? 'Anonim' }}</strong><br>

                    {{-- Jika sedang mengedit komentar --}}
                    @if(request()->get('edit') == $comment->id)
                        <form method="POST" action="{{ route('note-comments.update', $comment->id) }}">
                            @csrf
                            @method('PUT')
                            <textarea name="content" class="form-control mb-2">{{ $comment->content }}</textarea>
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                            <a href="{{ route('notes.show', $note->id) }}" class="btn btn-sm btn-secondary">Batal</a>
                        </form>
                    @else
                        {{ $comment->content }}
                        <div><small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small></div>

                        {{-- Tombol Edit dan Hapus --}}
                        <div class="mt-2">
                            <a href="{{ route('notes.show', [$note->id, 'edit' => $comment->id]) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('note-comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus komentar ini?')">Hapus</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
