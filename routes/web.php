<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ACL\AclController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WaybillController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\MovingJobController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PdfGeneratorController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\MailTemplatesController;
use App\Http\Controllers\AdditionalFieldController;

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


Route::get('/test-quotation-documents', function () {
    return view('documents.quotation-v1');
});

Route::get('/test-documents', [PdfGeneratorController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('6dem.index');

    Route::get('/6dem/dashboard', [DashboardController::class, 'index'])
        ->name('6dem.dashboard');

    Route::get('/6dem/documents', [DocumentController::class, 'index'])
        ->name('6dem.documents');

    Route::get('/6dem/quotation/preview/{id}', [QuotationController::class, 'preview'])
        ->name('6dem.documents.quotation.preview');

    # Organization
    Route::put('/6dem/organization/update', [OrganizationController::class, 'update'])
        ->name('6dem.organization.update');

    # Quotation
    Route::post('/6dem/quotation/init/{clientId}', [MovingJobController::class, 'initQuotation'])
        ->name('6dem.documents.quotation.init');

    Route::get('/6dem/documents/quotation/{movingjobId}/{clientId}/{quotationId}', [MovingJobController::class, 'quotation'])
        ->name('6dem.documents.quotation');

    Route::put('/6dem/quotation/update/{id}/{field}', [MovingJobController::class, 'updateQuotation'])
        ->name('6dem.quotation.update');

    Route::get('/6dem/quotation/search', [QuotationController::class, 'search'])
        ->name('6dem.search.quotation');

    # Waybill
    Route::get('/6dem/waybill/preview/{id}', [WaybillController::class, 'preview'])
        ->name('6dem.documents.waybill.preview');

    Route::post('/6dem/waybill/init/{quotationId}', [MovingJobController::class, 'initWaybill'])
        ->name('6dem.documents.waybill.init');

    Route::get('/6dem/documents/waybill/{movingjobId}/{clientId}/{waybillId}', [MovingJobController::class, 'waybill'])
        ->name('6dem.documents.waybill');

    Route::put('/6dem/waybill/update/{id}/{field}', [MovingJobController::class, 'updateWaybill'])
        ->name('6dem.waybill.update');

    # Invoice
    Route::get('/6dem/invoice/preview/{id}', [InvoiceController::class, 'preview'])
        ->name('6dem.documents.invoice.preview');

    Route::post('/6dem/invoice/init/{quotationId}', [MovingJobController::class, 'initInvoice'])
        ->name('6dem.documents.invoice.init');

    Route::get('/6dem/documents/invoice/{movingjobId}/{clientId}/{invoiceId}', [MovingJobController::class, 'invoice'])
        ->name('6dem.documents.invoice');

    Route::put('/6dem/invoice/update/{id}/{field}', [MovingJobController::class, 'updateInvoice'])
        ->name('6dem.invoice.update');

    # Option
    Route::post('/6dem/option/create/{id}/', [OptionController::class, 'store'])
        ->name('6dem.option.create');

    Route::put('/6dem/option/update/{id}/{field}', [OptionController::class, 'update'])
        ->name('6dem.option.update');

    Route::delete('/6dem/option/delete/{id}', [OptionController::class, 'delete'])
        ->name('6dem.option.delete');

    # Additional Fields
    Route::post('/6dem/additionalFields/create/{id}', [AdditionalFieldController::class, 'store'])
        ->name('6dem.additionalFields.create');

    Route::put('/6dem/additionalFields/update/{id}/{field}', [AdditionalFieldController::class, 'update'])
        ->name('6dem.additionalFields.update');

    Route::delete('/6dem/additionalFields/delete/{id}', [AdditionalFieldController::class, 'delete'])
        ->name('6dem.additionalFields.delete');

    # Insurance
    Route::put('/6dem/insurance/update/{id}/{field}', [InsuranceController::class, 'update'])
        ->name('6dem.insurance.update');

    Route::put('/6dem/insurance/update/contractual', [InsuranceController::class, 'contractual'])
        ->name('6dem.insurance.contractual');

    Route::put('/6dem/insurance/update/ad-valorem', [InsuranceController::class, 'adValorem'])
        ->name('6dem.insurance.adValorem');

    # Roles & Permissions
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

    # Users & Settings
    Route::post('/6dem/manage/invite-user', [AclController::class, 'inviteUser'])
        ->name('6dem.manage.invite.user');

    //Gérer les collaborateurs
    Route::delete('/6dem/manage/collaborateur/delete/{memberId}/{membeRole}', [AclController::class, 'deleteMember'])
        ->name('6dem.manage.collaborateur.delete');

    Route::put('/6dem/manage/collaborateur/updateUserRole/{id}', [AclController::class, 'UpdateRoleUser'])
        ->name('6dem.manage.collaborateur.userRole.update');

    Route::put('/6dem/manage/collaborateur/updateInvitRole/{id}', [AclController::class, 'UpdateRoleInvite'])
        ->name('6dem.manage.collaborateur.inviteRole.update');

    Route::get('/6dem/settings', [SettingsController::class, 'index'])
        ->name('6dem.settings');

    Route::put('/6dem/settings', [SettingsController::class, 'update'])
        ->name('6dem.settings.update');

    Route::get('/6dem/account', [OrganizationController::class, 'accountSettings'])
        ->name('6dem.account');

    Route::put('/6dem/password/update', [PasswordController::class, 'update'])
        ->name('6dem.password.update');

    Route::put('/6dem/profile/update', [ProfileController::class, 'update'])
        ->name('6dem.profile.update');

    Route::get('/6dem/storage', function () {
        return inertia('6dem/Storage');
    })->name('6dem.storage');

    // Manage Mail
    Route::get('/6dem/templates', [MailTemplatesController::class, 'index'])
        ->name('6dem.mail.templates');

    Route::post('/6dem/templates/create', [MailTemplatesController::class, 'store'])
        ->name('6dem.mail.templates.create');

    Route::delete('/maildel/{mail}', [MailTemplatesController::class, 'delete'])->name('maildel');
    Route::delete('/6dem/templates/delete/{id}', [MailTemplatesController::class, 'delete'])->name('6dem.mail.templates.delete');

    Route::put('/6dem/templates/{mail}', [MailTemplatesController::class, 'update'])
        ->name('6dem.mail.templates.update');

    Route::get('/6dem/clients', [ClientController::class, 'index'])
        ->name('6dem.clients');

    # Create Client
    Route::post('/6dem/clients/create', [ClientController::class, 'store'])
        ->name('6dem.create.clients');

    Route::get('/6dem/clients/search', [ClientController::class, 'search'])
        ->name('6dem.search.clients');

    Route::get('/6dem/tasks', function () {
        return inertia('6dem/Tasks');
    })->name('6dem.tasks');

    Route::get('/6dem/calendar', function () {
        return inertia('6dem/Calendar');
    })->name('6dem.calendar');

    Route::get('/6dem/messages', function () {
        return inertia('6dem/Messages');
    })->name('6dem.messages');
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
