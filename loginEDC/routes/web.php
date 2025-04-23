<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


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
Route::post('/reset_password_process', [AuthController::class, 'process_reset_password'])->name('auth.reset_password_process');