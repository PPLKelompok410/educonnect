{{-- resources/views/notes/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container px-3 px-md-5 my-5">
    <h2 class="mb-4">
        <i class="fas fa-edit text-warning"></i> Edit Catatan – {{ $note->judul }}
    </h2>

    <form action="{{ route('notes.update', $note->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text"
                   id="judul"
                   name="judul"
                   class="form-control"
                   value="{{ old('judul', $note->judul) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Preview Gambar Saat Ini</label><br>
            <img src="{{ asset('storage/' . $note->file_path) }}" 
                 alt="Preview" 
                 class="img-fluid mb-3" 
                 style="max-width: 300px;">
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Ganti Gambar (opsional)</label>
            <input type="file"
                   id="file"
                   name="file"
                   class="form-control"
                   accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
        <a href="{{ route('notes.show', $note->id) }}" class="btn btn-secondary ms-2">
            Batal
        </a>
    </form>
</div>
@endsection
