{{-- resources/views/notes/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-semibold text-yellow-600 mb-6 flex items-center gap-2">
        <i class="fas fa-edit"></i> Edit Catatan – {{ $note->judul }}
    </h2>

    <form action="{{ route('notes.update', $note->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
            <input type="text" id="judul" name="judul" required
                value="{{ old('judul', $note->judul) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-yellow-400 focus:border-yellow-400 text-sm" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Preview Gambar Saat Ini</label>
            <img src="{{ asset('storage/' . $note->file_path) }}" alt="Preview"
                class="rounded shadow-md max-w-xs w-full mb-4" />
        </div>

        <div>
            <label for="file" class="block text-sm font-medium text-gray-700 mb-1">Ganti Gambar (opsional)</label>
            <input type="file" id="file" name="file" accept="image/*"
                class="w-full border border-gray-300 rounded-lg shadow-sm text-sm file:px-4 file:py-2 file:border-0 file:bg-yellow-100 file:text-yellow-700 file:rounded file:cursor-pointer" />
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-full text-sm flex items-center gap-2 shadow">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
            <a href="{{ route('notes.show', $note->id) }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-full text-sm shadow">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection