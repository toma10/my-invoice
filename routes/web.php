<?php

use App\Http\Controllers\InviteUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SetupAccountController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('login', [LoginController::class, 'store'])->middleware('guest');

Route::view('password/reset', 'auth.passwords.email')->name('password.request');
// Route::post('password/email', '')->name('password.email');
Route::view('password/reset/{token}', 'auth.passwords.reset')->name('password.reset');
// Route::post('password/reset', '')->name('password.update');

Route::get('welcome/{token}', WelcomeController::class)->middleware('guest')->name('users.welcome');
Route::post('welcome', SetupAccountController::class)->middleware('guest')->name('users.setupAccount');
Route::post('users/invite', InviteUserController::class)->middleware('admin')->name('users.invite');

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
