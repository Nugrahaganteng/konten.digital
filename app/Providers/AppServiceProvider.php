<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\PageSection;
use App\Models\Service;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ── Inject active services ke navbar ──────────────────────────────
        // $navServices akan otomatis tersedia di layouts/app.blade.php
        // Hanya query 1x per request, di-cache oleh Laravel view composer.
        view()->composer('layouts.app', function ($view) {
            $view->with('navServices', Service::active()->ordered()->get());
        });
    }

    /**
     * Pastikan semua section footer sudah ada di database.
     * Dipanggil di boot() agar tersedia di semua halaman publik
     * meskipun admin belum pernah membuka halaman footer di CMS.
     */
    private function seedFooterSections(): void
    {
        try {
            $schema = PageSection::schema();
            if (!isset($schema['footer'])) return;

            // Cek hanya jika tabel sudah ada (hindari error saat migration awal)
            if (!\Illuminate\Support\Facades\Schema::hasTable('page_sections')) return;

            $existing = PageSection::forPage('footer')
                ->pluck('section_key')
                ->toArray();

            // Sudah lengkap → skip
            if (count($existing) >= count($schema['footer'])) return;

            $order = PageSection::forPage('footer')->max('order') ?? 0;

            foreach ($schema['footer'] as $sectionKey => $sectionDef) {
                if (!in_array($sectionKey, $existing)) {
                    $order++;
                    PageSection::firstOrCreate(
                        ['page' => 'footer', 'section_key' => $sectionKey],
                        [
                            'label'     => $sectionDef['label'],
                            'order'     => $order,
                            'is_active' => true,
                            'content'   => [],
                        ]
                    );
                }
            }
        } catch (\Throwable $e) {
            // Jangan sampai crash saat migration/fresh install
            // Log::warning('Footer seed failed: ' . $e->getMessage());
        }
    }
}