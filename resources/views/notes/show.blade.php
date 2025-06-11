@extends('layouts.app')

@section('content')

@php
$currentUser = session('user');
use Illuminate\Support\Str;
@endphp

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="max-w-5xl mx-auto py-8 px-4">
        
        {{-- Header Section --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-white mb-2 flex items-center gap-3">
                            {{ $note->judul }}
                        </h1>
                        <div class="flex items-center gap-4 text-white/90">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="white" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="font-medium text-white">{{ $note->user->full_name ?? 'Anonymous' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="white" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-white">{{ $note->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    @if ($currentUser && $note->user_id === $currentUser->id)
                    <div class="flex gap-3">
                        <a href="{{ route('notes.edit', $note->id) }}" 
                           class="group bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-xl flex items-center gap-2 transition-all duration-300 backdrop-blur-sm">
                            <svg class="w-4 h-4 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <span class="font-medium">Edit</span>
                        </a>
                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="group bg-red-500/20 hover:bg-red-500/30 text-white px-4 py-2 rounded-xl flex items-center gap-2 transition-all duration-300 backdrop-blur-sm border border-red-300/30">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <span class="font-medium">Hapus</span>
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Note Content Section --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="p-8">
                {{-- Galeri --}}
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2 mb-6" id="imageGallery">
                    @foreach ($note->files as $index => $file)
                        @php
                            $filePath = asset($file->file_path);
                            $ext = Str::lower(pathinfo($file->file_path, PATHINFO_EXTENSION));
                        @endphp

                        @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ $filePath }}"
                                data-index="{{ $index }}"
                                data-src="{{ $filePath }}"
                                alt="Image"
                                class="cursor-pointer w-full h-40 object-cover rounded-lg border border-blue hover:scale-105 transition-transform duration-200">
                        
                        @elseif ($ext === 'pdf')
                            <iframe src="{{ $filePath }}"
                                data-index="{{ $index }}"
                                data-src="{{ $filePath }}"
                                class="w-full h-40 rounded-lg border border-red-400 shadow-md hover:scale-105 transition-transform duration-200 cursor-pointer"
                                frameborder="0">
                            </iframe>
                        @endif
                    @endforeach
                </div>

                <div class="flex items-center justify-end mb-6">
                    {{-- Tombol unduh semua sebagai PDF --}}
                    <button id="downloadPdfBtn" class="bg-blue-600 text-white text-sm py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                        Unduh Semua Gambar sebagai PDF
                    </button>
                </div>

                {{-- Description Section --}}
                    @if($note->deskripsi)
                            <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl p-6 border border-gray-100">
                                <p class="text-gray-700 leading-relaxed text-lg">{{ $note->deskripsi }}</p>
                            </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Modal --}}
        <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-80 z-50 hidden flex items-center justify-center">
            <div class="relative max-w-5xl w-full flex items-center justify-center px-4">
                {{-- Tombol Close di luar kiri atas --}}
                <button id="closeModal" class="absolute top-6 left-6 text-white text-4xl z-50 hover:text-red-400 transition">
                    &times;
                </button>

                {{-- Tombol Prev di kiri luar --}}
                <div class="absolute left-2 md:left-6 top-1/2 -translate-y-1/2 cursor-pointer text-white text-5xl z-50 hover:text-blue-400 transition" id="prevImage">
                    &#10094;
                </div>

                {{-- Gambar Utama --}}
                <img id="modalImage" src="" class="max-h-[80vh] w-auto rounded-xl shadow-lg border border-white">

                {{-- Tombol Next di kanan luar --}}
                <div class="absolute right-2 md:right-6 top-1/2 -translate-y-1/2 cursor-pointer text-white text-5xl z-50 hover:text-blue-400 transition" id="nextImage">
                    &#10095;
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Rating Section --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-yellow-500 to-pink-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </div>
                        Berikan Rating
                    </h3>
                    
                    <div 
                        x-data="{
                            rating: {{ $note->ratings->where('user_id', $currentUser->id ?? 0)->first()->rating ?? 0 }},
                            hoverRating: 0,
                            setRating(value) {
                                this.rating = value;
                                fetch('{{ route('notes.rate', $note->id) }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({ rating: value })
                                }).then(() => {
                                    // Success feedback
                                    if (typeof Swal !== 'undefined') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Rating berhasil diberikan!',
                                            showConfirmButton: false,
                                            timer: 1500,
                                            toast: true,
                                            position: 'top-end'
                                        });
                                    }
                                });
                            }
                        }"
                        class="mb-6"
                    >
                        <div class="flex items-center justify-center gap-2 mb-4">
                            <template x-for="star in 5" :key="star">
                                <button type="button" 
                                        @click="setRating(star)" 
                                        @mouseover="hoverRating = star" 
                                        @mouseleave="hoverRating = 0" 
                                        class="focus:outline-none transition-all duration-200 hover:scale-110">
                                    <svg class="w-10 h-10 transition-colors duration-200"
                                         :class="(hoverRating >= star || (!hoverRating && rating >= star)) ? 'text-yellow-400' : 'text-gray-300'"
                                         fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </button>
                            </template>
                        </div>
                        <div class="text-center">
                            <span class="text-lg font-semibold text-gray-700" x-text="rating ? `${rating}/5` : 'Belum dinilai'"></span>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-100">
                        <div class="text-center">
                            <div class="flex items-center justify-center gap-2 mb-2">
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= ($note->averageRating() ?? 0) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    @endfor
                                </div>
                                <span class="font-bold text-gray-700">{{ number_format($note->averageRating() ?? 0, 1) }}</span>
                            </div>
                            <p class="text-sm text-gray-600">dari {{ $note->totalReviewer() }} reviewer</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Comments Section --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        Komentar ({{ $note->comments->count() }})
                    </h3>

                    {{-- Add Comment Form --}}
                    <form method="POST" action="{{ route('note-comments.store', ['note' => $note->id]) }}" class="mb-8">
                        @csrf
                        <div class="bg-gray-50 rounded-xl p-4 border-2 border-gray-100 focus-within:border-blue-300 transition-colors duration-300">
                            <textarea name="content" 
                                      rows="4" 
                                      class="w-full bg-transparent border-0 resize-none focus:outline-none text-gray-700 placeholder-gray-500" 
                                      placeholder="Bagikan pemikiran Anda tentang catatan ini..." 
                                      required></textarea>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit" 
                                    class="group bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white px-6 py-3 rounded-xl flex items-center gap-2 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                <span class="font-medium">Kirim Komentar</span>
                            </button>
                        </div>
                    </form>

                    {{-- Comments List --}}
                    <div class="space-y-4">
                        @forelse($note->comments as $comment)
                        <div x-data="{ editing: false, editedContent: @js($comment->content) }" 
                             class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl p-6 border border-gray-100 hover:shadow-md transition-all duration-300">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">{{ $comment->user->full_name ?? 'Anonim' }}</h4>
                                            <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>

                                    {{-- Edit Mode --}}
                                    <div x-show="editing" class="mt-4">
                                        <form method="POST" action="{{ route('note-comments.update', $comment->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="bg-white rounded-xl p-4 border-2 border-blue-200">
                                                <textarea name="content" 
                                                          x-model="editedContent"
                                                          class="w-full border-0 resize-none focus:outline-none text-gray-700" 
                                                          rows="3"></textarea>
                                            </div>
                                            <div class="flex gap-3 mt-4">
                                                <button type="submit"
                                                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-300">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Simpan
                                                </button>
                                                <button type="button" 
                                                        x-on:click="editing = false"
                                                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors duration-300">
                                                    Batal
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    {{-- Display Mode --}}
                                    <div x-show="!editing" class="mt-3">
                                        <p class="text-gray-700 leading-relaxed" x-text="editedContent"></p>
                                    </div>
                                </div>

                                {{-- Action Buttons --}}
                                @if ($currentUser && $comment->user_id === $currentUser->id)
                                <div class="flex gap-2 ml-4">
                                    <button x-on:click="editing = true"
                                            class="group p-2 text-blue-500 hover:bg-blue-100 rounded-lg transition-all duration-300">
                                        <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>

                                    <form action="{{ route('note-comments.destroy', $comment->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="group p-2 text-red-500 hover:bg-red-100 rounded-lg transition-all duration-300">
                                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12">
                            <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-600 mb-2">Belum ada komentar</h4>
                            <p class="text-gray-500">Jadilah yang pertama untuk memberikan komentar!</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-100 rounded-lg p-4 mt-4">
            <p class="text-sm text-gray-600">
                @php
                    $downloadLimit = \App\Models\DownloadLimit::where('user_id', $user->id)->first();
                    $count = $downloadLimit ? $downloadLimit->download_count : 0;
                    
                    $maxDownloads = 3; // Default untuk user gratis
                    $package = "Gratis";
                    
                    $latestTransaction = \App\Models\Transaction::where('user_id', $user->id)
                        ->with('payment')
                        ->latest()
                        ->first();

                    if ($latestTransaction && $latestTransaction->payment) {
                        if ($latestTransaction->payment->package === 'Genius') {
                            $maxDownloads = 5;
                            $package = "Genius";
                        } elseif ($latestTransaction->payment->package === 'Professor') {
                            $maxDownloads = 10;
                            $package = "Professor";
                        }
                    }
                @endphp
                
                <span class="font-semibold">Paket {{ $package }}</span><br>
                Download hari ini: {{ $count }}/{{ $maxDownloads }}
                @if($count >= $maxDownloads)
                    <br><span class="text-red-500">Batas download harian tercapai</span>
                @endif
            </p>
        </div>
    </div>
</div>

<style>
/* Custom animations */
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

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Custom scrollbar */
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
    const images = [...document.querySelectorAll('#imageGallery img')];
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const closeModal = document.getElementById('closeModal');
    const nextBtn = document.getElementById('nextImage');
    const prevBtn = document.getElementById('prevImage');
    let currentIndex = 0;

    function showModal(index) {
        currentIndex = index;
        modalImage.src = images[index].dataset.src;
        modal.classList.remove('hidden');
    }

    images.forEach((img, idx) => {
        img.addEventListener('click', () => showModal(idx));
    });

    closeModal.addEventListener('click', () => modal.classList.add('hidden'));

    nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % images.length;
        modalImage.src = images[currentIndex].dataset.src;
    });

    prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        modalImage.src = images[currentIndex].dataset.src;
    });

    // Tambahkan fungsi untuk mengecek dan menangani download
    async function handleDownload() {
        try {
            // Tampilkan loading
            Swal.fire({
                title: 'Memproses...',
                text: 'Sedang memeriksa batasan download',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        
            // Update counter di server
            const response = await fetch('{{ route("notes.increment-download", $note->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });
        
            // Tutup loading
            Swal.close();
        
            // Debug response
            console.log('Response status:', response.status);
            console.log('Response headers:', response.headers);

            // Cek content type response
            const contentType = response.headers.get('content-type');

            let data;
            try {
                const responseText = await response.text();
                console.log('Raw response:', responseText);

                if (contentType && contentType.includes('application/json')) {
                    data = JSON.parse(responseText);
                } else {
                    throw new Error('Server tidak mengembalikan JSON: ' + responseText);
                }
            } catch (parseError) {
                console.error('JSON Parse Error:', parseError);
                throw new Error('Gagal parsing response dari server');
            }

            console.log('Parsed data:', data);
        
            if (!response.ok) {
                if (response.status === 403) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Batas Download Tercapai',
                        text: 'Anda telah mencapai batas download harian. Upgrade akun untuk mendapatkan lebih banyak download!',
                        showCancelButton: true,
                        confirmButtonText: 'Upgrade Sekarang',
                        cancelButtonText: 'Tutup',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route("upgrade.plans") }}';
                        }
                    });
                    return;
                }

                throw new Error(data.error || 'Gagal memperbarui counter download');
            }
        
            // Jika berhasil, lakukan proses download PDF
            console.log('Starting PDF generation...');

            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF();

            // Pastikan ada gambar untuk didownload
            if (!images || images.length === 0) {
                throw new Error('Tidak ada gambar untuk didownload');
            }
        
            // Tampilkan progress download
            Swal.fire({
                title: 'Mengunduh...',
                text: 'Sedang membuat file PDF',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        
            // Process images untuk PDF
            for (let i = 0; i < images.length; i++) {
                const img = images[i];
                try {
                    // Gunakan src atau dataset.src
                    const imgSrc = img.dataset.src || img.src;
                    const imgData = await toDataURL(imgSrc);
                    if (i > 0) pdf.addPage();
                    pdf.addImage(imgData, 'JPEG', 10, 10, 190, 0);
                } catch (imgError) {
                    console.error('Error processing image:', imgError);
                    // Skip image yang error tapi lanjut process
                }
            }

            // Save PDF
            pdf.save(`catatan-${Date.now()}.pdf`);

            // Tutup loading dan tampilkan pesan sukses
            Swal.close();

            // Refresh halaman untuk update counter di UI
            setTimeout(() => {
                location.reload();
            }, 2000);

            Swal.fire({
                icon: 'success',
                title: 'Download Berhasil!',
                html: `
                    <p>File PDF berhasil diunduh!</p>
                    <small>Sisa download hari ini: <strong>${data.remaining_downloads}</strong></small>
                    <br>
                    <small>Total download hari ini: <strong>${data.current_count}/${data.max_downloads}</strong></small>
                `,
                timer: 3000,
                showConfirmButton: true,
                confirmButtonText: 'OK'
            });
        
        } catch (error) {
            console.error('Download Error:', error);

            // Tutup loading jika masih terbuka
            Swal.close();

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error.message || 'Terjadi kesalahan saat mengunduh file!',
                confirmButtonText: 'OK'
            });
        }
    }

    // Helper function untuk convert image ke data URL 
    function toDataURL(url) {
        return fetch(url)
            .then(res => {
                if (!res.ok) {
                    throw new Error(`Failed to fetch image: ${res.status}`);
                }
                return res.blob();
            })
            .then(blob => new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onloadend = () => resolve(reader.result);
                reader.onerror = reject;
                reader.readAsDataURL(blob);
            }));
    }

    // Update event listener untuk tombol download
    document.addEventListener('DOMContentLoaded', function() {
        const downloadBtn = document.getElementById('downloadPdfBtn');
        if (downloadBtn) {
            downloadBtn.addEventListener('click', handleDownload);
        }
    });
</script>

@endsection