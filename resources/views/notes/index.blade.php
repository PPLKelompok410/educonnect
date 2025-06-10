@extends('layouts.app')

@section('content')
<div class="min-h-screen">
  <!-- Enhanced Header Section -->
  <div class="relative overflow-hidden mb-2">
    <div class="relative px-8 pb-8">
      <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
        <div>
          <h1 class="font-title text-4xl font-bold text-gray-800 flex items-center mb-3">
            <span class="text-5xl mr-4">📚</span>
            <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
              {{ $matkul->nama }}
            </span>
          </h1>
          <p class="text-gray-600 text-lg">
            Jelajahi koleksi catatan dan materi pembelajaran untuk mata kuliah ini
          </p>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-3">
          <a href="{{ route('notes.create', $matkul->id) }}" 
             class="group bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-md text-white px-6 py-3 rounded-xl flex items-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <span class="font-semibold">Tambah</span>
          </a>
          
          <a href="{{ route('matkul.discussion', $matkul->id) }}" 
             class="group bg-white border-2 border-gray-200 hover:border-blue-300 text-gray-700 hover:text-blue-600 px-6 py-3 rounded-xl flex items-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <span class="font-semibold">Forum Diskusi</span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Notes Gallery Section -->
  <div class="px-8 pb-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach ($notes as $note)
      <a href="{{ route('notes.show', $note->id) }}" 
         class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2 hover:scale-105 border border-gray-100 cursor-pointer block">
        
        <!-- Image Container with Overlay -->
        <div class="relative overflow-hidden">
         @php
                $previewFile = collect($note->files)->first(function ($file) {
                    return Str::endsWith($file->file_path, ['jpg', 'jpeg', 'png', 'gif', 'pdf']);
                });
            @endphp

            @if ($previewFile)
                @if (Str::endsWith($previewFile->file_path, ['jpg', 'jpeg', 'png', 'gif']))
                    <img src="{{ asset($previewFile->file_path) }}" 
                        alt="Preview Gambar" 
                        class="w-full h-60 object-cover shadow-lg">
                @elseif (Str::endsWith($previewFile->file_path, ['pdf']))
                    <iframe src="{{ asset($previewFile->file_path) }}" 
                            class="w-full h-60 shadow-lg" 
                            frameborder="0"></iframe>
                @endif
          @else
          <img src="{{ asset('images/default-note.png') }}" 
               alt="Default Preview" 
               class="w-full h-56 object-cover transition-transform duration-700 group-hover:scale-110 bg-gradient-to-br from-gray-100 to-gray-200">
          @endif
          
          <!-- Gradient Overlay -->
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          
          <!-- Date Badge -->
          <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1 text-xs font-semibold text-gray-700">
            {{ $note->created_at->format('d M Y') }}
          </div>

          <!-- Bookmark Button -->
          @if(session('user'))
          <button onclick="event.preventDefault(); event.stopPropagation(); toggleBookmark({{ $note->id }}, this)" 
                  class="absolute top-4 right-4 w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center transition-all duration-300 hover:bg-white {{ $note->bookmarks->where('user_id', session('user')->id)->count() ? 'text-yellow-500' : 'text-gray-400 hover:text-yellow-500' }}"
                  title="Bookmark">
            <svg class="w-5 h-5" fill="{{ $note->bookmarks->where('user_id', session('user')->id)->count() ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
            </svg>
          </button>
          @endif
        </div>
        
        <!-- Content Section -->
        <div class="p-6 flex flex-col flex-grow">
          <!-- Title -->
          <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300 mb-3 line-clamp-2">
            {{ $note->judul }}
          </h3>

          <!-- Author Info -->
          <div class="flex items-center mb-4 space-x-3">
            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
              </svg>
            </div>
            <div>
              <p class="text-xs text-gray-500">Dibagikan oleh</p>
              <p class="text-sm font-semibold text-gray-700">{{ $note->user->full_name }}</p>
            </div>
          </div>

          <!-- Rating Section -->
          <div class="mb-4">
            @if ($note->averageRating())
            <div class="flex items-center justify-between bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl p-4 border border-yellow-100">
              <div class="flex items-center space-x-2">
                <div class="flex items-center">
                  @for ($i = 1; $i <= 5; $i++)
                  <svg class="w-4 h-4 {{ $i <= $note->averageRating() ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                  </svg>
                  @endfor
                </div>
                <span class="text-sm font-bold text-gray-700">{{ number_format($note->averageRating(), 1) }}</span>
              </div>
              <div class="text-xs text-gray-500 bg-white px-2 py-1 rounded-full">
                {{ $note->totalReviewer() }} review{{ $note->totalReviewer() > 1 ? 's' : '' }}
              </div>
            </div>
            @else
            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 text-center">
              <div class="flex items-center justify-center space-x-2 text-gray-400">
                @for ($i = 1; $i <= 5; $i++)
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                @endfor
              </div>
              <p class="text-sm text-gray-500 mt-2">Belum ada rating</p>
            </div>
            @endif
          </div>

          <!-- Click to view indicator -->
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

    <!-- Empty State -->
    @if($notes->isEmpty())
    <div class="text-center py-16">
      <h3 class="text-2xl font-bold text-gray-800 mb-4">Belum ada catatan</h3>
      <p class="text-gray-600 text-lg mb-8">Jadilah yang pertama untuk berbagi catatan di mata kuliah ini</p>
      <a href="{{ route('notes.create', $matkul->id) }}" 
         class="inline-flex items-center bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-emerald-600 hover:to-green-700 text-white px-8 py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        <span class="font-semibold">Tambah Catatan Pertama</span>
      </a>
    </div>
    @endif
  </div>
</div>

<style>
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.group {
  animation: fadeInUp 0.6s ease-out;
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Custom scrollbar for better UX */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: #f1f5f9;
  border-radius: 10px;
}

::-webkit-scrollbar-thumb {
  background: linear-gradient(to bottom, #3b82f6, #6366f1);
  border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(to bottom, #2563eb, #4f46e5);
}
</style>

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
        const svg = button.querySelector('svg');
        
        if (data.status === 'added') {
            button.classList.add('text-yellow-500');
            button.classList.remove('text-gray-400');
            svg.setAttribute('fill', 'currentColor');
            
            // Success animation
            button.style.transform = 'scale(1.2)';
            setTimeout(() => {
                button.style.transform = 'scale(1)';
            }, 200);
            
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'success',
                    title: 'Bookmark berhasil ditambahkan!',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true,
                    position: 'top-end'
                });
            }
        } else {
            button.classList.remove('text-yellow-500');
            button.classList.add('text-gray-400');
            svg.setAttribute('fill', 'none');
            
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'success',
                    title: 'Bookmark berhasil dihapus!',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true,
                    position: 'top-end'
                });
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi kesalahan!',
                showConfirmButton: false,
                timer: 1500,
                toast: true,
                position: 'top-end'
            });
        }
    });
}

// Add staggered animation on page load
document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.group');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });
});
</script>

@push('scripts')
<script>
// Additional scripts can be added here if needed
</script>
@endpush
@endsection