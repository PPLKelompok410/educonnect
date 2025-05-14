@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 shadow rounded">
    <h2 class="text-2xl font-semibold mb-6 text-blue-600">Edit Profil</h2>

    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profiles.update', $profile->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $profile->name) }}"
                class="w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md shadow-sm p-2" required>
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $profile->email) }}"
                class="w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md shadow-sm p-2" required>
        </div>

        <!-- Phone Number -->
        <div>
            <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $profile->phone_number) }}"
                class="w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md shadow-sm p-2">
        </div>

        <!-- Address -->
        <div>
            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
            <textarea name="address" id="address" rows="3"
                class="w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md shadow-sm p-2">{{ old('address', $profile->address) }}</textarea>
        </div>

        <!-- Bio -->
        <div>
            <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
            <textarea name="bio" id="bio" rows="3"
                class="w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md shadow-sm p-2">{{ old('bio', $profile->bio) }}</textarea>
        </div>

        <!-- Submit -->
        <div class="pt-4 flex justify-between items-center">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow-md">
                Simpan Perubahan
            </button>
            <a href="{{ route('profiles.index') }}" class="text-blue-600 hover:underline text-sm">← Kembali ke Daftar Profil</a>
        </div>
    </form>
</div>
@endsection
