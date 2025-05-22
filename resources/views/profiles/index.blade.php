@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="container mt-5" style="max-width: 600px;">

    @if(session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
    @endif

    @if ($profiles->isEmpty())
        <p class="text-muted text-center">Belum ada profil yang tersedia.</p>
    @else
        @php $profile = $profiles->first(); @endphp

        <div class="text-center p-4" style="background: #f0f8ff; border-radius: 12px 12px 12px 12px; box-shadow: 0 2px 8px rgb(135 206 235 / 0.3);">
            <!-- Foto Profil -->
            <div class="mb-4">
                <img src="{{ asset('images/default-photo.jpg') }}" alt="Foto Profil" 
                    class="rounded-circle shadow-sm" 
                    style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #FFFFFF;">
            </div>

            <!-- Nama -->
            <h3 class="fw-bold mb-2" style="font-size: 1.9rem;">{{ $profile->name }}</h3>

            <!-- Bio -->
            @if($profile->bio)
                <p class="text-secondary fst-italic mb-4" style="font-size: 1.1rem;">{{ $profile->bio }}</p>
            @endif

            <!-- Detail Profil -->
            <div class="d-flex justify-content-center gap-5 mb-4 flex-wrap" style="font-size: 0.95rem;">
                <div>
                    <strong>Email</strong>
                    <p class="mb-0">{{ $profile->email }}</p>
                </div>
                <div>
                    <strong>Telepon</strong>
                    <p class="mb-0">{{ $profile->phone_number ?? '-' }}</p>
                </div>
                <div>
                    <strong>Alamat</strong>
                    <p class="mb-0">{{ $profile->address ?? '-' }}</p>
                </div>
            </div>

            <!-- Tombol Edit -->
            <a href="{{ route('profiles.edit', $profile->id) }}" 
               class="btn btn-primary px-5 shadow" 
               style="background-color: #3399ff; border-color: #3399ff;">
                Edit Profil
            </a>
        </div>
    @endif
</div>
@endsection
