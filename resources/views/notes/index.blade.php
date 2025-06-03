@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📚 {{ $matkul->nama }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('notes.create', $matkul->id) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow text-sm">
                + Tambah Catatan
            </a>
            <a href="{{ route('matkul.discussion', $matkul->id) }}" class="border border-gray-300 text-gray-700 hover:bg-gray-100 px-4 py-2 rounded shadow text-sm flex items-center gap-1">
                <i class="fas fa-comments"></i> Forum Diskusi
            </a>
        </div>
    </div>

    {{-- Daftar Catatan --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($notes as $note)
        <div class="bg-white rounded shadow overflow-hidden flex flex-col">
            {{-- Preview Gambar --}}
            @if ($note->file_path)
            <img src="{{ asset('storage/' . $note->file_path) }}" alt="Preview {{ $note->judul }}" class="w-full h-48 object-cover">
            @else
            <img src="{{ asset('images/default-note.png') }}" alt="Default Preview" class="w-full h-48 object-cover">
            @endif

            <div class="p-4 flex flex-col flex-grow">
                <h5 class="font-semibold text-gray-800 mb-2 text-lg">{{ $note->judul }}</h5>

                {{-- Info Pengguna --}}
                <p class="text-sm text-gray-600 mb-1">
                    Dibagikan oleh: <strong>{{ $note->user->full_name }}</strong>
                </p>

                <p class="text-xs text-gray-500 mb-3">
                    {{ $note->created_at->format('d M Y') }}
                </p>

                {{-- Rating --}}
                <div class="mb-4">
                    @if ($note->averageRating())
                    <div class="mt-4">
                        <p class="text-sm text-gray-600">
                            Rating: {{ number_format($note->averageRating(), 2) }} 
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $note->averageRating())
                                <i class="bi bi-star-fill text-warning"></i>
                                @else
                                <i class="bi bi-star text-warning"></i>
                                @endif
                            @endfor
                            <span class="ml-2 text-xs text-gray-500">({{ $note->totalReviewer() }} reviewer)</span>
                        </p>
                    </div>
                    @else
                    <div class="mt-4">
                        <p class="text-sm text-gray-500">Belum ada rating.</p>
                    </div>
                    @endif
                </div>

                {{-- Tombol Lihat --}}
                <!-- In the card actions div, add the bookmark button next to the view button -->
                <div class="px-4 py-3 bg-gray-50 border-t flex justify-between items-center">
                    <a href="{{ route('notes.show', $note->id) }}" class="text-blue-500 hover:text-blue-600 text-sm font-medium">
                        <i class="fas fa-eye"></i> Lihat
                    </a>
                    @if(session('user'))
                    <button 
                        onclick="toggleBookmark({{ $note->id }}, this)" 
                        class="text-gray-400 hover:text-yellow-500 {{ $note->bookmarks->where('user_id', session('user')->id)->count() ? 'text-yellow-500' : '' }}"
                        title="Bookmark"
                    >
                        <i class="fas fa-bookmark"></i>
                    </button>
                    @endif
                </div>

            @push('scripts')
            <script>
                function toggleBookmark(noteId, button) {
                    fetch(`/bookmarks/toggle/${noteId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'added') {
                            button.classList.add('text-yellow-500');
                            button.classList.remove('text-gray-400');
                            Swal.fire({
                                icon: 'success',
                                title: 'Bookmark berhasil ditambahkan!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            button.classList.remove('text-yellow-500');
                            button.classList.add('text-gray-400');
                            Swal.fire({
                                icon: 'success',
                                title: 'Bookmark berhasil dihapus!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                }
            </script>
            @endpush
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection