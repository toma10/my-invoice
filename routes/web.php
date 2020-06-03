<?php

use App\Http\Controllers\ActivateUserController;
use App\Http\Controllers\ApproveInvoiceController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DeactivateUserController;
use App\Http\Controllers\DenyInvoiceController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\DownloadInvoiceController;
use App\Http\Controllers\InviteUserController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ListInvoicesController;
use App\Http\Controllers\ListUsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PayInvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestResetPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SetupAccountController;
use App\Http\Controllers\ShowInvoiceController;
use App\Http\Controllers\ShowUserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('invoices.index'));

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'show'])->middleware('guest')->name('login');
    Route::post('login', [LoginController::class, 'store'])->middleware('guest');

    Route::view('password/reset', 'auth.passwords.email')->name('password.request');
    Route::post('password/email', RequestResetPasswordController::class)->name('password.email');

    Route::get('password/reset/{email}', [ResetPasswordController::class, 'show'])
        ->middleware('signed')
        ->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'store'])->name('password.update');
});

Route::post('logout', LogoutController::class)->name('logout');

Route::get('welcome/{token}', WelcomeController::class)->middleware('guest')->name('users.welcome');
Route::post('welcome', SetupAccountController::class)->middleware('guest')->name('users.setupAccount');

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('password', ChangePasswordController::class)->name('password.change');

    Route::resource('invoices', InvoicesController::class);
    Route::post('invoices/{invoice}/download', DownloadInvoiceController::class)->name('invoices.download');
});

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::view('/', 'admin.dashboard')->name('dashboard');

    Route::get('users', ListUsersController::class)->name('users.index');

    Route::get('users/invite', [InviteUserController::class, 'create'])->name('users.invite');
    Route::post('users/invite', [InviteUserController::class, 'store']);
    Route::get('users/{user}', ShowUserController::class)->name('users.show');

    Route::post('activated-users', ActivateUserController::class)->name('activateUser');
    Route::post('deactivated-users', DeactivateUserController::class)->name('deactivateUser');

    Route::resource('departments', DepartmentsController::class)->except(['show', 'destroy']);

    Route::get('invoices', ListInvoicesController::class)->name('invoices.index');
    Route::get('invoices/{invoice}', ShowInvoiceController::class)->name('invoices.show');
    Route::post('approved-invoices', ApproveInvoiceController::class)->name('approveInvoice');
    Route::post('paid-invoices', PayInvoiceController::class)->name('payInvoice');
    Route::post('denied-invoices', DenyInvoiceController::class)->name('denyInvoice');
});
