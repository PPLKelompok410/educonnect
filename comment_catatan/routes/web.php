<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NoteCommentController;

Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');

Route::get('/notes/{note}', [NoteController::class, 'show'])->name('notes.show');

Route::post('/notes/{note}/comments', [NoteCommentController::class, 'store'])->name('note-comments.store');
Route::put('/note-comments/{comment}', [NoteCommentController::class, 'update'])->name('note-comments.update');
Route::delete('/note-comments/{comment}', [NoteCommentController::class, 'destroy'])->name('note-comments.destroy');

Route::post('/logout', function() {
    Auth::logout();
    return redirect('/');
})->name('logout');
