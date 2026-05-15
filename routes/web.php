<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContactSubmissionController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ClientLogoController;
use App\Http\Controllers\Admin\PageSectionController;

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
require __DIR__ . '/auth.php';

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

    // ══════════════════════════════════════════════════════════════════
    // ── CMS ROUTES ────────────────────────────────────────────────────
    // ══════════════════════════════════════════════════════════════════

    // Site Settings (Hero, About, Contact, Footer, SEO, Social)
    Route::get('cms/settings/{group?}',  [SiteSettingController::class, 'index'])->name('cms.settings');
    Route::post('cms/settings/{group}',  [SiteSettingController::class, 'update'])->name('cms.settings.update');

    // Layanan / Services
    Route::post('cms/services/reorder',                  [ServiceController::class, 'reorder'])->name('cms.services.reorder');
    Route::get('cms/services',                           [ServiceController::class, 'index'])->name('cms.services.index');
    Route::get('cms/services/create',                    [ServiceController::class, 'create'])->name('cms.services.create');
    Route::post('cms/services',                          [ServiceController::class, 'store'])->name('cms.services.store');
    Route::get('cms/services/{service}/edit',            [ServiceController::class, 'edit'])->name('cms.services.edit');
    Route::put('cms/services/{service}',                 [ServiceController::class, 'update'])->name('cms.services.update');
    Route::delete('cms/services/{service}',              [ServiceController::class, 'destroy'])->name('cms.services.destroy');

    // Testimoni
    Route::get('cms/testimonials',                       [TestimonialController::class, 'index'])->name('cms.testimonials.index');
    Route::get('cms/testimonials/create',                [TestimonialController::class, 'create'])->name('cms.testimonials.create');
    Route::post('cms/testimonials',                      [TestimonialController::class, 'store'])->name('cms.testimonials.store');
    Route::get('cms/testimonials/{testimonial}/edit',    [TestimonialController::class, 'edit'])->name('cms.testimonials.edit');
    Route::put('cms/testimonials/{testimonial}',         [TestimonialController::class, 'update'])->name('cms.testimonials.update');
    Route::delete('cms/testimonials/{testimonial}',      [TestimonialController::class, 'destroy'])->name('cms.testimonials.destroy');

    // FAQ
    Route::get('cms/faqs',                               [FaqController::class, 'index'])->name('cms.faqs.index');
    Route::get('cms/faqs/create',                        [FaqController::class, 'create'])->name('cms.faqs.create');
    Route::post('cms/faqs',                              [FaqController::class, 'store'])->name('cms.faqs.store');
    Route::get('cms/faqs/{faq}/edit',                    [FaqController::class, 'edit'])->name('cms.faqs.edit');
    Route::put('cms/faqs/{faq}',                         [FaqController::class, 'update'])->name('cms.faqs.update');
    Route::delete('cms/faqs/{faq}',                      [FaqController::class, 'destroy'])->name('cms.faqs.destroy');

    // Logo Klien
    Route::get('cms/clients',                            [ClientLogoController::class, 'index'])->name('cms.clients.index');
    Route::post('cms/clients',                           [ClientLogoController::class, 'store'])->name('cms.clients.store');
    Route::delete('cms/clients/{client}',                [ClientLogoController::class, 'destroy'])->name('cms.clients.destroy');
    Route::patch('cms/clients/{client}/toggle',          [ClientLogoController::class, 'toggleActive'])->name('cms.clients.toggle');

    // ── Page Sections CMS ─────────────────────────────────────────────
    // PENTING: route statis harus SEBELUM route dengan {pageSection}
    Route::post('cms/page-sections/reorder',
        [PageSectionController::class, 'reorder'])->name('cms.page-sections.reorder');

    Route::get('cms/page-sections/{page?}',
        [PageSectionController::class, 'index'])->name('cms.page-sections.index')
        ->where('page', '[a-z0-9\-]+');

    Route::get('cms/page-sections/section/{pageSection}/edit',
        [PageSectionController::class, 'edit'])->name('cms.page-sections.edit');

    Route::put('cms/page-sections/section/{pageSection}',
        [PageSectionController::class, 'update'])->name('cms.page-sections.update');

    Route::patch('cms/page-sections/section/{pageSection}/toggle',
        [PageSectionController::class, 'toggleActive'])->name('cms.page-sections.toggle');

    Route::get('cms/page-sections/section/{pageSection}/histories',
        [PageSectionController::class, 'histories'])->name('cms.page-sections.histories');

    Route::post('cms/page-sections/section/{pageSection}/restore/{history}',
        [PageSectionController::class, 'restore'])->name('cms.page-sections.restore');
});