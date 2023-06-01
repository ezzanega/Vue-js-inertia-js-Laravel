<?php

use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use Illuminate\Support\Facades\Route;

Route::get('/signup', [SignUpController::class, 'create'])
    ->name('6dem.signup');

Route::post('/signup', [SignUpController::class, 'store']);

Route::get('/signin', [SignInController::class, 'create'])
    ->name('6dem.signin');

Route::post('/signin', [SignInController::class, 'store']);
