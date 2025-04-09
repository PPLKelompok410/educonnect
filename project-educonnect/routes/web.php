<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MataKuliahController;

Route::post('/matkul/{matkulId}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/matkul', [MataKuliahController::class, 'index']);