@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Catatan</h1>

    {{-- Tampilkan pesan error jika ada --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('notes.store', $matkul->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Catatan</label>
            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
        </div>

        <div>
            <label for="file_path" class="block text-sm font-medium text-gray-700 mb-1">Upload File</label>
            <input type="file" name="file_path" id="file_path" required
                class="w-full border border-gray-300 rounded-lg shadow-sm text-sm file:px-4 file:py-2 file:border-0 file:bg-blue-50 file:text-blue-700 file:rounded file:cursor-pointer">
        </div>

        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="flex gap-2">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full text-sm shadow">
                Simpan
            </button>
            <a href="{{ route('notes.index', $matkul->id) }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2 rounded-full text-sm shadow">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
