<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;

// ── PUBLIC ROUTES ──────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/layanan', [HomeController::class, 'services'])->name('services');
Route::get('/harga', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');
Route::post('/kontak', [HomeController::class, 'sendContact'])->name('contact.send');

// ── AUTH (Breeze) ──────────────────────────────
require __DIR__.'/auth.php';

// ── ADMIN ROUTES (protected) ───────────────────
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',             [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('orders',   OrderController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('media',    MediaController::class);
    Route::resource('clients',  ClientController::class);
    Route::get('reports',       [ReportController::class, 'index'])->name('reports.index');
    Route::get('settings',      [SettingController::class, 'index'])->name('settings');
    Route::post('settings',     [SettingController::class, 'update'])->name('settings.update');
});