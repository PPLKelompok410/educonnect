@extends('layouts.app')

@section('title', 'Kelola Mata Kuliah')

@section('content')
<div class="p-6 max-w-7xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">🛠️ Kelola Mata Kuliah</h2>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Tambah -->
    <button 
        class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition mb-4"
        onclick="document.getElementById('tambahModal').classList.remove('hidden')"
    >
        ➕ Tambah Mata Kuliah
    </button>

    <!-- Tabel Matkul -->
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 border-b font-semibold">
                <tr>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Kode</th>
                    <th class="px-6 py-3">Prodi</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mataKuliah as $mk)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-3">{{ $mk->nama }}</td>
                        <td class="px-6 py-3">{{ $mk->kode }}</td>
                        <td class="px-6 py-3">{{ $mk->prodi }}</td>
                        <td class="px-6 py-3 space-x-2">
                            <!-- Tombol Edit -->
                            <button
                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition"
                                onclick="document.getElementById('editModal{{ $mk->id }}').classList.remove('hidden')"
                            >
                                Edit
                            </button>

                            <!-- Form Hapus -->
                            <form action="{{ route('matkul.destroy', $mk->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus matkul ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div id="editModal{{ $mk->id }}" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
                        <div class="bg-white rounded-lg w-full max-w-md shadow-lg">
                            <form action="{{ route('matkul.update', $mk->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="px-6 py-4 border-b flex justify-between items-center">
                                    <h3 class="text-lg font-semibold">Edit Mata Kuliah</h3>
                                    <button type="button" onclick="document.getElementById('editModal{{ $mk->id }}').classList.add('hidden')">✖</button>
                                </div>
                                <div class="px-6 py-4 space-y-4">
                                    <input type="text" name="nama" class="w-full border px-4 py-2 rounded" placeholder="Nama" value="{{ $mk->nama }}" required>
                                    <input type="text" name="kode" class="w-full border px-4 py-2 rounded" placeholder="Kode" value="{{ $mk->kode }}" required>
                                    <input type="text" name="prodi" class="w-full border px-4 py-2 rounded" placeholder="Prodi" value="{{ $mk->prodi }}" required>
                                    <div>
                                        <label class="block mb-1 text-sm text-gray-600">Sampul (Opsional)</label>
                                        <input type="file" name="gambar" class="w-full border px-4 py-2 rounded">
                                        @if ($mk->gambar)
                                            <img src="{{ asset('storage/sampul/' . $mk->gambar) }}" alt="Sampul" class="mt-2 w-24 h-auto rounded border">
                                        @endif
                                    </div>
                                </div>
                                <div class="px-6 py-4 border-t flex justify-end">
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div id="tambahModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg w-full max-w-md shadow-lg">
        <form action="{{ route('matkul.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="px-6 py-4 border-b flex justify-between items-center">
                <h3 class="text-lg font-semibold">Tambah Mata Kuliah</h3>
                <button type="button" onclick="document.getElementById('tambahModal').classList.add('hidden')">✖</button>
            </div>
            <div class="px-6 py-4 space-y-4">
                <input type="text" name="nama" class="w-full border px-4 py-2 rounded" placeholder="Nama" required>
                <input type="text" name="kode" class="w-full border px-4 py-2 rounded" placeholder="Kode" required>
                <input type="text" name="prodi" class="w-full border px-4 py-2 rounded" placeholder="Prodi" required>
                <div>
                    <label class="block mb-1 text-sm text-gray-600">Sampul (Opsional)</label>
                    <input type="file" name="gambar" class="w-full border px-4 py-2 rounded">
                </div>
            </div>
            <div class="px-6 py-4 border-t flex justify-end">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
