<?php

use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [SignUpController::class, 'create'])
    ->name('register');

Route::post('/register', [SignUpController::class, 'store']);

Route::get('/login', [SignInController::class, 'create'])
    ->name('login');

Route::post('/login', [SignInController::class, 'store']);
