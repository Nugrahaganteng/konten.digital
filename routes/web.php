<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContactSubmissionController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;

// ── PUBLIC ROUTES ─────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/cara-order', [HomeController::class, 'caraOrder'])->name('cara-order');
Route::get('/syarat-ketentuan', [HomeController::class, 'syaratKetentuan'])->name('syarat-ketentuan');
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');
Route::post('/kontak', [HomeController::class, 'sendContact'])->name('contact.send');

// ── LAYANAN PAGES ─────────────────────────────────────────────
Route::get('/layanan/press-release',     [HomeController::class, 'pressRelease'])->name('layanan.press.release');
Route::get('/layanan/backlink',          [HomeController::class, 'backlink'])->name('layanan.backlink');
Route::get('/layanan/press-conference',  [HomeController::class, 'pressConference'])->name('layanan.press.conference');
Route::get('/layanan/penulisan-artikel', [HomeController::class, 'penulisanArtikel'])->name('layanan.penulisan.artikel');
Route::get('/layanan/script-video',      [HomeController::class, 'scriptVideo'])->name('layanan.script.video');
Route::get('/layanan/pelatihan-konten',  [HomeController::class, 'pelatihanKonten'])->name('layanan.pelatihan.konten');

// ── AUTH (Laravel Breeze) ─────────────────────────────────────
require __DIR__.'/auth.php';

// ── ADMIN PANEL ───────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('articles', AdminArticleController::class);
    Route::patch('articles/{article}/publish', [AdminArticleController::class, 'publish'])->name('articles.publish');

    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', [ContactSubmissionController::class, 'index'])->name('index');
        Route::get('/{contact}', [ContactSubmissionController::class, 'show'])->name('show');
        Route::patch('/{contact}/status', [ContactSubmissionController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/{contact}', [ContactSubmissionController::class, 'destroy'])->name('destroy');
    });

    Route::get('/orders',   fn() => "Orders")->name('orders');
    Route::get('/media',    fn() => "Media Partner")->name('media.index');
    Route::get('/clients',  fn() => "Clients")->name('clients.index');
    Route::get('/reports',  fn() => "Reports")->name('reports.index');
    Route::get('/settings', fn() => "Settings")->name('settings');
});