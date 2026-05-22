<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = [
        'page',
        'section_key',
        'label',
        'order',
        'is_active',
        'content',
        'hidden_fields',
    ];

    protected $casts = [
        'content'       => 'array',
        'hidden_fields' => 'array',
        'is_active'     => 'boolean',
        'order'         => 'integer',
    ];

    // ── Scopes ──────────────────────────────────────────────────────────

    public function scopeForPage($query, string $page)
    {
        return $query->where('page', $page);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('id');
    }

    // ── Relationships ────────────────────────────────────────────────────

    public function histories()
    {
        return $this->hasMany(PageSectionHistory::class);
    }

    // ── Helpers ─────────────────────────────────────────────────────────

    public function get(string $key, mixed $default = null): mixed
    {
        return data_get($this->content, $key, $default);
    }

    public function isFieldHidden(string $key): bool
    {
        return in_array($key, $this->hidden_fields ?? []);
    }

    public static function ofPage(string $page): \Illuminate\Support\Collection
    {
        return static::forPage($page)
            ->active()
            ->ordered()
            ->get()
            ->keyBy('section_key');
    }

    public function getField(string $key, mixed $default = null): mixed
    {
        if ($this->isFieldHidden($key)) {
            return $default;
        }
        return data_get($this->content, $key, $default);
    }

    // ── Schema ───────────────────────────────────────────────────────────

    public static function schema(): array
    {
        return [

            // ════════════════════════════════════════════════════════════
            // HOME
            // ════════════════════════════════════════════════════════════
            'home' => [
                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'badge_text',      'label' => 'Badge Text',                    'type' => 'text',     'placeholder' => '+ Digital Agency'],
                        ['key' => 'title_line1',     'label' => 'Judul Baris 1',                 'type' => 'text',     'placeholder' => 'KONTEN'],
                        ['key' => 'title_line2',     'label' => 'Judul Baris 2 (outline)',       'type' => 'text',     'placeholder' => 'DIGITAL'],
                        ['key' => 'subtitle',        'label' => 'Paragraf / Tagline',            'type' => 'textarea', 'placeholder' => "Kami bukan agensi biasa.\nKami adalah partner kreatif yang bikin brand kamu berkesan di galaksi ini."],
                        ['key' => 'highlight_words', 'label' => 'Kata Highlight (pisah koma)',   'type' => 'text',     'placeholder' => 'partner kreatif, yang'],
                        ['key' => 'cta_text',        'label' => 'Teks Tombol CTA',               'type' => 'text',     'placeholder' => 'MULAI SEKARANG →'],
                        ['key' => 'cta_url',         'label' => 'URL Tombol CTA',                'type' => 'text',     'placeholder' => 'https://wa.me/6281234567890'],
                        ['key' => 'image',           'label' => 'Gambar Maskot (opsional)',      'type' => 'image'],
                        ['key' => 'bg_color',        'label' => 'Warna Background',              'type' => 'color',    'placeholder' => '#facc15'],
                    ],
                ],

                'stats' => [
                    'label'  => 'Stats — Angka Pencapaian',
                    'fields' => [
                        ['key' => 'stat_1_number', 'label' => 'Angka 1',    'type' => 'text',  'placeholder' => '200+'],
                        ['key' => 'stat_1_label',  'label' => 'Label 1',    'type' => 'text',  'placeholder' => 'Media Partner'],
                        ['key' => 'stat_1_color',  'label' => 'Warna BG 1', 'type' => 'color', 'placeholder' => '#3b0764'],
                        ['key' => 'stat_2_number', 'label' => 'Angka 2',    'type' => 'text',  'placeholder' => '5+'],
                        ['key' => 'stat_2_label',  'label' => 'Label 2',    'type' => 'text',  'placeholder' => 'Tahun Pengalaman'],
                        ['key' => 'stat_2_color',  'label' => 'Warna BG 2', 'type' => 'color', 'placeholder' => '#ef4444'],
                        ['key' => 'stat_3_number', 'label' => 'Angka 3',    'type' => 'text',  'placeholder' => '1K+'],
                        ['key' => 'stat_3_label',  'label' => 'Label 3',    'type' => 'text',  'placeholder' => 'Klien Puas'],
                        ['key' => 'stat_3_color',  'label' => 'Warna BG 3', 'type' => 'color', 'placeholder' => '#14b8a6'],
                    ],
                ],

                'marquee' => [
                    'label'  => 'Marquee — Ticker Berjalan',
                    'fields' => [
                        ['key' => 'item_1',   'label' => 'Teks 1',                   'type' => 'text',  'placeholder' => 'PRESS RELEASE'],
                        ['key' => 'item_2',   'label' => 'Teks 2',                   'type' => 'text',  'placeholder' => '200+ MEDIA NASIONAL'],
                        ['key' => 'item_3',   'label' => 'Teks 3',                   'type' => 'text',  'placeholder' => 'GARANSI TAYANG'],
                        ['key' => 'item_4',   'label' => 'Teks 4',                   'type' => 'text',  'placeholder' => 'PROSES CEPAT'],
                        ['key' => 'item_5',   'label' => 'Teks 5',                   'type' => 'text',  'placeholder' => 'KONTEN DIGITAL'],
                        ['key' => 'bg_color', 'label' => 'Warna Background Marquee', 'type' => 'color', 'placeholder' => '#ef4444'],
                    ],
                ],

                'about_agency' => [
                    'label'  => 'About Agency',
                    'fields' => [
                        ['key' => 'title',       'label' => 'Judul',                        'type' => 'text',     'placeholder' => 'Wish Granted!'],
                        ['key' => 'description', 'label' => 'Paragraf Deskripsi',           'type' => 'textarea', 'placeholder' => 'Berbasis di Bogor, Indonesia...'],
                        ['key' => 'cta_text',    'label' => 'Teks Tombol',                  'type' => 'text',     'placeholder' => 'Pelajari Lebih →'],
                        ['key' => 'cta_url',     'label' => 'URL Tombol',                   'type' => 'text',     'placeholder' => '/about'],
                        ['key' => 'image',       'label' => 'Gambar (ganti ilustrasi SVG)', 'type' => 'image'],
                        ['key' => 'badge_stat',  'label' => 'Angka Badge pojok kanan',      'type' => 'text',     'placeholder' => '98%'],
                        ['key' => 'badge_label', 'label' => 'Label Badge',                  'type' => 'text',     'placeholder' => 'Tingkat Kepuasan'],
                    ],
                ],

                'services' => [
                    'label'  => 'Services (Layanan)',
                    'fields' => [
                        ['key' => 'section_title', 'label' => 'Judul Section', 'type' => 'text', 'placeholder' => 'Our Services.'],
                        ['key' => 'svc_1_tab',   'label' => 'Tab 1',       'type' => 'text',     'placeholder' => 'Press Release'],
                        ['key' => 'svc_1_title', 'label' => 'Judul 1',     'type' => 'text',     'placeholder' => "Jasa Press\nRelease"],
                        ['key' => 'svc_1_body',  'label' => 'Deskripsi 1', 'type' => 'textarea', 'placeholder' => 'Layanan publikasi informasi resmi brand Anda ke berbagai media massa.'],
                        ['key' => 'svc_1_bg',    'label' => 'Teks BG 1',   'type' => 'text',     'placeholder' => 'SOCIAL'],
                        ['key' => 'svc_1_img',   'label' => 'Gambar 1',    'type' => 'image'],
                        ['key' => 'svc_1_route', 'label' => 'Route/URL 1', 'type' => 'text',     'placeholder' => 'layanan.press.release'],
                        ['key' => 'svc_2_tab',   'label' => 'Tab 2',       'type' => 'text',     'placeholder' => 'Backlink Media'],
                        ['key' => 'svc_2_title', 'label' => 'Judul 2',     'type' => 'text',     'placeholder' => "Jasa Backlink\nMedia Nasional"],
                        ['key' => 'svc_2_body',  'label' => 'Deskripsi 2', 'type' => 'textarea', 'placeholder' => 'Tingkatkan otoritas domain dan peringkat SEO website Anda.'],
                        ['key' => 'svc_2_bg',    'label' => 'Teks BG 2',   'type' => 'text',     'placeholder' => 'NEWS'],
                        ['key' => 'svc_2_img',   'label' => 'Gambar 2',    'type' => 'image'],
                        ['key' => 'svc_2_route', 'label' => 'Route/URL 2', 'type' => 'text',     'placeholder' => 'layanan.backlink'],
                        ['key' => 'svc_3_tab',   'label' => 'Tab 3',       'type' => 'text',     'placeholder' => 'Press Conference'],
                        ['key' => 'svc_3_title', 'label' => 'Judul 3',     'type' => 'text',     'placeholder' => "Jasa Press\nConference / Pers"],
                        ['key' => 'svc_3_body',  'label' => 'Deskripsi 3', 'type' => 'textarea', 'placeholder' => 'Pengorganisasian konferensi pers profesional.'],
                        ['key' => 'svc_3_bg',    'label' => 'Teks BG 3',   'type' => 'text',     'placeholder' => 'ART'],
                        ['key' => 'svc_3_img',   'label' => 'Gambar 3',    'type' => 'image'],
                        ['key' => 'svc_3_route', 'label' => 'Route/URL 3', 'type' => 'text',     'placeholder' => 'layanan.press.conference'],
                        ['key' => 'svc_4_tab',   'label' => 'Tab 4',       'type' => 'text',     'placeholder' => 'Penulisan Artikel'],
                        ['key' => 'svc_4_title', 'label' => 'Judul 4',     'type' => 'text',     'placeholder' => "Jasa Penulisan\nArtikel"],
                        ['key' => 'svc_4_body',  'label' => 'Deskripsi 4', 'type' => 'textarea', 'placeholder' => 'Pembuatan konten artikel yang menarik, informatif, dan dioptimasi.'],
                        ['key' => 'svc_4_bg',    'label' => 'Teks BG 4',   'type' => 'text',     'placeholder' => 'GROW'],
                        ['key' => 'svc_4_img',   'label' => 'Gambar 4',    'type' => 'image'],
                        ['key' => 'svc_4_route', 'label' => 'Route/URL 4', 'type' => 'text',     'placeholder' => 'layanan.penulisan.artikel'],
                        ['key' => 'svc_5_tab',   'label' => 'Tab 5',       'type' => 'text',     'placeholder' => 'Script Video'],
                        ['key' => 'svc_5_title', 'label' => 'Judul 5',     'type' => 'text',     'placeholder' => "Jasa Penulisan\nScript Video / TV"],
                        ['key' => 'svc_5_body',  'label' => 'Deskripsi 5', 'type' => 'textarea', 'placeholder' => 'Penyusunan naskah kreatif untuk produksi video komersial.'],
                        ['key' => 'svc_5_bg',    'label' => 'Teks BG 5',   'type' => 'text',     'placeholder' => 'NEWS'],
                        ['key' => 'svc_5_img',   'label' => 'Gambar 5',    'type' => 'image'],
                        ['key' => 'svc_5_route', 'label' => 'Route/URL 5', 'type' => 'text',     'placeholder' => 'layanan.script.video'],
                        ['key' => 'svc_6_tab',   'label' => 'Tab 6',       'type' => 'text',     'placeholder' => 'Pelatihan Kreator'],
                        ['key' => 'svc_6_title', 'label' => 'Judul 6',     'type' => 'text',     'placeholder' => "Jasa Pelatihan\nKonten Kreator"],
                        ['key' => 'svc_6_body',  'label' => 'Deskripsi 6', 'type' => 'textarea', 'placeholder' => 'Program pelatihan intensif untuk menciptakan konten digital yang berdampak.'],
                        ['key' => 'svc_6_bg',    'label' => 'Teks BG 6',   'type' => 'text',     'placeholder' => 'ART'],
                        ['key' => 'svc_6_img',   'label' => 'Gambar 6',    'type' => 'image'],
                        ['key' => 'svc_6_route', 'label' => 'Route/URL 6', 'type' => 'text',     'placeholder' => 'layanan.pelatihan.konten'],
                    ],
                ],

                'services_header' => [
                    'label'  => 'Services — Judul Section (Legacy)',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul Section',    'type' => 'text',  'placeholder' => 'Our Services.'],
                        ['key' => 'bg_color', 'label' => 'Warna Background', 'type' => 'color', 'placeholder' => '#22d3ee'],
                    ],
                ],

                'clients' => [
                    'label'  => 'Our Clients',
                    'fields' => [
                        ['key' => 'section_title', 'label' => 'Judul Section', 'type' => 'text',  'placeholder' => 'Our Clients.'],
                        ['key' => 'logo_1',        'label' => 'Logo Klien 1',  'type' => 'image'],
                        ['key' => 'logo_2',        'label' => 'Logo Klien 2',  'type' => 'image'],
                        ['key' => 'logo_3',        'label' => 'Logo Klien 3',  'type' => 'image'],
                        ['key' => 'logo_4',        'label' => 'Logo Klien 4',  'type' => 'image'],
                        ['key' => 'logo_5',        'label' => 'Logo Klien 5',  'type' => 'image'],
                        ['key' => 'logo_6',        'label' => 'Logo Klien 6',  'type' => 'image'],
                        ['key' => 'logo_7',        'label' => 'Logo Klien 7',  'type' => 'image'],
                        ['key' => 'logo_8',        'label' => 'Logo Klien 8',  'type' => 'image'],
                        ['key' => 'logo_9',        'label' => 'Logo Klien 9',  'type' => 'image'],
                        ['key' => 'logo_10',       'label' => 'Logo Klien 10', 'type' => 'image'],
                        ['key' => 'logo_11',       'label' => 'Logo Klien 11', 'type' => 'image'],
                        ['key' => 'logo_12',       'label' => 'Logo Klien 12', 'type' => 'image'],
                    ],
                ],

                'clients_header' => [
                    'label'  => 'Clients — Judul Section (Legacy)',
                    'fields' => [
                        ['key' => 'title', 'label' => 'Judul Section', 'type' => 'text', 'placeholder' => 'Our Clients.'],
                    ],
                ],

                'contact_cta' => [
                    'label'  => 'Contact CTA',
                    'fields' => [
                        ['key' => 'badge',       'label' => 'Badge Text',          'type' => 'text',     'placeholder' => '✦ HUBUNGI KAMI'],
                        ['key' => 'title_line1', 'label' => 'Judul Baris 1',       'type' => 'text',     'placeholder' => "Let's Build"],
                        ['key' => 'title_line2', 'label' => 'Judul Baris 2',       'type' => 'text',     'placeholder' => 'Something'],
                        ['key' => 'title_line3', 'label' => 'Judul Baris 3',       'type' => 'text',     'placeholder' => 'Different.'],
                        ['key' => 'description', 'label' => 'Paragraf Deskripsi',  'type' => 'textarea', 'placeholder' => 'Punya ide gila untuk brand kamu? Kami siap dengar dan wujudkan.'],
                        ['key' => 'cta_text',    'label' => 'Teks Tombol',         'type' => 'text',     'placeholder' => "LET'S CHAT →"],
                        ['key' => 'cta_url',     'label' => 'URL Tombol (WA)',     'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                        ['key' => 'bg_color',    'label' => 'Warna Background',    'type' => 'color',    'placeholder' => '#ef4444'],
                    ],
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // ABOUT
            // ════════════════════════════════════════════════════════════
            'about' => [
                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'badge_text',  'label' => 'Badge Text',    'type' => 'text',     'placeholder' => 'SIAPA KAMI'],
                        ['key' => 'title_line1', 'label' => 'Judul Baris 1', 'type' => 'text',     'placeholder' => 'WHO'],
                        ['key' => 'title_line2', 'label' => 'Judul Baris 2', 'type' => 'text',     'placeholder' => 'WE ARE.'],
                        ['key' => 'subtitle',    'label' => 'Subjudul',      'type' => 'textarea', 'placeholder' => 'Mitra terpercaya dalam komunikasi dan pemasaran digital.'],
                    ],
                ],
                'tentang' => [
                    'label'  => 'Tentang Kami',
                    'fields' => [
                        ['key' => 'title',       'label' => 'Judul',     'type' => 'text',     'placeholder' => 'Mitra Digital Terpercaya'],
                        ['key' => 'description', 'label' => 'Deskripsi', 'type' => 'textarea', 'placeholder' => 'Kami adalah mitra terpercaya...'],
                        ['key' => 'image',       'label' => 'Foto Tim',  'type' => 'image'],
                    ],
                ],
                'visi_misi' => [
                    'label'  => 'Visi & Misi',
                    'fields' => [
                        ['key' => 'vision',   'label' => 'Visi',   'type' => 'textarea', 'placeholder' => 'Menjadi agensi digital terkemuka di Indonesia.'],
                        ['key' => 'mission1', 'label' => 'Misi 1', 'type' => 'text',     'placeholder' => 'Solusi komunikasi digital inovatif.'],
                        ['key' => 'mission2', 'label' => 'Misi 2', 'type' => 'text',     'placeholder' => 'Menghubungkan brand dengan 200+ media.'],
                        ['key' => 'mission3', 'label' => 'Misi 3', 'type' => 'text',     'placeholder' => 'Memberikan hasil nyata dan terukur.'],
                    ],
                ],
                'cta' => [
                    'label'  => 'CTA / Penutup',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul CTA',   'type' => 'text', 'placeholder' => 'Siap Melejit Bersama Kami?'],
                        ['key' => 'cta_text', 'label' => 'Teks Tombol', 'type' => 'text', 'placeholder' => 'WhatsApp Sekarang'],
                        ['key' => 'cta_url',  'label' => 'URL Tombol',  'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // CONTACT
            // ════════════════════════════════════════════════════════════
            'contact' => [
                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'badge_text',  'label' => 'Badge Text',  'type' => 'text',     'placeholder' => "✦ Let's Talk Business"],
                        ['key' => 'title',       'label' => 'Judul Hero',  'type' => 'text',     'placeholder' => 'KONSULTASI GRATIS!'],
                        ['key' => 'subtitle',    'label' => 'Subjudul',    'type' => 'text',     'placeholder' => 'Ubah statement menjadi berita nasional dalam sekejap.'],
                        ['key' => 'description', 'label' => 'Deskripsi',   'type' => 'textarea', 'placeholder' => 'Siap meledakkan brand Anda di media nasional?'],
                        ['key' => 'image',       'label' => 'Gambar Hero', 'type' => 'image'],
                        ['key' => 'cta_text',    'label' => 'Teks Tombol', 'type' => 'text',     'placeholder' => 'Mulai Diskusi Sekarang →'],
                    ],
                ],
                'info' => [
                    'label'  => 'Info Kontak',
                    'fields' => [
                        ['key' => 'email',      'label' => 'Email',                  'type' => 'text',     'placeholder' => 'kontendigitalid10@gmail.com'],
                        ['key' => 'whatsapp',   'label' => 'Nomor WhatsApp',         'type' => 'text',     'placeholder' => '+62 877-8600-0919'],
                        ['key' => 'address',    'label' => 'Alamat Lengkap',         'type' => 'textarea', 'placeholder' => 'Kaligawe, RT.02, Gandekan, Bantul, DIY 55711'],
                        ['key' => 'maps_embed', 'label' => 'URL Google Maps Embed', 'type' => 'text',     'placeholder' => 'https://www.google.com/maps/embed?pb=...'],
                        ['key' => 'maps_url',   'label' => 'URL Google Maps Arah',  'type' => 'text',     'placeholder' => 'https://www.google.com/maps/dir//Kontendigital.id'],
                    ],
                ],
                'cta_bottom' => [
                    'label'  => 'Fast Response Card',
                    'fields' => [
                        ['key' => 'response_time', 'label' => 'Teks Respon',  'type' => 'text',     'placeholder' => 'RESPON < 1 JAM'],
                        ['key' => 'description',   'label' => 'Deskripsi',    'type' => 'textarea', 'placeholder' => 'Tim admin kami standby di jam kerja (09:00 - 17:00 WIB).'],
                        ['key' => 'cta_text',      'label' => 'Teks Tombol',  'type' => 'text',     'placeholder' => 'Chat Via WhatsApp Sekarang →'],
                        ['key' => 'cta_url',       'label' => 'URL Tombol',   'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // CARA ORDER
            // ════════════════════════════════════════════════════════════
            'cara-order' => [
                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'badge_text',  'label' => 'Badge Text',  'type' => 'text',     'placeholder' => '✦ Panduan Pemesanan'],
                        ['key' => 'title',       'label' => 'Judul',       'type' => 'text',     'placeholder' => 'ALUR KERJA ORDER'],
                        ['key' => 'subtitle',    'label' => 'Subjudul',    'type' => 'text',     'placeholder' => 'Proses transparan, hasil maksimal untuk pesan Anda.'],
                        ['key' => 'description', 'label' => 'Deskripsi',   'type' => 'textarea', 'placeholder' => 'Kami memastikan setiap langkah pengerjaan Press Release dilakukan secara profesional.'],
                        ['key' => 'image',       'label' => 'Gambar Hero', 'type' => 'image'],
                    ],
                ],
                'steps' => [
                    'label'  => '10 Langkah Pemesanan',
                    'fields' => [
                        ['key' => 'step_1_title',  'label' => 'Langkah 1 — Judul',  'type' => 'text',     'placeholder' => 'Konsultasi'],
                        ['key' => 'step_1_desc',   'label' => 'Langkah 1 — Desc',   'type' => 'textarea', 'placeholder' => 'Konsultasikan rencana, tujuan, dan materi press release Anda.'],
                        ['key' => 'step_2_title',  'label' => 'Langkah 2 — Judul',  'type' => 'text',     'placeholder' => 'Pilih Paket'],
                        ['key' => 'step_2_desc',   'label' => 'Langkah 2 — Desc',   'type' => 'textarea', 'placeholder' => 'Pilih paket layanan yang paling sesuai dengan target audiens dan budget Anda.'],
                        ['key' => 'step_3_title',  'label' => 'Langkah 3 — Judul',  'type' => 'text',     'placeholder' => 'Isi Form Order'],
                        ['key' => 'step_3_desc',   'label' => 'Langkah 3 — Desc',   'type' => 'textarea', 'placeholder' => 'Lengkapi data detail pemesanan melalui form praktis yang kami kirimkan via WhatsApp.'],
                        ['key' => 'step_4_title',  'label' => 'Langkah 4 — Judul',  'type' => 'text',     'placeholder' => 'Invoice'],
                        ['key' => 'step_4_desc',   'label' => 'Langkah 4 — Desc',   'type' => 'textarea', 'placeholder' => 'Kami akan mengirimkan rincian biaya resmi (invoice) setelah form order kami validasi.'],
                        ['key' => 'step_5_title',  'label' => 'Langkah 5 — Judul',  'type' => 'text',     'placeholder' => 'Pembayaran'],
                        ['key' => 'step_5_desc',   'label' => 'Langkah 5 — Desc',   'type' => 'textarea', 'placeholder' => 'Lakukan pembayaran. Pesanan Anda segera masuk antrian prioritas produksi kami.'],
                        ['key' => 'step_6_title',  'label' => 'Langkah 6 — Judul',  'type' => 'text',     'placeholder' => 'Materi Press'],
                        ['key' => 'step_6_desc',   'label' => 'Langkah 6 — Desc',   'type' => 'textarea', 'placeholder' => 'Kirimkan draf artikel Anda. Jika belum ada, tim kami siap membantu koordinasi konten.'],
                        ['key' => 'step_7_title',  'label' => 'Langkah 7 — Judul',  'type' => 'text',     'placeholder' => 'Wawancara'],
                        ['key' => 'step_7_desc',   'label' => 'Langkah 7 — Desc',   'type' => 'textarea', 'placeholder' => 'Tim kami akan melakukan penggalian data (interview) untuk menyusun naskah yang kuat.'],
                        ['key' => 'step_8_title',  'label' => 'Langkah 8 — Judul',  'type' => 'text',     'placeholder' => 'Review Klien'],
                        ['key' => 'step_8_desc',   'label' => 'Langkah 8 — Desc',   'type' => 'textarea', 'placeholder' => 'Anda mendapatkan kesempatan meninjau draf artikel sebelum benar-benar dipublikasikan.'],
                        ['key' => 'step_9_title',  'label' => 'Langkah 9 — Judul',  'type' => 'text',     'placeholder' => 'Penerbitan'],
                        ['key' => 'step_9_desc',   'label' => 'Langkah 9 — Desc',   'type' => 'textarea', 'placeholder' => 'Artikel Anda tayang di jaringan media online nasional pilihan secara serentak.'],
                        ['key' => 'step_10_title', 'label' => 'Langkah 10 — Judul', 'type' => 'text',     'placeholder' => 'Monitoring'],
                        ['key' => 'step_10_desc',  'label' => 'Langkah 10 — Desc',  'type' => 'textarea', 'placeholder' => 'Laporan lengkap berupa tautan/link berita yang tayang akan dikirimkan langsung kepada Anda.'],
                    ],
                ],
                'cta' => [
                    'label'  => 'CTA Penutup',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul CTA',   'type' => 'text', 'placeholder' => 'SIAP UNTUK GO PUBLIC?'],
                        ['key' => 'cta_text', 'label' => 'Teks Tombol', 'type' => 'text', 'placeholder' => 'Order via WhatsApp →'],
                        ['key' => 'cta_url',  'label' => 'URL Tombol',  'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // SYARAT & KETENTUAN
            // ════════════════════════════════════════════════════════════
            'syarat-ketentuan' => [
                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul',    'type' => 'text',     'placeholder' => 'SYARAT & KETENTUAN'],
                        ['key' => 'subtitle', 'label' => 'Subjudul', 'type' => 'textarea', 'placeholder' => 'Transparansi adalah kunci kenyamanan kerjasama kita.'],
                        ['key' => 'image',    'label' => 'Gambar',   'type' => 'image'],
                    ],
                ],
                'syarat_pr' => [
                    'label'  => 'Syarat Umum Press Release',
                    'fields' => [
                        ['key' => 'rule_1', 'label' => 'Syarat 1', 'type' => 'text', 'placeholder' => 'Berita yang diterbitkan wajib memiliki news value.'],
                        ['key' => 'rule_2', 'label' => 'Syarat 2', 'type' => 'text', 'placeholder' => 'Bukan berisi ajakan membeli langsung (hard selling).'],
                        ['key' => 'rule_3', 'label' => 'Syarat 3', 'type' => 'text', 'placeholder' => 'Hasil penerbitan disesuaikan oleh editor media.'],
                        ['key' => 'rule_4', 'label' => 'Syarat 4', 'type' => 'text', 'placeholder' => 'Media memiliki kewenangan penuh mengedit judul, gambar, maupun teks.'],
                        ['key' => 'rule_5', 'label' => 'Syarat 5', 'type' => 'text', 'placeholder' => 'Tidak menerima revisi setelah terbit, kecuali kesalahan fatal.'],
                        ['key' => 'rule_6', 'label' => 'Syarat 6', 'type' => 'text', 'placeholder' => 'Press release TIDAK BISA menyertakan hyperlink/backlink.'],
                        ['key' => 'rule_7', 'label' => 'Syarat 7', 'type' => 'text', 'placeholder' => 'Berita yang sudah tayang tidak bisa di-TAKE DOWN.'],
                        ['key' => 'rule_8', 'label' => 'Syarat 8', 'type' => 'text', 'placeholder' => 'Waktu penayangan diproses dalam 1-3 hari kerja.'],
                    ],
                ],
                'ketentuan_penulisan' => [
                    'label'  => 'Ketentuan Penulisan Artikel',
                    'fields' => [
                        ['key' => 'rule_1', 'label' => 'Ketentuan 1', 'type' => 'text', 'placeholder' => 'Standar penulisan jurnalistik (5W + 1H).'],
                        ['key' => 'rule_2', 'label' => 'Ketentuan 2', 'type' => 'text', 'placeholder' => 'Wajib mencantumkan narasumber yang kredibel.'],
                        ['key' => 'rule_3', 'label' => 'Ketentuan 3', 'type' => 'text', 'placeholder' => 'Panjang artikel berkisar antara 200-500 kata.'],
                        ['key' => 'rule_4', 'label' => 'Ketentuan 4', 'type' => 'text', 'placeholder' => 'Judul menarik antara 50 hingga 70 karakter.'],
                        ['key' => 'rule_5', 'label' => 'Ketentuan 5', 'type' => 'text', 'placeholder' => 'Menyiapkan 2-3 foto resolusi tinggi.'],
                        ['key' => 'rule_6', 'label' => 'Ketentuan 6', 'type' => 'text', 'placeholder' => 'Format foto wajib Landscape (tidak pecah/blur).'],
                        ['key' => 'rule_7', 'label' => 'Ketentuan 7', 'type' => 'text', 'placeholder' => 'Foto terlalu komersil akan diganti oleh redaksi.'],
                    ],
                ],
                'cta' => [
                    'label'  => 'CTA Penutup',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul CTA',   'type' => 'text', 'placeholder' => 'BUTUH BANTUAN LEBIH LANJUT?'],
                        ['key' => 'cta_text', 'label' => 'Teks Tombol', 'type' => 'text', 'placeholder' => 'HUBUNGI ADMIN SEKARANG →'],
                        ['key' => 'cta_url',  'label' => 'URL Tombol',  'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // LAYANAN: PRESS RELEASE
            // ════════════════════════════════════════════════════════════
            'layanan-press-release' => [
                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'badge_text',   'label' => 'Badge Text',                'type' => 'text',     'placeholder' => '✦ JASA PRESS RELEASE'],
                        ['key' => 'title_line1',  'label' => 'Judul Baris 1',             'type' => 'text',     'placeholder' => 'BERSAMA'],
                        ['key' => 'title_line2',  'label' => 'Judul Baris 2',             'type' => 'text',     'placeholder' => 'WARTAWAN DARI'],
                        ['key' => 'title_line3',  'label' => 'Judul Baris 3 (highlight)', 'type' => 'text',     'placeholder' => 'MEDIA TERNAMA'],
                        ['key' => 'quote',        'label' => 'Kutipan',                   'type' => 'text',     'placeholder' => 'Ubah statement menjadi berita nasional dalam sekejap.'],
                        ['key' => 'description',  'label' => 'Deskripsi',                 'type' => 'textarea', 'placeholder' => 'Selain membantu mengundang wartawan/media untuk Anda...'],
                        ['key' => 'cta_text',     'label' => 'Teks Tombol',               'type' => 'text',     'placeholder' => 'KONSULTASI SEKARANG →'],
                        ['key' => 'cta_url',      'label' => 'URL Tombol',                'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                        ['key' => 'image',        'label' => 'Gambar Hero',               'type' => 'image'],
                    ],
                ],
                'why_pr' => [
                    'label'  => 'Mengapa Harus Press Release?',
                    'fields' => [
                        ['key' => 'title',          'label' => 'Judul Section',    'type' => 'text',     'placeholder' => 'Mengapa Harus Press Release?'],
                        ['key' => 'subtitle',       'label' => 'Subjudul',         'type' => 'text',     'placeholder' => 'Press release memiliki peran penting dalam strategi pemasaran...'],
                        ['key' => 'reason_1_title', 'label' => 'Alasan 1 — Judul', 'type' => 'text',     'placeholder' => 'Sarana Promosi Bisnis yang Efektif'],
                        ['key' => 'reason_1_desc',  'label' => 'Alasan 1 — Desc',  'type' => 'textarea', 'placeholder' => 'Press release dapat menjadi sarana promosi produk dan jasa Anda.'],
                        ['key' => 'reason_2_title', 'label' => 'Alasan 2 — Judul', 'type' => 'text',     'placeholder' => 'Media Branding yang Powerfull'],
                        ['key' => 'reason_2_desc',  'label' => 'Alasan 2 — Desc',  'type' => 'textarea', 'placeholder' => 'Tampil eksklusif dan diliput banyak media besar akan membuat reputasi bisnis Anda meroket.'],
                        ['key' => 'reason_3_title', 'label' => 'Alasan 3 — Judul', 'type' => 'text',     'placeholder' => 'Memudahkan Urusan Public Relation'],
                        ['key' => 'reason_3_desc',  'label' => 'Alasan 3 — Desc',  'type' => 'textarea', 'placeholder' => 'Berbagai urusan publikasi bisnis kini bisa dilakukan dengan mudah & cepat.'],
                        ['key' => 'reason_4_title', 'label' => 'Alasan 4 — Judul', 'type' => 'text',     'placeholder' => 'Syarat Verifikasi di Media Sosial dan Marketplace'],
                        ['key' => 'reason_4_desc',  'label' => 'Alasan 4 — Desc',  'type' => 'textarea', 'placeholder' => 'Tunjukkan bahwa brand Anda populer dan pernah muncul di media-media online ternama.'],
                        ['key' => 'reason_5_title', 'label' => 'Alasan 5 — Judul', 'type' => 'text',     'placeholder' => 'Konten Iklan yang Sangat Kuat'],
                        ['key' => 'reason_5_desc',  'label' => 'Alasan 5 — Desc',  'type' => 'textarea', 'placeholder' => 'Anda bisa memaksimalkan press release yang sudah terbit sebagai konten iklan di berbagai platform.'],
                    ],
                ],
                'pricing' => [
                    'label'  => 'Paket Harga',
                    'fields' => [
                        ['key' => 'title',                'label' => 'Judul Section',           'type' => 'text', 'placeholder' => 'Paket Harga Jasa Press Release Media Online'],
                        ['key' => 'bronze_price_ori',     'label' => 'Bronze — Harga Asli',     'type' => 'text', 'placeholder' => 'Rp 3.750.000,-'],
                        ['key' => 'bronze_price',         'label' => 'Bronze — Harga Promo',    'type' => 'text', 'placeholder' => 'Rp 3.000.000'],
                        ['key' => 'bronze_media_count',   'label' => 'Bronze — Jumlah Media',   'type' => 'text', 'placeholder' => '3'],
                        ['key' => 'silver_price_ori',     'label' => 'Silver — Harga Asli',     'type' => 'text', 'placeholder' => 'Rp 5.750.000,-'],
                        ['key' => 'silver_price',         'label' => 'Silver — Harga Promo',    'type' => 'text', 'placeholder' => 'Rp 4.750.000'],
                        ['key' => 'silver_media_count',   'label' => 'Silver — Jumlah Media',   'type' => 'text', 'placeholder' => '5'],
                        ['key' => 'gold_price_ori',       'label' => 'Gold — Harga Asli',       'type' => 'text', 'placeholder' => 'Rp 11.000.000,-'],
                        ['key' => 'gold_price',           'label' => 'Gold — Harga Promo',      'type' => 'text', 'placeholder' => 'Rp 9.000.000'],
                        ['key' => 'gold_media_count',     'label' => 'Gold — Jumlah Media',     'type' => 'text', 'placeholder' => '10'],
                        ['key' => 'platinum_price_ori',   'label' => 'Platinum — Harga Asli',   'type' => 'text', 'placeholder' => 'Rp 15.750.000,-'],
                        ['key' => 'platinum_price',       'label' => 'Platinum — Harga Promo',  'type' => 'text', 'placeholder' => 'Rp 12.750.000'],
                        ['key' => 'platinum_media_count', 'label' => 'Platinum — Jumlah Media', 'type' => 'text', 'placeholder' => '15'],
                        ['key' => 'cta_url',              'label' => 'URL Tombol Konsultasi',   'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
                'cta' => [
                    'label'  => 'CTA Penutup',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul CTA',   'type' => 'text', 'placeholder' => 'SIAP UNTUK GO NATIONAL?'],
                        ['key' => 'cta_text', 'label' => 'Teks Tombol', 'type' => 'text', 'placeholder' => 'Hubungi Kami Sekarang →'],
                        ['key' => 'cta_url',  'label' => 'URL Tombol',  'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // LAYANAN: BACKLINK MEDIA  ← BARU
            // ════════════════════════════════════════════════════════════
            'layanan-backlink' => [
                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'badge_text',  'label' => 'Badge Text',                'type' => 'text',     'placeholder' => '✦ JASA BACKLINK MEDIA'],
                        ['key' => 'title_line1', 'label' => 'Judul Baris 1',             'type' => 'text',     'placeholder' => 'TINGKATKAN'],
                        ['key' => 'title_line2', 'label' => 'Judul Baris 2',             'type' => 'text',     'placeholder' => 'OTORITAS DOMAIN'],
                        ['key' => 'title_line3', 'label' => 'Judul Baris 3 (highlight)', 'type' => 'text',     'placeholder' => 'WEBSITE ANDA'],
                        ['key' => 'quote',       'label' => 'Kutipan',                   'type' => 'text',     'placeholder' => 'Backlink berkualitas dari ratusan media nasional terpercaya.'],
                        ['key' => 'description', 'label' => 'Deskripsi',                 'type' => 'textarea', 'placeholder' => 'Dapatkan backlink do-follow dari media nasional ternama untuk mendongkrak peringkat SEO website Anda secara signifikan.'],
                        ['key' => 'cta_text',    'label' => 'Teks Tombol',               'type' => 'text',     'placeholder' => 'KONSULTASI SEKARANG →'],
                        ['key' => 'cta_url',     'label' => 'URL Tombol',                'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                        ['key' => 'image',       'label' => 'Gambar Hero',               'type' => 'image'],
                    ],
                ],
                'why_backlink' => [
                    'label'  => 'Mengapa Backlink Penting?',
                    'fields' => [
                        ['key' => 'title',          'label' => 'Judul Section',    'type' => 'text',     'placeholder' => 'Mengapa Backlink Media Penting?'],
                        ['key' => 'subtitle',       'label' => 'Subjudul',         'type' => 'text',     'placeholder' => 'Backlink dari media terpercaya adalah sinyal kuat untuk Google.'],
                        ['key' => 'reason_1_title', 'label' => 'Alasan 1 — Judul', 'type' => 'text',     'placeholder' => 'Tingkatkan Domain Authority'],
                        ['key' => 'reason_1_desc',  'label' => 'Alasan 1 — Desc',  'type' => 'textarea', 'placeholder' => 'Backlink dari media nasional ber-DA tinggi akan mendongkrak otoritas domain website Anda.'],
                        ['key' => 'reason_2_title', 'label' => 'Alasan 2 — Judul', 'type' => 'text',     'placeholder' => 'Naikkan Peringkat Google'],
                        ['key' => 'reason_2_desc',  'label' => 'Alasan 2 — Desc',  'type' => 'textarea', 'placeholder' => 'Semakin banyak backlink berkualitas, semakin tinggi posisi website Anda di halaman hasil pencarian Google.'],
                        ['key' => 'reason_3_title', 'label' => 'Alasan 3 — Judul', 'type' => 'text',     'placeholder' => 'Tambah Traffic Organik'],
                        ['key' => 'reason_3_desc',  'label' => 'Alasan 3 — Desc',  'type' => 'textarea', 'placeholder' => 'Pengunjung dari media besar yang mengklik backlink Anda adalah traffic organik berkualitas tinggi.'],
                        ['key' => 'reason_4_title', 'label' => 'Alasan 4 — Judul', 'type' => 'text',     'placeholder' => 'Bangun Kepercayaan Brand'],
                        ['key' => 'reason_4_desc',  'label' => 'Alasan 4 — Desc',  'type' => 'textarea', 'placeholder' => 'Disebut dan di-link oleh media ternama secara otomatis meningkatkan kredibilitas dan kepercayaan brand Anda.'],
                        ['key' => 'reason_5_title', 'label' => 'Alasan 5 — Judul', 'type' => 'text',     'placeholder' => 'Hasil Jangka Panjang'],
                        ['key' => 'reason_5_desc',  'label' => 'Alasan 5 — Desc',  'type' => 'textarea', 'placeholder' => 'Backlink dari media online bersifat permanen, memberikan manfaat SEO yang terus bekerja dalam jangka panjang.'],
                    ],
                ],
                'pricing' => [
                    'label'  => 'Paket Harga',
                    'fields' => [
                        ['key' => 'title',              'label' => 'Judul Section',         'type' => 'text', 'placeholder' => 'Paket Harga Jasa Backlink Media Nasional'],
                        ['key' => 'starter_price_ori',  'label' => 'Starter — Harga Asli',  'type' => 'text', 'placeholder' => 'Rp 500.000,-'],
                        ['key' => 'starter_price',      'label' => 'Starter — Harga Promo', 'type' => 'text', 'placeholder' => 'Rp 350.000'],
                        ['key' => 'starter_count',      'label' => 'Starter — Jumlah Link', 'type' => 'text', 'placeholder' => '1'],
                        ['key' => 'basic_price_ori',    'label' => 'Basic — Harga Asli',    'type' => 'text', 'placeholder' => 'Rp 2.250.000,-'],
                        ['key' => 'basic_price',        'label' => 'Basic — Harga Promo',   'type' => 'text', 'placeholder' => 'Rp 1.750.000'],
                        ['key' => 'basic_count',        'label' => 'Basic — Jumlah Link',   'type' => 'text', 'placeholder' => '5'],
                        ['key' => 'pro_price_ori',      'label' => 'Pro — Harga Asli',      'type' => 'text', 'placeholder' => 'Rp 4.000.000,-'],
                        ['key' => 'pro_price',          'label' => 'Pro — Harga Promo',     'type' => 'text', 'placeholder' => 'Rp 3.250.000'],
                        ['key' => 'pro_count',          'label' => 'Pro — Jumlah Link',     'type' => 'text', 'placeholder' => '10'],
                        ['key' => 'enterprise_price_ori','label'=> 'Enterprise — Harga Asli','type'=> 'text', 'placeholder' => 'Rp 7.500.000,-'],
                        ['key' => 'enterprise_price',   'label' => 'Enterprise — Harga Promo','type'=> 'text','placeholder' => 'Rp 6.000.000'],
                        ['key' => 'enterprise_count',   'label' => 'Enterprise — Jumlah Link','type'=> 'text','placeholder' => '20'],
                        ['key' => 'cta_url',            'label' => 'URL Tombol Konsultasi', 'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
                'cta' => [
                    'label'  => 'CTA Penutup',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul CTA',   'type' => 'text', 'placeholder' => 'SIAP BOOST SEO WEBSITE KAMU?'],
                        ['key' => 'cta_text', 'label' => 'Teks Tombol', 'type' => 'text', 'placeholder' => 'Hubungi Kami Sekarang →'],
                        ['key' => 'cta_url',  'label' => 'URL Tombol',  'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // LAYANAN: PRESS CONFERENCE  ← BARU
            // ════════════════════════════════════════════════════════════
            'layanan-press-conference' => [
                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'badge_text',  'label' => 'Badge Text',                'type' => 'text',     'placeholder' => '✦ JASA PRESS CONFERENCE'],
                        ['key' => 'title_line1', 'label' => 'Judul Baris 1',             'type' => 'text',     'placeholder' => 'KONFERENSI PERS'],
                        ['key' => 'title_line2', 'label' => 'Judul Baris 2',             'type' => 'text',     'placeholder' => 'PROFESIONAL &'],
                        ['key' => 'title_line3', 'label' => 'Judul Baris 3 (highlight)', 'type' => 'text',     'placeholder' => 'BERGARANSI MEDIA'],
                        ['key' => 'quote',       'label' => 'Kutipan',                   'type' => 'text',     'placeholder' => 'Hadirkan wartawan media ternama ke acara brand Anda.'],
                        ['key' => 'description', 'label' => 'Deskripsi',                 'type' => 'textarea', 'placeholder' => 'Kami mengelola seluruh proses konferensi pers Anda, mulai dari undangan media hingga distribusi siaran pers pasca acara.'],
                        ['key' => 'cta_text',    'label' => 'Teks Tombol',               'type' => 'text',     'placeholder' => 'KONSULTASI SEKARANG →'],
                        ['key' => 'cta_url',     'label' => 'URL Tombol',                'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                        ['key' => 'image',       'label' => 'Gambar Hero',               'type' => 'image'],
                    ],
                ],
                'why_pc' => [
                    'label'  => 'Mengapa Butuh Press Conference?',
                    'fields' => [
                        ['key' => 'title',          'label' => 'Judul Section',    'type' => 'text',     'placeholder' => 'Mengapa Harus Press Conference?'],
                        ['key' => 'subtitle',       'label' => 'Subjudul',         'type' => 'text',     'placeholder' => 'Press conference adalah cara paling efektif menyampaikan pesan brand ke media sekaligus.'],
                        ['key' => 'reason_1_title', 'label' => 'Alasan 1 — Judul', 'type' => 'text',     'placeholder' => 'Liputan Media Serentak'],
                        ['key' => 'reason_1_desc',  'label' => 'Alasan 1 — Desc',  'type' => 'textarea', 'placeholder' => 'Satu event, ratusan media meliput secara bersamaan. Efisiensi maksimal untuk jangkauan pemberitaan yang luas.'],
                        ['key' => 'reason_2_title', 'label' => 'Alasan 2 — Judul', 'type' => 'text',     'placeholder' => 'Bangun Citra Brand yang Kuat'],
                        ['key' => 'reason_2_desc',  'label' => 'Alasan 2 — Desc',  'type' => 'textarea', 'placeholder' => 'Kehadiran media di event Anda memperkuat persepsi publik bahwa brand Anda terpercaya dan berpengaruh.'],
                        ['key' => 'reason_3_title', 'label' => 'Alasan 3 — Judul', 'type' => 'text',     'placeholder' => 'Sampaikan Pesan Secara Langsung'],
                        ['key' => 'reason_3_desc',  'label' => 'Alasan 3 — Desc',  'type' => 'textarea', 'placeholder' => 'Narasumber Anda bisa menjawab pertanyaan media secara langsung, menghindari miskomunikasi dan kesalahan informasi.'],
                        ['key' => 'reason_4_title', 'label' => 'Alasan 4 — Judul', 'type' => 'text',     'placeholder' => 'Cocok untuk Berbagai Momen'],
                        ['key' => 'reason_4_desc',  'label' => 'Alasan 4 — Desc',  'type' => 'textarea', 'placeholder' => 'Peluncuran produk, pencapaian perusahaan, klarifikasi isu, atau penandatanganan kerjasama — semua bisa dikemas dalam press conference.'],
                        ['key' => 'reason_5_title', 'label' => 'Alasan 5 — Judul', 'type' => 'text',     'placeholder' => 'Kami Tangani dari A sampai Z'],
                        ['key' => 'reason_5_desc',  'label' => 'Alasan 5 — Desc',  'type' => 'textarea', 'placeholder' => 'Undangan media, siaran pers, distribusi berita pasca acara — semua kami kelola agar Anda fokus pada konten.'],
                    ],
                ],
                'pricing' => [
                    'label'  => 'Paket Harga',
                    'fields' => [
                        ['key' => 'title',             'label' => 'Judul Section',          'type' => 'text', 'placeholder' => 'Paket Harga Jasa Press Conference'],
                        ['key' => 'basic_price_ori',   'label' => 'Basic — Harga Asli',     'type' => 'text', 'placeholder' => 'Rp 5.000.000,-'],
                        ['key' => 'basic_price',       'label' => 'Basic — Harga Promo',    'type' => 'text', 'placeholder' => 'Rp 4.000.000'],
                        ['key' => 'basic_media_count', 'label' => 'Basic — Jumlah Media',   'type' => 'text', 'placeholder' => '10'],
                        ['key' => 'pro_price_ori',     'label' => 'Pro — Harga Asli',       'type' => 'text', 'placeholder' => 'Rp 10.000.000,-'],
                        ['key' => 'pro_price',         'label' => 'Pro — Harga Promo',      'type' => 'text', 'placeholder' => 'Rp 8.500.000'],
                        ['key' => 'pro_media_count',   'label' => 'Pro — Jumlah Media',     'type' => 'text', 'placeholder' => '25'],
                        ['key' => 'vip_price_ori',     'label' => 'VIP — Harga Asli',       'type' => 'text', 'placeholder' => 'Rp 20.000.000,-'],
                        ['key' => 'vip_price',         'label' => 'VIP — Harga Promo',      'type' => 'text', 'placeholder' => 'Rp 17.000.000'],
                        ['key' => 'vip_media_count',   'label' => 'VIP — Jumlah Media',     'type' => 'text', 'placeholder' => '50'],
                        ['key' => 'cta_url',           'label' => 'URL Tombol Konsultasi',  'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
                'cta' => [
                    'label'  => 'CTA Penutup',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul CTA',   'type' => 'text', 'placeholder' => 'SIAP GELAR PRESS CONFERENCE?'],
                        ['key' => 'cta_text', 'label' => 'Teks Tombol', 'type' => 'text', 'placeholder' => 'Hubungi Kami Sekarang →'],
                        ['key' => 'cta_url',  'label' => 'URL Tombol',  'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // LAYANAN: PENULISAN ARTIKEL  ← BARU
            // ════════════════════════════════════════════════════════════
            'layanan-penulisan-artikel' => [
                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'badge_text',  'label' => 'Badge Text',                'type' => 'text',     'placeholder' => '✦ JASA PENULISAN ARTIKEL'],
                        ['key' => 'title_line1', 'label' => 'Judul Baris 1',             'type' => 'text',     'placeholder' => 'KONTEN ARTIKEL'],
                        ['key' => 'title_line2', 'label' => 'Judul Baris 2',             'type' => 'text',     'placeholder' => 'BERKUALITAS &'],
                        ['key' => 'title_line3', 'label' => 'Judul Baris 3 (highlight)', 'type' => 'text',     'placeholder' => 'SEO FRIENDLY'],
                        ['key' => 'quote',       'label' => 'Kutipan',                   'type' => 'text',     'placeholder' => 'Artikel yang menarik pembaca sekaligus disukai Google.'],
                        ['key' => 'description', 'label' => 'Deskripsi',                 'type' => 'textarea', 'placeholder' => 'Tim penulis berpengalaman kami siap menghasilkan artikel informatif, engaging, dan teroptimasi untuk kebutuhan website, blog, maupun media Anda.'],
                        ['key' => 'cta_text',    'label' => 'Teks Tombol',               'type' => 'text',     'placeholder' => 'KONSULTASI SEKARANG →'],
                        ['key' => 'cta_url',     'label' => 'URL Tombol',                'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                        ['key' => 'image',       'label' => 'Gambar Hero',               'type' => 'image'],
                    ],
                ],
                'why_artikel' => [
                    'label'  => 'Mengapa Butuh Jasa Penulisan Artikel?',
                    'fields' => [
                        ['key' => 'title',          'label' => 'Judul Section',    'type' => 'text',     'placeholder' => 'Mengapa Harus Jasa Penulisan Artikel?'],
                        ['key' => 'subtitle',       'label' => 'Subjudul',         'type' => 'text',     'placeholder' => 'Konten artikel yang baik adalah investasi jangka panjang untuk traffic organik.'],
                        ['key' => 'reason_1_title', 'label' => 'Alasan 1 — Judul', 'type' => 'text',     'placeholder' => 'Hemat Waktu & Tenaga'],
                        ['key' => 'reason_1_desc',  'label' => 'Alasan 1 — Desc',  'type' => 'textarea', 'placeholder' => 'Serahkan penulisan kepada ahlinya. Anda fokus mengelola bisnis, kami tangani kontennya.'],
                        ['key' => 'reason_2_title', 'label' => 'Alasan 2 — Judul', 'type' => 'text',     'placeholder' => 'Artikel SEO Teroptimasi'],
                        ['key' => 'reason_2_desc',  'label' => 'Alasan 2 — Desc',  'type' => 'textarea', 'placeholder' => 'Setiap artikel ditulis dengan riset kata kunci yang tepat agar mudah ditemukan di mesin pencari.'],
                        ['key' => 'reason_3_title', 'label' => 'Alasan 3 — Judul', 'type' => 'text',     'placeholder' => 'Gaya Penulisan Sesuai Brand'],
                        ['key' => 'reason_3_desc',  'label' => 'Alasan 3 — Desc',  'type' => 'textarea', 'placeholder' => 'Kami menyesuaikan tone of voice dan gaya penulisan dengan identitas brand Anda.'],
                        ['key' => 'reason_4_title', 'label' => 'Alasan 4 — Judul', 'type' => 'text',     'placeholder' => 'Konten Orisinal & Anti Plagiat'],
                        ['key' => 'reason_4_desc',  'label' => 'Alasan 4 — Desc',  'type' => 'textarea', 'placeholder' => 'Setiap artikel ditulis dari nol, 100% original, dan melalui pengecekan plagiarisme sebelum diserahkan.'],
                        ['key' => 'reason_5_title', 'label' => 'Alasan 5 — Judul', 'type' => 'text',     'placeholder' => 'Berbagai Jenis Artikel'],
                        ['key' => 'reason_5_desc',  'label' => 'Alasan 5 — Desc',  'type' => 'textarea', 'placeholder' => 'Artikel blog, advertorial, listicle, how-to, berita, ulasan produk — semua bisa kami kerjakan.'],
                    ],
                ],
                'pricing' => [
                    'label'  => 'Paket Harga',
                    'fields' => [
                        ['key' => 'title',            'label' => 'Judul Section',          'type' => 'text', 'placeholder' => 'Paket Harga Jasa Penulisan Artikel'],
                        ['key' => 'basic_price_ori',  'label' => 'Basic — Harga Asli',     'type' => 'text', 'placeholder' => 'Rp 100.000,-'],
                        ['key' => 'basic_price',      'label' => 'Basic — Harga Promo',    'type' => 'text', 'placeholder' => 'Rp 75.000'],
                        ['key' => 'basic_words',      'label' => 'Basic — Jumlah Kata',    'type' => 'text', 'placeholder' => '500'],
                        ['key' => 'standard_price_ori','label'=> 'Standard — Harga Asli',  'type' => 'text', 'placeholder' => 'Rp 200.000,-'],
                        ['key' => 'standard_price',   'label' => 'Standard — Harga Promo', 'type' => 'text', 'placeholder' => 'Rp 150.000'],
                        ['key' => 'standard_words',   'label' => 'Standard — Jumlah Kata', 'type' => 'text', 'placeholder' => '1000'],
                        ['key' => 'pro_price_ori',    'label' => 'Pro — Harga Asli',       'type' => 'text', 'placeholder' => 'Rp 350.000,-'],
                        ['key' => 'pro_price',        'label' => 'Pro — Harga Promo',      'type' => 'text', 'placeholder' => 'Rp 275.000'],
                        ['key' => 'pro_words',        'label' => 'Pro — Jumlah Kata',      'type' => 'text', 'placeholder' => '2000'],
                        ['key' => 'cta_url',          'label' => 'URL Tombol Konsultasi',  'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
                'cta' => [
                    'label'  => 'CTA Penutup',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul CTA',   'type' => 'text', 'placeholder' => 'SIAP PUNYA KONTEN BERKUALITAS?'],
                        ['key' => 'cta_text', 'label' => 'Teks Tombol', 'type' => 'text', 'placeholder' => 'Pesan Artikel Sekarang →'],
                        ['key' => 'cta_url',  'label' => 'URL Tombol',  'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // LAYANAN: SCRIPT VIDEO  ← BARU
            // ════════════════════════════════════════════════════════════
            'layanan-script-video' => [
                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'badge_text',  'label' => 'Badge Text',                'type' => 'text',     'placeholder' => '✦ JASA PENULISAN SCRIPT VIDEO'],
                        ['key' => 'title_line1', 'label' => 'Judul Baris 1',             'type' => 'text',     'placeholder' => 'SCRIPT VIDEO'],
                        ['key' => 'title_line2', 'label' => 'Judul Baris 2',             'type' => 'text',     'placeholder' => 'YANG MEMIKAT &'],
                        ['key' => 'title_line3', 'label' => 'Judul Baris 3 (highlight)', 'type' => 'text',     'placeholder' => 'KONVERSI TINGGI'],
                        ['key' => 'quote',       'label' => 'Kutipan',                   'type' => 'text',     'placeholder' => 'Dari ide menjadi naskah yang siap produksi.'],
                        ['key' => 'description', 'label' => 'Deskripsi',                 'type' => 'textarea', 'placeholder' => 'Kami merancang naskah video yang engaging, sesuai target audiens Anda, dan siap langsung digunakan untuk produksi iklan, konten sosial media, atau video korporat.'],
                        ['key' => 'cta_text',    'label' => 'Teks Tombol',               'type' => 'text',     'placeholder' => 'KONSULTASI SEKARANG →'],
                        ['key' => 'cta_url',     'label' => 'URL Tombol',                'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                        ['key' => 'image',       'label' => 'Gambar Hero',               'type' => 'image'],
                    ],
                ],
                'why_script' => [
                    'label'  => 'Mengapa Butuh Jasa Script Video?',
                    'fields' => [
                        ['key' => 'title',          'label' => 'Judul Section',    'type' => 'text',     'placeholder' => 'Mengapa Harus Jasa Script Video?'],
                        ['key' => 'subtitle',       'label' => 'Subjudul',         'type' => 'text',     'placeholder' => 'Script yang baik adalah pondasi video yang sukses.'],
                        ['key' => 'reason_1_title', 'label' => 'Alasan 1 — Judul', 'type' => 'text',     'placeholder' => 'Hemat Biaya Produksi'],
                        ['key' => 'reason_1_desc',  'label' => 'Alasan 1 — Desc',  'type' => 'textarea', 'placeholder' => 'Script yang matang mengurangi risiko reshooting dan revisi produksi yang memakan waktu dan biaya.'],
                        ['key' => 'reason_2_title', 'label' => 'Alasan 2 — Judul', 'type' => 'text',     'placeholder' => 'Pesan Tersampaikan dengan Tepat'],
                        ['key' => 'reason_2_desc',  'label' => 'Alasan 2 — Desc',  'type' => 'textarea', 'placeholder' => 'Kami memastikan setiap kata dalam script membawa pesan brand Anda secara jelas dan persuasif.'],
                        ['key' => 'reason_3_title', 'label' => 'Alasan 3 — Judul', 'type' => 'text',     'placeholder' => 'Sesuai Platform & Durasi'],
                        ['key' => 'reason_3_desc',  'label' => 'Alasan 3 — Desc',  'type' => 'textarea', 'placeholder' => 'Script disesuaikan untuk YouTube, Instagram Reels, TikTok, iklan TV, atau video korporat dengan durasi yang tepat.'],
                        ['key' => 'reason_4_title', 'label' => 'Alasan 4 — Judul', 'type' => 'text',     'placeholder' => 'Storytelling yang Kuat'],
                        ['key' => 'reason_4_desc',  'label' => 'Alasan 4 — Desc',  'type' => 'textarea', 'placeholder' => 'Kami membangun narasi yang emosional dan relevan agar penonton terhubung dengan brand Anda.'],
                        ['key' => 'reason_5_title', 'label' => 'Alasan 5 — Judul', 'type' => 'text',     'placeholder' => 'Revisi Hingga Puas'],
                        ['key' => 'reason_5_desc',  'label' => 'Alasan 5 — Desc',  'type' => 'textarea', 'placeholder' => 'Kami menyediakan revisi terbatas hingga script benar-benar sesuai dengan visi dan kebutuhan Anda.'],
                    ],
                ],
                'pricing' => [
                    'label'  => 'Paket Harga',
                    'fields' => [
                        ['key' => 'title',            'label' => 'Judul Section',          'type' => 'text', 'placeholder' => 'Paket Harga Jasa Penulisan Script Video'],
                        ['key' => 'short_price_ori',  'label' => 'Short — Harga Asli',     'type' => 'text', 'placeholder' => 'Rp 300.000,-'],
                        ['key' => 'short_price',      'label' => 'Short — Harga Promo',    'type' => 'text', 'placeholder' => 'Rp 250.000'],
                        ['key' => 'short_duration',   'label' => 'Short — Durasi Video',   'type' => 'text', 'placeholder' => '< 1 Menit'],
                        ['key' => 'medium_price_ori', 'label' => 'Medium — Harga Asli',    'type' => 'text', 'placeholder' => 'Rp 600.000,-'],
                        ['key' => 'medium_price',     'label' => 'Medium — Harga Promo',   'type' => 'text', 'placeholder' => 'Rp 500.000'],
                        ['key' => 'medium_duration',  'label' => 'Medium — Durasi Video',  'type' => 'text', 'placeholder' => '1 - 3 Menit'],
                        ['key' => 'long_price_ori',   'label' => 'Long — Harga Asli',      'type' => 'text', 'placeholder' => 'Rp 1.200.000,-'],
                        ['key' => 'long_price',       'label' => 'Long — Harga Promo',     'type' => 'text', 'placeholder' => 'Rp 1.000.000'],
                        ['key' => 'long_duration',    'label' => 'Long — Durasi Video',    'type' => 'text', 'placeholder' => '3 - 10 Menit'],
                        ['key' => 'cta_url',          'label' => 'URL Tombol Konsultasi',  'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
                'cta' => [
                    'label'  => 'CTA Penutup',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul CTA',   'type' => 'text', 'placeholder' => 'SIAP BIKIN VIDEO YANG VIRAL?'],
                        ['key' => 'cta_text', 'label' => 'Teks Tombol', 'type' => 'text', 'placeholder' => 'Pesan Script Sekarang →'],
                        ['key' => 'cta_url',  'label' => 'URL Tombol',  'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // LAYANAN: PELATIHAN KONTEN  ← BARU
            // ════════════════════════════════════════════════════════════
            'layanan-pelatihan-konten' => [
                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'badge_text',  'label' => 'Badge Text',                'type' => 'text',     'placeholder' => '✦ JASA PELATIHAN KONTEN KREATOR'],
                        ['key' => 'title_line1', 'label' => 'Judul Baris 1',             'type' => 'text',     'placeholder' => 'JADILAH KONTEN'],
                        ['key' => 'title_line2', 'label' => 'Judul Baris 2',             'type' => 'text',     'placeholder' => 'KREATOR YANG'],
                        ['key' => 'title_line3', 'label' => 'Judul Baris 3 (highlight)', 'type' => 'text',     'placeholder' => 'BERDAMPAK'],
                        ['key' => 'quote',       'label' => 'Kutipan',                   'type' => 'text',     'placeholder' => 'Kuasai skill konten digital dari praktisi berpengalaman.'],
                        ['key' => 'description', 'label' => 'Deskripsi',                 'type' => 'textarea', 'placeholder' => 'Program pelatihan intensif yang dirancang untuk individu, tim, maupun korporat yang ingin menguasai dunia konten digital secara strategis dan terukur.'],
                        ['key' => 'cta_text',    'label' => 'Teks Tombol',               'type' => 'text',     'placeholder' => 'DAFTAR SEKARANG →'],
                        ['key' => 'cta_url',     'label' => 'URL Tombol',                'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                        ['key' => 'image',       'label' => 'Gambar Hero',               'type' => 'image'],
                    ],
                ],
                'why_pelatihan' => [
                    'label'  => 'Mengapa Ikut Pelatihan Ini?',
                    'fields' => [
                        ['key' => 'title',          'label' => 'Judul Section',    'type' => 'text',     'placeholder' => 'Mengapa Harus Ikut Pelatihan Konten?'],
                        ['key' => 'subtitle',       'label' => 'Subjudul',         'type' => 'text',     'placeholder' => 'Di era digital, skill membuat konten yang baik adalah aset berharga.'],
                        ['key' => 'reason_1_title', 'label' => 'Alasan 1 — Judul', 'type' => 'text',     'placeholder' => 'Kurikulum Berbasis Praktik'],
                        ['key' => 'reason_1_desc',  'label' => 'Alasan 1 — Desc',  'type' => 'textarea', 'placeholder' => 'Materi dirancang langsung oleh praktisi industri dengan pendekatan hands-on, bukan sekadar teori.'],
                        ['key' => 'reason_2_title', 'label' => 'Alasan 2 — Judul', 'type' => 'text',     'placeholder' => 'Cocok untuk Semua Level'],
                        ['key' => 'reason_2_desc',  'label' => 'Alasan 2 — Desc',  'type' => 'textarea', 'placeholder' => 'Baik pemula yang baru mulai atau profesional yang ingin upgrade skill, program kami tersedia untuk semua tingkatan.'],
                        ['key' => 'reason_3_title', 'label' => 'Alasan 3 — Judul', 'type' => 'text',     'placeholder' => 'Sertifikat Resmi'],
                        ['key' => 'reason_3_desc',  'label' => 'Alasan 3 — Desc',  'type' => 'textarea', 'placeholder' => 'Peserta mendapatkan sertifikat pelatihan yang dapat digunakan sebagai portofolio profesional.'],
                        ['key' => 'reason_4_title', 'label' => 'Alasan 4 — Judul', 'type' => 'text',     'placeholder' => 'Online & Offline Tersedia'],
                        ['key' => 'reason_4_desc',  'label' => 'Alasan 4 — Desc',  'type' => 'textarea', 'placeholder' => 'Pilih format yang paling nyaman — pelatihan online via Zoom atau offline di lokasi yang bisa disesuaikan.'],
                        ['key' => 'reason_5_title', 'label' => 'Alasan 5 — Judul', 'type' => 'text',     'placeholder' => 'Mentoring Pasca Pelatihan'],
                        ['key' => 'reason_5_desc',  'label' => 'Alasan 5 — Desc',  'type' => 'textarea', 'placeholder' => 'Kami tidak berhenti di kelas. Peserta mendapat akses mentoring lanjutan untuk membantu penerapan di lapangan.'],
                    ],
                ],
                'materi' => [
                    'label'  => 'Materi Pelatihan',
                    'fields' => [
                        ['key' => 'title',      'label' => 'Judul Section',    'type' => 'text',     'placeholder' => 'Apa yang Akan Kamu Pelajari?'],
                        ['key' => 'materi_1',   'label' => 'Materi 1',         'type' => 'text',     'placeholder' => 'Dasar-dasar Content Marketing'],
                        ['key' => 'materi_2',   'label' => 'Materi 2',         'type' => 'text',     'placeholder' => 'Riset Keyword & SEO On-Page'],
                        ['key' => 'materi_3',   'label' => 'Materi 3',         'type' => 'text',     'placeholder' => 'Strategi Konten Media Sosial'],
                        ['key' => 'materi_4',   'label' => 'Materi 4',         'type' => 'text',     'placeholder' => 'Penulisan Copywriting yang Menjual'],
                        ['key' => 'materi_5',   'label' => 'Materi 5',         'type' => 'text',     'placeholder' => 'Produksi Konten Video Pendek'],
                        ['key' => 'materi_6',   'label' => 'Materi 6',         'type' => 'text',     'placeholder' => 'Analitik & Pengukuran Performa Konten'],
                        ['key' => 'materi_7',   'label' => 'Materi 7',         'type' => 'text',     'placeholder' => 'Personal Branding untuk Kreator'],
                        ['key' => 'materi_8',   'label' => 'Materi 8',         'type' => 'text',     'placeholder' => 'Monetisasi Konten Digital'],
                    ],
                ],
                'pricing' => [
                    'label'  => 'Paket Harga',
                    'fields' => [
                        ['key' => 'title',              'label' => 'Judul Section',            'type' => 'text',     'placeholder' => 'Paket Harga Pelatihan Konten Kreator'],
                        ['key' => 'personal_price_ori', 'label' => 'Personal — Harga Asli',    'type' => 'text',     'placeholder' => 'Rp 1.500.000,-'],
                        ['key' => 'personal_price',     'label' => 'Personal — Harga Promo',   'type' => 'text',     'placeholder' => 'Rp 1.200.000'],
                        ['key' => 'personal_desc',      'label' => 'Personal — Deskripsi',     'type' => 'textarea', 'placeholder' => 'Untuk individu, 1 hari pelatihan online, sertifikat digital.'],
                        ['key' => 'group_price_ori',    'label' => 'Group — Harga Asli',       'type' => 'text',     'placeholder' => 'Rp 800.000,-'],
                        ['key' => 'group_price',        'label' => 'Group — Harga Promo',      'type' => 'text',     'placeholder' => 'Rp 650.000'],
                        ['key' => 'group_desc',         'label' => 'Group — Deskripsi',        'type' => 'textarea', 'placeholder' => 'Per orang min. 5 peserta, 1 hari pelatihan online, sertifikat digital.'],
                        ['key' => 'corporate_price_ori','label' => 'Corporate — Harga Asli',   'type' => 'text',     'placeholder' => 'Hubungi Kami'],
                        ['key' => 'corporate_price',    'label' => 'Corporate — Harga Promo',  'type' => 'text',     'placeholder' => 'Custom'],
                        ['key' => 'corporate_desc',     'label' => 'Corporate — Deskripsi',    'type' => 'textarea', 'placeholder' => 'Untuk perusahaan/instansi, kurikulum custom, offline/online, sertifikat resmi.'],
                        ['key' => 'cta_url',            'label' => 'URL Tombol Konsultasi',    'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
                'cta' => [
                    'label'  => 'CTA Penutup',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul CTA',   'type' => 'text', 'placeholder' => 'SIAP JADI KONTEN KREATOR PROFESIONAL?'],
                        ['key' => 'cta_text', 'label' => 'Teks Tombol', 'type' => 'text', 'placeholder' => 'Daftar Pelatihan Sekarang →'],
                        ['key' => 'cta_url',  'label' => 'URL Tombol',  'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // FOOTER
            // ════════════════════════════════════════════════════════════
            'footer' => [
                'main' => [
                    'label'  => 'Footer — Konten Utama',
                    'fields' => [
                        ['key' => 'headline_1',  'label' => 'Headline Baris 1',          'type' => 'text',     'placeholder' => 'Bersama Kami,'],
                        ['key' => 'headline_2',  'label' => 'Headline Baris 2 (kuning)', 'type' => 'text',     'placeholder' => 'Raih Kesuksesan'],
                        ['key' => 'headline_3',  'label' => 'Headline Baris 3',          'type' => 'text',     'placeholder' => 'di Era Digital'],
                        ['key' => 'description', 'label' => 'Paragraf Deskripsi',        'type' => 'textarea', 'placeholder' => 'Bergabunglah dengan ratusan klien yang puas...'],
                        ['key' => 'copyright',   'label' => 'Teks Copyright',            'type' => 'text',     'placeholder' => '© 2025 HNP Communications.id — ALL RIGHTS RESERVED'],
                    ],
                ],
                'contact' => [
                    'label'  => 'Footer — Kontak & WhatsApp',
                    'fields' => [
                        ['key' => 'wa1_number', 'label' => 'WA Hotline 1 — Nomor', 'type' => 'text', 'placeholder' => '6287786000919'],
                        ['key' => 'wa1_label',  'label' => 'WA Hotline 1 — Tampil','type' => 'text', 'placeholder' => '+62 877-8600-0919'],
                        ['key' => 'wa2_number', 'label' => 'WA Hotline 2 — Nomor', 'type' => 'text', 'placeholder' => '628121967610'],
                        ['key' => 'wa2_label',  'label' => 'WA Hotline 2 — Tampil','type' => 'text', 'placeholder' => '+62 812-1967-610'],
                    ],
                ],
                'social' => [
                    'label'  => 'Footer — Social Media',
                    'fields' => [
                        ['key' => 'instagram', 'label' => 'Link Instagram', 'type' => 'text', 'placeholder' => 'https://instagram.com/hnpcommunications'],
                        ['key' => 'facebook',  'label' => 'Link Facebook',  'type' => 'text', 'placeholder' => 'https://facebook.com/hnpcommunications'],
                        ['key' => 'youtube',   'label' => 'Link YouTube',   'type' => 'text', 'placeholder' => 'https://youtube.com/@hnpcommunications'],
                        ['key' => 'tiktok',    'label' => 'Link TikTok',    'type' => 'text', 'placeholder' => 'https://tiktok.com/@hnpcommunications'],
                    ],
                ],
            ],

        ];
    }

    public function getFields(): array
    {
        return static::schema()[$this->page][$this->section_key]['fields'] ?? [];
    }
}