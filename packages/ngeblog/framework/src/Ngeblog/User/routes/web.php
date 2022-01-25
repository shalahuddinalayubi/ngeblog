<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', [\Ngeblog\User\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', [\Ngeblog\User\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\Ngeblog\User\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [\Ngeblog\User\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('password/reset', [\Ngeblog\User\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [\Ngeblog\User\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [\Ngeblog\User\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [\Ngeblog\User\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
