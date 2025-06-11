@php
    $layout = session('is_admin') === true ? 'layouts.appadmin' : 'layouts.app';
@endphp

@extends($layout)

@section('title', 'Forum Diskusi - ' . $matkul->nama)

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
    <div class="bg-white border rounded-xl shadow p-4 mb-4">
        <p class="text-gray-800 mb-3">{{ $comment->comment }}</p>
        <div class="flex justify-between items-center text-sm text-gray-500">
            <span>
                oleh <strong class="text-gray-700">{{ $comment->user->full_name }}</strong> |
                {{ $comment->created_at->locale('id')->diffForHumans() }} {{-- Menggunakan diffForHumans() --}}
            </span>

            {{-- Show edit/delete only for comment owner --}}
            @if(session('user_id') === $comment->user_id)
            <div class="flex gap-2">
                <a href="{{ route('comments.edit', $comment->id) }}"
                    class="px-3 py-1 border border-blue-500 text-blue-500 text-sm rounded hover:bg-blue-100 transition">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" 
                      onsubmit="return confirm('Yakin hapus komentar ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-3 py-1 border border-red-500 text-red-500 text-sm rounded hover:bg-red-100 transition">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
    @empty
    <p class="text-gray-500">💬 Belum ada topik diskusi. Jadilah yang pertama!</p>
    @endforelse

    <hr class="my-8 border-gray-300">

    @if(isset($user) && $user)
        <!-- Form tambah komentar hanya muncul jika user login -->
        <div class="mt-6">
            <h4 class="text-xl font-semibold flex items-center gap-2">
                <i class="bi bi-plus-circle"></i> Tambah Topik Diskusi
            </h4>
            <form action="{{ route('comments.store', $matkul->id) }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-4">
                    <textarea name="comment" id="comment" rows="3" 
                        class="w-full p-3 border border-gray-300 rounded-md focus:ring focus:ring-green-200 focus:outline-none"
                        placeholder="Tulis topikmu..." required></textarea>
                </div>
                <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                    <i class="bi bi-send"></i> Kirim
                </button>
            </form>
        </div>
    @else
        <div class="text-center py-4">
            <p>Silakan <a href="{{ route('auth.login') }}" class="text-blue-600 hover:underline">login</a> untuk berpartisipasi dalam diskusi</p>
        </div>
    @endif


</div>
@endsection