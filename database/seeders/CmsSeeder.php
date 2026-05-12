<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\ClientLogo;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. SITE SETTINGS ──────────────────────────────────────────
        $settings = [

            // ── Hero ──
            ['key' => 'hero_badge_text',    'value' => '✦ DIGITAL AGENCY',             'type' => 'text',    'group' => 'hero',    'label' => 'Teks Badge Hero'],
            ['key' => 'hero_tagline',        'value' => "Kami bukan agensi biasa.\nKami adalah partner kreatif yang bikin brand kamu berkesan di galaksi ini.", 'type' => 'textarea', 'group' => 'hero', 'label' => 'Tagline Hero Kiri'],
            ['key' => 'hero_cta_text',       'value' => 'MULAI SEKARANG →',             'type' => 'text',    'group' => 'hero',    'label' => 'Teks Tombol CTA'],
            ['key' => 'hero_cta_link',       'value' => 'https://wa.me/6287786000919',  'type' => 'text',    'group' => 'hero',    'label' => 'Link Tombol CTA'],
            ['key' => 'hero_headline_1',     'value' => 'KONTEN',                       'type' => 'text',    'group' => 'hero',    'label' => 'Headline Baris 1 (solid)'],
            ['key' => 'hero_headline_2',     'value' => 'DIGITAL',                      'type' => 'text',    'group' => 'hero',    'label' => 'Headline Baris 2 (outline)'],
            ['key' => 'hero_stat_1_number',  'value' => '200+',                         'type' => 'text',    'group' => 'hero',    'label' => 'Stat 1 – Angka'],
            ['key' => 'hero_stat_1_label',   'value' => 'Media Partner',                'type' => 'text',    'group' => 'hero',    'label' => 'Stat 1 – Label'],
            ['key' => 'hero_stat_2_number',  'value' => '5+',                           'type' => 'text',    'group' => 'hero',    'label' => 'Stat 2 – Angka'],
            ['key' => 'hero_stat_2_label',   'value' => 'Tahun Pengalaman',             'type' => 'text',    'group' => 'hero',    'label' => 'Stat 2 – Label'],
            ['key' => 'hero_stat_3_number',  'value' => '1K+',                          'type' => 'text',    'group' => 'hero',    'label' => 'Stat 3 – Angka'],
            ['key' => 'hero_stat_3_label',   'value' => 'Klien Puas',                   'type' => 'text',    'group' => 'hero',    'label' => 'Stat 3 – Label'],

            // ── Marquee ──
            ['key' => 'marquee_items',  'value' => 'PRESS RELEASE|200+ MEDIA NASIONAL|GARANSI TAYANG|PROSES CEPAT|KONTEN DIGITAL', 'type' => 'text', 'group' => 'hero', 'label' => 'Item Marquee (pisahkan dengan |)'],

            // ── About ──
            ['key' => 'about_headline_1',    'value' => 'Wish',                         'type' => 'text',    'group' => 'about',   'label' => 'Headline About Baris 1'],
            ['key' => 'about_headline_2',    'value' => 'Granted!',                     'type' => 'text',    'group' => 'about',   'label' => 'Headline About Baris 2 (kuning)'],
            ['key' => 'about_description',   'value' => 'Berbasis di Bogor, Indonesia, kami adalah agensi digital kreatif yang berspesialisasi memberikan solusi dengan formula ideal. Kami membawa brand ke fase pertumbuhan luar biasa melalui pendekatan kekeluargaan yang modern ala luar angkasa.', 'type' => 'textarea', 'group' => 'about', 'label' => 'Deskripsi About'],
            ['key' => 'about_satisfaction',  'value' => '98%',                          'type' => 'text',    'group' => 'about',   'label' => 'Angka Kepuasan Klien'],
            ['key' => 'about_stat_1_num',    'value' => '200+',                         'type' => 'text',    'group' => 'about',   'label' => 'Grid Stat 1 – Angka'],
            ['key' => 'about_stat_1_label',  'value' => 'Media Partner',                'type' => 'text',    'group' => 'about',   'label' => 'Grid Stat 1 – Label'],
            ['key' => 'about_stat_2_num',    'value' => '1K+',                          'type' => 'text',    'group' => 'about',   'label' => 'Grid Stat 2 – Angka'],
            ['key' => 'about_stat_2_label',  'value' => 'Happy Clients',                'type' => 'text',    'group' => 'about',   'label' => 'Grid Stat 2 – Label'],
            ['key' => 'about_stat_3_num',    'value' => '5+',                           'type' => 'text',    'group' => 'about',   'label' => 'Grid Stat 3 – Angka'],
            ['key' => 'about_stat_3_label',  'value' => 'Tahun Berdiri',                'type' => 'text',    'group' => 'about',   'label' => 'Grid Stat 3 – Label'],
            ['key' => 'about_stat_4_num',    'value' => '8',                            'type' => 'text',    'group' => 'about',   'label' => 'Grid Stat 4 – Angka'],
            ['key' => 'about_stat_4_label',  'value' => 'Jenis Layanan',                'type' => 'text',    'group' => 'about',   'label' => 'Grid Stat 4 – Label'],

            // ── Contact / CTA Section ──
            ['key' => 'cta_headline_1',      'value' => "Let's Build",                  'type' => 'text',    'group' => 'contact', 'label' => 'CTA Headline Baris 1'],
            ['key' => 'cta_headline_2',      'value' => 'Something',                    'type' => 'text',    'group' => 'contact', 'label' => 'CTA Headline Baris 2'],
            ['key' => 'cta_headline_3',      'value' => 'Different.',                   'type' => 'text',    'group' => 'contact', 'label' => 'CTA Headline Baris 3 (outline)'],
            ['key' => 'cta_description',     'value' => 'Punya ide gila untuk brand kamu? Kami siap dengar dan wujudkan. Hubungi kami sekarang dan mulai perjalanan pertumbuhan brand kamu melintasi orbit digital.', 'type' => 'textarea', 'group' => 'contact', 'label' => 'CTA Deskripsi'],
            ['key' => 'cta_button_text',     'value' => "LET'S CHAT →",                 'type' => 'text',    'group' => 'contact', 'label' => 'CTA Teks Tombol'],

            // ── Footer ──
            ['key' => 'footer_headline_1',   'value' => 'Bersama Kami,',                'type' => 'text',    'group' => 'footer',  'label' => 'Footer Headline Baris 1'],
            ['key' => 'footer_headline_2',   'value' => 'Raih Kesuksesan',              'type' => 'text',    'group' => 'footer',  'label' => 'Footer Headline Baris 2 (kuning)'],
            ['key' => 'footer_headline_3',   'value' => 'di Era Digital',               'type' => 'text',    'group' => 'footer',  'label' => 'Footer Headline Baris 3'],
            ['key' => 'footer_description',  'value' => 'Bergabunglah dengan ratusan klien yang puas dan rasakan perbedaan dengan konten berkualitas dari HNP Communications. Mulailah sekarang dan bawa bisnis Anda ke level berikutnya.', 'type' => 'textarea', 'group' => 'footer', 'label' => 'Footer Deskripsi'],
            ['key' => 'footer_copyright',    'value' => '© ' . date('Y') . ' HNP Communications.id — ALL RIGHTS RESERVED NUGRAHA & WILDAN', 'type' => 'text', 'group' => 'footer', 'label' => 'Teks Copyright'],

            // ── Kontak / WhatsApp ──
            ['key' => 'whatsapp_1',          'value' => '6287786000919',                'type' => 'text',    'group' => 'contact', 'label' => 'WhatsApp Hotline 1'],
            ['key' => 'whatsapp_1_label',    'value' => '+62 877-8600-0919',            'type' => 'text',    'group' => 'contact', 'label' => 'WhatsApp 1 – Label Tampil'],
            ['key' => 'whatsapp_2',          'value' => '628121967610',                 'type' => 'text',    'group' => 'contact', 'label' => 'WhatsApp Hotline 2'],
            ['key' => 'whatsapp_2_label',    'value' => '+62 812-1967-610',             'type' => 'text',    'group' => 'contact', 'label' => 'WhatsApp 2 – Label Tampil'],
            ['key' => 'contact_email',       'value' => 'hello@kontendigital.id',       'type' => 'text',    'group' => 'contact', 'label' => 'Email Kontak'],

            // ── Social Media ──
            ['key' => 'social_instagram',    'value' => '#',                            'type' => 'text',    'group' => 'social',  'label' => 'Link Instagram'],
            ['key' => 'social_facebook',     'value' => '#',                            'type' => 'text',    'group' => 'social',  'label' => 'Link Facebook'],
            ['key' => 'social_youtube',      'value' => '#',                            'type' => 'text',    'group' => 'social',  'label' => 'Link YouTube'],
            ['key' => 'social_tiktok',       'value' => '#',                            'type' => 'text',    'group' => 'social',  'label' => 'Link TikTok'],

            // ── SEO Global ──
            ['key' => 'seo_site_name',       'value' => 'HNP Communications.id',        'type' => 'text',    'group' => 'seo',     'label' => 'Nama Situs (SEO)'],
            ['key' => 'seo_meta_title',      'value' => 'HNP Communications — Jasa Press Release & Digital Agency Terpercaya', 'type' => 'text', 'group' => 'seo', 'label' => 'Meta Title Default'],
            ['key' => 'seo_meta_description','value' => 'Jasa press release, backlink media nasional, penulisan artikel, dan konten kreatif untuk bisnis Anda.', 'type' => 'textarea', 'group' => 'seo', 'label' => 'Meta Description Default'],
            ['key' => 'seo_og_image',        'value' => '',                             'type' => 'image',   'group' => 'seo',     'label' => 'OG Image Default (1200x630px)'],
        ];

        foreach ($settings as $data) {
            SiteSetting::updateOrCreate(['key' => $data['key']], $data);
        }

        // ── 2. SERVICES ────────────────────────────────────────────────
        $services = [
            ['title' => 'Press Release',          'slug' => 'press-release',       'tab_label' => 'Press Release',      'description' => 'Layanan publikasi informasi resmi brand Anda ke berbagai media massa untuk meningkatkan jangkauan.', 'bg_label' => 'SOCIAL', 'image' => 'r.png',  'order' => 1],
            ['title' => 'Backlink Media Nasional', 'slug' => 'backlink',            'tab_label' => 'Backlink Media',     'description' => 'Tingkatkan otoritas domain dan peringkat SEO website Anda melalui backlink berkualitas dari media nasional.', 'bg_label' => 'NEWS', 'image' => 'i.png',  'order' => 2],
            ['title' => 'Press Conference',        'slug' => 'press-conference',    'tab_label' => 'Press Conference',   'description' => 'Pengorganisasian konferensi pers profesional untuk mengomunikasikan pesan penting kepada publik.', 'bg_label' => 'ART', 'image' => 'k.png',  'order' => 3],
            ['title' => 'Penulisan Artikel',       'slug' => 'penulisan-artikel',   'tab_label' => 'Penulisan Artikel',  'description' => 'Pembuatan konten artikel yang menarik, informatif, dan dioptimasi untuk kebutuhan digital Anda.', 'bg_label' => 'GROW', 'image' => 'c.png',  'order' => 4],
            ['title' => 'Script Video / TV',       'slug' => 'script-video',        'tab_label' => 'Script Video',      'description' => 'Penyusunan naskah kreatif untuk produksi video komersial, media sosial, maupun tayangan televisi.', 'bg_label' => 'NEWS', 'image' => 'U.png',  'order' => 5],
            ['title' => 'Pelatihan Konten Kreator','slug' => 'pelatihan-konten',    'tab_label' => 'Pelatihan Kreator', 'description' => 'Program pelatihan intensif untuk mengasah kemampuan dalam menciptakan konten digital yang berdampak.', 'bg_label' => 'ART', 'image' => 'P.png',  'order' => 6],
        ];

        foreach ($services as $data) {
            Service::updateOrCreate(['slug' => $data['slug']], array_merge($data, ['is_active' => true]));
        }

        // ── 3. TESTIMONIALS ────────────────────────────────────────────
        $testimonials = [
            ['name' => 'Budi Santoso',   'position' => 'CEO',        'company' => 'PT Maju Bersama',   'content' => 'HNP Communications benar-benar mengubah cara kami berkomunikasi dengan media. Press release kami kini tayang di 50+ media nasional!', 'rating' => 5, 'order' => 1],
            ['name' => 'Dewi Rahayu',    'position' => 'Marketing',  'company' => 'Startup Nusantara', 'content' => 'Tim yang profesional dan responsif. Backlink yang mereka sediakan sangat membantu ranking SEO website kami naik drastis.', 'rating' => 5, 'order' => 2],
            ['name' => 'Ahmad Fauzi',    'position' => 'Direktur',   'company' => 'CV Kreasi Digital', 'content' => 'Pelatihan konten kreator yang sangat bermanfaat. Sekarang tim kami bisa membuat konten yang engaging dan viral!', 'rating' => 5, 'order' => 3],
        ];

        foreach ($testimonials as $data) {
            Testimonial::updateOrCreate(
                ['name' => $data['name'], 'company' => $data['company']],
                array_merge($data, ['is_active' => true])
            );
        }

        // ── 4. FAQ ─────────────────────────────────────────────────────
        $faqs = [
            ['question' => 'Berapa lama proses press release tayang?', 'answer' => 'Umumnya press release akan tayang dalam 1-3 hari kerja setelah konten disetujui. Untuk paket prioritas, kami bisa proses dalam 24 jam.', 'category' => 'press-release', 'order' => 1],
            ['question' => 'Di media mana saja press release saya akan tayang?', 'answer' => 'Kami memiliki jaringan 200+ media nasional dan regional. Mulai dari media online besar, portal berita, hingga media niche sesuai industri Anda.', 'category' => 'press-release', 'order' => 2],
            ['question' => 'Apakah ada garansi backlink tidak dihapus?', 'answer' => 'Ya, kami memberikan garansi backlink aktif selama minimal 1 tahun. Jika ada yang dihapus, kami akan ganti dengan backlink di media setara.', 'category' => 'backlink', 'order' => 3],
            ['question' => 'Bagaimana cara memesan layanan?', 'answer' => "Anda cukup menghubungi kami via WhatsApp, ceritakan kebutuhan Anda, dan tim kami akan memberikan penawaran terbaik dalam 1x24 jam.", 'category' => 'umum', 'order' => 4],
            ['question' => 'Apakah bisa request revisi konten?', 'answer' => 'Tentu! Setiap paket sudah termasuk revisi. Jumlah revisi tergantung paket yang dipilih, mulai dari 1x hingga unlimited revisi.', 'category' => 'umum', 'order' => 5],
        ];

        foreach ($faqs as $data) {
            Faq::updateOrCreate(
                ['question' => $data['question']],
                array_merge($data, ['is_active' => true])
            );
        }

        // ── 5. CLIENT LOGOS ────────────────────────────────────────────
        $clients = [
            ['name' => 'Tugu',      'logo' => 'tugu.png',     'order' => 1],
            ['name' => 'Lunas',     'logo' => 'lunas.png',    'order' => 2],
            ['name' => 'Kuliner',   'logo' => 'kuliner.png',  'order' => 3],
            ['name' => 'Dog',       'logo' => 'dog.png',      'order' => 4],
            ['name' => 'Hikmat',    'logo' => 'hikmat.png',   'order' => 5],
            ['name' => 'Indo',      'logo' => 'indo.png',     'order' => 6],
            ['name' => 'Kids',      'logo' => 'kids.png',     'order' => 7],
            ['name' => 'Bio',       'logo' => 'bio.png',      'order' => 8],
            ['name' => 'Praja',     'logo' => 'praja.png',    'order' => 9],
            ['name' => 'Price',     'logo' => 'price.png',    'order' => 10],
            ['name' => 'Volantis',  'logo' => 'volantis.png', 'order' => 11],
            ['name' => 'Gorem',     'logo' => 'gorem.png',    'order' => 12],
        ];

        foreach ($clients as $data) {
            ClientLogo::updateOrCreate(
                ['logo' => $data['logo']],
                array_merge($data, ['is_active' => true])
            );
        }

        $this->command->info('✅ CMS Seeder selesai! Semua data awal berhasil dimasukkan.');
    }
}