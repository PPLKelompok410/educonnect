@extends('layouts.app')

@section('title', 'Detail Profil')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold text-blue-600 mb-6">Detail Profil</h2>

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
                  onsubmit="return confirm('Yakin ingin menghapus profil ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('profiles.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded shadow">
            Kembali ke Daftar Profil
        </a>
    </div>
</div>
@endsection
