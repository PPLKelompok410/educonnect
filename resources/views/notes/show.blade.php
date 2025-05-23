@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fas fa-sticky-note text-green-500"></i> {{ $note->judul }}
        </h2>
        <div class="flex gap-2">
            <a href="{{ route('notes.edit', $note->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-full shadow text-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full shadow text-sm">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    {{-- Informasi Catatan --}}
    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <p class="mb-4 text-sm text-gray-700">
            <strong>File Catatan:</strong>
            <a href="{{ asset('storage/' . $note->file_path) }}" target="_blank" class="underline text-blue-600 hover:text-blue-800">Lihat File</a>
        </p>

        {{-- Preview Gambar --}}
        <div class="text-center mb-4">
            <img src="{{ asset('storage/' . $note->file_path) }}" alt="Preview Catatan" class="rounded-lg shadow max-w-full h-auto">
        </div>

        <p class="text-sm text-gray-500">
            🗓️ Dibagikan oleh: <strong>{{ $note->user->full_name ?? 'Anonymous' }}</strong> | {{ $note->created_at->format('d M Y') }}
        </p>
    </div>

    {{-- Form Give Rating --}}
    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <h5 class="text-lg font-semibold text-gray-800 mb-3">Berikan Rating</h5>
        <form action="{{ route('notes.rate', $note->id) }}" method="POST" class="flex items-center gap-2">
            @csrf
            <select name="rating" class="border rounded-lg px-3 py-2 text-sm text-gray-700" required>
                <option value="" disabled selected>Pilih Rating</option>
                <option value="1">1 - Sangat Buruk</option>
                <option value="2">2 - Buruk</option>
                <option value="3">3 - Cukup</option>
                <option value="4">4 - Baik</option>
                <option value="5">5 - Sangat Baik</option>
            </select>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full shadow text-sm">Kirim</button>
        </form>

        @if ($note->rating)
            <div class="mt-4">
                <p class="text-sm text-gray-600">Rating saat ini:
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $note->rating)
                            <i class="fas fa-star text-yellow-400"></i>
                        @else
                            <i class="far fa-star text-yellow-400"></i>
                        @endif
                    @endfor
                </p>
            </div>
        @endif
    </div>

    {{-- Komentar --}}
    <div class="bg-white rounded-2xl shadow p-6">
        <h5 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="bi bi-chat-left-text"></i> Komentar
        </h5>

        {{-- Form Tambah Komentar --}}
        <form method="POST" action="{{ route('note-comments.store', ['note' => $note->id]) }}" class="mb-6">
            @csrf
            <textarea name="content" rows="3" class="w-full border rounded-xl p-3 text-sm text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Tulis komentar..." required></textarea>
            <button type="submit" class="mt-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full shadow text-sm">
                <i class="bi bi-send"></i> Kirim
            </button>
        </form>

        {{-- Daftar Komentar --}}
        @forelse($note->comments as $comment)
            <div class="bg-gray-50 rounded-xl p-4 mb-4 shadow-sm">
                <strong class="text-gray-800">{{ $comment->user->name ?? 'Anonim' }}</strong>
                <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                <p class="mt-2 text-sm text-gray-700">{{ $comment->content }}</p>
            </div>
        @empty
            <p class="text-gray-500 text-sm">💬 Belum ada komentar. Jadilah yang pertama!</p>
        @endforelse
    </div>
</div>
@endsection
