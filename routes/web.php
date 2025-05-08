<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NoteCommentController;

// Page Galeri Matkul (Home)
Route::get('/', [MataKuliahController::class, 'index']);
Route::get('/matkul/manage', [MataKuliahController::class, 'manage'])->name('matkul.manage');
Route::get('/matkul/create', [MataKuliahController::class, 'create'])->name('matkul.create');
Route::post('/matkul', [MataKuliahController::class, 'store'])->name('matkul.store');
Route::get('/matkul/{id}/edit', [MataKuliahController::class, 'edit'])->name('matkul.edit');
Route::put('/matkul/{id}', [MataKuliahController::class, 'update'])->name('matkul.update');
Route::delete('/matkul/{id}', [MataKuliahController::class, 'destroy'])->name('matkul.destroy');


// Page Diskusi di Matkul
Route::get('/matkul/{id}/discussion', [MataKuliahController::class, 'discussion'])->name('matkul.discussion');
Route::post('/matkul/{matkulId}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

// Page notes 
Route::get('/matkul/{matkul}', [NoteController::class, 'index'])->name('notes.index');
Route::get('/notes/create/{matkul}', [NoteController::class, 'create'])->name('notes.create');
Route::post('/notes/{matkul}', [NoteController::class, 'store'])->name('notes.store');
Route::get('/notes/{note}', [NoteController::class, 'show'])->name('notes.show');
Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');


// Page comments di notes
Route::get('/notes/{note}', [NoteController::class, 'show'])->name('notes.show');
Route::post('/notes/{note}/comments', [NoteCommentController::class, 'store'])->name('note-comments.store');
Route::put('/note-comments/{comment}', [NoteCommentController::class, 'update'])->name('note-comments.update');
Route::delete('/note-comments/{comment}', [NoteCommentController::class, 'destroy'])->name('note-comments.destroy');
