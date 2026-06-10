<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'show'])->defaults('slug', 'home')->name('home');
Route::get('/who-we-are', [PageController::class, 'show'])->defaults('slug', 'who-we-are')->name('who-we-are');
Route::get('/what-we-do', [PageController::class, 'show'])->defaults('slug', 'what-we-do')->name('what-we-do');
Route::get('/get-involved', [PageController::class, 'show'])->defaults('slug', 'get-involved')->name('get-involved');
Route::get('/donate', [PageController::class, 'show'])->defaults('slug', 'donate')->name('donate');

Route::post('/form/submit', function (Request $request) {
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:50',
        'type' => 'nullable|string|max:50',
        'church' => 'nullable|string|max:255',
        'message' => 'nullable|string',
    ]);

    $formData = $request->except('_token');
    $data['form_data'] = $formData;

    FormSubmission::create($data);

    return back()->with('form_success', 'Thank you for your submission! We will get back to you shortly.');
})->name('form.submit');

// Theme asset serving
Route::get('/theme-assets/{slug}/{path}', function (string $slug, string $path) {
    return app(\App\Services\ThemeService::class)->serveAsset($slug, $path);
})->where('path', '.*')->name('theme.asset');

Route::get('/news', [BlogController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [BlogController::class, 'show'])->name('news.show');

require __DIR__.'/settings.php';
require __DIR__.'/admin.php';

// Catch-all for pages created in admin — runs after all other routes
Route::fallback([\App\Http\Controllers\PageController::class, 'fallback']);
