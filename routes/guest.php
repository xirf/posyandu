<?php

use App\Http\Controllers\Guest\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'show'])->name('home');
Route::get('/news', [HomeController::class, 'show'])->name('news.index');
Route::get('/news/{slug}', [HomeController::class, 'show'])->name('news.show');