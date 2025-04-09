<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MataKuliahController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/matkul', [MataKuliahController::class, 'index']);