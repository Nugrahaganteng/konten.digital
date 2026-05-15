<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\PageSection;

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
        // ── Seed footer sections jika belum ada ─────────────────────
        // Ini berjalan sekali setiap request, sangat ringan karena
        // hanya query count + early return jika sudah lengkap.
        $this->seedFooterSections();
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