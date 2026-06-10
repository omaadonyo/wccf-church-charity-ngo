<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'show'])->defaults('slug', 'home')->name('home');
Route::get('/who-we-are', [PageController::class, 'show'])->defaults('slug', 'who-we-are')->name('who-we-are');
Route::get('/what-we-do', [PageController::class, 'show'])->defaults('slug', 'what-we-do')->name('what-we-do');
Route::get('/get-involved', [PageController::class, 'show'])->defaults('slug', 'get-involved')->name('get-involved');
Route::get('/donate', [PageController::class, 'show'])->defaults('slug', 'donate')->name('donate');

Route::get('/news', [BlogController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [BlogController::class, 'show'])->name('news.show');

require __DIR__.'/settings.php';
require __DIR__.'/admin.php';

// Catch-all for pages created in admin — runs after all other routes
Route::fallback([\App\Http\Controllers\PageController::class, 'fallback']);
