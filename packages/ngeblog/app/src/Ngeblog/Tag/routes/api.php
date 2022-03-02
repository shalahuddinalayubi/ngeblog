<?php

use Illuminate\Support\Facades\Route;

Route::get('/tags', [\Ngeblog\Tag\Http\Controller\Api\TagController::class, 'index'])->name('tags.index');
