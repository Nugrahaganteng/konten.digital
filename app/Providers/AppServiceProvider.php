<?php

namespace App\Providers;

use App\Models\Service;
use App\Models\PageSection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ── Inject navServices + navSettings + navLinks ke semua view frontend ──
        View::composer(['layouts.app', 'components.site-footer'], function ($view) {
            static $navData = null;

            if ($navData === null) {
                try {
                    if (!Schema::hasTable('page_sections') || !Schema::hasTable('services')) {
                        $navData = $this->getDefaultNavData();
                        $view->with($navData);
                        return;
                    }

                    // Seed navbar jika belum ada
                    $this->seedNavbarSections();

                    $sections = PageSection::ofPage('services-navbar');

                    // ── Ambil services dari tabel 'services' (bukan PageSection) ──
                    // Filter is_active = true agar yang nonaktif tidak tampil di navbar
                    $navServices = Service::active()
                        ->ordered()
                        ->get();

                    // ── Fallback jika tabel services kosong ──
                    if ($navServices->isEmpty()) {
                        $navServices = $this->getDefaultServices();
                    }

                    // ── navbar settings (logo, nama, tagline) ──
                    $navSettings = $sections->has('main') ? $sections->get('main') : null;

                    // ── navbar links ──
                    $navLinks = $sections->has('links') ? $sections->get('links') : null;

                    $navData = compact('navServices', 'navSettings', 'navLinks');

                } catch (\Throwable $e) {
                    $navData = $this->getDefaultNavData();
                }
            }

            $view->with($navData);
        });

        // ── Seed footer sections jika belum ada di database ──
        $this->seedFooterSections();
    }

    /**
     * Default nav data jika DB belum siap
     */
    private function getDefaultNavData(): array
    {
        return [
            'navServices' => $this->getDefaultServices(),
            'navSettings' => null,
            'navLinks'    => null,
        ];
    }

    /**
     * Default services untuk dropdown navbar (fallback saat tabel kosong)
     */
    private function getDefaultServices(): \Illuminate\Support\Collection
    {
        return collect([
            (object)['title' => 'Press Release',           'url' => '/layanan/press-release',     'icon_class' => 'fa-solid fa-newspaper'],
            (object)['title' => 'Backlink Media Nasional',  'url' => '/layanan/backlink',          'icon_class' => 'fa-solid fa-link'],
            (object)['title' => 'Press Conference',         'url' => '/layanan/press-conference',  'icon_class' => 'fa-solid fa-microphone'],
            (object)['title' => 'Penulisan Artikel',        'url' => '/layanan/penulisan-artikel', 'icon_class' => 'fa-solid fa-pen-nib'],
            (object)['title' => 'Script Video / TV',        'url' => '/layanan/script-video',      'icon_class' => 'fa-solid fa-video'],
            (object)['title' => 'Pelatihan Konten Kreator', 'url' => '/layanan/pelatihan-konten',  'icon_class' => 'fa-solid fa-chalkboard-user'],
        ]);
    }

    /**
     * Seed services-navbar sections jika belum ada
     */
    private function seedNavbarSections(): void
    {
        try {
            if (!Schema::hasTable('page_sections')) return;

            $schema = PageSection::schema();
            if (!isset($schema['services-navbar'])) return;

            $existing = PageSection::forPage('services-navbar')
                ->pluck('section_key')
                ->toArray();

            if (count($existing) >= count($schema['services-navbar'])) return;

            $order = PageSection::forPage('services-navbar')->max('order') ?? 0;

            $defaults = [
                'main' => [
                    'logo'            => null,
                    'logo_alt'        => 'HNP Communications.id',
                    'brand_name'      => 'HNP Communications',
                    'brand_tagline'   => 'Your Strategic PR and Digital Partner',
                    'navbar_bg_color' => '#facc15',
                    'navbar_border'   => '#000000',
                ],
            ];

            foreach ($schema['services-navbar'] as $sectionKey => $sectionDef) {
                if (!in_array($sectionKey, $existing)) {
                    $order++;
                    PageSection::firstOrCreate(
                        ['page' => 'services-navbar', 'section_key' => $sectionKey],
                        [
                            'label'         => $sectionDef['label'],
                            'order'         => $order,
                            'is_active'     => true,
                            'content'       => $defaults[$sectionKey] ?? [],
                            'hidden_fields' => [],
                        ]
                    );
                }
            }
        } catch (\Throwable $e) {
            // Silent fail saat migration awal
        }
    }

    /**
     * Seed footer sections jika belum ada
     */
    private function seedFooterSections(): void
    {
        try {
            $schema = PageSection::schema();
            if (!isset($schema['footer'])) return;

            if (!Schema::hasTable('page_sections')) return;

            $existing = PageSection::forPage('footer')
                ->pluck('section_key')
                ->toArray();

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
            // Silent fail
        }
    }
}