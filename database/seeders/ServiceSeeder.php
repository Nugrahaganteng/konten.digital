<?php
// database/seeders/ServiceSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title'       => 'Press Release',
                'tab_label'   => 'Press Release',
                'slug'        => 'press-release',
                'route_name'  => 'layanan.press.release',
                'icon_class'  => 'fa-solid fa-newspaper',
                'description' => 'Layanan Press Release',
                'order'       => 1,
                'is_active'   => true,
            ],
            [
                'title'       => 'Backlink Media',
                'tab_label'   => 'Backlink Media',
                'slug'        => 'backlink-media',
                'route_name'  => 'layanan.backlink',
                'icon_class'  => 'fa-solid fa-link',
                'description' => 'Layanan Backlink Media',
                'order'       => 2,
                'is_active'   => true,
            ],
            [
                'title'       => 'Press Conference',
                'tab_label'   => 'Press Conference',
                'slug'        => 'press-conference',
                'route_name'  => 'layanan.press.conference',
                'icon_class'  => 'fa-solid fa-microphone',
                'description' => 'Layanan Press Conference',
                'order'       => 3,
                'is_active'   => true,
            ],
            [
                'title'       => 'Penulisan Artikel',
                'tab_label'   => 'Penulisan Artikel',
                'slug'        => 'penulisan-artikel',
                'route_name'  => 'layanan.penulisan.artikel',
                'icon_class'  => 'fa-solid fa-pen-nib',
                'description' => 'Layanan Penulisan Artikel',
                'order'       => 4,
                'is_active'   => true,
            ],
            // ── DIUBAH: Script Video → Buzzer ──────────────────────────
            [
                'title'       => 'Buzzer',
                'tab_label'   => 'Buzzer',
                'slug'        => 'buzzer',
                'route_name'  => 'layanan.buzzer',
                'icon_class'  => 'fa-solid fa-bullhorn',
                'description' => 'Layanan Buzzer Media Sosial',
                'order'       => 5,
                'is_active'   => true,
            ],
            [
                'title'       => 'Pelatihan Konten',
                'tab_label'   => 'Pelatihan Konten',
                'slug'        => 'pelatihan-konten',
                'route_name'  => 'layanan.pelatihan.konten',
                'icon_class'  => 'fa-solid fa-chalkboard-user',
                'description' => 'Layanan Pelatihan Konten',
                'order'       => 6,
                'is_active'   => true,
            ],
        ];

        foreach ($services as $data) {
            Service::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}