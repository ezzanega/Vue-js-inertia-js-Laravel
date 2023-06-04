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


/*Route::get('/signin', function () {
    return inertia('Auth/SignIn');
})->name('6dem.signin');

Route::get('/signup', function () {
    return inertia('Auth/SignUp');
})->name('6dem.signup');;*/

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

<<<<<<< HEAD
Route::get('/6dem/documents',function () {
    return inertia('6dem/Documents');
} )->name('6dem.documents');

Route::get('/6dem/manage', [AclController::class, 'create'])
    ->name('6dem.manage');
=======
    Route::get('/6dem/dashboard', function () {
        return inertia('6dem/Dashboard');
    })->name('6dem.dashboard');

    Route::get('/6dem/clients', function () {
        return inertia('6dem/Clients');
    })->name('6dem.clients');
>>>>>>> 7414dbbd187b3b0370fe0d421a6ec892a8261629

    Route::get('/6dem/documents', function () {
        return inertia('6dem/Documents');
    })->name('6dem.documents');

    Route::get('/6dem/manage', function () {
        return inertia('6dem/Manage');
    })->name('6dem.manage');

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
