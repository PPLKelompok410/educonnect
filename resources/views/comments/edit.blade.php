@extends('layouts.app')

@section('title', 'Edit Komentar')

@section('content')
<div class="container mx-auto px-4 md:px-10 mt-10">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold mb-2 flex items-center gap-2">
                <i class="bi bi-pencil-square text-blue-600"></i>
                Edit Komentar
            </h2>
            <p class="text-gray-600">Perbarui komentar Anda dalam diskusi</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Comment Textarea -->
                <div class="mb-6">
                    <textarea 
                        name="comment" 
                        id="comment" 
                        rows="4" 
                        class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none transition-all duration-200"
                        placeholder="Tulis komentar Anda..."
                        required
                    >{{ $comment->comment }}</textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3">
                    <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center gap-2">
                        <i class="bi bi-check2"></i>
                        Simpan Perubahan
                    </button>
                    <a href="{{ url()->previous() }}" 
                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200 flex items-center gap-2">
                        <i class="bi bi-x"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection