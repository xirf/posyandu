<?php

use App\Http\Controllers\Guest\ActivityController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'show'])->name('home');

Route::get('/news', [NewsController::class, 'showAll'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/activity', [ActivityController::class, 'showAll'])->name('activity.index');
Route::get('/activity/{slug}', [ActivityController::class, 'show'])->name('activity.show');
