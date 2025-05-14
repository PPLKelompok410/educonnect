@extends('layouts.app')

@section('title', 'Daftar Profil')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold text-blue-600 mb-6">Profil Pengguna</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($profiles->isEmpty())
        <p class="text-gray-600">Belum ada profil yang tersedia.</p>
    @else
        @php $profile = $profiles->first(); @endphp
        <div class="bg-gray-50 p-5 rounded shadow-sm">
            <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $profile->name }}</h3>
            <p class="text-sm text-gray-600"><strong>Email:</strong> {{ $profile->email }}</p>
            <p class="text-sm text-gray-600"><strong>Telepon:</strong> {{ $profile->phone_number ?? '-' }}</p>
            <p class="text-sm text-gray-600"><strong>Alamat:</strong> {{ $profile->address ?? '-' }}</p>
            <p class="text-sm text-gray-600"><strong>Bio:</strong> {{ $profile->bio ?? '-' }}</p>

            <div class="flex items-center gap-4 mt-6">
                <a href="{{ route('profiles.edit', $profile->id) }}"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                    Edit
                </a>

                <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST"
                    onsubmit="return confirm('Apakah kamu yakin ingin menghapus profil ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    @endif

    <div class="mt-6">
        <a href="{{ route('profiles.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow">
            Tambah Profil Baru
        </a>
    </div>
</div>
@endsection
