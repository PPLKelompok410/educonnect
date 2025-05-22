@extends('layouts.app')

@section('title', 'Kelola Mata Kuliah')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">🛠️ Kelola Mata Kuliah</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">
        <i class="bi bi-plus-circle"></i> Tambah Mata Kuliah
    </button>

    <!-- Tabel Matkul -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kode</th>
                <th>Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mataKuliah as $mk)
                <tr>
                    <td>{{ $mk->nama }}</td>
                    <td>{{ $mk->kode }}</td>
                    <td>{{ $mk->prodi }}</td>
                    <td>
                        <!-- Tombol Edit -->
                        <button class="btn btn-warning btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editModal{{ $mk->id }}">
                            Edit
                        </button>

                        <!-- Form Hapus -->
                        <form action="{{ route('matkul.destroy', $mk->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus matkul ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{ $mk->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $mk->id }}" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                    <form action="{{ route('matkul.update', $mk->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                          <h5 class="modal-title" id="editModalLabel{{ $mk->id }}">Edit Mata Kuliah</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                              <label>Nama</label>
                              <input type="text" name="nama" class="form-control" value="{{ $mk->nama }}" required>
                          </div>
                          <div class="mb-3">
                              <label>Kode</label>
                              <input type="text" name="kode" class="form-control" value="{{ $mk->kode }}" required>
                          </div>
                          <div class="mb-3">
                              <label>Prodi</label>
                              <input type="text" name="prodi" class="form-control" value="{{ $mk->prodi }}" required>
                          </div>
                          <div class="mb-3">
                            <label>Sampul (Opsional)</label>
                            <input type="file" name="gambar" class="form-control">
                            @if ($mk->gambar)
                                <img src="{{ asset('storage/sampul/' . $mk->gambar) }}" alt="Sampul" class="img-thumbnail mt-2" width="120">
                            @endif
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('matkul.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Tambah Mata Kuliah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>Kode</label>
              <input type="text" name="kode" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>Prodi</label>
              <input type="text" name="prodi" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>Sampul (Opsional)</label>
              <input type="file" name="gambar" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
