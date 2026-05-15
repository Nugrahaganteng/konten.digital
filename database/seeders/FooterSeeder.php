<?php

namespace App\Http\Controllers;

use App\Models\PageSection;

/**
 * Trait FooterSeeder
 *
 * Mixin untuk controller publik agar footer section
 * selalu tersedia di database tanpa harus masuk admin.
 *
 * Cara pakai: tambahkan `use FooterSeeder;` di HomeController,
 * lalu panggil `$this->ensureFooterSeeded();` di __construct atau boot.
 *
 * ATAU lebih simpel: panggil langsung di AppServiceProvider::boot()
 * (lihat contoh di bawah).
 */
trait FooterSeeder
{
    protected function ensureFooterSeeded(): void
    {
        static $done = false;
        if ($done) return;
        $done = true;

        $schema = PageSection::schema();
        if (!isset($schema['footer'])) return;

        $existing = PageSection::forPage('footer')->pluck('section_key')->toArray();
        if (count($existing) >= count($schema['footer'])) return; // sudah lengkap

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
    }
}