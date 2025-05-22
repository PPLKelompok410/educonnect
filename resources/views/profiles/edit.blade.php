@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header text-white" style="background-color: #87CEEB;">
            <h2 class="mb-0">Edit Profil</h2>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profiles.update', $profile->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $profile->name) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $profile->email) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Nomor Telepon</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number', $profile->phone_number) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea name="address" class="form-control" rows="3">{{ old('address', $profile->address) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea name="bio" class="form-control" rows="3">{{ old('bio', $profile->bio) }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn text-white" style="background-color: #87CEEB;">Simpan Perubahan</button>
                    <a href="{{ route('profiles.index') }}" class="btn btn-outline-info">← Kembali ke Daftar Profil</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection