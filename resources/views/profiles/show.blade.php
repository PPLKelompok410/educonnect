@extends('layouts.app')

@section('title', 'Daftar Profil')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h2 class="mb-0">Profil Pengguna</h2>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($profiles->isEmpty())
                <p class="text-muted">Belum ada profil yang tersedia.</p>
            @else
                @php $profile = $profiles->first(); @endphp
                <div class="card mb-4">
                    <div class="d-flex align-items-center gap-4">
                        <img src="https://via.placeholder.com/100" alt="Foto Profil" class="rounded-circle" width="100" height="100">
                        <div>
                            <h3 class="card-title">{{ $profile->name }}</h3>
                            <p class="card-text"><strong>Email:</strong> {{ $profile->email }}</p>
                            <p class="card-text"><strong>Telepon:</strong> {{ $profile->phone_number ?? '-' }}</p>
                            <p class="card-text"><strong>Alamat:</strong> {{ $profile->address ?? '-' }}</p>
                            <p class="card-text"><strong>Bio:</strong> {{ $profile->bio ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-3">
                        <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
