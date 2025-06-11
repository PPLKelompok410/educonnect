@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">🔖 Bookmarks</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($bookmarks as $bookmark)
        @php
            $note = $bookmark->note;
            $previewFile = collect($note->files)->first(function ($file) {
                return Str::endsWith($file->file_path, ['jpg', 'jpeg', 'png', 'gif', 'pdf']);
            });
        @endphp

        <a href="{{ route('notes.show', $note->id) }}"
           class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2 hover:scale-105 border border-gray-100 cursor-pointer block">

            <!-- Preview -->
            <div class="relative overflow-hidden">
                @if ($previewFile)
                    @if (Str::endsWith($previewFile->file_path, ['jpg', 'jpeg', 'png', 'gif']))
                        <img src="{{ asset($previewFile->file_path) }}" alt="Preview"
                            class="w-full h-60 object-cover shadow-lg">
                    @elseif (Str::endsWith($previewFile->file_path, ['pdf']))
                        <iframe src="{{ asset($previewFile->file_path) }}" class="w-full h-60 shadow-lg" frameborder="0"></iframe>
                    @endif
                @else
                    <img src="{{ asset('images/default-note.jpg') }}"
                        alt="Default Preview"
                        class="w-full h-60 object-cover bg-gradient-to-br from-gray-100 to-gray-200">
                @endif

                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                <!-- Date Badge -->
                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1 text-xs font-semibold text-gray-700">
                    {{ $note->created_at->format('d M Y') }}
                </div>

                <!-- Bookmark Button -->
                <button onclick="event.preventDefault(); event.stopPropagation(); toggleBookmark({{ $note->id }}, this)"
                    class="absolute top-4 right-4 w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center transition-all duration-300 hover:bg-white text-yellow-500"
                    title="Bookmark">
                    <svg class="w-5 h-5" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                    </svg>
                </button>
            </div>

            <!-- Info -->
            <div class="p-6 flex flex-col flex-grow">
                <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300 mb-3 line-clamp-2">
                    {{ $note->judul }}
                </h3>
                <div class="flex items-center mb-4 space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Dibagikan oleh</p>
                        <p class="text-sm font-semibold text-gray-700">{{ $note->user->full_name }}</p>
                    </div>
                </div>
                <div class="mt-auto pt-4 border-t border-gray-100">
                    <div class="flex items-center justify-center text-blue-600 group-hover:text-blue-700 transition-colors duration-300">
                        <svg class="w-5 h-5 mr-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span class="text-sm font-medium">Klik untuk melihat</span>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    @if($bookmarks->isEmpty())
    <div class="text-center py-16">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Belum ada bookmark</h3>
        <p class="text-gray-600 text-lg mb-8">Tandai catatan favoritmu untuk akses cepat kapan saja!</p>
        <a href="{{ url('/matkul') }}"
            class="inline-flex items-center bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-8 py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <span class="font-semibold">Lihat Semua Catatan</span>
        </a>
    </div>
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
        if (data.status === 'removed') {
            // Remove the entire bookmark card from view
            button.closest('.bg-white').remove();
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
@endsection