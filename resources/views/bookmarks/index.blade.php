@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-200">
                    <h2 class="text-xl font-bold mb-4">Bookmark Saya</h2>

                    @if($bookmarks->isEmpty())
                        <div class="text-center py-6">
                            <div class="text-gray-500">
                                <svg class="mx-auto h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                                <h3 class="mt-2 text-xs font-medium text-gray-900">Tidak ada bookmark</h3>
                                <p class="mt-1 text-xs text-gray-500">Mulai bookmark catatan yang Anda sukai.</p>
                            </div>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($bookmarks as $bookmark)
                                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                                    <div class="p-4">
                                        @if($bookmark->note->file_path)
                                            <div class="aspect-w-16 aspect-h-9 mb-3">
                                                <img src="{{ asset('storage/' . $bookmark->note->file_path) }}" 
                                                     alt="{{ $bookmark->note->judul }}"
                                                     class="object-cover w-full h-32 rounded-lg">
                                            </div>
                                        @endif
                                        
                                        <div class="flex justify-between items-start mb-3">
                                            <h3 class="text-base font-semibold text-gray-900">{{ $bookmark->note->judul }}</h3>
                                            <form action="{{ route('bookmarks.destroy', $bookmark->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                        <div class="text-xs text-gray-600 mb-3">
                                            <p>Mata Kuliah: {{ $bookmark->note->matkul->nama }}</p>
                                            <p class="mt-1">Oleh: {{ $bookmark->note->user->name }}</p>
                                            <p class="mt-1">Dibookmark: {{ $bookmark->created_at->diffForHumans() }}</p>
                                        </div>

                                        <a href="{{ route('notes.show', $bookmark->note->id) }}" 
                                           class="inline-flex items-center px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-md transition-colors duration-200">
                                            <span>Lihat Catatan</span>
                                            <svg class="ml-1.5 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection