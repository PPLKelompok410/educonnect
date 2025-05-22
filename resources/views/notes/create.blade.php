@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Catatan</h1>

    {{-- Tampilkan pesan error jika ada --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('notes.store', $matkul->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Catatan</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        <div class="mb-3">
            <label for="file_path" class="form-label">Upload File</label>
            <input type="file" name="file_path" id="file_path" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4">{{ old('deskripsi') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('notes.index', $matkul->id) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
