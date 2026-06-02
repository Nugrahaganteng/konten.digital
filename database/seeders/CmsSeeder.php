<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\ClientLogo;
use App\Models\PageSection;

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
            [
                'page'        => 'footer',
                'section_key' => 'main',
                'label'       => 'Footer — Konten Utama',
                'order'       => 1,
                'content'     => [
                    // ✅ BARU: logo — null artinya belum diisi, fallback ke CSS logo
                    'logo'        => null,
                    'logo_alt'    => 'HNP Communications.id',
                    // Teks (tidak berubah)
                    'headline_1'  => 'Bersama Kami,',
                    'headline_2'  => 'Raih Kesuksesan',
                    'headline_3'  => 'di Era Digital',
                    'description' => 'Bergabunglah dengan ratusan klien yang puas dan rasakan perbedaan dengan konten berkualitas dari HNP Communications. Mulailah sekarang dan bawa bisnis Anda ke level berikutnya.',
                    'copyright'   => '© ' . date('Y') . ' HNP Communications.id — ALL RIGHTS RESERVED NUGRAHA & WILDAN',
                ],
            ],

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

        // ── 6. PAGE SECTIONS ───────────────────────────────────────────
        $pageSections = [

            // ════════════════════════════════════════════════════════════
            // HOME
            // ════════════════════════════════════════════════════════════
            [
                'page' => 'home', 'section_key' => 'hero',
                'label' => 'Hero Section', 'order' => 1,
                'content' => [
                    'badge_text'  => '+ Digital Agency',
                    'title_line1' => 'KONTEN',
                    'title_line2' => 'DIGITAL',
                    'subtitle'    => "Kami bukan agensi biasa.\nKami adalah partner kreatif yang bikin brand kamu berkesan di galaksi ini.",
                    'cta_text'    => 'MULAI SEKARANG →',
                    'cta_url'     => 'https://wa.me/6287786000919',
                    'image'       => null,
                    'bg_color'    => '#facc15',
                ],
            ],
            [
                'page' => 'home', 'section_key' => 'stats',
                'label' => 'Stats — Angka Pencapaian', 'order' => 2,
                'content' => [
                    'stat_1_number' => '200+', 'stat_1_label' => 'Media Partner',    'stat_1_color' => '#3b0764',
                    'stat_2_number' => '5+',   'stat_2_label' => 'Tahun Pengalaman', 'stat_2_color' => '#ef4444',
                    'stat_3_number' => '1K+',  'stat_3_label' => 'Klien Puas',       'stat_3_color' => '#14b8a6',
                ],
            ],
            [
                'page' => 'home', 'section_key' => 'marquee',
                'label' => 'Marquee — Ticker Berjalan', 'order' => 3,
                'content' => [
                    'item_1' => 'PRESS RELEASE', 'item_2' => '200+ MEDIA NASIONAL',
                    'item_3' => 'GARANSI TAYANG', 'item_4' => 'PROSES CEPAT',
                    'item_5' => 'KONTEN DIGITAL', 'bg_color' => '#ef4444',
                ],
            ],
            [
                'page' => 'home', 'section_key' => 'about_agency',
                'label' => 'About Agency', 'order' => 4,
                'content' => [
                    'title'       => 'Wish Granted!',
                    'description' => 'Berbasis di Bogor, Indonesia, kami adalah agensi digital kreatif yang berspesialisasi memberikan solusi dengan formula ideal.',
                    'cta_text'    => 'Pelajari Lebih →',
                    'cta_url'     => '/about',
                    'image'       => null,
                    'badge_stat'  => '98%',
                    'badge_label' => 'Tingkat Kepuasan',
                ],
            ],
            [
                'page' => 'home', 'section_key' => 'services',
                'label' => 'Services (Layanan)', 'order' => 5,
                'content' => [
                    'section_title' => 'Our Services.',
                    'svc_1_tab' => 'Press Release',     'svc_1_title' => "Jasa Press\nRelease",            'svc_1_body' => 'Layanan publikasi informasi resmi brand Anda ke berbagai media massa.',        'svc_1_bg' => 'SOCIAL', 'svc_1_img' => null, 'svc_1_route' => 'layanan.press.release',
                    'svc_2_tab' => 'Backlink Media',    'svc_2_title' => "Jasa Backlink\nMedia Nasional",  'svc_2_body' => 'Tingkatkan otoritas domain dan peringkat SEO website Anda.',                  'svc_2_bg' => 'NEWS',   'svc_2_img' => null, 'svc_2_route' => 'layanan.backlink',
                    'svc_3_tab' => 'Press Conference',  'svc_3_title' => "Jasa Press\nConference / Pers",  'svc_3_body' => 'Pengorganisasian konferensi pers profesional untuk komunikasi pesan penting.', 'svc_3_bg' => 'ART',    'svc_3_img' => null, 'svc_3_route' => 'layanan.press.conference',
                    'svc_4_tab' => 'Penulisan Artikel', 'svc_4_title' => "Jasa Penulisan\nArtikel",        'svc_4_body' => 'Pembuatan konten artikel yang menarik, informatif, dan dioptimasi.',           'svc_4_bg' => 'GROW',   'svc_4_img' => null, 'svc_4_route' => 'layanan.penulisan.artikel',
                    'svc_5_tab' => 'Script Video',      'svc_5_title' => "Jasa Penulisan\nScript Video",   'svc_5_body' => 'Penyusunan naskah kreatif untuk produksi video komersial.',                   'svc_5_bg' => 'NEWS',   'svc_5_img' => null, 'svc_5_route' => 'layanan.script.video',
                    'svc_6_tab' => 'Pelatihan Kreator', 'svc_6_title' => "Jasa Pelatihan\nKonten Kreator", 'svc_6_body' => 'Program pelatihan intensif menciptakan konten digital yang berdampak.',        'svc_6_bg' => 'ART',    'svc_6_img' => null, 'svc_6_route' => 'layanan.pelatihan.konten',
                ],
            ],
            [
                'page' => 'home', 'section_key' => 'clients',
                'label' => 'Our Clients', 'order' => 6,
                'content' => [
                    'section_title' => 'Our Clients.',
                    'logo_1' => null, 'logo_2'  => null, 'logo_3'  => null, 'logo_4'  => null,
                    'logo_5' => null, 'logo_6'  => null, 'logo_7'  => null, 'logo_8'  => null,
                    'logo_9' => null, 'logo_10' => null, 'logo_11' => null, 'logo_12' => null,
                ],
            ],
            [
                'page' => 'home', 'section_key' => 'contact_cta',
                'label' => 'Contact CTA', 'order' => 7,
                'content' => [
                    'badge'       => '✦ HUBUNGI KAMI',
                    'title_line1' => "Let's Build",
                    'title_line2' => 'Something',
                    'title_line3' => 'Different.',
                    'description' => 'Punya ide gila untuk brand kamu? Kami siap dengar dan wujudkan.',
                    'cta_text'    => "LET'S CHAT →",
                    'cta_url'     => 'https://wa.me/6287786000919',
                    'bg_color'    => '#ef4444',
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // ABOUT
            // ════════════════════════════════════════════════════════════
            [
                'page' => 'about', 'section_key' => 'hero',
                'label' => 'Hero Section', 'order' => 1,
                'content' => [
                    'badge_text' => 'SIAPA KAMI', 'title_line1' => 'WHO',
                    'title_line2' => 'WE ARE.', 'subtitle' => 'Mitra terpercaya dalam komunikasi dan pemasaran digital.',
                ],
            ],
            [
                'page' => 'about', 'section_key' => 'tentang',
                'label' => 'Tentang Kami', 'order' => 2,
                'content' => [
                    'title'       => 'Mitra Digital Terpercaya',
                    'description' => 'Kami adalah mitra terpercaya dalam komunikasi dan pemasaran digital.',
                    'image'       => null,
                ],
            ],
            [
                'page' => 'about', 'section_key' => 'visi_misi',
                'label' => 'Visi & Misi', 'order' => 3,
                'content' => [
                    'vision'   => 'Menjadi agensi digital terkemuka di Indonesia.',
                    'mission1' => 'Solusi komunikasi digital inovatif.',
                    'mission2' => 'Menghubungkan brand dengan 200+ media.',
                    'mission3' => 'Memberikan hasil nyata dan terukur.',
                ],
            ],
            [
                'page' => 'about', 'section_key' => 'cta',
                'label' => 'CTA / Penutup', 'order' => 4,
                'content' => [
                    'title'    => 'Siap Melejit Bersama Kami?',
                    'cta_text' => 'WhatsApp Sekarang',
                    'cta_url'  => 'https://wa.me/6287786000919',
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // CONTACT
            // ════════════════════════════════════════════════════════════
            [
                'page' => 'contact', 'section_key' => 'hero',
                'label' => 'Hero Section', 'order' => 1,
                'content' => [
                    'badge_text'  => "✦ Let's Talk Business",
                    'title'       => 'KONSULTASI GRATIS!',
                    'subtitle'    => 'Ubah statement menjadi berita nasional dalam sekejap.',
                    'description' => 'Siap meledakkan brand Anda di media nasional?',
                    'image'       => null,
                    'cta_text'    => 'Mulai Diskusi Sekarang →',
                ],
            ],
            [
                'page' => 'contact', 'section_key' => 'info',
                'label' => 'Info Kontak', 'order' => 2,
                'content' => [
                    'email'      => 'kontendigitalid10@gmail.com',
                    'whatsapp'   => '+62 877-8600-0919',
                    'address'    => 'Kaligawe, RT.02, Gandekan, Bantul, DIY 55711',
                    'maps_embed' => '',
                    'maps_url'   => '',
                ],
            ],
            [
                'page' => 'contact', 'section_key' => 'cta_bottom',
                'label' => 'Fast Response Card', 'order' => 3,
                'content' => [
                    'response_time' => 'RESPON < 1 JAM',
                    'description'   => 'Tim admin kami standby di jam kerja (09:00 - 17:00 WIB).',
                    'cta_text'      => 'Chat Via WhatsApp Sekarang →',
                    'cta_url'       => 'https://wa.me/6287786000919',
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // CARA ORDER
            // ════════════════════════════════════════════════════════════
            [
                'page' => 'cara-order', 'section_key' => 'hero',
                'label' => 'Hero Section', 'order' => 1,
                'content' => [
                    'badge_text'  => '✦ Panduan Pemesanan',
                    'title'       => 'ALUR KERJA ORDER',
                    'subtitle'    => 'Proses transparan, hasil maksimal untuk pesan Anda.',
                    'description' => 'Kami memastikan setiap langkah pengerjaan Press Release dilakukan secara profesional.',
                    'image'       => null,
                ],
            ],
            [
                'page' => 'cara-order', 'section_key' => 'steps',
                'label' => '10 Langkah Pemesanan', 'order' => 2,
                'content' => [
                    'step_1_title' => 'Konsultasi',     'step_1_desc' => 'Konsultasikan rencana, tujuan, dan materi press release Anda.',
                    'step_2_title' => 'Pilih Paket',    'step_2_desc' => 'Pilih paket layanan yang paling sesuai dengan target audiens dan budget Anda.',
                    'step_3_title' => 'Isi Form Order', 'step_3_desc' => 'Lengkapi data detail pemesanan melalui form praktis yang kami kirimkan via WhatsApp.',
                    'step_4_title' => 'Invoice',        'step_4_desc' => 'Kami akan mengirimkan rincian biaya resmi (invoice) setelah form order kami validasi.',
                    'step_5_title' => 'Pembayaran',     'step_5_desc' => 'Lakukan pembayaran. Pesanan Anda segera masuk antrian prioritas produksi kami.',
                    'step_6_title' => 'Materi Press',   'step_6_desc' => 'Kirimkan draf artikel Anda. Jika belum ada, tim kami siap membantu koordinasi konten.',
                    'step_7_title' => 'Wawancara',      'step_7_desc' => 'Tim kami akan melakukan penggalian data (interview) untuk menyusun naskah yang kuat.',
                    'step_8_title' => 'Review Klien',   'step_8_desc' => 'Anda mendapatkan kesempatan meninjau draf artikel sebelum benar-benar dipublikasikan.',
                    'step_9_title' => 'Penerbitan',     'step_9_desc' => 'Artikel Anda tayang di jaringan media online nasional pilihan secara serentak.',
                    'step_10_title' => 'Monitoring',    'step_10_desc' => 'Laporan lengkap berupa tautan/link berita yang tayang akan dikirimkan langsung kepada Anda.',
                ],
            ],
            [
                'page' => 'cara-order', 'section_key' => 'cta',
                'label' => 'CTA Penutup', 'order' => 3,
                'content' => [
                    'title'    => 'SIAP UNTUK GO PUBLIC?',
                    'cta_text' => 'Order via WhatsApp →',
                    'cta_url'  => 'https://wa.me/6287786000919',
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // SYARAT & KETENTUAN
            // ════════════════════════════════════════════════════════════
            [
                'page' => 'syarat-ketentuan', 'section_key' => 'hero',
                'label' => 'Hero Section', 'order' => 1,
                'content' => [
                    'title'    => 'SYARAT & KETENTUAN',
                    'subtitle' => 'Transparansi adalah kunci kenyamanan kerjasama kita.',
                    'image'    => null,
                ],
            ],
            [
                'page' => 'syarat-ketentuan', 'section_key' => 'syarat_pr',
                'label' => 'Syarat Umum Press Release', 'order' => 2,
                'content' => [
                    'rule_1' => 'Berita yang diterbitkan wajib memiliki news value.',
                    'rule_2' => 'Bukan berisi ajakan membeli langsung (hard selling).',
                    'rule_3' => 'Hasil penerbitan disesuaikan oleh editor media.',
                    'rule_4' => 'Media memiliki kewenangan penuh mengedit judul, gambar, maupun teks.',
                    'rule_5' => 'Tidak menerima revisi setelah terbit, kecuali kesalahan fatal.',
                    'rule_6' => 'Press release TIDAK BISA menyertakan hyperlink/backlink.',
                    'rule_7' => 'Berita yang sudah tayang tidak bisa di-TAKE DOWN.',
                    'rule_8' => 'Waktu penayangan diproses dalam 1-3 hari kerja.',
                ],
            ],
            [
                'page' => 'syarat-ketentuan', 'section_key' => 'ketentuan_penulisan',
                'label' => 'Ketentuan Penulisan Artikel', 'order' => 3,
                'content' => [
                    'rule_1' => 'Standar penulisan jurnalistik (5W + 1H).',
                    'rule_2' => 'Wajib mencantumkan narasumber yang kredibel.',
                    'rule_3' => 'Panjang artikel berkisar antara 200-500 kata.',
                    'rule_4' => 'Judul menarik antara 50 hingga 70 karakter.',
                    'rule_5' => 'Menyiapkan 2-3 foto resolusi tinggi.',
                    'rule_6' => 'Format foto wajib Landscape (tidak pecah/blur).',
                    'rule_7' => 'Foto terlalu komersil akan diganti oleh redaksi.',
                ],
            ],
            [
                'page' => 'syarat-ketentuan', 'section_key' => 'cta',
                'label' => 'CTA Penutup', 'order' => 4,
                'content' => [
                    'title'    => 'BUTUH BANTUAN LEBIH LANJUT?',
                    'cta_text' => 'HUBUNGI ADMIN SEKARANG →',
                    'cta_url'  => 'https://wa.me/6287786000919',
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // LAYANAN: PRESS RELEASE
            // ════════════════════════════════════════════════════════════
            [
                'page' => 'layanan-press-release', 'section_key' => 'hero',
                'label' => 'Hero Section', 'order' => 1,
                'content' => [
                    'badge_text'  => '✦ JASA PRESS RELEASE',
                    'title_line1' => 'BERSAMA',
                    'title_line2' => 'WARTAWAN DARI',
                    'title_line3' => 'MEDIA TERNAMA',
                    'quote'       => 'Ubah statement menjadi berita nasional dalam sekejap.',
                    'description' => 'Selain membantu mengundang wartawan/media untuk Anda, kami menangani pembuatan artikel press release, undangan media, distribusi berita, hingga monitoring pemuatan berita secara tuntas.',
                    'cta_text'    => 'KONSULTASI SEKARANG →',
                    'cta_url'     => 'https://wa.me/6287786000919',
                    'image'       => null,
                ],
            ],
            [
                'page' => 'layanan-press-release', 'section_key' => 'why_pr',
                'label' => 'Mengapa Harus Press Release?', 'order' => 2,
                'content' => [
                    'title'          => 'Mengapa Harus Press Release?',
                    'subtitle'       => 'Press release memiliki peran penting dalam strategi pemasaran dan branding suatu perusahaan.',
                    'reason_1_title' => 'Sarana Promosi Bisnis yang Efektif',
                    'reason_1_desc'  => 'Press release dapat menjadi sarana promosi produk dan jasa Anda ke skala nasional.',
                    'reason_2_title' => 'Media Branding yang Powerfull',
                    'reason_2_desc'  => 'Tampil eksklusif dan diliput banyak media besar akan membuat reputasi bisnis Anda meroket.',
                    'reason_3_title' => 'Memudahkan Urusan Public Relation',
                    'reason_3_desc'  => 'Berbagai urusan publikasi bisnis kini bisa dilakukan dengan mudah & cepat.',
                    'reason_4_title' => 'Syarat Verifikasi di Media Sosial dan Marketplace',
                    'reason_4_desc'  => 'Tunjukkan bahwa brand Anda populer dan pernah muncul di media-media online ternama.',
                    'reason_5_title' => 'Konten Iklan yang Sangat Kuat',
                    'reason_5_desc'  => 'Anda bisa memaksimalkan press release yang sudah terbit sebagai konten iklan di berbagai platform.',
                ],
            ],
            [
                'page' => 'layanan-press-release', 'section_key' => 'materi_publikasi',
                'label' => 'Materi Publikasi — Checklist', 'order' => 3,
                'content' => [
                    'title'   => 'Pilih Materi Publikasi Sesuai Kebutuhan Anda!',
                    'item_1'  => 'Promosi launching/peluncuran bisnis atau brand',
                    'item_2'  => 'Kegiatan sosial atau kemasyarakatan',
                    'item_3'  => 'Memperkenalkan produk atau jasa baru',
                    'item_4'  => 'Promosi perusahaan, event, seminar, kegiatan kampus, dll',
                    'item_5'  => 'Siaran pers perusahaan / korporat',
                    'item_6'  => 'Peningkatan brand awareness & reputasi',
                    'item_7'  => '',
                    'item_8'  => '',
                    'bg_image'=> null,
                ],
            ],
            [
                'page' => 'layanan-press-release', 'section_key' => 'target_audience',
                'label' => 'Target Audience — Siapa Target Anda?', 'order' => 4,
                'content' => [
                    'title'          => 'SIAPA TARGET ANDA?',
                    'subtitle'       => 'PILIH KATEGORI UNTUK MULAI EKSPANSI',
                    'target_1_badge' => 'P01',
                    'target_1_title' => 'Brand & UMKM',
                    'target_1_desc'  => 'Tingkatkan konversi customer dengan validasi berita dari media terpercaya.',
                    'target_1_color' => 'bg-cyan-300',
                    'target_2_badge' => 'P02',
                    'target_2_title' => 'Profesional',
                    'target_2_desc'  => 'Bangun personal branding kuat dan tingkatkan elektabilitas di mata publik.',
                    'target_2_color' => 'bg-yellow-300',
                    'target_3_badge' => 'P03',
                    'target_3_title' => 'Influencer',
                    'target_3_desc'  => 'Naikkan kelas endorsement Anda dengan label "Diliput Media Nasional".',
                    'target_3_color' => 'bg-rose-300',
                    'target_4_badge' => 'P04',
                    'target_4_title' => 'Komunitas',
                    'target_4_desc'  => 'Dapatkan kepercayaan maksimal untuk menarik ribuan anggota baru ke institusi Anda.',
                    'target_4_color' => 'bg-lime-300',
                ],
            ],
            [
                'page' => 'layanan-press-release', 'section_key' => 'keunggulan',
                'label' => 'Keunggulan — Mengapa Klien Memilih Kami?', 'order' => 5,
                'content' => [
                    'title'        => 'MENGAPA KLIEN',
                    'title_line2'  => 'MEMILIH KAMI?',
                    'bg_color'     => '#22d3ee',
                    'item_1_title' => 'Proses Cepat',       'item_1_desc' => 'Tim profesional kami memastikan rilis Anda diproses dalam hitungan jam, bukan hari.',    'item_1_color' => 'bg-white',
                    'item_2_title' => 'Garansi 100%',       'item_2_desc' => 'Jaminan tayang atau uang kembali 100% jika rilis tidak lolos kebijakan redaksi.',         'item_2_color' => 'bg-yellow-400',
                    'item_3_title' => 'Revisi Unlimited',   'item_3_desc' => 'Kepuasan Anda prioritas. Kami berikan revisi tanpa batas hingga narasi sempurna.',        'item_3_color' => 'bg-purple-500',
                    'item_4_title' => 'Admin Responsif',    'item_4_desc' => 'Konsultasi gratis kapan saja. Admin kami stand-by untuk menjawab setiap pertanyaan.',     'item_4_color' => 'bg-rose-400',
                    'item_5_title' => 'Biaya Kompetitif',   'item_5_desc' => 'Harga paling masuk akal di kelasnya tanpa menurunkan standar kualitas publikasi.',        'item_5_color' => 'bg-green-400',
                    'item_6_title' => '200+ Media',         'item_6_desc' => 'Akses ke jaringan media nasional terbesar mulai dari portal berita hingga koran cetak.',  'item_6_color' => 'bg-orange-400',
                    'item_7_title' => 'Gratis Penulisan',   'item_7_desc' => 'Belum ada draft? Tim editor kami buatkan artikel rilis profesional secara gratis.',       'item_7_color' => 'bg-indigo-400',
                    'item_8_title' => 'Bonus Media',        'item_8_desc' => 'Setiap pembelian paket tertentu, dapatkan ekstra publikasi di media mitra kami.',         'item_8_color' => 'bg-white',
                ],
            ],
            [
                'page' => 'layanan-press-release', 'section_key' => 'pricing',
                'label' => 'Paket Harga', 'order' => 6,
                'content' => [
                    'title'                => 'Paket Harga Jasa Press Release Media Online',
                    'bronze_price_ori'     => 'Rp 3.750.000,-',
                    'bronze_price'         => 'Rp 3.000.000',
                    'bronze_media_count'   => '3',
                    'silver_price_ori'     => 'Rp 5.750.000,-',
                    'silver_price'         => 'Rp 4.750.000',
                    'silver_media_count'   => '5',
                    'gold_price_ori'       => 'Rp 11.000.000,-',
                    'gold_price'           => 'Rp 9.000.000',
                    'gold_media_count'     => '10',
                    'platinum_price_ori'   => 'Rp 15.750.000,-',
                    'platinum_price'       => 'Rp 12.750.000',
                    'platinum_media_count' => '15',
                    'cta_url'              => 'https://wa.me/6287786000919',
                ],
            ],
            [
                'page' => 'layanan-press-release', 'section_key' => 'media_partner',
                'label' => 'Media Partner — Strip Logo Mitra', 'order' => 7,
                'content' => [
                    'title'    => '100+ MITRA.',
                    'subtitle' => 'Terpercaya di Seluruh Indonesia',
                    'logo_1'   => null, 'logo_2'  => null, 'logo_3'  => null, 'logo_4'  => null,
                    'logo_5'   => null, 'logo_6'  => null, 'logo_7'  => null, 'logo_8'  => null,
                    'logo_9'   => null, 'logo_10' => null, 'logo_11' => null, 'logo_12' => null,
                ],
            ],
            [
                'page' => 'layanan-press-release', 'section_key' => 'cta',
                'label' => 'CTA Penutup', 'order' => 8,
                'content' => [
                    'title'    => 'SIAP UNTUK GO NATIONAL?',
                    'cta_text' => 'Hubungi Kami Sekarang →',
                    'cta_url'  => 'https://wa.me/6287786000919',
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // LAYANAN: BACKLINK ← DATA LENGKAP (BUKAN PLACEHOLDER)
            // ════════════════════════════════════════════════════════════

            // ── 1. Hero ──────────────────────────────────────────────────
            [
                'page'        => 'layanan-backlink',
                'section_key' => 'hero',
                'label'       => 'Hero Section',
                'order'       => 1,
                'content'     => [
                    'badge_text'  => '✦ JASA BACKLINK MEDIA NASIONAL',
                    'title'       => 'BACKLINK',
                    'description' => 'Mitra terpercaya dalam komunikasi dan pemasaran digital yang mudah, murah, cepat, dan terjamin kualitasnya.',
                    'cta_text'    => 'KONSULTASI SEKARANG',
                    'cta_url'     => 'https://wa.me/6287786000919',
                ],
            ],

            // ── 2. Manfaat Backlink ──────────────────────────────────────
            [
                'page'        => 'layanan-backlink',
                'section_key' => 'benefits',
                'label'       => 'Manfaat Backlink',
                'order'       => 2,
                'content'     => [
                    'title'           => 'MANFAAT BACKLINK MEDIA NASIONAL',
                    'subtitle'        => 'Backlink media nasional memiliki beberapa manfaat sebagai berikut:',

                    'benefit_1_title' => 'Meningkatkan Jumlah Pengunjung (Visitor)',
                    'benefit_1_desc'  => 'Backlink dari media nasional dapat meningkatkan visibilitas website Anda di kalangan audiens yang lebih luas sehingga mendatangkan lebih banyak pengunjung organik.',

                    'benefit_2_title' => 'Memudahkan Google Menemukan Website Anda',
                    'benefit_2_desc'  => 'Backlink berkualitas membantu mesin pencari Google dalam menemukan dan mengindeks website Anda lebih cepat sehingga peringkat di SERP meningkat signifikan.',

                    'benefit_3_title' => 'Meningkatkan Authority Website',
                    'benefit_3_desc'  => 'Disebut oleh media ber-DA tinggi meningkatkan reputasi domain Anda dan menjadikannya dianggap sebagai sumber informasi yang terpercaya oleh Google.',
                ],
            ],

            // ── 3. Apa Itu Backlink ──────────────────────────────────────
            [
                'page'        => 'layanan-backlink',
                'section_key' => 'what_is',
                'label'       => 'Apa Itu Backlink?',
                'order'       => 3,
                'content'     => [
                    'title'    => 'APA ITU',
                    'subtitle' => 'Media Nasional Expertise',
                    'point_1'  => 'Tautan atau hyperlink strategis yang ditempatkan pada portal berita raksasa di Indonesia untuk mengarahkan traffic ke website Anda.',
                    'point_2'  => 'Senjata utama untuk memicu algoritma Google agar mengenali website Anda sebagai Otoritas Tinggi dan menaikkan posisinya di halaman pencarian.',
                    'image'    => null,
                ],
            ],

            // ── 4. Mengapa Memilih Kami ──────────────────────────────────
            [
                'page'        => 'layanan-backlink',
                'section_key' => 'why_us',
                'label'       => 'Mengapa Klien Memilih Kami?',
                'order'       => 4,
                'content'     => [
                    'title'         => 'MENGAPA KLIEN MEMILIH JASA HNP COMMUNICATIONS.ID?',

                    'reason_1'      => 'Proses Cepat dan Mudah',
                    'reason_1_desc' => 'Tim kami yang berpengalaman dan profesional memastikan setiap pesanan backlink diproses dengan cepat, tepat, dan tanpa kerumitan di pihak Anda.',

                    'reason_2'      => 'Garansi 100% Tayang',
                    'reason_2_desc' => 'Kami memberikan garansi tayang di media online terpilih. Jika backlink tidak bisa tayang, kami siap memberikan alternatif media setara atau full refund.',

                    'reason_3'      => 'Revisi Sepuasnya',
                    'reason_3_desc' => 'Kami memberikan garansi revisi sepuasnya, terutama dalam penulisan artikel pendukung backlink jika terdapat kesalahan dari pihak kami.',

                    'reason_4'      => 'Biaya Murah & Kompetitif',
                    'reason_4_desc' => 'Kami memberikan harga yang super kompetitif tanpa mengorbankan kualitas backlink dan media penempatan yang Anda dapatkan.',

                    'reason_5'      => 'Banyak Pilihan Media (200+)',
                    'reason_5_desc' => 'Kami memiliki jaringan lebih dari 200 media nasional dan regional sehingga Anda bisa memilih media penempatan backlink sesuai niche bisnis.',

                    'reason_6'      => 'Gratis Penulisan Draft Artikel',
                    'reason_6_desc' => 'Jika Anda belum memiliki artikel, tim penulis kami akan membuatkan draft artikel berkualitas tanpa biaya tambahan.',
                ],
            ],

            // ── 5. CTA Penutup ───────────────────────────────────────────
            [
                'page'        => 'layanan-backlink',
                'section_key' => 'cta',
                'label'       => 'CTA Penutup',
                'order'       => 5,
                'content'     => [
                    'title'    => 'SIAP UNTUK GO NATIONAL?',
                    'cta_text' => 'HUBUNGI KAMI SEKARANG →',
                    'cta_url'  => 'https://wa.me/6287786000919',
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // LAYANAN: PRESS CONFERENCE
            // ════════════════════════════════════════════════════════════
            [
                'page' => 'layanan-press-conference', 'section_key' => 'hero',
                'label' => 'Hero Section', 'order' => 1,
                'content' => [
                    'badge_text'      => '✦ JASA KONFERENSI PERS (KHUSUS JOGJA)',
                    'title_line1'     => 'Bersama Wartawan dari',
                    'title_highlight' => 'Media Ternama',
                    'quote'           => 'Ubah statement menjadi berita nasional dalam sekejap.',
                    'description'     => 'Selain membantu mengundang wartawan/media untuk Anda, kami menangani pembuatan artikel press release, undangan media, distribusi berita, hingga monitoring pemuatan berita secara tuntas.',
                    'cta_text'        => 'Konsultasi Sekarang →',
                    'cta_url'         => 'https://wa.me/6287786000919',
                    'image'           => null,
                    'badge_1'         => '✦ Launching Produk',
                    'badge_2'         => '✦ Press Release',
                ],
            ],
            [
                'page' => 'layanan-press-conference', 'section_key' => 'why_needed',
                'label' => 'Mengapa Dibutuhkan Konferensi Pers?', 'order' => 2,
                'content' => [
                    'title'           => 'Mengapa Dibutuhkan Konferensi Pers?',
                    'description'     => 'Dalam konferensi pers, narasumber bisa menjawab pertanyaan secara langsung dari para wartawan.',
                    'benefit_1_title' => 'Statement / Informasi',
                    'benefit_1_desc'  => 'Menyatakan suatu statement/informasi ke publik dan menyebarkannya secara luas melalui media.',
                    'benefit_2_title' => 'Launching Produk/Brand',
                    'benefit_2_desc'  => 'Ingin me-launching produk atau brand dan mengenalkan ke masyarakat luas.',
                    'benefit_3_title' => 'Ajakan Kegiatan Sosial',
                    'benefit_3_desc'  => 'Mengadakan kegiatan sosial/kemasyarakatan dan mengajak masyarakat luas ikut serta.',
                    'benefit_4_title' => 'Promosi & Pengenalan',
                    'benefit_4_desc'  => 'Ingin melakukan promosi suatu produk, perusahaan, seminar, atau acara kampus.',
                    'benefit_5_title' => 'Media Laporan Keuangan',
                    'benefit_5_desc'  => 'Mengumumkan laporan keuangan suatu perusahaan.',
                    'benefit_6_title' => 'Pengumuman Pemerintah',
                    'benefit_6_desc'  => 'Mengumumkan kebijakan baru pemerintahan.',
                ],
            ],
            [
                'page' => 'layanan-press-conference', 'section_key' => 'prep',
                'label' => 'Apa yang Perlu Disiapkan?', 'order' => 3,
                'content' => [
                    'title'  => 'Apa yang Perlu Disiapkan?',
                    'prep_1' => 'Menyiapkan ruang press conference (Hotel, Meeting Room, atau Event Hall).',
                    'prep_2' => 'Menetapkan Narasumber & Moderator utama.',
                    'prep_3' => 'Menyiapkan Key Points atau informasi inti yang akan disampaikan.',
                    'prep_4' => 'Fasilitas teknis pendukung (Meja, Sound System, Mic, dll).',
                ],
            ],
            [
                'page' => 'layanan-press-conference', 'section_key' => 'our_work',
                'label' => 'Apa yang Kami Kerjakan?', 'order' => 4,
                'content' => [
                    'title'  => 'Apa Saja yang Kami Kerjakan?',
                    'work_1' => 'Mengatur persiapan & mengundang media.',
                    'work_2' => 'Distribusi Press Release ke Jaringan Media.',
                    'work_3' => 'Pembuatan naskah Press Release profesional.',
                    'work_4' => 'Media monitoring (Follow up penayangan).',
                    'work_5' => 'Report Link URL & dokumentasi berita.',
                    'work_6' => 'Konsultasi strategi media.',
                ],
            ],
            [
                'page' => 'layanan-press-conference', 'section_key' => 'cta',
                'label' => 'CTA Penutup', 'order' => 5,
                'content' => [
                    'title'    => 'Siap Menjadi Headline Besok Pagi?',
                    'cta_text' => 'Hubungi Kami Sekarang →',
                    'cta_url'  => 'https://wa.me/6287786000919',
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // LAYANAN: PENULISAN ARTIKEL
            // ════════════════════════════════════════════════════════════
            [
                'page'        => 'layanan-penulisan-artikel',
                'section_key' => 'hero',
                'label'       => 'Hero Section',
                'order'       => 1,
                'content'     => [
                    'badge_text'  => '✦ JASA PENULISAN ARTIKEL',
                    'title_line1' => 'KONTEN ARTIKEL',
                    'title_line2' => 'BERKUALITAS &',
                    'title_line3' => 'SEO FRIENDLY',
                    'quote'       => 'Artikel yang menarik pembaca sekaligus disukai Google.',
                    'description' => 'Tim penulis berpengalaman kami siap menghasilkan artikel informatif, engaging, dan teroptimasi untuk kebutuhan website, blog, maupun media Anda.',
                    'cta_text'    => 'KONSULTASI SEKARANG →',
                    'cta_url'     => 'https://wa.me/6287786000919',
                    'image'       => null,
                ],
            ],
            [
                'page'        => 'layanan-penulisan-artikel',
                'section_key' => 'problems',
                'label'       => 'Masalah yang Kami Selesaikan',
                'order'       => 2,
                'content'     => [
                    'title'     => 'Apakah Anda Mengalami Hal Ini?',
                    'image'     => null,
                    'problem_1' => 'Tidak tahu cara riset kata kunci',
                    'problem_2' => 'Harga jasa penulisan artikel sangat mahal',
                    'problem_3' => 'Butuh banyak artikel dalam waktu cepat',
                    'problem_4' => 'Trauma dengan jasa penulis asal-asalan',
                    'problem_5' => 'Tidak punya waktu untuk konsisten posting',
                    'problem_6' => '',
                    'problem_7' => '',
                    'problem_8' => '',
                ],
            ],
            [
                'page'        => 'layanan-penulisan-artikel',
                'section_key' => 'why_artikel',
                'label'       => 'Mengapa Butuh Jasa Penulisan Artikel?',
                'order'       => 3,
                'content'     => [
                    'title'          => 'Mengapa Harus Jasa Penulisan Artikel?',
                    'subtitle'       => 'Konten artikel yang baik adalah investasi jangka panjang untuk traffic organik.',
                    'reason_1_title' => 'Hemat Waktu & Tenaga',
                    'reason_1_desc'  => 'Serahkan penulisan kepada ahlinya. Anda fokus mengelola bisnis, kami tangani kontennya.',
                    'reason_2_title' => 'Artikel SEO Teroptimasi',
                    'reason_2_desc'  => 'Setiap artikel ditulis dengan riset kata kunci yang tepat agar mudah ditemukan di mesin pencari.',
                    'reason_3_title' => 'Gaya Penulisan Sesuai Brand',
                    'reason_3_desc'  => 'Kami menyesuaikan tone of voice dan gaya penulisan dengan identitas brand Anda.',
                    'reason_4_title' => 'Konten Orisinal & Anti Plagiat',
                    'reason_4_desc'  => 'Setiap artikel ditulis dari nol, 100% original, dan melalui pengecekan plagiarisme sebelum diserahkan.',
                    'reason_5_title' => 'Berbagai Jenis Artikel',
                    'reason_5_desc'  => 'Artikel blog, advertorial, listicle, how-to, berita, ulasan produk — semua bisa kami kerjakan.',
                ],
            ],
            [
                'page'        => 'layanan-penulisan-artikel',
                'section_key' => 'topics',
                'label'       => 'Topik Penulisan',
                'order'       => 4,
                'content'     => [
                    'title'    => 'Topik Penulisan',
                    'subtitle' => 'Kami Menguasai Berbagai Niche Industri:',
                    'image'    => null,
                    'topic_1'  => 'Teknologi',
                    'topic_2'  => 'Kesehatan',
                    'topic_3'  => 'Parenting',
                    'topic_4'  => 'Pendidikan',
                    'topic_5'  => 'Travel',
                    'topic_6'  => 'Otomotif',
                    'topic_7'  => 'Kuliner',
                    'topic_8'  => 'Lifestyle',
                ],
            ],
            [
                'page'        => 'layanan-penulisan-artikel',
                'section_key' => 'pricing',
                'label'       => 'Paket Harga',
                'order'       => 5,
                'content'     => [
                    'title'              => 'Paket Harga Jasa Penulisan Artikel',
                    'basic_name'         => 'BASIC',
                    'basic_price_ori'    => 'Rp 100.000,-',
                    'basic_price'        => 'Rp 75.000',
                    'basic_words'        => '500',
                    'basic_feature_1'    => 'Artikel original',
                    'basic_feature_2'    => 'Anti plagiat',
                    'basic_feature_3'    => 'Riset topik',
                    'basic_feature_4'    => 'Revisi 1x',
                    'basic_feature_5'    => 'Format Word/PDF',
                    'basic_feature_6'    => '',
                    'standard_name'      => 'STANDARD',
                    'standard_badge'     => 'TERPOPULER',
                    'standard_price_ori' => 'Rp 200.000,-',
                    'standard_price'     => 'Rp 150.000',
                    'standard_words'     => '1000',
                    'standard_feature_1' => 'Artikel original',
                    'standard_feature_2' => 'Anti plagiat',
                    'standard_feature_3' => 'Riset kata kunci SEO',
                    'standard_feature_4' => 'Revisi 2x',
                    'standard_feature_5' => 'Format Word/PDF',
                    'standard_feature_6' => 'Optimasi on-page SEO',
                    'standard_feature_7' => '',
                    'standard_feature_8' => '',
                    'pro_name'           => 'PRO',
                    'pro_price_ori'      => 'Rp 350.000,-',
                    'pro_price'          => 'Rp 275.000',
                    'pro_words'          => '2000',
                    'pro_feature_1'      => 'Artikel original',
                    'pro_feature_2'      => 'Anti plagiat',
                    'pro_feature_3'      => 'Riset kata kunci SEO',
                    'pro_feature_4'      => 'Revisi unlimited',
                    'pro_feature_5'      => 'Format Word/PDF',
                    'pro_feature_6'      => 'Optimasi on-page SEO',
                    'pro_feature_7'      => 'Internal & external linking',
                    'pro_feature_8'      => 'Meta description',
                    'pro_feature_9'      => '',
                    'pro_feature_10'     => '',
                    'cta_text'           => 'Pesan Sekarang',
                    'cta_url'            => 'https://wa.me/6287786000919',
                ],
            ],
            [
                'page'        => 'layanan-penulisan-artikel',
                'section_key' => 'cta',
                'label'       => 'CTA Penutup',
                'order'       => 6,
                'content'     => [
                    'tagline'  => 'Siap Punya Konten yang Merajai Google?',
                    'title'    => 'SIAP PUNYA KONTEN BERKUALITAS?',
                    'cta_text' => 'PESAN ARTIKEL SEKARANG',
                    'cta_url'  => 'https://wa.me/6287786000919',
                ],
            ],

            
[
    'page'        => 'layanan-buzzer',
    'section_key' => 'hero',
    'label'       => 'Hero Section',
    'order'       => 1,
    'content'     => [
        'badge_text'  => '✦ JASA BUZZER MEDIA SOSIAL',
        'title_line1' => 'BUZZER',
        'title_line2' => 'VIRAL &',
        'title_line3' => 'ENGAGEMENT TINGGI',
        'quote'       => 'Dari brand menjadi trending topic.',
        'description' => 'Kami menyebarkan pesan brand Anda secara masif, organik, dan terkoordinasi di seluruh platform media sosial untuk menciptakan buzz yang nyata.',
        'cta_text'    => 'KONSULTASI SEKARANG',
        'cta_url'     => 'https://wa.me/6287786000919',
        'image'       => null,
    ],
],
 
// ── 2. Mengapa Jasa Buzzer ────────────────────────────────────────────────────
[
    'page'        => 'layanan-buzzer',
    'section_key' => 'why_buzzer',
    'label'       => 'Mengapa Butuh Jasa Buzzer?',
    'order'       => 2,
    'content'     => [
        'title'          => 'Mengapa Harus Jasa Buzzer?',
        'subtitle'       => 'Buzzer yang terkoordinasi adalah kunci viral marketing yang efektif dan terukur.',
        'reason_1_title' => 'Jangkauan Masif & Cepat',
        'reason_1_desc'  => 'Ribuan akun aktif menyebarkan pesan brand Anda dalam waktu singkat ke seluruh platform media sosial.',
        'reason_2_title' => 'Engagement Organik Nyata',
        'reason_2_desc'  => 'Interaksi dari akun-akun aktif yang membuat konten Anda terlihat natural dan terpercaya di mata algoritma.',
        'reason_3_title' => 'Sesuai Target Audiens',
        'reason_3_desc'  => 'Kampanye diarahkan ke segmen audiens yang paling relevan dengan brand dan tujuan bisnis Anda.',
        'reason_4_title' => 'Monitoring & Laporan Lengkap',
        'reason_4_desc'  => 'Setiap kampanye dipantau real-time dan dilaporkan secara detail sehingga ROI dapat diukur dengan jelas.',
        'reason_5_title' => 'Multi-Platform Sekaligus',
        'reason_5_desc'  => 'Satu kampanye menyentuh Twitter/X, Instagram, TikTok, Facebook, dan YouTube secara bersamaan.',
    ],
],
 
// ── 3. Daftar Layanan Buzzer ──────────────────────────────────────────────────
[
    'page'        => 'layanan-buzzer',
    'section_key' => 'services_list',
    'label'       => 'Daftar Layanan Buzzer',
    'order'       => 3,
    'content'     => [
        'title'           => 'LAYANAN KAMI',
        'subtitle'        => 'Strategi buzzer profesional yang dirancang khusus untuk mendominasi platform digital.',
        'service_1_title' => 'Buzzer Twitter/X',
        'service_1_desc'  => 'Sebarkan narasi brand secara masif di Twitter/X dengan ribuan akun aktif terkoordinasi.',
        'service_2_title' => 'Buzzer Instagram',
        'service_2_desc'  => 'Tingkatkan engagement, komentar, dan jangkauan konten Instagram Anda secara organik.',
        'service_3_title' => 'Buzzer TikTok',
        'service_3_desc'  => 'Dorong konten TikTok Anda ke FYP dengan interaksi nyata dari akun-akun aktif.',
        'service_4_title' => 'Buzzer Facebook',
        'service_4_desc'  => 'Viralkan postingan dan halaman Facebook Anda dengan share, like, dan komentar masif.',
        'service_5_title' => 'Buzzer YouTube',
        'service_5_desc'  => 'Tingkatkan views, subscriber, dan komentar video YouTube Anda secara cepat.',
        'service_6_title' => 'Buzzer Multi-Platform',
        'service_6_desc'  => 'Kampanye buzzer terpadu di semua platform sekaligus untuk dampak maksimal.',
    ],
],
 
// ── 4. Proses Kerja ───────────────────────────────────────────────────────────
[
    'page'        => 'layanan-buzzer',
    'section_key' => 'process',
    'label'       => 'Proses / Alur Kerja',
    'order'       => 4,
    'content'     => [
        'title'        => 'Alur Kerja Kampanye Buzzer',
        'step_1_title' => 'KONSULTASI AWAL',
        'step_1_desc'  => 'Membedah tujuan kampanye, target audiens, dan platform yang disasar.',
        'step_2_title' => 'RANCANG STRATEGI',
        'step_2_desc'  => 'Penyusunan narasi, hashtag, dan jadwal penyebaran yang optimal.',
        'step_3_title' => 'EKSEKUSI KAMPANYE',
        'step_3_desc'  => 'Penyebaran konten secara masif dan terkoordinasi di semua platform.',
        'step_4_title' => 'MONITORING REAL-TIME',
        'step_4_desc'  => 'Pemantauan engagement, reach, dan respons audiens secara langsung.',
        'step_5_title' => 'LAPORAN & ANALISIS',
        'step_5_desc'  => 'Laporan lengkap performa kampanye beserta rekomendasi lanjutan.',
    ],
],
 
// ── 5. Paket Harga ────────────────────────────────────────────────────────────
[
    'page'        => 'layanan-buzzer',
    'section_key' => 'pricing',
    'label'       => 'Paket Harga',
    'order'       => 5,
    'content'     => [
        'title'              => 'Paket Harga Jasa Buzzer Media Sosial',
        // BASIC
        'basic_price_ori'    => 'Rp 600.000,-',
        'basic_price'        => 'Rp 500.000',
        'basic_duration'     => '7 Hari',
        'basic_feature_1'    => '1 Platform',
        'basic_feature_2'    => '500 Interaksi/hari',
        'basic_feature_3'    => 'Laporan mingguan',
        'basic_feature_4'    => 'Konsultasi via WA',
        'basic_feature_5'    => 'Cocok untuk UMKM',
        // STANDARD
        'standard_price_ori' => 'Rp 1.200.000,-',
        'standard_price'     => 'Rp 1.000.000',
        'standard_duration'  => '14 Hari',
        'standard_feature_1' => '3 Platform',
        'standard_feature_2' => '1.500 Interaksi/hari',
        'standard_feature_3' => 'Laporan mingguan',
        'standard_feature_4' => 'Strategi hashtag',
        'standard_feature_5' => 'Monitoring real-time',
        'standard_feature_6' => 'Content calendar',
        // PREMIUM
        'premium_price_ori'  => 'Rp 2.400.000,-',
        'premium_price'      => 'Rp 2.000.000',
        'premium_duration'   => '30 Hari',
        'premium_feature_1'  => 'Semua Platform',
        'premium_feature_2'  => '5.000 Interaksi/hari',
        'premium_feature_3'  => 'Laporan harian',
        'premium_feature_4'  => 'GARANSI VIRAL',
        'premium_feature_5'  => 'Dedicated account manager',
        'premium_feature_6'  => 'Strategi konten lengkap',
        'premium_feature_7'  => 'Crisis management',
        // CTA
        'cta_text'           => 'Pesan Sekarang',
        'cta_url'            => 'https://wa.me/6287786000919',
    ],
],
 
// ── 6. CTA Penutup ────────────────────────────────────────────────────────────
[
    'page'        => 'layanan-buzzer',
    'section_key' => 'cta',
    'label'       => 'CTA Penutup',
    'order'       => 6,
    'content'     => [
        'title'    => 'SIAP BIKIN BRAND KAMU VIRAL?',
        'cta_text' => 'PESAN BUZZER SEKARANG',
        'cta_url'  => 'https://wa.me/6287786000919',
    ],
],

            // ════════════════════════════════════════════════════════════
            // LAYANAN: PELATIHAN KONTEN
            // ════════════════════════════════════════════════════════════
            [
                'page'        => 'layanan-pelatihan-konten',
                'section_key' => 'hero',
                'label'       => 'Hero Section',
                'order'       => 1,
                'content'     => [
                    'badge_text'      => '✦ UPGRADE SKILL KONTEN KREATORMU',
                    'title_line1'     => 'Ciptakan Konten',
                    'title_highlight' => 'Inovatif',
                    'title_line2'     => 'dengan Smartphone',
                    'quote'           => 'Ubah perangkat harian Anda menjadi mesin produksi konten profesional.',
                    'description'     => 'Ikuti pelatihan konten kreator bersama HNP Communications.id. Materi komprehensif mulai dari pengambilan video, editing, hingga strategi publikasi.',
                    'cta_text'        => 'KONSULTASI SEKARANG →',
                    'cta_url'         => 'https://wa.me/6287786000919',
                    'image'           => null,
                    'badge_cert'      => 'Sertifikasi BNSP',
                    'badge_live'      => '✦ LIVE WORKSHOP',
                ],
            ],
             
            // ── 2. Mengapa Harus Ikut ─────────────────────────────────────────────────────
            [
                'page'        => 'layanan-pelatihan-konten',
                'section_key' => 'why_join',
                'label'       => 'Mengapa Harus Ikut?',
                'order'       => 2,
                'content'     => [
                    'title'          => 'Mengapa Harus Ikut Pelatihan Kami?',
                    'subtitle'       => '',
                    'reason_1_title' => 'Belajar Dari Ahlinya',
                    'reason_1_desc'  => 'Tim pengajar kami adalah mantan produser senior TV nasional dengan pengalaman lebih dari 20 tahun.',
                    'reason_2_title' => 'Pengajar BNSP',
                    'reason_2_desc'  => 'Tim bersertifikasi Badan Nasional Sertifikasi Profesi (BNSP) dengan gelar Certified Content Creator.',
                    'reason_3_title' => 'Materi Komprehensif',
                    'reason_3_desc'  => 'Mencakup seluruh aspek creation mulai dari teknik pengambilan gambar hingga strategi engagement.',
                    'reason_4_title' => 'Metode Fleksibel',
                    'reason_4_desc'  => 'Tersedia format kolektif maupun privat, cocok untuk perusahaan, instansi, maupun UMKM.',
                    'reason_5_title' => '',
                    'reason_5_desc'  => '',
                    'reason_6_title' => '',
                    'reason_6_desc'  => '',
                ],
            ],
             
            // ── 3. Modul Materi ───────────────────────────────────────────────────────────
            [
                'page'        => 'layanan-pelatihan-konten',
                'section_key' => 'modules',
                'label'       => 'Modul Materi Pelatihan',
                'order'       => 3,
                'content'     => [
                    'title'          => 'Apa Saja Materi Pelatihan Kami?',
                    'subtitle'       => '',
                    'module_1_title' => 'Modul 1: Pengenalan Dunia Konten Kreator',
                    'module_1_desc'  => 'Niche content, personal branding, dan peran kreator di industri digital.',
                    'module_2_title' => 'Modul 2: Persiapan dan Perencanaan',
                    'module_2_desc'  => 'Ide konten, scriptwriting yang efektif, riset audiens, dan pembuatan storyboard.',
                    'module_3_title' => 'Modul 3: Produksi Konten',
                    'module_3_desc'  => 'Teknik kamera (angle, framing, lighting) dan penggunaan aksesoris smartphone.',
                    'module_4_title' => 'Modul 4: Editing Video dengan Smartphone',
                    'module_4_desc'  => 'Pengenalan aplikasi CapCut, dasar editing, transisi, musik, dan color correction.',
                    'module_5_title' => 'Modul 5: Distribusi dan Promosi Video',
                    'module_5_desc'  => 'Optimasi video untuk platform YouTube, Instagram, TikTok, dan Facebook.',
                    'module_6_title' => 'Modul 6: Cuan dari Ngonten',
                    'module_6_desc'  => 'Strategi monetisasi, affiliate marketing, endorse, dan penjualan produk/jasa.',
                    'module_7_title' => '',
                    'module_7_desc'  => '',
                    'module_8_title' => '',
                    'module_8_desc'  => '',
                ],
            ],
             
            // ── 4. Targets / Siapa yang Cocok ─────────────────────────────────────────────
            [
                'page'        => 'layanan-pelatihan-konten',
                'section_key' => 'targets',
                'label'       => 'Siapa yang Cocok?',
                'order'       => 4,
                'content'     => [
                    'title'        => 'Siapa Saja yang Cocok?',
                    'target_1'     => 'Perusahaan Profesional',
                    'target_1_desc'=> 'Perusahaan yang concern terhadap konten (properti, travel, RS, dsb).',
                    'target_2'     => 'Instansi & Lembaga',
                    'target_2_desc'=> 'Sekolah, ponpes, universitas, dan lembaga pemerintahan.',
                    'target_3'     => 'Individu Kreator',
                    'target_3_desc'=> 'Individu yang ingin menjadi kreator profesional atau meningkatkan kompetensi.',
                    'target_4'     => 'Business Owner & UMKM',
                    'target_4_desc'=> 'Pemilik bisnis yang ingin mempromosikan produk melalui konten kreatif.',
                    'target_5'     => '',
                    'target_5_desc'=> '',
                    'target_6'     => '',
                    'target_6_desc'=> '',
                ],
            ],
             
            // ── 5. Pricing / Paket Harga ──────────────────────────────────────────────────
            [
                'page'        => 'layanan-pelatihan-konten',
                'section_key' => 'pricing',
                'label'       => 'Paket Harga',
                'order'       => 5,
                'content'     => [
                    'title'    => 'Paket Harga Pelatihan Konten Kreator',
                    'subtitle' => '',
                    // Paket 1: KOLEKTIF
                    'package_1_name'      => 'KOLEKTIF',
                    'package_1_price_ori' => 'Rp 800.000,-',
                    'package_1_price'     => 'Rp 650.000',
                    'package_1_desc'      => 'Per orang, min. 5 peserta',
                    'package_1_badge'     => '',
                    'package_1_feature_1' => 'Pelatihan 1 hari',
                    'package_1_feature_2' => 'Materi komprehensif',
                    'package_1_feature_3' => 'Sertifikat digital',
                    'package_1_feature_4' => 'Cocok untuk tim/instansi',
                    'package_1_feature_5' => '',
                    'package_1_feature_6' => '',
                    'package_1_feature_7' => '',
                    'package_1_feature_8' => '',
                    // Paket 2: PRIVAT
                    'package_2_name'      => 'PRIVAT',
                    'package_2_price_ori' => 'Rp 1.500.000,-',
                    'package_2_price'     => 'Rp 1.200.000',
                    'package_2_desc'      => 'Untuk individu/1-2 orang',
                    'package_2_badge'     => 'TERPOPULER',
                    'package_2_feature_1' => 'Pelatihan 1 hari',
                    'package_2_feature_2' => 'Materi komprehensif',
                    'package_2_feature_3' => 'Sertifikat digital',
                    'package_2_feature_4' => 'Sesi tanya jawab intensif',
                    'package_2_feature_5' => 'Mentoring pasca pelatihan',
                    'package_2_feature_6' => '',
                    'package_2_feature_7' => '',
                    'package_2_feature_8' => '',
                    // Paket 3: KORPORAT
                    'package_3_name'      => 'KORPORAT',
                    'package_3_price_ori' => 'Custom',
                    'package_3_price'     => 'Hubungi Kami',
                    'package_3_desc'      => 'Untuk perusahaan/instansi besar',
                    'package_3_badge'     => '',
                    'package_3_feature_1' => 'Kurikulum custom',
                    'package_3_feature_2' => 'Offline/Online',
                    'package_3_feature_3' => 'Sertifikat resmi BNSP',
                    'package_3_feature_4' => 'Minimal 10 peserta',
                    'package_3_feature_5' => 'Laporan evaluasi peserta',
                    'package_3_feature_6' => '',
                    'package_3_feature_7' => '',
                    'package_3_feature_8' => '',
                    // Paket 4, 5, 6 (kosong, bisa diisi admin)
                    'package_4_name'      => '',
                    'package_4_price_ori' => '',
                    'package_4_price'     => '',
                    'package_4_desc'      => '',
                    'package_4_badge'     => '',
                    'package_4_feature_1' => '',
                    'package_4_feature_2' => '',
                    'package_4_feature_3' => '',
                    'package_4_feature_4' => '',
                    'package_4_feature_5' => '',
                    'package_4_feature_6' => '',
                    'package_4_feature_7' => '',
                    'package_4_feature_8' => '',
                    // CTA
                    'cta_text' => 'Daftar Sekarang →',
                    'cta_url'  => 'https://wa.me/6287786000919',
                    'note'     => '',
                ],
            ],
             
            // ── 6. CTA Penutup ────────────────────────────────────────────────────────────
            [
                'page'        => 'layanan-pelatihan-konten',
                'section_key' => 'cta',
                'label'       => 'CTA Penutup',
                'order'       => 6,
                'content'     => [
                    'title'    => "SIAP JADI\nKREATOR?",
                    'subtitle' => 'Daftar sekarang dan mulai perjalanan kreatormu bersama HNP Communications.id.',
                    'cta_text' => 'HUBUNGI KAMI SEKARANG →',
                    'cta_url'  => 'https://wa.me/6287786000919',
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // FOOTER
            // ════════════════════════════════════════════════════════════
            [
                'page'        => 'footer',
                'section_key' => 'main',
                'label'       => 'Footer — Konten Utama',
                'order'       => 1,
                'content'     => [
                    'logo'        => null,
                    'logo_alt'    => 'HNP Communications.id',
                    'headline_1'  => 'Bersama Kami,',
                    'headline_2'  => 'Raih Kesuksesan',
                    'headline_3'  => 'di Era Digital',
                    'description' => 'Bergabunglah dengan ratusan klien yang puas dan rasakan perbedaan dengan konten berkualitas dari HNP Communications. Mulailah sekarang dan bawa bisnis Anda ke level berikutnya.',
                    'copyright'   => '© ' . date('Y') . ' HNP Communications.id — ALL RIGHTS RESERVED NUGRAHA & WILDAN',
                ],
            ],
            [
                'page'        => 'footer',
                'section_key' => 'contact',
                'label'       => 'Footer — Kontak & WhatsApp',
                'order'       => 2,
                'content'     => [
                    'wa1_number' => '6287786000919',
                    'wa1_label'  => '+62 877-8600-0919',
                    'wa2_number' => '628121967610',
                    'wa2_label'  => '+62 812-1967-610',
                ],
            ],
            [
                'page'        => 'footer',
                'section_key' => 'social',
                'label'       => 'Footer — Social Media',
                'order'       => 3,
                'content'     => [
                    'instagram' => '#',
                    'facebook'  => '#',
                    'youtube'   => '#',
                    'tiktok'    => '#',
                ],
            ],
 
            // ════════════════════════════════════════════════════════════
            // SERVICES-NAVBAR ← INI YANG PALING PENTING
            // ════════════════════════════════════════════════════════════
            // ════════════════════════════════════════════════════════════
// SERVICES-NAVBAR
// ════════════════════════════════════════════════════════════
[
    'page'        => 'services-navbar',
    'section_key' => 'main',
    'label'       => 'Navbar — Identitas Brand',
    'order'       => 1,
    'content'     => [
        'logo'            => null,
        'logo_alt'        => 'HNP Communications.id',
        'brand_name'      => 'HNP Communications',
        'brand_tagline'   => 'Your Strategic PR and Digital Partner',
        'navbar_bg_color' => '#facc15',
        'navbar_border'   => '#000000',
    ],
],
        ];

        foreach ($pageSections as $data) {
            PageSection::updateOrCreate(
                ['page' => $data['page'], 'section_key' => $data['section_key']],
                [
                    'label'         => $data['label'],
                    'order'         => $data['order'],
                    'is_active'     => true,
                    'content'       => $data['content'],
                    'hidden_fields' => [],
                ]
            );

            
        }

        $this->command->info('✅ CMS Seeder selesai! Semua data awal berhasil dimasukkan.');
    }
}