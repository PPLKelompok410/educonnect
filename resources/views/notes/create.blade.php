@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Catatan – {{ $matkul->nama }}</h2>

    <form action="{{ route('notes.store', $matkul->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" name="judul" required>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Gambar</label>
            <input type="file" class="form-control" name="file" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
