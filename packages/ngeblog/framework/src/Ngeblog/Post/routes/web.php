<?php

use Illuminate\Support\Facades\Route;

Route::get('/posts', [\Ngeblog\Post\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [\Ngeblog\Post\Http\Controllers\PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/posts', [\Ngeblog\Post\Http\Controllers\PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}', [\Ngeblog\Post\Http\Controllers\PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{id}/edit', [\Ngeblog\Post\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
Route::put('/post/{id}', [\Ngeblog\Post\Http\Controllers\PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [\Ngeblog\Post\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/', [\Ngeblog\Post\Http\Controllers\PostController::class, 'index']);

Route::post('/posts/{post}/comments', [\Ngeblog\Post\Http\Controllers\CommentController::class, 'store'])->name('posts.comments.store')->middleware('auth');
Route::get('/posts/{post}/comments', [\Ngeblog\Post\Http\Controllers\CommentController::class, 'store'])->name('posts.comments.store')->middleware('auth');
