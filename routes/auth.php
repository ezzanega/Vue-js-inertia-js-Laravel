<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


Route::middleware('guest')->group(function () {
    Route::get('/signup', [SignUpController::class, 'create'])
        ->name('6dem.signup');

    Route::post('/signup', [SignUpController::class, 'store']);

    Route::get('/signin', [SignInController::class, 'create'])
        ->name('6dem.signin');

    Route::post('/signin', [SignInController::class, 'store']);
});


Route::middleware('auth')->group(function () {
    Route::post('logout', [SignInController::class, 'destroy'])
        ->name('logout');
});
