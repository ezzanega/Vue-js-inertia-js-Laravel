<?php

use App\Http\Controllers\ACL\AclController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/forgotpassword', function () {
    return inertia('ForgotPassword');
})->name('6dem.forgot-password');

Route::get('/resetpassword', function () {
    return inertia('ResetPassword');
})->name('6dem.reset-password');

Route::get('/design-system', function () {
    return inertia('6dem/DesignSystem');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return inertia('6dem/Index');
    });

    Route::get('/6dem/dashboard', function () {
        return inertia('6dem/Dashboard');
    })->name('6dem.dashboard');

    Route::get('/6dem/clients', function () {
        return inertia('6dem/Clients');
    })->name('6dem.clients');

    Route::get('/6dem/documents', function () {
        return inertia('6dem/Documents');
    })->name('6dem.documents');

    Route::get('/6dem/documents/nouveau-devis', function () {
        return inertia('6dem/Devis');
    })->name('6dem.documents.devis');

    Route::get('/6dem/documents/nouvelle-lettre-voiture', function () {
        return inertia('6dem/Lettre de voiture');
    })->name('6dem.documents.lettreVoiture');

    Route::get('/6dem/documents/nouvelle-facture', function () {
        return inertia('6dem/Invoice');
    })->name('6dem.documents.invoice');

    Route::get('/6dem/manage', [AclController::class, 'create'])
        ->name('6dem.manage');

    Route::post('/6dem/manage/role', [AclController::class, 'store'])
        ->name('6dem.manage.role');

    Route::get('/6dem/manage/role/permissions/{id}', [AclController::class, 'getPermissionsById'])
        ->name('6dem.manage.role.getPermissionsById');

    Route::put('/6dem/manage/role/{id}', [AclController::class, 'update'])
        ->name('6dem.manage.role.update');

    Route::delete('/6dem/manage/role/{id}', [AclController::class, 'delete'])
        ->name('6dem.manage.role.delete');

    Route::post('/6dem/manage/invite-user', [AclController::class, 'inviteUser'])
        ->name('6dem.manage.invite.user');

    Route::get('/6dem/settings', function () {
        return inertia('6dem/Settings');
    })->name('6dem.settings');

    Route::get('/6dem/storage', function () {
        return inertia('6dem/Storage');
    })->name('6dem.storage');

    Route::get('/6dem/templetes', function () {
        return inertia('6dem/Templetes');
    })->name('6dem.templetes');
});



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
