@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📚 {{ $matkul->nama }}</h1>
        <a href="{{ route('notes.create', $matkul->id) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full shadow text-sm">
            + Tambah Catatan
        </a>
    </div>

    {{-- Daftar Catatan --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($notes as $note)
        <div class="bg-white rounded-2xl shadow overflow-hidden flex flex-col">
            {{-- Preview Gambar --}}
            @if ($note->file_path)
            <img src="{{ asset('storage/' . $note->file_path) }}" alt="Preview {{ $note->judul }}" class="w-full h-48 object-cover">
            @else
            <img src="{{ asset('images/default-note.png') }}" alt="Default Preview" class="w-full h-48 object-cover">
            @endif

            <div class="p-4 flex flex-col flex-grow">
                <h5 class="font-semibold text-gray-800 mb-2 text-lg">{{ $note->judul }}</h5>

                {{-- Tombol Tambah & Forum --}}
                <div class="flex gap-2 mb-4">
                    <a href="{{ route('notes.create', $matkul->id) }}" class="bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-1.5 rounded shadow">
                        Tambah Catatan
                    </a>
                    <a href="{{ route('matkul.discussion', $matkul->id) }}" class="border border-gray-300 text-gray-700 hover:bg-gray-100 text-xs px-3 py-1.5 rounded shadow flex items-center gap-1">
                        <i class="fas fa-comments"></i> Forum Diskusi
                    </a>
                </div>

                {{-- Info Pengguna --}}
                <p class="text-sm text-gray-600 mb-1">
                    Dibagikan oleh: <strong>{{ $note->user->name }}</strong>
                </p>

                <p class="text-xs text-gray-500 mb-3">
                    {{ $note->created_at->format('d M Y') }}
                </p>

                {{-- Rating --}}
                <div class="mb-4">
                    @if ($note->rating)
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <=$note->rating)
                        <i class="fas fa-star text-yellow-400"></i>
                        @else
                        <i class="far fa-star text-yellow-400"></i>
                        @endif
                        @endfor
                        @else
                        <span class="text-gray-400 text-xs">Belum ada rating</span>
                        @endif
                </div>

                {{-- Tombol Lihat --}}
                <a href="{{ route('notes.show', $note->id) }}" class="mt-auto bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-full shadow">
                    Lihat
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection