<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NoteCommentController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AuthController;


Route::view('/', 'welcome')->name('welcome');
Route::view('/dashboard', 'dashboard')->name('dashboard');

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login_process', [AuthController::class, 'login_process'])->name('auth.login_process');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register_process', [AuthController::class, 'register_process'])->name('auth.register_process');

Route::get('/forgot_password', [AuthController::class, 'forgot_password'])->name('auth.forgot_password');
Route::post('/forgot_password_process', [AuthController::class, 'process_forgot_password'])->name('auth.forgot_password_process');
Route::get('/security_question', [AuthController::class, 'security_question'])->name('auth.security_question');
Route::post('/security_question_process', [AuthController::class, 'process_security_question'])->name('auth.security_question_process');
Route::get('/reset_password', [AuthController::class, 'reset_password'])->name('auth.reset_password');
Route::post('/reset_password_process', [AuthController::class, 'reset_password_process'])->name('auth.reset_password_process');

// Page Galeri Matkul 
Route::get('/matkul', [MataKuliahController::class, 'index']);
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
Route::post('/notes/{note}/rate', [NoteController::class, 'rate'])->name('notes.rate');

// Page comments di notes
Route::get('/notes/{note}', [NoteController::class, 'show'])->name('notes.show');
Route::post('/notes/{note}/comments', [NoteCommentController::class, 'store'])->name('note-comments.store');
Route::put('/note-comments/{comment}', [NoteCommentController::class, 'update'])->name('note-comments.update');
Route::delete('/note-comments/{comment}', [NoteCommentController::class, 'destroy'])->name('note-comments.destroy');

Route::get('profiles', [ProfilController::class, 'index'])->name('profiles.index');
Route::get('profiles/create', [ProfilController::class, 'create'])->name('profiles.create');
Route::post('profiles', [ProfilController::class, 'store'])->name('profiles.store');
Route::get('profiles/{profile}', [ProfilController::class, 'show'])->name('profiles.show');
Route::get('profiles/{profile}/edit', [ProfilController::class, 'edit'])->name('profiles.edit');
Route::put('profiles/{profile}', [ProfilController::class, 'update'])->name('profiles.update');
Route::delete('profiles/{profile}', [ProfilController::class, 'destroy'])->name('profiles.destroy');