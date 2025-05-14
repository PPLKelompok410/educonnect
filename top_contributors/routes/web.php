<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopContributorsController;

Route::get('/top-contributors', [TopContributorsController::class, 'index'])->name('top-contributors.index');


