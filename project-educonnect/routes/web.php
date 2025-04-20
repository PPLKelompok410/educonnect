<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NoteCommentController;

// Page Galeri Matkul (Home)
Route::get('/', [MataKuliahController::class, 'index']);

// Page Diskusi di Matkul
Route::get('/matkul/{id}/discussion', [MataKuliahController::class, 'discussion'])->name('matkul.discussion');
Route::post('/matkul/{matkulId}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

// Page notes 
Route::get('/matkul/{matkul}/notes', [NoteController::class, 'index'])->name('notes.index');

// Page comments di notes
Route::get('/notes/{note}', [NoteController::class, 'show'])->name('notes.show');
Route::post('/notes/{note}/comments', [NoteCommentController::class, 'store'])->name('note-comments.store');
Route::put('/note-comments/{comment}', [NoteCommentController::class, 'update'])->name('note-comments.update');
Route::delete('/note-comments/{comment}', [NoteCommentController::class, 'destroy'])->name('note-comments.destroy');
