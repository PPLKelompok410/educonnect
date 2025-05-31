@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">🔖 Bookmarks</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($bookmarks as $bookmark)
        <div class="bg-white rounded shadow overflow-hidden flex flex-col">
            @if ($bookmark->note->file_path)
            <img src="{{ asset('storage/' . $bookmark->note->file_path) }}" alt="Preview {{ $bookmark->note->judul }}" class="w-full h-48 object-cover">
            @else
            <img src="{{ asset('images/default-note.png') }}" alt="Default Preview" class="w-full h-48 object-cover">
            @endif

            <div class="p-4 flex-grow">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $bookmark->note->judul }}</h3>
                <p class="text-sm text-gray-600 mb-1">Dibagikan oleh: <strong>{{ $bookmark->note->user->full_name }}</strong></p>
                <p class="text-xs text-gray-500">{{ $bookmark->note->created_at->format('d M Y') }}</p>
            </div>

            <div class="px-4 py-3 bg-gray-50 border-t flex justify-between items-center">
                <a href="{{ route('notes.show', $bookmark->note->id) }}" class="text-blue-500 hover:text-blue-600 text-sm font-medium">
                    <i class="fas fa-eye"></i> Lihat
                </a>
                <button onclick="toggleBookmark({{ $bookmark->note->id }}, this)" class="text-yellow-500 hover:text-yellow-600">
                    <i class="fas fa-bookmark"></i>
                </button>
            </div>
        </div>
        @endforeach
    </div>
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