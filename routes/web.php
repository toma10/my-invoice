<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DownloadInvoiceController;
use App\Http\Controllers\InviteUserController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetupAccountController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('invoices.index'));

Route::get('login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('login', [LoginController::class, 'store'])->middleware('guest');
Route::post('logout', LogoutController::class)->name('logout');

Route::view('password/reset', 'auth.passwords.email')->name('password.request');
// Route::post('password/email', '')->name('password.email');
Route::view('password/reset/{token}', 'auth.passwords.reset')->name('password.reset');
// Route::post('password/reset', '')->name('password.update');

Route::get('welcome/{token}', WelcomeController::class)->middleware('guest')->name('users.welcome');
Route::post('welcome', SetupAccountController::class)->middleware('guest')->name('users.setupAccount');
Route::post('users/invite', InviteUserController::class)->middleware('admin')->name('users.invite');

Route::group(['middleware' => 'auth'], function () {
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('password', ChangePasswordController::class)->name('password.change');
});

Route::group(['middleware' => 'admin'], function () {
    Route::view('admin', 'admin.dashboard')->name('admin.dashboard');
});

Route::view('admin/users', 'admin.users.index')->name('admin.users.index');

Route::view('admin/departments', 'admin.departments.index')->name('admin.departments.index');
Route::view('admin/departments/{department}/edit', 'admin.departments.edit')->name('admin.departments.edit');

Route::view('admin/invoices', 'admin.invoices.index')->name('admin.invoices.index');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('invoices', InvoicesController::class);
    Route::post('invoices/{invoice}/download', DownloadInvoiceController::class)->name('invoices.download');
});
