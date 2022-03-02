<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', [\Ngeblog\User\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\Ngeblog\User\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [\Ngeblog\User\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('password/reset', [\Ngeblog\User\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [\Ngeblog\User\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [\Ngeblog\User\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [\Ngeblog\User\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('password/edit', [\Ngeblog\User\Http\Controllers\User\ChangePasswordController::class, 'edit'])->name('password.edit');
Route::put('password', [\Ngeblog\User\Http\Controllers\User\ChangePasswordController::class, 'update'])->name('password.update');

Route::get('profile/edit', [\Ngeblog\User\Http\Controllers\User\ChangeProfileController::class, 'edit'])->name('profile.edit');
Route::put('profile', [\Ngeblog\User\Http\Controllers\User\ChangeProfileController::class, 'update'])->name('profile.update');

Route::controller(\Ngeblog\User\Http\Controllers\User\RegisterController::class)->group(function () {
    Route::get('register', 'showRegistrationForm')->name('register');
    Route::post('register', 'register');
});
