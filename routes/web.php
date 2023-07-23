<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ACL\AclController;
use App\Http\Controllers\AdditionalFieldController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovingJobController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\QuotationController;

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

    Route::get('/6dem/dashboard', [DashboardController::class, 'index'])
        ->name('6dem.dashboard');

    Route::get('/6dem/documents', [QuotationController::class, 'index'])
        ->name('6dem.documents');

    Route::get('/6dem/quotation/preview/{id}', [QuotationController::class, 'preview'])
        ->name('6dem.documents.quotation.preview');

    # Organization
    Route::put('/6dem/organization/update', [OrganizationController::class, 'update'])
        ->name('6dem.organization.update');

    Route::post('/6dem/quotation/init/{clientId}', [MovingJobController::class, 'initQuotation'])
        ->name('6dem.documents.quotation.init');

    Route::get('/6dem/documents/quotation/{movingjobId}/{clientId}/{quotationId}/{optionId}', [MovingJobController::class, 'quotation'])
        ->name('6dem.documents.quotation');

    Route::put('/6dem/quotation/update/{id}/{field}', [MovingJobController::class, 'updateQuotation'])
        ->name('6dem.quotation.update');

    Route::get('/6dem/quotation/search', [QuotationController::class, 'search'])
        ->name('6dem.search.quotation');

    Route::post('/6dem/waybill/init/{quotationId}', [MovingJobController::class, 'initWaybill'])
        ->name('6dem.documents.waybill.init');

    Route::get('/6dem/documents/waybill/{movingjobId}/{clientId}/{waybillId}', [MovingJobController::class, 'waybill'])
        ->name('6dem.documents.waybill');

    Route::put('/6dem/waybill/update/{id}/{field}', [MovingJobController::class, 'updateWaybill'])
        ->name('6dem.waybill.update');

    Route::post('/6dem/option/create/{id}/', [OptionController::class, 'store'])
        ->name('6dem.option.create');

    Route::put('/6dem/option/update/{id}/{field}', [OptionController::class, 'update'])
        ->name('6dem.option.update');

    Route::post('/6dem/additionalFields/create/{id}', [AdditionalFieldController::class, 'store'])
        ->name('6dem.additionalFields.create');

    Route::put('/6dem/additionalFields/update/{id}/{field}', [AdditionalFieldController::class, 'update'])
        ->name('6dem.additionalFields.update');

    Route::put('/6dem/insurance/update/{id}/{field}', [InsuranceController::class, 'update'])
        ->name('6dem.insurance.update');

    Route::get('/6dem/documents/nouvelle-lettre-voiture', function () {
        return inertia('6dem/Lettre de voiture');
    })->name('6dem.documents.lettreVoiture');

    Route::get('/6dem/documents/nouvelle-facture', function () {
        return inertia('6dem/Invoice');
    })->name('6dem.documents.invoice');

    Route::get('/6dem/manage', [AclController::class, 'index'])
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

    Route::get('/6dem/settings', [OrganizationController::class, 'accountSettings'])
        ->name('6dem.settings');

    Route::get('/6dem/account', [OrganizationController::class, 'accountSettings'])
        ->name('6dem.account');

    Route::put('/6dem/password/update', [PasswordController::class, 'update'])
        ->name('6dem.password.update');

    Route::put('/6dem/profile/update', [ProfileController::class, 'update'])
        ->name('6dem.profile.update');

    Route::get('/6dem/storage', function () {
        return inertia('6dem/Storage');
    })->name('6dem.storage');

    Route::get('/6dem/templetes', function () {
        return inertia('6dem/Templetes');
    })->name('6dem.templetes');

    Route::get('/6dem/clients', [ClientController::class, 'index'])
        ->name('6dem.clients');

    # Create Client
    Route::post('/6dem/clients/create', [ClientController::class, 'store'])
        ->name('6dem.create.clients');

    Route::get('/6dem/clients/search', [ClientController::class, 'search'])
        ->name('6dem.search.clients');
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
