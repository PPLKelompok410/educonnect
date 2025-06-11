@php
 $layout = session('is_admin') === true ? 'layouts.appadmin' : 'layouts.app';
@endphp
@extends($layout)
@section('title', 'Forum Diskusi (' . $matkul->nama . ')')
@section('content')
<div class="container mx-auto px-4 md:px-10 mt-10">
<div class="border rounded-xl p-6 mb-6 bg-gray-100 shadow">
<h2 class="text-2xl font-semibold mb-2 flex items-center gap-2">
<i class="bi bi-chat-dots"></i>
 Forum Diskusi: <span class="text-blue-600">{{ $matkul->nama }}</span>
</h2>
<p class="text-sm text-gray-600 flex items-center gap-4">
<span class="flex items-center gap-1">
<i class="bi bi-journal-code"></i> Kode: {{ $matkul->kode }}
</span>
<span class="flex items-center gap-1">
<i class="bi bi-building"></i> Prodi: {{ $matkul->prodi }}
</span>
</p>
</div>

<h4 class="text-xl font-semibold mb-4 flex items-center gap-2">
<i class="bi bi-chat-left-text"></i> Topik Diskusi
</h4>

@forelse($matkul->comments as $comment)
<div class="bg-white border rounded-xl shadow mb-6">
    <!-- Topik Diskusi Utama -->
    <div class="p-4 border-b border-gray-200">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                {{ substr($comment->user->full_name, 0, 1) }}
            </div>
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-2">
                    <h5 class="font-semibold text-gray-800">{{ $comment->user->full_name }}</h5>
                    <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                    <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">Topik</span>
                </div>
                <p class="text-gray-800 mb-3">{{ $comment->comment }}</p>
                
                <!-- Action Buttons untuk Topik -->
                <div class="flex items-center gap-3 text-sm">
                    <button onclick="toggleReplyForm({{ $comment->id }})" 
                            class="flex items-center gap-1 text-blue-600 hover:text-blue-800 transition">
                        <i class="bi bi-reply"></i> Balas
                    </button>
                    <span class="text-gray-400">•</span>
                    <span class="text-gray-500">
                        <i class="bi bi-chat"></i> {{ $comment->replies->count() }} balasan
                    </span>
                    
                    {{-- Action buttons untuk pemilik topik --}}
                    @if($user->id === $comment->user_id)
                    <div class="ml-auto flex gap-2">
                        <a href="{{ route('comments.edit', $comment->id) }}"
                           class="px-2 py-1 text-xs border border-blue-500 text-blue-500 rounded hover:bg-blue-50 transition">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin hapus topik ini beserta semua balasannya?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-2 py-1 text-xs border border-red-500 text-red-500 rounded hover:bg-red-50 transition">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Form Balas (Hidden by default) -->
    <div id="reply-form-{{ $comment->id }}" class="hidden p-4 bg-gray-50 border-b border-gray-200">
        <form action="{{ route('replies.store', $comment->id) }}" method="POST">
            @csrf
            <div class="flex gap-3">
                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                    {{ Auth::check() ? substr(Auth::user()->full_name, 0, 1) : 'A' }}
                </div>
                <div class="flex-1">
                    <textarea name="reply" rows="3" 
                              class="w-full p-3 border border-gray-300 rounded-md focus:ring focus:ring-green-200 focus:outline-none text-sm"
                              placeholder="Tulis balasan Anda..." required></textarea>
                    <div class="flex gap-2 mt-2">
                        <button type="submit"
                                class="px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition">
                            <i class="bi bi-send"></i> Kirim Balasan
                        </button>
                        <button type="button" onclick="toggleReplyForm({{ $comment->id }})"
                                class="px-3 py-1 border border-gray-300 text-gray-600 text-sm rounded hover:bg-gray-50 transition">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Daftar Balasan -->
    @if($comment->replies && $comment->replies->count() > 0)
    <div class="bg-gray-50">
        @foreach($comment->replies as $reply)
        <div class="p-4 border-b border-gray-200 last:border-b-0">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                    {{ substr($reply->user->full_name, 0, 1) }}
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <h6 class="font-medium text-gray-800">{{ $reply->user->full_name }}</h6>
                        <span class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                        <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Balasan</span>
                    </div>
                    <p class="text-gray-700 text-sm mb-2">{{ $reply->reply }}</p>
                    
                    {{-- Action buttons untuk pemilik balasan --}}
                    @if($user->id === $reply->user_id)
                    <div class="flex gap-2">
                        <a href="{{ route('replies.edit', $reply->id) }}"
                           class="px-2 py-1 text-xs border border-blue-500 text-blue-500 rounded hover:bg-blue-50 transition">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('replies.destroy', $reply->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin hapus balasan ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-2 py-1 text-xs border border-red-500 text-red-500 rounded hover:bg-red-50 transition">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@empty
<div class="text-center py-12">
    <i class="bi bi-chat-dots text-6xl text-gray-300 mb-4"></i>
    <p class="text-gray-500 text-lg">💬 Belum ada topik diskusi. Jadilah yang pertama memulai diskusi!</p>
</div>
@endforelse

<hr class="my-8 border-gray-300">

<!-- Form Tambah Topik Diskusi -->
<div class="bg-white border rounded-xl shadow p-6">
    <h4 class="text-xl font-semibold mb-4 flex items-center gap-2">
        <i class="bi bi-plus-circle text-green-600"></i> Tambah Topik Diskusi Baru
    </h4>
    <form action="{{ route('comments.store', $matkul->id) }}" method="POST">
        @csrf
        <div class="flex gap-4">
            <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                {{ Auth::check() ? substr(Auth::user()->full_name, 0, 1) : 'A' }}
            </div>
            <div class="flex-1">
                <textarea name="comment" id="comment" rows="4"
                          class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200 focus:border-green-500 focus:outline-none"
                          placeholder="Mulai topik diskusi baru... Jelaskan pertanyaan atau topik yang ingin didiskusikan." required></textarea>
                <div class="flex justify-between items-center mt-3">
                    <div class="text-sm text-gray-500">
                        <i class="bi bi-info-circle"></i> Topik yang baik akan mendapat lebih banyak tanggapan
                    </div>
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium">
                        <i class="bi bi-send"></i> Posting Topik
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>

<script>
function toggleReplyForm(commentId) {
    const replyForm = document.getElementById('reply-form-' + commentId);
    if (replyForm.classList.contains('hidden')) {
        replyForm.classList.remove('hidden');
        replyForm.querySelector('textarea').focus();
    } else {
        replyForm.classList.add('hidden');
    }
}

// Auto-resize textarea
document.addEventListener('DOMContentLoaded', function() {
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });
});
</script>

<style>
/* Custom scrollbar untuk area diskusi */
.overflow-y-auto::-webkit-scrollbar {
    width: 4px;
}

.overflow-y-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 2px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Animasi untuk form reply */
#reply-form-{{ $comment->id ?? '' }} {
    transition: all 0.3s ease-in-out;
}
</style>
@endsection