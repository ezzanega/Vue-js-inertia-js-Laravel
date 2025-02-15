<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AdminController;
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
use App\Http\Controllers\CalendarEventController;
use App\Http\Controllers\MailTemplatesController;
use App\Http\Controllers\AdditionalFieldController;
use App\Http\Controllers\ExecutingCompanyController;

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


Route::get('/test-quotation-doc', function () {
    return view('documents.test');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'redirect'])
        ->name('6dem.index');

    Route::get('/6dem/dashboard', [DashboardController::class, 'index'])
        ->name('6dem.dashboard');
    #Admin
    Route::get('/6dem/Admin', [AdminController::class, 'index'])
    ->name('6dem.admin');

    # Documents
    Route::get('/6dem/documents/quotation/pdf/{id}', [PdfGeneratorController::class, 'quotation'])
        ->name('6dem.quotation.pdf');

    Route::get('/6dem/documents', [DocumentController::class, 'index'])
        ->name('6dem.documents');

    Route::get('/6dem/documents/waybill/pdf/{id}', [PdfGeneratorController::class, 'waybill'])
        ->name('6dem.waybill.pdf');

    Route::get('/6dem/documents/invoice/pdf/{id}', [PdfGeneratorController::class, 'invoice'])
        ->name('6dem.invoice.pdf');

    Route::get('/6dem/documents/quotation/download/{id}', [PdfGeneratorController::class, 'downloadQuotation'])
        ->name('6dem.quotation.download');

    Route::get('/6dem/documents/waybill/download/{id}', [PdfGeneratorController::class, 'downloadWaybill'])
        ->name('6dem.waybill.download');

    Route::get('/6dem/documents/invoice/download/{id}', [PdfGeneratorController::class, 'downloadInvoice'])
        ->name('6dem.invoice.download');

    Route::get('/6dem/documents/send/quotation/{id}', [PdfGeneratorController::class, 'sendQuotationToClient'])
        ->name('6dem.documents.send.quotation');

    Route::get('/6dem/documents/send/waybill/{id}', [PdfGeneratorController::class, 'sendWaybillToClient'])
        ->name('6dem.documents.send.waybill');

    Route::get('/6dem/documents/send/invoice/{id}', [PdfGeneratorController::class, 'sendInvoiceToClient'])
        ->name('6dem.documents.send.invoice');

    # Organization
    Route::put('/6dem/organization/update', [OrganizationController::class, 'update'])
        ->name('6dem.organization.update');

    Route::post('/6dem/organization/upload-logo', [OrganizationController::class, 'uploadLogo'])
        ->name('6dem.organization.upload.logo');

    # MovingJob
    Route::put('/6dem/documents/movingjob/update/{id}', [MovingJobController::class, 'updateMovingJob'])
        ->name('6dem.movingJob.update');

    # Quotation
    Route::post('/6dem/documents/quotation/init/{clientId}', [MovingJobController::class, 'initQuotation'])
        ->name('6dem.documents.quotation.init');

    Route::get('/6dem/documents/quotation/{movingjobId}/{clientId}/{quotationId}', [MovingJobController::class, 'quotation'])
        ->name('6dem.documents.quotation');

    Route::put('/6dem/documents/quotation/update/{id}/{field}', [MovingJobController::class, 'updateQuotation'])
        ->name('6dem.quotation.update');

    Route::put('/6dem/quotation/location/{id}/{from}', [MovingJobController::class, 'createUpdateLocation'])
        ->name('6dem.quotation.location');

    Route::get('/6dem/documents/quotation/preview/{id}', [QuotationController::class, 'preview'])
        ->name('6dem.documents.quotation.preview');

    Route::post('/6dem.documents.quotation.duplicate/{id}', [QuotationController::class, 'duplicate'])
        ->name('6dem.documents.quotation.duplicate');

    Route::put('/6dem.documents.payment.quotation/{id}', [QuotationController::class, 'SavePayment'])
        ->name('6dem.documents.payment.quotation');

    Route::get('/6dem/documents/quotation/search', [QuotationController::class, 'search'])
        ->name('6dem.search.quotation');

    Route::get('/6dem/documents/quotation/sort', [QuotationController::class, 'sort'])
        ->name('6dem.sort.quotation');
    # Delete Quotation
    Route::delete('/6dem/documents/quotation/delete/{id}', [QuotationController::class, 'deleteQuotation'])
        ->name('6dem.delete.quotation');


    # Waybill
    Route::post('/6dem/documents/waybill/init/{quotationId}', [MovingJobController::class, 'initWaybill'])
        ->name('6dem.documents.waybill.init');

    Route::get('/6dem/documents/waybill/{movingjobId}/{clientId}/{waybillId}', [MovingJobController::class, 'waybill'])
        ->name('6dem.documents.waybill');

    Route::put('/6dem/documents/waybill/update/{id}/{field}', [MovingJobController::class, 'updateWaybill'])
        ->name('6dem.waybill.update');

    Route::get('/6dem/documents/waybill/preview/{id}', [WaybillController::class, 'preview'])
        ->name('6dem.documents.waybill.preview');

    Route::put('/6dem/documents/waybill/updateStatus/{id}/{field}', [WaybillController::class, 'updateStatutWaybill'])
        ->name('6dem.waybill.updateStatus');

    Route::post('/6dem/documents/waybill/quotation/preview/{id}', [MovingJobController::class, 'initWaybillPreview'])
        ->name('6dem.documents.waybill.quotation.preview');

    Route::get('/6dem/documents/waybill/search', [WaybillController::class, 'search'])
        ->name('6dem.search.waybill');


    # Delete Waybill
    Route::delete('/6dem/documents/waybill/delete/{id}', [WaybillController::class, 'deleteWaybill'])
        ->name('6dem.delete.waybill');

    Route::get('/6dem/documents/waybill/sort', [WaybillController::class, 'sort'])
        ->name('6dem.sort.waybill');

    # Invoice
    Route::post('/6dem/documents/invoice/init/{quotationId}', [MovingJobController::class, 'initInvoice'])
        ->name('6dem.documents.invoice.init');

    Route::get('/6dem/documents/documents/invoice/{movingjobId}/{clientId}/{invoiceId}', [MovingJobController::class, 'invoice'])
        ->name('6dem.documents.invoice');

    Route::put('/6dem/documents/invoice/update/{id}', [MovingJobController::class, 'updateInvoice'])
        ->name('6dem.invoice.update');

    Route::get('/6dem/documents/invoice/preview/{id}', [InvoiceController::class, 'preview'])
        ->name('6dem.documents.invoice.preview');

    Route::put('/6dem/documents/invoice/updateStatus/{id}/{field}', [InvoiceController::class, 'updateStatutInvoice'])
        ->name('6dem.invoice.updateStatus');

    Route::put('/6dem/documents/invoice/updateAmounts/{id}', [InvoiceController::class, 'updateAmountsInvoice'])
        ->name('6dem.invoice.updateAmountsInvoice');

    Route::post('/6dem/documents/invoice/quotation/preview/{id}', [MovingJobController::class, 'initInvoicePreview'])
        ->name('6dem.documents.invoice.quotation.preview');

    Route::get('/6dem/documents/invoice/search', [InvoiceController::class, 'search'])
        ->name('6dem.search.invoice');
    # Delete Invoice
    Route::delete('/6dem/documents/invoice/delete/{id}', [InvoiceController::class, 'deleteInvoice'])
        ->name('6dem.delete.invoice');

    Route::get('/6dem/documents/invoice/sort', [InvoiceController::class, 'sort'])
        ->name('6dem.sort.invoice');

    # Option
    Route::post('/6dem/option/create/{id}/', [OptionController::class, 'store'])
        ->name('6dem.option.create');

    Route::put('/6dem/option/update/{id}', [OptionController::class, 'update'])
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

    Route::get('/6dem/settings', [SettingsController::class, 'index'])
        ->name('6dem.settings');

    Route::put('/6dem/settings', [SettingsController::class, 'update'])
        ->name('6dem.settings.update');
    #update Formulas name ans slug
    Route::put('/6dem/formula/update/{id}', [SettingsController::class, 'update_Formulas'])->name('6dem.formula.update');
    #delete Formulas
    Route::delete('/6dem/formula/delete/{id}', [SettingsController::class, 'delete_Formulas'])->name('6dem.formula.delete');
    #Create Formulas
    Route::post('/6dem/formula/create/', [SettingsController::class, 'create_Formulas'])->name('6dem.formula.create');

    Route::put('/6dem/formula/option/update/{id}', [SettingsController::class, 'update_Formulas_option'])->name('6dem.formula.option.update');
    #delete Formulas options
    Route::delete('/6dem/formula/option/delete/{id}', [SettingsController::class, 'delete_Formulas_option'])->name('6dem.formula.option.delete');

    #Add Option to formulas
    Route::post('/6dem/formula/option/create/', [SettingsController::class, 'addOptionToFormula'])
        ->name('6dem.settings.create');


    #Executing Companies
    Route::post('/6dem/executing-comapnies/create', [ExecutingCompanyController::class, 'store'])
        ->name('6dem.create.executingCompany');

    Route::put('/6dem/executingCompany/update/{id}', [ExecutingCompanyController::class, 'update'])
        ->name('6dem.udpate.executingCompany');

    Route::delete('/6dem/executingCompany/delete/{id}', [ExecutingCompanyController::class, 'delete'])
        ->name('6dem.executingCompany.delete');

    //Gérer les collaborateurs
    Route::delete('/6dem/manage/collaborateur/delete/{memberId}/{membeRole}', [AclController::class, 'deleteMember'])
        ->name('6dem.manage.collaborateur.delete');

    Route::put('/6dem/manage/collaborateur/updateUserRole/{id}', [AclController::class, 'UpdateRoleUser'])
        ->name('6dem.manage.collaborateur.userRole.update');

    Route::put('/6dem/manage/collaborateur/updateInvitRole/{id}', [AclController::class, 'UpdateRoleInvite'])
        ->name('6dem.manage.collaborateur.inviteRole.update');

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

    Route::delete('/6dem/templates/maildel/{mail}', [MailTemplatesController::class, 'delete'])->name('maildel');
    Route::delete('/6dem/templates/delete/{id}', [MailTemplatesController::class, 'delete'])->name('6dem.mail.templates.delete');

    Route::put('/6dem/templates/{mail}', [MailTemplatesController::class, 'update'])
        ->name('6dem.mail.templates.update');

    Route::get('/6dem/clients', [ClientController::class, 'index'])
        ->name('6dem.clients');

    # Search Client
    Route::get('/6dem/clients/search', [ClientController::class, 'search'])
        ->name('6dem.search.clients');

    Route::get('/6dem/clients/details/{id}', [ClientController::class, 'clientDetails'])
        ->name('6dem.clients.details');

    # Create Client
    Route::post('/6dem/clients/create', [ClientController::class, 'store'])
        ->name('6dem.create.clients');
    # Delete Client
    Route::delete('/6dem/clients/delete/{id}', [ClientController::class, 'deleteClient'])
        ->name('6dem.delete.clients');
    # update Client
    Route::put('/6dem/clients/update/{id}', [ClientController::class, 'updateClient'])
        ->name('6dem.update.clients');

    Route::get('/6dem/clients/sort', [ClientController::class, 'sort'])
        ->name('6dem.sort.client');

    # Calendar Event
    Route::get('/6dem/calendar', [CalendarEventController::class, 'index'])
        ->name('6dem.calendar');

    Route::get('/6dem/calendar/events', [CalendarEventController::class, 'events'])
        ->name('6dem.calendar.events');

    Route::post('/6dem/calendar/events', [CalendarEventController::class, 'store'])
        ->name('6dem.calendar.create.events');

    Route::get('/6dem/tasks', function () {
        return inertia('6dem/Tasks');
    })->name('6dem.tasks');

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
