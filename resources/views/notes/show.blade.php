@extends('layouts.app')

@section('content')

@php
$currentUser = session('user');
@endphp

<div class="max-w-4xl mx-auto py-8 px-4">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fas fa-sticky-note text-green-500"></i> {{ $note->judul }}
        </h2>
        @if ($currentUser && $note->user_id === $currentUser->id)
        <div class="flex gap-2">
            <a href="{{ route('notes.edit', $note->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded shadow text-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow text-sm">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </form>
        </div>
        @endif
    </div>

    {{-- Informasi Catatan --}}
    <div class="bg-white rounded shadow p-6 mb-6">
        <p class="mb-4 text-sm text-gray-700">
            <strong>File Catatan:</strong>
            <a href="{{ asset('storage/' . $note->file_path) }}" target="_blank" class="underline text-blue-600 hover:text-blue-800">Lihat File</a>
        </p>

        {{-- Preview Gambar --}}
        <div class="text-center mb-4">
            <img src="{{ asset('storage/' . $note->file_path) }}" alt="Preview Catatan" class="rounded shadow max-w-full h-auto">
        </div>

        <p class="text-sm text-gray-500">
            🗓️ Dibagikan oleh: <strong>{{ $note->user->full_name ?? 'Anonymous' }}</strong> | {{ $note->created_at->format('d M Y') }}
        </p>
    </div>

    {{-- Form Give Rating --}}
    <div class="bg-white rounded shadow p-6 mb-6">
        <h5 class="text-lg font-semibold text-gray-800 mb-3">Berikan Rating</h5>
        <form action="{{ route('notes.rate', $note->id) }}" method="POST" class="flex items-center gap-2">
            @csrf
            <select name="rating" class="border rounded px-3 py-2 text-sm text-gray-700" required>
                <option value="" disabled selected>Pilih Rating</option>
                <option value="1">1 - Sangat Buruk</option>
                <option value="2">2 - Buruk</option>
                <option value="3">3 - Cukup</option>
                <option value="4">4 - Baik</option>
                <option value="5">5 - Sangat Baik</option>
            </select>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-sm">Kirim</button>
        </form>

        @if ($note->rating && $note->rating > 0)
        <div class="mt-4">
            <p class="text-sm text-gray-600">
                Rating saat ini:
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <=$note->rating)
                    <i class="bi bi-star-fill text-warning"></i>
                    @else
                    <i class="bi bi-star text-warning"></i>
                    @endif
                    @endfor
            </p>
        </div>
        @else
        <div class="mt-4">
            <p class="text-sm text-gray-500">Belum ada rating</p>
        </div>
        @endif

    </div>

    {{-- Komentar --}}
    <div class="bg-white rounded shadow p-6">
        <h5 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="bi bi-chat-left-text"></i> Komentar
        </h5>

        {{-- Form Tambah Komentar --}}
        <form method="POST" action="{{ route('note-comments.store', ['note' => $note->id]) }}" class="mb-6">
            @csrf
            <textarea name="content" rows="3" class="w-full border rounded p-3 text-sm text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Tulis komentar..." required></textarea>
            <button type="submit" class="mt-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-sm">
                <i class="bi bi-send"></i> Kirim
            </button>
        </form>

        @forelse($note->comments as $comment)
        <div x-data="{ editing: false, editedContent: @js($comment->content) }" class="bg-gray-50 rounded p-4 mb-4 shadow-sm">
            <div class="flex justify-between items-start">
                <div class="w-full">
                    <strong class="text-gray-800">{{ $comment->user->full_name ?? 'Anonim' }}</strong>
                    <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>

                    {{-- Mode Edit --}}
                    <div x-show="editing" class="mt-2">
                        <form method="POST" action="{{ route('note-comments.update', $comment->id) }}">
                            @csrf
                            @method('PUT')
                            <textarea name="content" x-model="editedContent"
                                class="w-full p-2 border rounded text-sm text-gray-700" rows="3"></textarea>
                            <div class="mt-2 flex gap-2">
                                <button type="submit"
                                    class="px-3 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600">
                                    Simpan
                                </button>
                                <button type="button" x-on:click="editing = false"
                                    class="px-3 py-1 border text-xs rounded hover:bg-gray-100">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Mode Tampilan --}}
                    <p x-show="!editing" class="mt-2 text-sm text-gray-700" x-text="editedContent"></p>
                </div>

                {{-- Tombol Edit / Hapus hanya untuk pemilik --}}
                @if ($currentUser && $comment->user_id === $currentUser->id)
                <div class="flex gap-2 ml-4">
                    <button x-on:click="editing = true"
                        class="px-3 py-1 border border-blue-500 text-blue-500 text-xs rounded hover:bg-blue-100 transition">
                        Edit
                    </button>

                    <form action="{{ route('note-comments.destroy', $comment->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-3 py-1 border border-red-500 text-red-500 text-xs rounded hover:bg-red-100 transition">
                            Hapus
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
        @empty
        <p class="text-gray-500 text-sm">💬 Belum ada komentar. Jadilah yang pertama!</p>
        @endforelse


    </div>
</div>
@endsection