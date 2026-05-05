<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;

// ── PUBLIC ────────────────────────────────────────────────────
Route::get('/',        [HomeController::class, 'index'])->name('home');
Route::get('/layanan', [HomeController::class, 'services'])->name('services');
Route::prefix('layanan')->name('layanan.')->group(function () {
    Route::get('/press-release',    fn() => view('layanan.press-release'))->name('press.release');
    Route::get('/backlink',         fn() => view('layanan.backlink'))->name('backlink');
    Route::get('/press-conference', fn() => view('layanan.press-conference'))->name('press.conference');
    Route::get('/penulisan-artikel',fn() => view('layanan.penulisan-artikel'))->name('penulisan.artikel');
    Route::get('/script-video',     fn() => view('layanan.script-video'))->name('script.video');
    Route::get('/pelatihan-konten', fn() => view('layanan.pelatihan-konten'))->name('pelatihan.konten');
});
Route::get('/harga',            [HomeController::class, 'pricing'])->name('pricing');
Route::get('/tentang',          [HomeController::class, 'about'])->name('about');
Route::get('/kontak',           [HomeController::class, 'contact'])->name('contact');
Route::post('/kontak',          [HomeController::class, 'sendContact'])->name('contact.send');

// ── HALAMAN BARU ───────────────────────────────────────────────
Route::get('/cara-order',       fn() => view('pages.cara-order'))->name('cara-order');
Route::get('/syarat-ketentuan', fn() => view('pages.syarat-ketentuan'))->name('syarat-ketentuan');

// ── ARTIKEL PUBLIC ────────────────────────────────────────────
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');

// ── ARTIKEL AUTH (harus login) ────────────────────────────────
// PENTING: /artikel/buat harus SEBELUM /artikel/{slug}
// agar Laravel tidak menganggap "buat" sebagai nilai {slug}.
Route::middleware('auth')->group(function () {
    Route::get('/artikel/buat',              [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/artikel',                  [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/artikel/{article}/edit',    [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/artikel/{article}',         [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/artikel/{article}',      [ArticleController::class, 'destroy'])->name('articles.destroy');
});

// ── Route {slug} SETELAH /buat ────────────────────────────────
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// ── AUTH (Laravel Breeze) ─────────────────────────────────────
require __DIR__.'/auth.php';

// ── ADMIN (harus login + role admin) ─────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('articles', AdminArticleController::class);
    Route::patch('articles/{article}/publish', [AdminArticleController::class, 'publish'])->name('articles.publish');
    Route::patch('articles/{article}/reject',  [AdminArticleController::class, 'reject'])->name('articles.reject');
});