<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;

// ── PUBLIC ROUTES ───────────────────────────────────────────
Route::get('/',         [HomeController::class, 'index'])->name('home');
Route::get('/layanan',  [HomeController::class, 'services'])->name('services');
Route::get('/harga',    [HomeController::class, 'pricing'])->name('pricing');
Route::get('/tentang',  [HomeController::class, 'about'])->name('about');
Route::get('/kontak',   [HomeController::class, 'contact'])->name('contact');
Route::post('/kontak',  [HomeController::class, 'sendContact'])->name('contact.send');

// ── BLOG / ARTIKEL (public: index & show) ──────────────────
Route::get('/artikel',          [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}',   [ArticleController::class, 'show'])->name('articles.show');

// ── BLOG (auth required: create, store, edit, update, destroy)
Route::middleware('auth')->group(function () {
    Route::get('/artikel/buat',              [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/artikel',                  [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/artikel/{article}/edit',    [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/artikel/{article}',         [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/artikel/{article}',      [ArticleController::class, 'destroy'])->name('articles.destroy');
});

// ── AUTH (Laravel Breeze / default) ────────────────────────
require __DIR__.'/auth.php';

// ── ADMIN ROUTES ────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',                                          [DashboardController::class, 'index'])->name('dashboard');

    // Artikel management
    Route::resource('articles', AdminArticleController::class);
    Route::patch('articles/{article}/publish', [AdminArticleController::class, 'publish'])->name('articles.publish');
    Route::patch('articles/{article}/reject',  [AdminArticleController::class, 'reject'])->name('articles.reject');
});