<?php

use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'show'])->name('home');

Route::get('/news', [NewsController::class, 'showAll'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/activity', [HomeController::class, 'show'])->name('activity.index');
Route::get('/activity/{slug}', [HomeController::class, 'show'])->name('activity.show');