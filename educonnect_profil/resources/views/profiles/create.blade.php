@extends('layouts.app')

@section('title', 'Buat Profil Baru')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold text-blue-600 mb-6">Buat Profil Baru</h2>

    <!-- Display validation errors if any -->
    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form to create profile -->
    <form action="{{ route('profiles.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block mb-1">Nomor Telepon</label>
            <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block mb-1">Alamat</label>
            <textarea name="address" class="w-full border p-2 rounded">{{ old('address') }}</textarea>
        </div>

        <div>
            <label class="block mb-1">Bio</label>
            <textarea name="bio" class="w-full border p-2 rounded">{{ old('bio') }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Buat Profil</button>
    </form>
</div>
@endsection
