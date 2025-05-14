<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('profiles', [ProfilController::class, 'index'])->name('profiles.index');
Route::get('profiles/create', [ProfilController::class, 'create'])->name('profiles.create');
Route::post('profiles', [ProfilController::class, 'store'])->name('profiles.store');
Route::get('profiles/{profile}', [ProfilController::class, 'show'])->name('profiles.show');
Route::get('profiles/{profile}/edit', [ProfilController::class, 'edit'])->name('profiles.edit');
Route::put('profiles/{profile}', [ProfilController::class, 'update'])->name('profiles.update');
Route::delete('profiles/{profile}', [ProfilController::class, 'destroy'])->name('profiles.destroy');
