<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\InviteUserController;
use App\Http\Controllers\SetupAccountController;

Route::view('login', 'auth.login')->name('login');
// Route::post('login', '');

Route::view('password/reset', 'auth.passwords.email')->name('password.request');
// Route::post('password/email', '')->name('password.email');
Route::view('password/reset/{token}', 'auth.passwords.reset')->name('password.reset');
// Route::post('password/reset', '')->name('password.update');

Route::middleware('guest')->get('welcome/{token}', WelcomeController::class)->name('users.welcome');
Route::middleware('guest')->post('welcome', SetupAccountController::class)->name('users.setupAccount');
Route::middleware('admin')->post('users/invite', InviteUserController::class)->name('users.invite');

Route::view('profile', 'profile.show')->name('profile.show');
Route::view('profile/edit', 'profile.edit')->name('profile.edit');
// Route::put('profile', '')->name('profile.update');

Route::view('admin', 'admin.dashboard')->name('admin.dashboard');

Route::view('admin/users', 'admin.users.index')->name('admin.users.index');

Route::view('admin/departments', 'admin.departments.index')->name('admin.departments.index');
Route::view('admin/departments/{department}/edit', 'admin.departments.edit')->name('admin.departments.edit');

Route::view('admin/invoices', 'admin.invoices.index')->name('admin.invoices.index');

Route::view('/', 'invoices.index')->name('invoices.index');
Route::view('invoices/create', 'invoices.create')->name('invoices.create');
Route::view('invoices/{invoice}', 'invoices.show')->name('invoices.show');
Route::view('invoices/{invoice}/edit', 'invoices.edit')->name('invoices.edit');
