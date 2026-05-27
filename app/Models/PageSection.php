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
 
    // ── Scopes ──────────────────────────────────────────────────────
 
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
 
    // ── Relationships ────────────────────────────────────────────────
 
    public function histories()
    {
        return $this->hasMany(PageSectionHistory::class);
    }
 
    // ── Helpers ─────────────────────────────────────────────────────
 
    /**
     * Ambil nilai dari content (tanpa cek hidden).
     * Dipakai di admin edit form.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return data_get($this->content, $key, $default);
    }
 
    /**
     * Cek apakah field ini di-hidden oleh admin.
     */
    public function isFieldHidden(string $key): bool
    {
        return in_array($key, $this->hidden_fields ?? []);
    }
 
    /**
     * Ambil nilai field untuk FRONTEND.
     * Return NULL (bukan $default) jika field di-hidden,
     * supaya blade bisa bedain "hidden" vs "kosong tapi tampil".
     *
     * Gunakan FIELD_HIDDEN sentinel agar blade bisa cek eksplisit.
     */
    public const FIELD_HIDDEN = '__HIDDEN__';
 
    public function getField(string $key, mixed $default = null): mixed
    {
        if ($this->isFieldHidden($key)) {
            return self::FIELD_HIDDEN;
        }
        return data_get($this->content, $key, $default);
    }
 
    /**
     * Helper: cek apakah nilai yang dikembalikan getField() adalah hidden.
     */
    public static function isHiddenValue(mixed $value): bool
    {
        return $value === self::FIELD_HIDDEN;
    }
 
    public static function ofPage(string $page): \Illuminate\Support\Collection
    {
        return static::forPage($page)
            ->active()
            ->ordered()
            ->get()
            ->keyBy('section_key');
    }
 
    // ── Helpers ─────────────────────────────────────────────────────

    public function getFields(): array
    {
        return static::schema()[$this->page][$this->section_key]['fields'] ?? [];
    }

    // ── Schema ───────────────────────────────────────────────────────

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
                'materi_publikasi' => [
                    'label'  => 'Materi Publikasi — Checklist',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul Section',               'type' => 'text', 'placeholder' => 'Pilih Materi Publikasi Sesuai Kebutuhan Anda!'],
                        ['key' => 'item_1',   'label' => 'Checklist Item 1',            'type' => 'text', 'placeholder' => 'Promosi launching/peluncuran bisnis atau brand'],
                        ['key' => 'item_2',   'label' => 'Checklist Item 2',            'type' => 'text', 'placeholder' => 'Kegiatan sosial atau kemasyarakatan'],
                        ['key' => 'item_3',   'label' => 'Checklist Item 3',            'type' => 'text', 'placeholder' => 'Memperkenalkan produk atau jasa baru'],
                        ['key' => 'item_4',   'label' => 'Checklist Item 4',            'type' => 'text', 'placeholder' => 'Promosi perusahaan, event, seminar, kegiatan kampus, dll'],
                        ['key' => 'item_5',   'label' => 'Checklist Item 5',            'type' => 'text', 'placeholder' => 'Siaran pers perusahaan / korporat'],
                        ['key' => 'item_6',   'label' => 'Checklist Item 6',            'type' => 'text', 'placeholder' => 'Peningkatan brand awareness & reputasi'],
                        ['key' => 'item_7',   'label' => 'Checklist Item 7 (opsional)', 'type' => 'text', 'placeholder' => ''],
                        ['key' => 'item_8',   'label' => 'Checklist Item 8 (opsional)', 'type' => 'text', 'placeholder' => ''],
                        ['key' => 'bg_image', 'label' => 'Gambar Background (opsional)','type' => 'image'],
                    ],
                ],
                'target_audience' => [
                    'label'  => 'Target Audience — Siapa Target Anda?',
                    'fields' => [
                        ['key' => 'title',          'label' => 'Judul Section',           'type' => 'text',     'placeholder' => 'SIAPA TARGET ANDA?'],
                        ['key' => 'subtitle',       'label' => 'Subjudul',                'type' => 'text',     'placeholder' => 'PILIH KATEGORI UNTUK MULAI EKSPANSI'],
                        ['key' => 'target_1_badge', 'label' => 'Kartu 1 — Badge',         'type' => 'text',     'placeholder' => 'P01'],
                        ['key' => 'target_1_title', 'label' => 'Kartu 1 — Judul',         'type' => 'text',     'placeholder' => 'Brand & UMKM'],
                        ['key' => 'target_1_desc',  'label' => 'Kartu 1 — Deskripsi',     'type' => 'textarea', 'placeholder' => 'Tingkatkan konversi customer dengan validasi berita dari media terpercaya.'],
                        ['key' => 'target_1_color', 'label' => 'Kartu 1 — Warna Aksen',  'type' => 'text',     'placeholder' => 'bg-cyan-300'],
                        ['key' => 'target_2_badge', 'label' => 'Kartu 2 — Badge',         'type' => 'text',     'placeholder' => 'P02'],
                        ['key' => 'target_2_title', 'label' => 'Kartu 2 — Judul',         'type' => 'text',     'placeholder' => 'Profesional'],
                        ['key' => 'target_2_desc',  'label' => 'Kartu 2 — Deskripsi',     'type' => 'textarea', 'placeholder' => 'Bangun personal branding kuat dan tingkatkan elektabilitas di mata publik.'],
                        ['key' => 'target_2_color', 'label' => 'Kartu 2 — Warna Aksen',  'type' => 'text',     'placeholder' => 'bg-yellow-300'],
                        ['key' => 'target_3_badge', 'label' => 'Kartu 3 — Badge',         'type' => 'text',     'placeholder' => 'P03'],
                        ['key' => 'target_3_title', 'label' => 'Kartu 3 — Judul',         'type' => 'text',     'placeholder' => 'Influencer'],
                        ['key' => 'target_3_desc',  'label' => 'Kartu 3 — Deskripsi',     'type' => 'textarea', 'placeholder' => 'Naikkan kelas endorsement Anda dengan label "Diliput Media Nasional".'],
                        ['key' => 'target_3_color', 'label' => 'Kartu 3 — Warna Aksen',  'type' => 'text',     'placeholder' => 'bg-rose-300'],
                        ['key' => 'target_4_badge', 'label' => 'Kartu 4 — Badge',         'type' => 'text',     'placeholder' => 'P04'],
                        ['key' => 'target_4_title', 'label' => 'Kartu 4 — Judul',         'type' => 'text',     'placeholder' => 'Komunitas'],
                        ['key' => 'target_4_desc',  'label' => 'Kartu 4 — Deskripsi',     'type' => 'textarea', 'placeholder' => 'Dapatkan kepercayaan maksimal untuk menarik ribuan anggota baru ke institusi Anda.'],
                        ['key' => 'target_4_color', 'label' => 'Kartu 4 — Warna Aksen',  'type' => 'text',     'placeholder' => 'bg-lime-300'],
                    ],
                ],
                'keunggulan' => [
                    'label'  => 'Keunggulan — Mengapa Klien Memilih Kami?',
                    'fields' => [
                        ['key' => 'title',        'label' => 'Judul Baris 1',             'type' => 'text',     'placeholder' => 'MENGAPA KLIEN'],
                        ['key' => 'title_line2',  'label' => 'Judul Baris 2 (highlight)', 'type' => 'text',     'placeholder' => 'MEMILIH KAMI?'],
                        ['key' => 'bg_color',     'label' => 'Warna Background Section',  'type' => 'color',    'placeholder' => '#22d3ee'],
                        ['key' => 'item_1_title', 'label' => 'Item 1 — Judul',            'type' => 'text',     'placeholder' => 'Proses Cepat'],
                        ['key' => 'item_1_desc',  'label' => 'Item 1 — Deskripsi',        'type' => 'textarea', 'placeholder' => 'Tim profesional kami memastikan rilis Anda diproses dalam hitungan jam, bukan hari.'],
                        ['key' => 'item_1_color', 'label' => 'Item 1 — Warna Kartu',     'type' => 'text',     'placeholder' => 'bg-white'],
                        ['key' => 'item_2_title', 'label' => 'Item 2 — Judul',            'type' => 'text',     'placeholder' => 'Garansi 100%'],
                        ['key' => 'item_2_desc',  'label' => 'Item 2 — Deskripsi',        'type' => 'textarea', 'placeholder' => 'Jaminan tayang atau uang kembali 100% jika rilis tidak lolos kebijakan redaksi.'],
                        ['key' => 'item_2_color', 'label' => 'Item 2 — Warna Kartu',     'type' => 'text',     'placeholder' => 'bg-yellow-400'],
                        ['key' => 'item_3_title', 'label' => 'Item 3 — Judul',            'type' => 'text',     'placeholder' => 'Revisi Unlimited'],
                        ['key' => 'item_3_desc',  'label' => 'Item 3 — Deskripsi',        'type' => 'textarea', 'placeholder' => 'Kepuasan Anda prioritas. Kami berikan revisi tanpa batas hingga narasi sempurna.'],
                        ['key' => 'item_3_color', 'label' => 'Item 3 — Warna Kartu',     'type' => 'text',     'placeholder' => 'bg-purple-500'],
                        ['key' => 'item_4_title', 'label' => 'Item 4 — Judul',            'type' => 'text',     'placeholder' => 'Admin Responsif'],
                        ['key' => 'item_4_desc',  'label' => 'Item 4 — Deskripsi',        'type' => 'textarea', 'placeholder' => 'Konsultasi gratis kapan saja. Admin kami stand-by untuk menjawab setiap pertanyaan.'],
                        ['key' => 'item_4_color', 'label' => 'Item 4 — Warna Kartu',     'type' => 'text',     'placeholder' => 'bg-rose-400'],
                        ['key' => 'item_5_title', 'label' => 'Item 5 — Judul',            'type' => 'text',     'placeholder' => 'Biaya Kompetitif'],
                        ['key' => 'item_5_desc',  'label' => 'Item 5 — Deskripsi',        'type' => 'textarea', 'placeholder' => 'Harga paling masuk akal di kelasnya tanpa menurunkan standar kualitas publikasi.'],
                        ['key' => 'item_5_color', 'label' => 'Item 5 — Warna Kartu',     'type' => 'text',     'placeholder' => 'bg-green-400'],
                        ['key' => 'item_6_title', 'label' => 'Item 6 — Judul',            'type' => 'text',     'placeholder' => '200+ Media'],
                        ['key' => 'item_6_desc',  'label' => 'Item 6 — Deskripsi',        'type' => 'textarea', 'placeholder' => 'Akses ke jaringan media nasional terbesar mulai dari portal berita hingga koran cetak.'],
                        ['key' => 'item_6_color', 'label' => 'Item 6 — Warna Kartu',     'type' => 'text',     'placeholder' => 'bg-orange-400'],
                        ['key' => 'item_7_title', 'label' => 'Item 7 — Judul',            'type' => 'text',     'placeholder' => 'Gratis Penulisan'],
                        ['key' => 'item_7_desc',  'label' => 'Item 7 — Deskripsi',        'type' => 'textarea', 'placeholder' => 'Belum ada draft? Tim editor kami buatkan artikel rilis profesional secara gratis.'],
                        ['key' => 'item_7_color', 'label' => 'Item 7 — Warna Kartu',     'type' => 'text',     'placeholder' => 'bg-indigo-400'],
                        ['key' => 'item_8_title', 'label' => 'Item 8 — Judul',            'type' => 'text',     'placeholder' => 'Bonus Media'],
                        ['key' => 'item_8_desc',  'label' => 'Item 8 — Deskripsi',        'type' => 'textarea', 'placeholder' => 'Setiap pembelian paket tertentu, dapatkan ekstra publikasi di media mitra kami.'],
                        ['key' => 'item_8_color', 'label' => 'Item 8 — Warna Kartu',     'type' => 'text',     'placeholder' => 'bg-white'],
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
                'media_partner' => [
                    'label'  => 'Media Partner — Strip Logo Mitra',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul Strip',   'type' => 'text',  'placeholder' => '100+ MITRA.'],
                        ['key' => 'subtitle', 'label' => 'Subjudul',      'type' => 'text',  'placeholder' => 'Terpercaya di Seluruh Indonesia'],
                        ['key' => 'logo_1',   'label' => 'Logo Mitra 1',  'type' => 'image'],
                        ['key' => 'logo_2',   'label' => 'Logo Mitra 2',  'type' => 'image'],
                        ['key' => 'logo_3',   'label' => 'Logo Mitra 3',  'type' => 'image'],
                        ['key' => 'logo_4',   'label' => 'Logo Mitra 4',  'type' => 'image'],
                        ['key' => 'logo_5',   'label' => 'Logo Mitra 5',  'type' => 'image'],
                        ['key' => 'logo_6',   'label' => 'Logo Mitra 6',  'type' => 'image'],
                        ['key' => 'logo_7',   'label' => 'Logo Mitra 7',  'type' => 'image'],
                        ['key' => 'logo_8',   'label' => 'Logo Mitra 8',  'type' => 'image'],
                        ['key' => 'logo_9',   'label' => 'Logo Mitra 9',  'type' => 'image'],
                        ['key' => 'logo_10',  'label' => 'Logo Mitra 10', 'type' => 'image'],
                        ['key' => 'logo_11',  'label' => 'Logo Mitra 11', 'type' => 'image'],
                        ['key' => 'logo_12',  'label' => 'Logo Mitra 12', 'type' => 'image'],
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
            // LAYANAN: BACKLINK MEDIA
            // ════════════════════════════════════════════════════════════
            'layanan-backlink' => [

                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'badge_text',  'label' => 'Badge Text',   'type' => 'text',     'placeholder' => '✦ JASA BACKLINK MEDIA NASIONAL'],
                        ['key' => 'title',       'label' => 'Judul Hero',   'type' => 'text',     'placeholder' => 'BACKLINK'],
                        ['key' => 'description', 'label' => 'Deskripsi',    'type' => 'textarea', 'placeholder' => 'Mitra terpercaya dalam komunikasi dan pemasaran digital yang mudah, murah, cepat, dan terjamin kualitasnya.'],
                        ['key' => 'cta_text',    'label' => 'Teks Tombol',  'type' => 'text',     'placeholder' => 'KONSULTASI SEKARANG'],
                        ['key' => 'cta_url',     'label' => 'URL Tombol',   'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],

                'benefits' => [
                    'label'  => 'Manfaat Backlink Media Nasional',
                    'fields' => [
                        ['key' => 'title',           'label' => 'Judul Section',      'type' => 'text',     'placeholder' => 'MANFAAT BACKLINK MEDIA NASIONAL'],
                        ['key' => 'subtitle',        'label' => 'Subjudul',           'type' => 'text',     'placeholder' => 'Backlink media nasional memiliki beberapa manfaat sebagai berikut:'],
                        ['key' => 'benefit_1_title', 'label' => 'Manfaat 1 — Judul', 'type' => 'text',     'placeholder' => 'Meningkatkan Jumlah Pengunjung (Visitor)'],
                        ['key' => 'benefit_1_desc',  'label' => 'Manfaat 1 — Desc',  'type' => 'textarea', 'placeholder' => 'Backlink dapat meningkatkan visibilitas di kalangan audiens yang lebih luas.'],
                        ['key' => 'benefit_2_title', 'label' => 'Manfaat 2 — Judul', 'type' => 'text',     'placeholder' => 'Memudahkan Google Menemukan Website Anda'],
                        ['key' => 'benefit_2_desc',  'label' => 'Manfaat 2 — Desc',  'type' => 'textarea', 'placeholder' => 'Memudahkan mesin pencarian Google dalam menemukan website yang Anda miliki.'],
                        ['key' => 'benefit_3_title', 'label' => 'Manfaat 3 — Judul', 'type' => 'text',     'placeholder' => 'Meningkatkan Authority Website'],
                        ['key' => 'benefit_3_desc',  'label' => 'Manfaat 3 — Desc',  'type' => 'textarea', 'placeholder' => 'Meningkatkan reputasi yang tinggi dan dianggap sebagai sumber berita terpercaya.'],
                    ],
                ],

                'what_is' => [
                    'label'  => 'Apa Itu Backlink?',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul (baris 1)',  'type' => 'text',     'placeholder' => 'APA ITU'],
                        ['key' => 'subtitle', 'label' => 'Sub-label kecil',  'type' => 'text',     'placeholder' => 'Media Nasional Expertise'],
                        ['key' => 'point_1',  'label' => 'Poin 01',          'type' => 'textarea', 'placeholder' => 'Tautan atau hyperlink strategis yang ditempatkan pada portal berita raksasa di Indonesia.'],
                        ['key' => 'point_2',  'label' => 'Poin 02',          'type' => 'textarea', 'placeholder' => 'Senjata utama untuk memicu algoritma Google agar mengenali website Anda sebagai Otoritas Tinggi.'],
                        ['key' => 'image',    'label' => 'Gambar Ilustrasi', 'type' => 'image'],
                    ],
                ],

                'why_us' => [
                    'label'  => 'Mengapa Klien Memilih Kami?',
                    'fields' => [
                        ['key' => 'title',         'label' => 'Judul Section',        'type' => 'text',     'placeholder' => 'MENGAPA KLIEN MEMILIH JASA HNP COMMUNICATIONS.ID?'],
                        ['key' => 'reason_1',      'label' => 'Keunggulan 1 — Judul', 'type' => 'text',     'placeholder' => 'Proses Cepat dan Mudah'],
                        ['key' => 'reason_1_desc', 'label' => 'Keunggulan 1 — Desc',  'type' => 'textarea', 'placeholder' => 'Tim kami berpengalaman dan profesional sehingga prosesnya bisa dilakukan dengan cepat.'],
                        ['key' => 'reason_2',      'label' => 'Keunggulan 2 — Judul', 'type' => 'text',     'placeholder' => 'Garansi 100% Tayang'],
                        ['key' => 'reason_2_desc', 'label' => 'Keunggulan 2 — Desc',  'type' => 'textarea', 'placeholder' => 'Garansi tayang di media online, jika tidak bisa tayang kami berikan alternatif media atau full refund.'],
                        ['key' => 'reason_3',      'label' => 'Keunggulan 3 — Judul', 'type' => 'text',     'placeholder' => 'Revisi Sepuasnya'],
                        ['key' => 'reason_3_desc', 'label' => 'Keunggulan 3 — Desc',  'type' => 'textarea', 'placeholder' => 'Kami memberikan garansi revisi sepuasnya, terutama dalam penulisan artikel jika ada kesalahan dari kami.'],
                        ['key' => 'reason_4',      'label' => 'Keunggulan 4 — Judul', 'type' => 'text',     'placeholder' => 'Biaya Murah & Kompetitif'],
                        ['key' => 'reason_4_desc', 'label' => 'Keunggulan 4 — Desc',  'type' => 'textarea', 'placeholder' => 'Memberikan harga yang super murah tanpa mengorbankan kualitas press release Anda.'],
                        ['key' => 'reason_5',      'label' => 'Keunggulan 5 — Judul', 'type' => 'text',     'placeholder' => 'Banyak Pilihan Media (200+)'],
                        ['key' => 'reason_5_desc', 'label' => 'Keunggulan 5 — Desc',  'type' => 'textarea', 'placeholder' => 'Memiliki lebih dari 200 list media sehingga Anda bisa memilih media sesuai kebutuhan.'],
                        ['key' => 'reason_6',      'label' => 'Keunggulan 6 — Judul', 'type' => 'text',     'placeholder' => 'Gratis Penulisan Draft Artikel'],
                        ['key' => 'reason_6_desc', 'label' => 'Keunggulan 6 — Desc',  'type' => 'textarea', 'placeholder' => 'Jika Anda belum memiliki artikel, kami akan membuatkan draft artikel tanpa biaya tambahan.'],
                    ],
                ],

                'cta' => [
                    'label'  => 'CTA Penutup',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul CTA',   'type' => 'text', 'placeholder' => 'SIAP UNTUK GO NATIONAL?'],
                        ['key' => 'cta_text', 'label' => 'Teks Tombol', 'type' => 'text', 'placeholder' => 'HUBUNGI KAMI SEKARANG →'],
                        ['key' => 'cta_url',  'label' => 'URL Tombol',  'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],

            ],

            // ════════════════════════════════════════════════════════════
            // LAYANAN: PRESS CONFERENCE
            // ════════════════════════════════════════════════════════════
            'layanan-press-conference' => [
                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'badge_text',   'label' => 'Badge Text',                'type' => 'text',     'placeholder' => '✦ JASA PRESS CONFERENCE'],
                        ['key' => 'title_line1',  'label' => 'Judul Baris 1',             'type' => 'text',     'placeholder' => 'KONFERENSI PERS'],
                        ['key' => 'title_line2',  'label' => 'Judul Baris 2',             'type' => 'text',     'placeholder' => 'PROFESIONAL &'],
                        ['key' => 'title_line3',  'label' => 'Judul Baris 3 (highlight)', 'type' => 'text',     'placeholder' => 'BERGARANSI MEDIA'],
                        ['key' => 'quote',        'label' => 'Kutipan',                   'type' => 'text',     'placeholder' => 'Hadirkan wartawan media ternama ke acara brand Anda.'],
                        ['key' => 'description',  'label' => 'Deskripsi',                 'type' => 'textarea', 'placeholder' => 'Kami mengelola seluruh proses konferensi pers Anda, mulai dari undangan media hingga distribusi siaran pers pasca acara.'],
                        ['key' => 'cta_text',     'label' => 'Teks Tombol',               'type' => 'text',     'placeholder' => 'KONSULTASI SEKARANG →'],
                        ['key' => 'cta_url',      'label' => 'URL Tombol',                'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                        ['key' => 'image',        'label' => 'Gambar Hero',               'type' => 'image'],
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
                        ['key' => 'reason_4_desc',  'label' => 'Alasan 4 — Desc',  'type' => 'textarea', 'placeholder' => 'Peluncuran produk, pencapaian perusahaan, klarifikasi isu — semua bisa dikemas dalam press conference.'],
                        ['key' => 'reason_5_title', 'label' => 'Alasan 5 — Judul', 'type' => 'text',     'placeholder' => 'Kami Tangani dari A sampai Z'],
                        ['key' => 'reason_5_desc',  'label' => 'Alasan 5 — Desc',  'type' => 'textarea', 'placeholder' => 'Undangan media, siaran pers, distribusi berita pasca acara — semua kami kelola agar Anda fokus pada konten.'],
                    ],
                ],
                'materi_publikasi' => [
                    'label'  => 'Materi Publikasi — Checklist',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul Section',               'type' => 'text', 'placeholder' => 'Pilih Materi Press Conference Sesuai Kebutuhan Anda!'],
                        ['key' => 'item_1',   'label' => 'Checklist Item 1',            'type' => 'text', 'placeholder' => 'Statement / pengumuman resmi perusahaan'],
                        ['key' => 'item_2',   'label' => 'Checklist Item 2',            'type' => 'text', 'placeholder' => 'Launching produk atau brand baru'],
                        ['key' => 'item_3',   'label' => 'Checklist Item 3',            'type' => 'text', 'placeholder' => 'Kegiatan sosial atau kemasyarakatan'],
                        ['key' => 'item_4',   'label' => 'Checklist Item 4',            'type' => 'text', 'placeholder' => 'Promosi perusahaan, event, seminar, kegiatan kampus'],
                        ['key' => 'item_5',   'label' => 'Checklist Item 5',            'type' => 'text', 'placeholder' => 'Pengumuman laporan keuangan korporat'],
                        ['key' => 'item_6',   'label' => 'Checklist Item 6',            'type' => 'text', 'placeholder' => 'Pengumuman kebijakan baru pemerintahan'],
                        ['key' => 'item_7',   'label' => 'Checklist Item 7 (opsional)', 'type' => 'text', 'placeholder' => ''],
                        ['key' => 'item_8',   'label' => 'Checklist Item 8 (opsional)', 'type' => 'text', 'placeholder' => ''],
                        ['key' => 'bg_image', 'label' => 'Gambar Background (opsional)','type' => 'image'],
                    ],
                ],
                'target_audience' => [
                    'label'  => 'Target Audience — Siapa Target Anda?',
                    'fields' => [
                        ['key' => 'title',          'label' => 'Judul Section',    'type' => 'text',     'placeholder' => 'SIAPA TARGET ANDA?'],
                        ['key' => 'subtitle',       'label' => 'Subjudul',         'type' => 'text',     'placeholder' => 'PILIH KATEGORI UNTUK MULAI EKSPANSI'],
                        ['key' => 'target_1_badge', 'label' => 'Kartu 1 — Badge', 'type' => 'text',     'placeholder' => 'P01'],
                        ['key' => 'target_1_title', 'label' => 'Kartu 1 — Judul', 'type' => 'text',     'placeholder' => 'Perusahaan & Korporat'],
                        ['key' => 'target_1_desc',  'label' => 'Kartu 1 — Desk',  'type' => 'textarea', 'placeholder' => 'Sampaikan pengumuman resmi dan bangun citra profesional melalui liputan media terpercaya.'],
                        ['key' => 'target_1_color', 'label' => 'Kartu 1 — Warna', 'type' => 'text',     'placeholder' => 'bg-cyan-300'],
                        ['key' => 'target_2_badge', 'label' => 'Kartu 2 — Badge', 'type' => 'text',     'placeholder' => 'P02'],
                        ['key' => 'target_2_title', 'label' => 'Kartu 2 — Judul', 'type' => 'text',     'placeholder' => 'Brand & UMKM'],
                        ['key' => 'target_2_desc',  'label' => 'Kartu 2 — Desk',  'type' => 'textarea', 'placeholder' => 'Perkenalkan produk atau brand baru ke publik luas dengan jangkauan media yang maksimal.'],
                        ['key' => 'target_2_color', 'label' => 'Kartu 2 — Warna', 'type' => 'text',     'placeholder' => 'bg-yellow-300'],
                        ['key' => 'target_3_badge', 'label' => 'Kartu 3 — Badge', 'type' => 'text',     'placeholder' => 'P03'],
                        ['key' => 'target_3_title', 'label' => 'Kartu 3 — Judul', 'type' => 'text',     'placeholder' => 'Instansi Pemerintah'],
                        ['key' => 'target_3_desc',  'label' => 'Kartu 3 — Desk',  'type' => 'textarea', 'placeholder' => 'Komunikasikan kebijakan dan program pemerintah secara transparan kepada masyarakat.'],
                        ['key' => 'target_3_color', 'label' => 'Kartu 3 — Warna', 'type' => 'text',     'placeholder' => 'bg-rose-300'],
                        ['key' => 'target_4_badge', 'label' => 'Kartu 4 — Badge', 'type' => 'text',     'placeholder' => 'P04'],
                        ['key' => 'target_4_title', 'label' => 'Kartu 4 — Judul', 'type' => 'text',     'placeholder' => 'Komunitas & Organisasi'],
                        ['key' => 'target_4_desc',  'label' => 'Kartu 4 — Desk',  'type' => 'textarea', 'placeholder' => 'Tingkatkan visibilitas kegiatan sosial dan kemasyarakatan melalui liputan media nasional.'],
                        ['key' => 'target_4_color', 'label' => 'Kartu 4 — Warna', 'type' => 'text',     'placeholder' => 'bg-lime-300'],
                    ],
                ],
                'keunggulan' => [
                    'label'  => 'Keunggulan — Mengapa Klien Memilih Kami?',
                    'fields' => [
                        ['key' => 'title',        'label' => 'Judul Baris 1',             'type' => 'text',     'placeholder' => 'MENGAPA KLIEN'],
                        ['key' => 'title_line2',  'label' => 'Judul Baris 2 (highlight)', 'type' => 'text',     'placeholder' => 'MEMILIH KAMI?'],
                        ['key' => 'bg_color',     'label' => 'Warna Background Section',  'type' => 'color',    'placeholder' => '#22d3ee'],
                        ['key' => 'item_1_title', 'label' => 'Item 1 — Judul',            'type' => 'text',     'placeholder' => 'Proses Cepat'],
                        ['key' => 'item_1_desc',  'label' => 'Item 1 — Deskripsi',        'type' => 'textarea', 'placeholder' => 'Tim profesional kami memastikan persiapan press conference Anda berjalan lancar dan tepat waktu.'],
                        ['key' => 'item_1_color', 'label' => 'Item 1 — Warna Kartu',     'type' => 'text',     'placeholder' => 'bg-white'],
                        ['key' => 'item_2_title', 'label' => 'Item 2 — Judul',            'type' => 'text',     'placeholder' => 'Garansi 100%'],
                        ['key' => 'item_2_desc',  'label' => 'Item 2 — Deskripsi',        'type' => 'textarea', 'placeholder' => 'Jaminan kehadiran media atau uang kembali 100% jika target jumlah media tidak terpenuhi.'],
                        ['key' => 'item_2_color', 'label' => 'Item 2 — Warna Kartu',     'type' => 'text',     'placeholder' => 'bg-yellow-400'],
                        ['key' => 'item_3_title', 'label' => 'Item 3 — Judul',            'type' => 'text',     'placeholder' => 'Jaringan Media Luas'],
                        ['key' => 'item_3_desc',  'label' => 'Item 3 — Deskripsi',        'type' => 'textarea', 'placeholder' => 'Akses ke jaringan wartawan dari 200+ media nasional dan regional yang siap meliput event Anda.'],
                        ['key' => 'item_3_color', 'label' => 'Item 3 — Warna Kartu',     'type' => 'text',     'placeholder' => 'bg-purple-500'],
                        ['key' => 'item_4_title', 'label' => 'Item 4 — Judul',            'type' => 'text',     'placeholder' => 'Admin Responsif'],
                        ['key' => 'item_4_desc',  'label' => 'Item 4 — Deskripsi',        'type' => 'textarea', 'placeholder' => 'Konsultasi gratis kapan saja. Admin kami stand-by untuk menjawab setiap pertanyaan.'],
                        ['key' => 'item_4_color', 'label' => 'Item 4 — Warna Kartu',     'type' => 'text',     'placeholder' => 'bg-rose-400'],
                        ['key' => 'item_5_title', 'label' => 'Item 5 — Judul',            'type' => 'text',     'placeholder' => 'Biaya Kompetitif'],
                        ['key' => 'item_5_desc',  'label' => 'Item 5 — Deskripsi',        'type' => 'textarea', 'placeholder' => 'Harga paling masuk akal di kelasnya tanpa menurunkan standar kualitas peliputan.'],
                        ['key' => 'item_5_color', 'label' => 'Item 5 — Warna Kartu',     'type' => 'text',     'placeholder' => 'bg-green-400'],
                        ['key' => 'item_6_title', 'label' => 'Item 6 — Judul',            'type' => 'text',     'placeholder' => 'Press Release Termasuk'],
                        ['key' => 'item_6_desc',  'label' => 'Item 6 — Deskripsi',        'type' => 'textarea', 'placeholder' => 'Setiap paket sudah termasuk pembuatan dan distribusi press release ke jaringan media.'],
                        ['key' => 'item_6_color', 'label' => 'Item 6 — Warna Kartu',     'type' => 'text',     'placeholder' => 'bg-orange-400'],
                        ['key' => 'item_7_title', 'label' => 'Item 7 — Judul',            'type' => 'text',     'placeholder' => 'Media Monitoring'],
                        ['key' => 'item_7_desc',  'label' => 'Item 7 — Deskripsi',        'type' => 'textarea', 'placeholder' => 'Kami follow up penayangan berita dan kirimkan laporan lengkap berupa URL tautan ke klien.'],
                        ['key' => 'item_7_color', 'label' => 'Item 7 — Warna Kartu',     'type' => 'text',     'placeholder' => 'bg-indigo-400'],
                        ['key' => 'item_8_title', 'label' => 'Item 8 — Judul',            'type' => 'text',     'placeholder' => 'Konsultasi Strategi'],
                        ['key' => 'item_8_desc',  'label' => 'Item 8 — Deskripsi',        'type' => 'textarea', 'placeholder' => 'Tim kami siap memberikan konsultasi strategi media agar pesan brand Anda tersampaikan optimal.'],
                        ['key' => 'item_8_color', 'label' => 'Item 8 — Warna Kartu',     'type' => 'text',     'placeholder' => 'bg-white'],
                    ],
                ],
                'pricing' => [
                    'label'  => 'Paket Harga',
                    'fields' => [
                        ['key' => 'title',             'label' => 'Judul Section',         'type' => 'text', 'placeholder' => 'Paket Harga Jasa Press Conference'],
                        ['key' => 'basic_price_ori',   'label' => 'Basic — Harga Asli',    'type' => 'text', 'placeholder' => 'Rp 5.000.000,-'],
                        ['key' => 'basic_price',       'label' => 'Basic — Harga Promo',   'type' => 'text', 'placeholder' => 'Rp 4.000.000'],
                        ['key' => 'basic_media_count', 'label' => 'Basic — Jumlah Media',  'type' => 'text', 'placeholder' => '10'],
                        ['key' => 'pro_price_ori',     'label' => 'Pro — Harga Asli',      'type' => 'text', 'placeholder' => 'Rp 10.000.000,-'],
                        ['key' => 'pro_price',         'label' => 'Pro — Harga Promo',     'type' => 'text', 'placeholder' => 'Rp 8.500.000'],
                        ['key' => 'pro_media_count',   'label' => 'Pro — Jumlah Media',    'type' => 'text', 'placeholder' => '25'],
                        ['key' => 'vip_price_ori',     'label' => 'VIP — Harga Asli',      'type' => 'text', 'placeholder' => 'Rp 20.000.000,-'],
                        ['key' => 'vip_price',         'label' => 'VIP — Harga Promo',     'type' => 'text', 'placeholder' => 'Rp 17.000.000'],
                        ['key' => 'vip_media_count',   'label' => 'VIP — Jumlah Media',    'type' => 'text', 'placeholder' => '50'],
                        ['key' => 'cta_url',           'label' => 'URL Tombol Konsultasi', 'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
                'media_partner' => [
                    'label'  => 'Media Partner — Strip Logo Mitra',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul Strip',   'type' => 'text',  'placeholder' => '100+ MITRA.'],
                        ['key' => 'subtitle', 'label' => 'Subjudul',      'type' => 'text',  'placeholder' => 'Terpercaya di Seluruh Indonesia'],
                        ['key' => 'logo_1',   'label' => 'Logo Mitra 1',  'type' => 'image'],
                        ['key' => 'logo_2',   'label' => 'Logo Mitra 2',  'type' => 'image'],
                        ['key' => 'logo_3',   'label' => 'Logo Mitra 3',  'type' => 'image'],
                        ['key' => 'logo_4',   'label' => 'Logo Mitra 4',  'type' => 'image'],
                        ['key' => 'logo_5',   'label' => 'Logo Mitra 5',  'type' => 'image'],
                        ['key' => 'logo_6',   'label' => 'Logo Mitra 6',  'type' => 'image'],
                        ['key' => 'logo_7',   'label' => 'Logo Mitra 7',  'type' => 'image'],
                        ['key' => 'logo_8',   'label' => 'Logo Mitra 8',  'type' => 'image'],
                        ['key' => 'logo_9',   'label' => 'Logo Mitra 9',  'type' => 'image'],
                        ['key' => 'logo_10',  'label' => 'Logo Mitra 10', 'type' => 'image'],
                        ['key' => 'logo_11',  'label' => 'Logo Mitra 11', 'type' => 'image'],
                        ['key' => 'logo_12',  'label' => 'Logo Mitra 12', 'type' => 'image'],
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
            // LAYANAN: PENULISAN ARTIKEL
            // ════════════════════════════════════════════════════════════
            'layanan-penulisan-artikel' => [

                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'badge_text',  'label' => 'Badge Text',                'type' => 'text',     'placeholder' => '✦ JASA PENULISAN ARTIKEL'],
                        ['key' => 'title_line1', 'label' => 'Judul Baris 1',             'type' => 'text',     'placeholder' => 'KONTEN ARTIKEL'],
                        ['key' => 'title_line2', 'label' => 'Judul Baris 2',             'type' => 'text',     'placeholder' => 'BERKUALITAS &'],
                        ['key' => 'title_line3', 'label' => 'Judul Baris 3 (highlight)', 'type' => 'text',     'placeholder' => 'SEO FRIENDLY'],
                        ['key' => 'quote',       'label' => 'Kutipan (dalam tanda petik)','type' => 'text',     'placeholder' => 'Artikel yang menarik pembaca sekaligus disukai Google.'],
                        ['key' => 'description', 'label' => 'Deskripsi Paragraf',        'type' => 'textarea', 'placeholder' => 'Tim penulis berpengalaman kami siap menghasilkan artikel informatif, engaging, dan teroptimasi untuk kebutuhan website, blog, maupun media Anda.'],
                        ['key' => 'cta_text',    'label' => 'Teks Tombol CTA',           'type' => 'text',     'placeholder' => 'KONSULTASI SEKARANG →'],
                        ['key' => 'cta_url',     'label' => 'URL Tombol CTA',            'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                        ['key' => 'image',       'label' => 'Gambar Hero (maskot)',       'type' => 'image'],
                    ],
                ],

                'problems' => [
                    'label'  => 'Masalah yang Kami Selesaikan',
                    'fields' => [
                        ['key' => 'title',     'label' => 'Judul Section',         'type' => 'text',  'placeholder' => 'Apakah Anda Mengalami Hal Ini?'],
                        ['key' => 'image',     'label' => 'Gambar Ilustrasi',      'type' => 'image'],
                        ['key' => 'problem_1', 'label' => 'Problem Item 1',        'type' => 'text',  'placeholder' => 'Tidak tahu cara riset kata kunci'],
                        ['key' => 'problem_2', 'label' => 'Problem Item 2',        'type' => 'text',  'placeholder' => 'Harga jasa penulisan artikel sangat mahal'],
                        ['key' => 'problem_3', 'label' => 'Problem Item 3',        'type' => 'text',  'placeholder' => 'Butuh banyak artikel dalam waktu cepat'],
                        ['key' => 'problem_4', 'label' => 'Problem Item 4',        'type' => 'text',  'placeholder' => 'Trauma dengan jasa penulis asal-asalan'],
                        ['key' => 'problem_5', 'label' => 'Problem Item 5',        'type' => 'text',  'placeholder' => 'Tidak punya waktu untuk konsisten posting'],
                        ['key' => 'problem_6', 'label' => 'Problem Item 6 (opt.)', 'type' => 'text',  'placeholder' => ''],
                        ['key' => 'problem_7', 'label' => 'Problem Item 7 (opt.)', 'type' => 'text',  'placeholder' => ''],
                        ['key' => 'problem_8', 'label' => 'Problem Item 8 (opt.)', 'type' => 'text',  'placeholder' => ''],
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

                'topics' => [
                    'label'  => 'Topik Penulisan',
                    'fields' => [
                        ['key' => 'title',   'label' => 'Judul Section',    'type' => 'text',  'placeholder' => 'Topik Penulisan'],
                        ['key' => 'subtitle','label' => 'Subjudul',         'type' => 'text',  'placeholder' => 'Kami Menguasai Berbagai Niche Industri:'],
                        ['key' => 'image',   'label' => 'Gambar Ilustrasi', 'type' => 'image'],
                        ['key' => 'topic_1', 'label' => 'Topik 1',         'type' => 'text',  'placeholder' => 'Teknologi'],
                        ['key' => 'topic_2', 'label' => 'Topik 2',         'type' => 'text',  'placeholder' => 'Kesehatan'],
                        ['key' => 'topic_3', 'label' => 'Topik 3',         'type' => 'text',  'placeholder' => 'Parenting'],
                        ['key' => 'topic_4', 'label' => 'Topik 4',         'type' => 'text',  'placeholder' => 'Pendidikan'],
                        ['key' => 'topic_5', 'label' => 'Topik 5',         'type' => 'text',  'placeholder' => 'Travel'],
                        ['key' => 'topic_6', 'label' => 'Topik 6',         'type' => 'text',  'placeholder' => 'Otomotif'],
                        ['key' => 'topic_7', 'label' => 'Topik 7',         'type' => 'text',  'placeholder' => 'Kuliner'],
                        ['key' => 'topic_8', 'label' => 'Topik 8',         'type' => 'text',  'placeholder' => 'Lifestyle'],
                    ],
                ],

                'pricing' => [
                    'label'  => 'Paket Harga',
                    'fields' => [
                        ['key' => 'title',              'label' => 'Judul Section',           'type' => 'text', 'placeholder' => 'Paket Harga Jasa Penulisan Artikel'],
                        ['key' => 'basic_name',         'label' => 'Basic — Nama Paket',      'type' => 'text', 'placeholder' => 'BASIC'],
                        ['key' => 'basic_price_ori',    'label' => 'Basic — Harga Asli',      'type' => 'text', 'placeholder' => 'Rp 100.000,-'],
                        ['key' => 'basic_price',        'label' => 'Basic — Harga Promo',     'type' => 'text', 'placeholder' => 'Rp 75.000'],
                        ['key' => 'basic_words',        'label' => 'Basic — Jumlah Kata',     'type' => 'text', 'placeholder' => '500'],
                        ['key' => 'basic_feature_1',    'label' => 'Basic — Fitur 1',         'type' => 'text', 'placeholder' => 'Artikel original'],
                        ['key' => 'basic_feature_2',    'label' => 'Basic — Fitur 2',         'type' => 'text', 'placeholder' => 'Anti plagiat'],
                        ['key' => 'basic_feature_3',    'label' => 'Basic — Fitur 3',         'type' => 'text', 'placeholder' => 'Riset topik'],
                        ['key' => 'basic_feature_4',    'label' => 'Basic — Fitur 4',         'type' => 'text', 'placeholder' => 'Revisi 1x'],
                        ['key' => 'basic_feature_5',    'label' => 'Basic — Fitur 5',         'type' => 'text', 'placeholder' => 'Format Word/PDF'],
                        ['key' => 'basic_feature_6',    'label' => 'Basic — Fitur 6 (opt.)',  'type' => 'text', 'placeholder' => ''],
                        ['key' => 'standard_name',      'label' => 'Standard — Nama Paket',   'type' => 'text', 'placeholder' => 'STANDARD'],
                        ['key' => 'standard_badge',     'label' => 'Standard — Badge Label',  'type' => 'text', 'placeholder' => 'TERPOPULER'],
                        ['key' => 'standard_price_ori', 'label' => 'Standard — Harga Asli',   'type' => 'text', 'placeholder' => 'Rp 200.000,-'],
                        ['key' => 'standard_price',     'label' => 'Standard — Harga Promo',  'type' => 'text', 'placeholder' => 'Rp 150.000'],
                        ['key' => 'standard_words',     'label' => 'Standard — Jumlah Kata',  'type' => 'text', 'placeholder' => '1000'],
                        ['key' => 'standard_feature_1', 'label' => 'Standard — Fitur 1',      'type' => 'text', 'placeholder' => 'Artikel original'],
                        ['key' => 'standard_feature_2', 'label' => 'Standard — Fitur 2',      'type' => 'text', 'placeholder' => 'Anti plagiat'],
                        ['key' => 'standard_feature_3', 'label' => 'Standard — Fitur 3',      'type' => 'text', 'placeholder' => 'Riset kata kunci SEO'],
                        ['key' => 'standard_feature_4', 'label' => 'Standard — Fitur 4',      'type' => 'text', 'placeholder' => 'Revisi 2x'],
                        ['key' => 'standard_feature_5', 'label' => 'Standard — Fitur 5',      'type' => 'text', 'placeholder' => 'Format Word/PDF'],
                        ['key' => 'standard_feature_6', 'label' => 'Standard — Fitur 6',      'type' => 'text', 'placeholder' => 'Optimasi on-page SEO'],
                        ['key' => 'standard_feature_7', 'label' => 'Standard — Fitur 7 (opt.)','type'=> 'text', 'placeholder' => ''],
                        ['key' => 'standard_feature_8', 'label' => 'Standard — Fitur 8 (opt.)','type'=> 'text', 'placeholder' => ''],
                        ['key' => 'pro_name',           'label' => 'Pro — Nama Paket',        'type' => 'text', 'placeholder' => 'PRO'],
                        ['key' => 'pro_price_ori',      'label' => 'Pro — Harga Asli',        'type' => 'text', 'placeholder' => 'Rp 350.000,-'],
                        ['key' => 'pro_price',          'label' => 'Pro — Harga Promo',       'type' => 'text', 'placeholder' => 'Rp 275.000'],
                        ['key' => 'pro_words',          'label' => 'Pro — Jumlah Kata',       'type' => 'text', 'placeholder' => '2000'],
                        ['key' => 'pro_feature_1',      'label' => 'Pro — Fitur 1',           'type' => 'text', 'placeholder' => 'Artikel original'],
                        ['key' => 'pro_feature_2',      'label' => 'Pro — Fitur 2',           'type' => 'text', 'placeholder' => 'Anti plagiat'],
                        ['key' => 'pro_feature_3',      'label' => 'Pro — Fitur 3',           'type' => 'text', 'placeholder' => 'Riset kata kunci SEO'],
                        ['key' => 'pro_feature_4',      'label' => 'Pro — Fitur 4',           'type' => 'text', 'placeholder' => 'Revisi unlimited'],
                        ['key' => 'pro_feature_5',      'label' => 'Pro — Fitur 5',           'type' => 'text', 'placeholder' => 'Format Word/PDF'],
                        ['key' => 'pro_feature_6',      'label' => 'Pro — Fitur 6',           'type' => 'text', 'placeholder' => 'Optimasi on-page SEO'],
                        ['key' => 'pro_feature_7',      'label' => 'Pro — Fitur 7',           'type' => 'text', 'placeholder' => 'Internal & external linking'],
                        ['key' => 'pro_feature_8',      'label' => 'Pro — Fitur 8',           'type' => 'text', 'placeholder' => 'Meta description'],
                        ['key' => 'pro_feature_9',      'label' => 'Pro — Fitur 9 (opt.)',    'type' => 'text', 'placeholder' => ''],
                        ['key' => 'pro_feature_10',     'label' => 'Pro — Fitur 10 (opt.)',   'type' => 'text', 'placeholder' => ''],
                        ['key' => 'cta_text',           'label' => 'Teks Tombol Pesan',       'type' => 'text', 'placeholder' => 'Pesan Sekarang'],
                        ['key' => 'cta_url',            'label' => 'URL Tombol Pesan',        'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],

                'cta' => [
                    'label'  => 'CTA Penutup',
                    'fields' => [
                        ['key' => 'tagline',  'label' => 'Tagline (dashed box)', 'type' => 'text', 'placeholder' => 'Siap Punya Konten yang Merajai Google?'],
                        ['key' => 'title',    'label' => 'Judul Utama CTA',      'type' => 'text', 'placeholder' => 'SIAP PUNYA KONTEN BERKUALITAS?'],
                        ['key' => 'cta_text', 'label' => 'Teks Tombol',          'type' => 'text', 'placeholder' => 'PESAN ARTIKEL SEKARANG'],
                        ['key' => 'cta_url',  'label' => 'URL Tombol',           'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // LAYANAN: SCRIPT VIDEO
            // ════════════════════════════════════════════════════════════
            'layanan-script-video' => [
 
    // ── 1. Hero ─────────────────────────────────────────────────────────────
    'hero' => [
        'label'  => 'Hero Section',
        'fields' => [
            ['key' => 'badge_text',  'label' => 'Badge Text',                 'type' => 'text',     'placeholder' => '✦ JASA PENULISAN SCRIPT VIDEO'],
            ['key' => 'title_line1', 'label' => 'Judul Baris 1',              'type' => 'text',     'placeholder' => 'SCRIPT VIDEO'],
            ['key' => 'title_line2', 'label' => 'Judul Baris 2',              'type' => 'text',     'placeholder' => 'YANG MEMIKAT &'],
            ['key' => 'title_line3', 'label' => 'Judul Baris 3 (highlight)',  'type' => 'text',     'placeholder' => 'KONVERSI TINGGI'],
            ['key' => 'quote',       'label' => 'Kutipan',                    'type' => 'text',     'placeholder' => 'Dari ide menjadi naskah yang siap produksi.'],
            ['key' => 'description', 'label' => 'Deskripsi',                  'type' => 'textarea', 'placeholder' => 'Kami merancang naskah video yang engaging, sesuai target audiens Anda.'],
            ['key' => 'cta_text',    'label' => 'Teks Tombol',                'type' => 'text',     'placeholder' => 'KONSULTASI SEKARANG'],
            ['key' => 'cta_url',     'label' => 'URL Tombol',                 'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
            ['key' => 'image',       'label' => 'Gambar Hero',                'type' => 'image'],
        ],
    ],
 
    // ── 2. Mengapa Jasa Script Video ─────────────────────────────────────────
    'why_script' => [
        'label'  => 'Mengapa Butuh Jasa Script Video?',
        'fields' => [
            ['key' => 'title',          'label' => 'Judul Section',    'type' => 'text',     'placeholder' => 'Mengapa Harus Jasa Script Video?'],
            ['key' => 'subtitle',       'label' => 'Subjudul',         'type' => 'text',     'placeholder' => 'Script yang baik adalah pondasi video yang sukses.'],
            ['key' => 'reason_1_title', 'label' => 'Alasan 1 — Judul', 'type' => 'text',     'placeholder' => 'Hemat Biaya Produksi'],
            ['key' => 'reason_1_desc',  'label' => 'Alasan 1 — Desc',  'type' => 'textarea', 'placeholder' => 'Script yang matang mengurangi risiko reshooting.'],
            ['key' => 'reason_2_title', 'label' => 'Alasan 2 — Judul', 'type' => 'text',     'placeholder' => 'Pesan Tersampaikan dengan Tepat'],
            ['key' => 'reason_2_desc',  'label' => 'Alasan 2 — Desc',  'type' => 'textarea', 'placeholder' => 'Kami memastikan setiap kata membawa pesan brand Anda secara jelas dan persuasif.'],
            ['key' => 'reason_3_title', 'label' => 'Alasan 3 — Judul', 'type' => 'text',     'placeholder' => 'Sesuai Platform & Durasi'],
            ['key' => 'reason_3_desc',  'label' => 'Alasan 3 — Desc',  'type' => 'textarea', 'placeholder' => 'Script disesuaikan untuk YouTube, Instagram Reels, TikTok, iklan TV, atau video korporat.'],
            ['key' => 'reason_4_title', 'label' => 'Alasan 4 — Judul', 'type' => 'text',     'placeholder' => 'Storytelling yang Kuat'],
            ['key' => 'reason_4_desc',  'label' => 'Alasan 4 — Desc',  'type' => 'textarea', 'placeholder' => 'Kami membangun narasi yang emosional agar penonton terhubung dengan brand Anda.'],
            ['key' => 'reason_5_title', 'label' => 'Alasan 5 — Judul', 'type' => 'text',     'placeholder' => 'Revisi Hingga Puas'],
            ['key' => 'reason_5_desc',  'label' => 'Alasan 5 — Desc',  'type' => 'textarea', 'placeholder' => 'Kami menyediakan revisi hingga script benar-benar sesuai visi Anda.'],
        ],
    ],
 
    // ── 3. Daftar Layanan Script ──────────────────────────────────────────────
    'services_list' => [
        'label'  => 'Daftar Layanan Script',
        'fields' => [
            ['key' => 'title',            'label' => 'Judul Section',    'type' => 'text',     'placeholder' => 'LAYANAN KAMI'],
            ['key' => 'subtitle',         'label' => 'Subjudul',         'type' => 'text',     'placeholder' => 'Struktur naskah profesional yang dirancang khusus untuk mendominasi platform digital.'],
            ['key' => 'service_1_title',  'label' => 'Layanan 1 — Judul','type' => 'text',     'placeholder' => 'Script Video Pendek'],
            ['key' => 'service_1_desc',   'label' => 'Layanan 1 — Desc', 'type' => 'textarea', 'placeholder' => 'Naskah tajam, fast-paced, dan hook memikat di 3 detik pertama.'],
            ['key' => 'service_2_title',  'label' => 'Layanan 2 — Judul','type' => 'text',     'placeholder' => 'Script Perusahaan'],
            ['key' => 'service_2_desc',   'label' => 'Layanan 2 — Desc', 'type' => 'textarea', 'placeholder' => 'Penyampaian profil bisnis, nilai corporate, dan visi misi dengan alur formal namun tetap bernyawa.'],
            ['key' => 'service_3_title',  'label' => 'Layanan 3 — Judul','type' => 'text',     'placeholder' => 'Script Video Iklan'],
            ['key' => 'service_3_desc',   'label' => 'Layanan 3 — Desc', 'type' => 'textarea', 'placeholder' => 'Formula copywriting psikologis tinggi untuk memicu konversi pembelian.'],
            ['key' => 'service_4_title',  'label' => 'Layanan 4 — Judul','type' => 'text',     'placeholder' => 'Script YouTube'],
            ['key' => 'service_4_desc',   'label' => 'Layanan 4 — Desc', 'type' => 'textarea', 'placeholder' => 'Menjaga retention rate penonton tetap tinggi untuk video berdurasi panjang.'],
            ['key' => 'service_5_title',  'label' => 'Layanan 5 — Judul','type' => 'text',     'placeholder' => 'Script Sosmed'],
            ['key' => 'service_5_desc',   'label' => 'Layanan 5 — Desc', 'type' => 'textarea', 'placeholder' => 'Konsep kreatif organik yang relevan dengan tren terkini.'],
            ['key' => 'service_6_title',  'label' => 'Layanan 6 — Judul','type' => 'text',     'placeholder' => 'Script Dokumenter'],
            ['key' => 'service_6_desc',   'label' => 'Layanan 6 — Desc', 'type' => 'textarea', 'placeholder' => 'Alur storytelling sinematik mendalam yang informatif dan menggugah emosi.'],
        ],
    ],
 
    // ── 4. Proses Kerja ───────────────────────────────────────────────────────
    'process' => [
        'label'  => 'Proses / Alur Kerja',
        'fields' => [
            ['key' => 'title',        'label' => 'Judul Section',    'type' => 'text',     'placeholder' => 'Alur Kerja Pembuatan Naskah'],
            ['key' => 'step_1_title', 'label' => 'Step 1 — Judul',   'type' => 'text',     'placeholder' => 'KONSULTASI AWAL'],
            ['key' => 'step_1_desc',  'label' => 'Step 1 — Desc',    'type' => 'textarea', 'placeholder' => 'Membedah visi produk, detail brief, serta segmentasi audiens yang disasar.'],
            ['key' => 'step_2_title', 'label' => 'Step 2 — Judul',   'type' => 'text',     'placeholder' => 'RANCANG KONSEP'],
            ['key' => 'step_2_desc',  'label' => 'Step 2 — Desc',    'type' => 'textarea', 'placeholder' => 'Penyusunan premis cerita, angle penulisan, dan penentuan hook utama.'],
            ['key' => 'step_3_title', 'label' => 'Step 3 — Judul',   'type' => 'text',     'placeholder' => 'PENULISAN DRAFT'],
            ['key' => 'step_3_desc',  'label' => 'Step 3 — Desc',    'type' => 'textarea', 'placeholder' => 'Eksekusi naskah baris per baris lengkap dengan instruksi visual/audio.'],
            ['key' => 'step_4_title', 'label' => 'Step 4 — Judul',   'type' => 'text',     'placeholder' => 'REVISI & FINAL'],
            ['key' => 'step_4_desc',  'label' => 'Step 4 — Desc',    'type' => 'textarea', 'placeholder' => 'Penyelarasan feedback berkala hingga naskah dinilai solid & siap rekam.'],
            ['key' => 'step_5_title', 'label' => 'Step 5 — Judul',   'type' => 'text',     'placeholder' => 'DUKUNGAN PRODUKSI'],
            ['key' => 'step_5_desc',  'label' => 'Step 5 — Desc',    'type' => 'textarea', 'placeholder' => 'Pendampingan interpretasi naskah agar proses syuting tidak melenceng dari konsep.'],
        ],
    ],
 
    // ── 5. Paket Harga ────────────────────────────────────────────────────────
    'pricing' => [
        'label'  => 'Paket Harga',
        'fields' => [
            ['key' => 'title',              'label' => 'Judul Section',            'type' => 'text', 'placeholder' => 'Paket Harga Jasa Penulisan Script Video'],
            // SHORT
            ['key' => 'short_price_ori',    'label' => 'Short — Harga Asli',       'type' => 'text', 'placeholder' => 'Rp 300.000,-'],
            ['key' => 'short_price',        'label' => 'Short — Harga Promo',      'type' => 'text', 'placeholder' => 'Rp 250.000'],
            ['key' => 'short_duration',     'label' => 'Short — Durasi Video',     'type' => 'text', 'placeholder' => '< 1 Menit'],
            ['key' => 'short_feature_1',    'label' => 'Short — Fitur 1',          'type' => 'text', 'placeholder' => 'Naskah lengkap'],
            ['key' => 'short_feature_2',    'label' => 'Short — Fitur 2',          'type' => 'text', 'placeholder' => 'Sesuai brief khusus'],
            ['key' => 'short_feature_3',    'label' => 'Short — Fitur 3',          'type' => 'text', 'placeholder' => 'Format (.docx / .pdf)'],
            ['key' => 'short_feature_4',    'label' => 'Short — Fitur 4',          'type' => 'text', 'placeholder' => 'Revisi Maksimal 1x'],
            ['key' => 'short_feature_5',    'label' => 'Short — Fitur 5',          'type' => 'text', 'placeholder' => 'Cocok untuk Reels/TikTok'],
            // MEDIUM
            ['key' => 'medium_price_ori',   'label' => 'Medium — Harga Asli',      'type' => 'text', 'placeholder' => 'Rp 600.000,-'],
            ['key' => 'medium_price',       'label' => 'Medium — Harga Promo',     'type' => 'text', 'placeholder' => 'Rp 500.000'],
            ['key' => 'medium_duration',    'label' => 'Medium — Durasi Video',    'type' => 'text', 'placeholder' => '1 - 3 Menit'],
            ['key' => 'medium_feature_1',   'label' => 'Medium — Fitur 1',         'type' => 'text', 'placeholder' => 'Naskah lengkap'],
            ['key' => 'medium_feature_2',   'label' => 'Medium — Fitur 2',         'type' => 'text', 'placeholder' => 'Sesuai brief khusus'],
            ['key' => 'medium_feature_3',   'label' => 'Medium — Fitur 3',         'type' => 'text', 'placeholder' => 'Format (.docx / .pdf)'],
            ['key' => 'medium_feature_4',   'label' => 'Medium — Fitur 4',         'type' => 'text', 'placeholder' => 'Revisi Maksimal 2x'],
            ['key' => 'medium_feature_5',   'label' => 'Medium — Fitur 5',         'type' => 'text', 'placeholder' => 'Cocok untuk YouTube/IG'],
            ['key' => 'medium_feature_6',   'label' => 'Medium — Fitur 6',         'type' => 'text', 'placeholder' => 'Scene breakdown visual'],
            // LONG
            ['key' => 'long_price_ori',     'label' => 'Long — Harga Asli',        'type' => 'text', 'placeholder' => 'Rp 1.200.000,-'],
            ['key' => 'long_price',         'label' => 'Long — Harga Promo',       'type' => 'text', 'placeholder' => 'Rp 1.000.000'],
            ['key' => 'long_duration',      'label' => 'Long — Durasi Video',      'type' => 'text', 'placeholder' => '3 - 10 Menit'],
            ['key' => 'long_feature_1',     'label' => 'Long — Fitur 1',           'type' => 'text', 'placeholder' => 'Naskah lengkap'],
            ['key' => 'long_feature_2',     'label' => 'Long — Fitur 2',           'type' => 'text', 'placeholder' => 'Sesuai brief khusus'],
            ['key' => 'long_feature_3',     'label' => 'Long — Fitur 3',           'type' => 'text', 'placeholder' => 'Format (.docx / .pdf)'],
            ['key' => 'long_feature_4',     'label' => 'Long — Fitur 4 (highlight)','type' => 'text', 'placeholder' => 'REVISI SEPUASNYA'],
            ['key' => 'long_feature_5',     'label' => 'Long — Fitur 5',           'type' => 'text', 'placeholder' => 'Video korporat/Iklan TV'],
            ['key' => 'long_feature_6',     'label' => 'Long — Fitur 6',           'type' => 'text', 'placeholder' => 'Scene breakdown'],
            ['key' => 'long_feature_7',     'label' => 'Long — Fitur 7',           'type' => 'text', 'placeholder' => 'Voice over notes'],
            // CTA
            ['key' => 'cta_text',           'label' => 'Teks Tombol Pesan',        'type' => 'text', 'placeholder' => 'Pesan Sekarang'],
            ['key' => 'cta_url',            'label' => 'URL Tombol Konsultasi',    'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
        ],
    ],
 
    // ── 6. CTA Penutup ────────────────────────────────────────────────────────
    'cta' => [
        'label'  => 'CTA Penutup',
        'fields' => [
            ['key' => 'title',    'label' => 'Judul CTA',   'type' => 'text', 'placeholder' => 'SIAP BIKIN VIDEO YANG VIRAL?'],
            ['key' => 'cta_text', 'label' => 'Teks Tombol', 'type' => 'text', 'placeholder' => 'PESAN SCRIPT SEKARANG'],
            ['key' => 'cta_url',  'label' => 'URL Tombol',  'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
        ],
    ],
 
], // end layanan-script-video

            // ════════════════════════════════════════════════════════════
            // LAYANAN: PELATIHAN KONTEN
            // ════════════════════════════════════════════════════════════
            'layanan-pelatihan-konten' => [
 
                // ── 1. Hero ─────────────────────────────────────────────
                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'badge_text',      'label' => 'Badge Text',                    'type' => 'text',     'placeholder' => '✦ UPGRADE SKILL KONTEN KREATORMU'],
                        ['key' => 'title_line1',     'label' => 'Judul Baris 1',                 'type' => 'text',     'placeholder' => 'Ciptakan Konten'],
                        ['key' => 'title_highlight', 'label' => 'Judul Highlight (kotak hitam)', 'type' => 'text',     'placeholder' => 'Inovatif'],
                        ['key' => 'title_line2',     'label' => 'Judul Baris 2',                 'type' => 'text',     'placeholder' => 'dengan Smartphone'],
                        ['key' => 'quote',           'label' => 'Kutipan (dalam tanda petik)',   'type' => 'text',     'placeholder' => 'Ubah perangkat harian Anda menjadi mesin produksi konten profesional.'],
                        ['key' => 'description',     'label' => 'Deskripsi Paragraf',            'type' => 'textarea', 'placeholder' => 'Ikuti pelatihan konten kreator bersama HNP Communications.id.'],
                        ['key' => 'cta_text',        'label' => 'Teks Tombol CTA',               'type' => 'text',     'placeholder' => 'KONSULTASI SEKARANG →'],
                        ['key' => 'cta_url',         'label' => 'URL Tombol CTA',                'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                        ['key' => 'image',           'label' => 'Gambar Hero',                   'type' => 'image'],
                        ['key' => 'badge_cert',      'label' => 'Badge Bawah (Sertifikasi)',     'type' => 'text',     'placeholder' => 'Sertifikasi BNSP'],
                        ['key' => 'badge_live',      'label' => 'Badge Kanan Atas',              'type' => 'text',     'placeholder' => '✦ LIVE WORKSHOP'],
                    ],
                ],
 
                // ── 2. Mengapa Harus Ikut ───────────────────────────────
                'why_join' => [
                    'label'  => 'Mengapa Harus Ikut?',
                    'fields' => [
                        ['key' => 'title',          'label' => 'Judul Section',    'type' => 'text',     'placeholder' => 'Mengapa Harus Ikut Pelatihan Kami?'],
                        ['key' => 'subtitle',       'label' => 'Subjudul',         'type' => 'text',     'placeholder' => ''],
                        ['key' => 'reason_1_title', 'label' => 'Alasan 1 — Judul', 'type' => 'text',     'placeholder' => 'Belajar Dari Ahlinya'],
                        ['key' => 'reason_1_desc',  'label' => 'Alasan 1 — Desc',  'type' => 'textarea', 'placeholder' => 'Tim pengajar kami adalah mantan produser senior TV nasional dengan pengalaman lebih dari 20 tahun.'],
                        ['key' => 'reason_2_title', 'label' => 'Alasan 2 — Judul', 'type' => 'text',     'placeholder' => 'Pengajar BNSP'],
                        ['key' => 'reason_2_desc',  'label' => 'Alasan 2 — Desc',  'type' => 'textarea', 'placeholder' => 'Tim bersertifikasi Badan Nasional Sertifikasi Profesi (BNSP) dengan gelar Certified Content Creator.'],
                        ['key' => 'reason_3_title', 'label' => 'Alasan 3 — Judul', 'type' => 'text',     'placeholder' => 'Materi Komprehensif'],
                        ['key' => 'reason_3_desc',  'label' => 'Alasan 3 — Desc',  'type' => 'textarea', 'placeholder' => 'Mencakup seluruh aspek creation mulai dari teknik pengambilan gambar hingga strategi engagement.'],
                        ['key' => 'reason_4_title', 'label' => 'Alasan 4 — Judul', 'type' => 'text',     'placeholder' => 'Metode Fleksibel'],
                        ['key' => 'reason_4_desc',  'label' => 'Alasan 4 — Desc',  'type' => 'textarea', 'placeholder' => 'Tersedia format kolektif maupun privat, cocok untuk perusahaan, instansi, maupun UMKM.'],
                        ['key' => 'reason_5_title', 'label' => 'Alasan 5 — Judul (opsional)', 'type' => 'text',     'placeholder' => ''],
                        ['key' => 'reason_5_desc',  'label' => 'Alasan 5 — Desc (opsional)',  'type' => 'textarea', 'placeholder' => ''],
                        ['key' => 'reason_6_title', 'label' => 'Alasan 6 — Judul (opsional)', 'type' => 'text',     'placeholder' => ''],
                        ['key' => 'reason_6_desc',  'label' => 'Alasan 6 — Desc (opsional)',  'type' => 'textarea', 'placeholder' => ''],
                    ],
                ],
 
                // ── 3. Modul Materi ─────────────────────────────────────
                'modules' => [
                    'label'  => 'Modul Materi Pelatihan',
                    'fields' => [
                        ['key' => 'title',           'label' => 'Judul Section',           'type' => 'text',     'placeholder' => 'Apa Saja Materi Pelatihan Kami?'],
                        ['key' => 'subtitle',        'label' => 'Subjudul',                'type' => 'text',     'placeholder' => ''],
                        ['key' => 'module_1_title',  'label' => 'Modul 1 — Judul',         'type' => 'text',     'placeholder' => 'Modul 1: Pengenalan Dunia Konten Kreator'],
                        ['key' => 'module_1_desc',   'label' => 'Modul 1 — Deskripsi',     'type' => 'textarea', 'placeholder' => 'Niche content, personal branding, dan peran kreator di industri digital.'],
                        ['key' => 'module_2_title',  'label' => 'Modul 2 — Judul',         'type' => 'text',     'placeholder' => 'Modul 2: Persiapan dan Perencanaan'],
                        ['key' => 'module_2_desc',   'label' => 'Modul 2 — Deskripsi',     'type' => 'textarea', 'placeholder' => 'Ide konten, scriptwriting yang efektif, riset audiens, dan pembuatan storyboard.'],
                        ['key' => 'module_3_title',  'label' => 'Modul 3 — Judul',         'type' => 'text',     'placeholder' => 'Modul 3: Produksi Konten'],
                        ['key' => 'module_3_desc',   'label' => 'Modul 3 — Deskripsi',     'type' => 'textarea', 'placeholder' => 'Teknik kamera (angle, framing, lighting) dan penggunaan aksesoris smartphone.'],
                        ['key' => 'module_4_title',  'label' => 'Modul 4 — Judul',         'type' => 'text',     'placeholder' => 'Modul 4: Editing Video dengan Smartphone'],
                        ['key' => 'module_4_desc',   'label' => 'Modul 4 — Deskripsi',     'type' => 'textarea', 'placeholder' => 'Pengenalan aplikasi CapCut, dasar editing, transisi, musik, dan color correction.'],
                        ['key' => 'module_5_title',  'label' => 'Modul 5 — Judul',         'type' => 'text',     'placeholder' => 'Modul 5: Distribusi dan Promosi Video'],
                        ['key' => 'module_5_desc',   'label' => 'Modul 5 — Deskripsi',     'type' => 'textarea', 'placeholder' => 'Optimasi video untuk platform YouTube, Instagram, TikTok, dan Facebook.'],
                        ['key' => 'module_6_title',  'label' => 'Modul 6 — Judul',         'type' => 'text',     'placeholder' => 'Modul 6: Cuan dari Ngonten'],
                        ['key' => 'module_6_desc',   'label' => 'Modul 6 — Deskripsi',     'type' => 'textarea', 'placeholder' => 'Strategi monetisasi, affiliate marketing, endorse, dan penjualan produk/jasa.'],
                        ['key' => 'module_7_title',  'label' => 'Modul 7 — Judul (opt.)',  'type' => 'text',     'placeholder' => ''],
                        ['key' => 'module_7_desc',   'label' => 'Modul 7 — Desc (opt.)',   'type' => 'textarea', 'placeholder' => ''],
                        ['key' => 'module_8_title',  'label' => 'Modul 8 — Judul (opt.)',  'type' => 'text',     'placeholder' => ''],
                        ['key' => 'module_8_desc',   'label' => 'Modul 8 — Desc (opt.)',   'type' => 'textarea', 'placeholder' => ''],
                    ],
                ],
 
                // ── 4. Target / Siapa yang Cocok ────────────────────────
                'targets' => [
                    'label'  => 'Siapa yang Cocok?',
                    'fields' => [
                        ['key' => 'title',        'label' => 'Judul Section',           'type' => 'text',     'placeholder' => 'Siapa Saja yang Cocok?'],
                        ['key' => 'target_1',     'label' => 'Target 1 — Nama',         'type' => 'text',     'placeholder' => 'Perusahaan Profesional'],
                        ['key' => 'target_1_desc','label' => 'Target 1 — Deskripsi',    'type' => 'textarea', 'placeholder' => 'Perusahaan yang concern terhadap konten (properti, travel, RS, dsb).'],
                        ['key' => 'target_2',     'label' => 'Target 2 — Nama',         'type' => 'text',     'placeholder' => 'Instansi & Lembaga'],
                        ['key' => 'target_2_desc','label' => 'Target 2 — Deskripsi',    'type' => 'textarea', 'placeholder' => 'Sekolah, ponpes, universitas, dan lembaga pemerintahan.'],
                        ['key' => 'target_3',     'label' => 'Target 3 — Nama',         'type' => 'text',     'placeholder' => 'Individu Kreator'],
                        ['key' => 'target_3_desc','label' => 'Target 3 — Deskripsi',    'type' => 'textarea', 'placeholder' => 'Individu yang ingin menjadi kreator profesional atau meningkatkan kompetensi.'],
                        ['key' => 'target_4',     'label' => 'Target 4 — Nama',         'type' => 'text',     'placeholder' => 'Business Owner & UMKM'],
                        ['key' => 'target_4_desc','label' => 'Target 4 — Deskripsi',    'type' => 'textarea', 'placeholder' => 'Pemilik bisnis yang ingin mempromosikan produk melalui konten kreatif.'],
                        ['key' => 'target_5',     'label' => 'Target 5 — Nama (opt.)',  'type' => 'text',     'placeholder' => ''],
                        ['key' => 'target_5_desc','label' => 'Target 5 — Desc (opt.)',  'type' => 'textarea', 'placeholder' => ''],
                        ['key' => 'target_6',     'label' => 'Target 6 — Nama (opt.)',  'type' => 'text',     'placeholder' => ''],
                        ['key' => 'target_6_desc','label' => 'Target 6 — Desc (opt.)',  'type' => 'textarea', 'placeholder' => ''],
                    ],
                ],
 
                // ── 5. Pricing / Paket Harga ────────────────────────────
                'pricing' => [
                    'label'  => 'Paket Harga',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul Section', 'type' => 'text', 'placeholder' => 'Paket Harga Pelatihan Konten Kreator'],
                        ['key' => 'subtitle', 'label' => 'Subjudul',      'type' => 'text', 'placeholder' => ''],
                        // Package 1
                        ['key' => 'package_1_name',      'label' => 'Paket 1 — Nama',         'type' => 'text',     'placeholder' => 'KOLEKTIF'],
                        ['key' => 'package_1_price_ori', 'label' => 'Paket 1 — Harga Asli',   'type' => 'text',     'placeholder' => 'Rp 800.000,-'],
                        ['key' => 'package_1_price',     'label' => 'Paket 1 — Harga Promo',  'type' => 'text',     'placeholder' => 'Rp 650.000'],
                        ['key' => 'package_1_desc',      'label' => 'Paket 1 — Deskripsi',    'type' => 'text',     'placeholder' => 'Per orang, min. 5 peserta'],
                        ['key' => 'package_1_badge',     'label' => 'Paket 1 — Badge (opt.)', 'type' => 'text',     'placeholder' => ''],
                        ['key' => 'package_1_feature_1', 'label' => 'Paket 1 — Fitur 1',      'type' => 'text',     'placeholder' => 'Pelatihan 1 hari'],
                        ['key' => 'package_1_feature_2', 'label' => 'Paket 1 — Fitur 2',      'type' => 'text',     'placeholder' => 'Materi komprehensif'],
                        ['key' => 'package_1_feature_3', 'label' => 'Paket 1 — Fitur 3',      'type' => 'text',     'placeholder' => 'Sertifikat digital'],
                        ['key' => 'package_1_feature_4', 'label' => 'Paket 1 — Fitur 4',      'type' => 'text',     'placeholder' => 'Cocok untuk tim/instansi'],
                        ['key' => 'package_1_feature_5', 'label' => 'Paket 1 — Fitur 5 (opt.)','type' => 'text',   'placeholder' => ''],
                        ['key' => 'package_1_feature_6', 'label' => 'Paket 1 — Fitur 6 (opt.)','type' => 'text',   'placeholder' => ''],
                        ['key' => 'package_1_feature_7', 'label' => 'Paket 1 — Fitur 7 (opt.)','type' => 'text',   'placeholder' => ''],
                        ['key' => 'package_1_feature_8', 'label' => 'Paket 1 — Fitur 8 (opt.)','type' => 'text',   'placeholder' => ''],
                        // Package 2
                        ['key' => 'package_2_name',      'label' => 'Paket 2 — Nama',         'type' => 'text',     'placeholder' => 'PRIVAT'],
                        ['key' => 'package_2_price_ori', 'label' => 'Paket 2 — Harga Asli',   'type' => 'text',     'placeholder' => 'Rp 1.500.000,-'],
                        ['key' => 'package_2_price',     'label' => 'Paket 2 — Harga Promo',  'type' => 'text',     'placeholder' => 'Rp 1.200.000'],
                        ['key' => 'package_2_desc',      'label' => 'Paket 2 — Deskripsi',    'type' => 'text',     'placeholder' => 'Untuk individu/1-2 orang'],
                        ['key' => 'package_2_badge',     'label' => 'Paket 2 — Badge (opt.)', 'type' => 'text',     'placeholder' => 'TERPOPULER'],
                        ['key' => 'package_2_feature_1', 'label' => 'Paket 2 — Fitur 1',      'type' => 'text',     'placeholder' => 'Pelatihan 1 hari'],
                        ['key' => 'package_2_feature_2', 'label' => 'Paket 2 — Fitur 2',      'type' => 'text',     'placeholder' => 'Materi komprehensif'],
                        ['key' => 'package_2_feature_3', 'label' => 'Paket 2 — Fitur 3',      'type' => 'text',     'placeholder' => 'Sertifikat digital'],
                        ['key' => 'package_2_feature_4', 'label' => 'Paket 2 — Fitur 4',      'type' => 'text',     'placeholder' => 'Sesi tanya jawab intensif'],
                        ['key' => 'package_2_feature_5', 'label' => 'Paket 2 — Fitur 5',      'type' => 'text',     'placeholder' => 'Mentoring pasca pelatihan'],
                        ['key' => 'package_2_feature_6', 'label' => 'Paket 2 — Fitur 6 (opt.)','type' => 'text',   'placeholder' => ''],
                        ['key' => 'package_2_feature_7', 'label' => 'Paket 2 — Fitur 7 (opt.)','type' => 'text',   'placeholder' => ''],
                        ['key' => 'package_2_feature_8', 'label' => 'Paket 2 — Fitur 8 (opt.)','type' => 'text',   'placeholder' => ''],
                        // Package 3
                        ['key' => 'package_3_name',      'label' => 'Paket 3 — Nama',         'type' => 'text',     'placeholder' => 'KORPORAT'],
                        ['key' => 'package_3_price_ori', 'label' => 'Paket 3 — Harga Asli',   'type' => 'text',     'placeholder' => 'Custom'],
                        ['key' => 'package_3_price',     'label' => 'Paket 3 — Harga Promo',  'type' => 'text',     'placeholder' => 'Hubungi Kami'],
                        ['key' => 'package_3_desc',      'label' => 'Paket 3 — Deskripsi',    'type' => 'text',     'placeholder' => 'Untuk perusahaan/instansi besar'],
                        ['key' => 'package_3_badge',     'label' => 'Paket 3 — Badge (opt.)', 'type' => 'text',     'placeholder' => ''],
                        ['key' => 'package_3_feature_1', 'label' => 'Paket 3 — Fitur 1',      'type' => 'text',     'placeholder' => 'Kurikulum custom'],
                        ['key' => 'package_3_feature_2', 'label' => 'Paket 3 — Fitur 2',      'type' => 'text',     'placeholder' => 'Offline/Online'],
                        ['key' => 'package_3_feature_3', 'label' => 'Paket 3 — Fitur 3',      'type' => 'text',     'placeholder' => 'Sertifikat resmi BNSP'],
                        ['key' => 'package_3_feature_4', 'label' => 'Paket 3 — Fitur 4',      'type' => 'text',     'placeholder' => 'Minimal 10 peserta'],
                        ['key' => 'package_3_feature_5', 'label' => 'Paket 3 — Fitur 5',      'type' => 'text',     'placeholder' => 'Laporan evaluasi peserta'],
                        ['key' => 'package_3_feature_6', 'label' => 'Paket 3 — Fitur 6 (opt.)','type' => 'text',   'placeholder' => ''],
                        ['key' => 'package_3_feature_7', 'label' => 'Paket 3 — Fitur 7 (opt.)','type' => 'text',   'placeholder' => ''],
                        ['key' => 'package_3_feature_8', 'label' => 'Paket 3 — Fitur 8 (opt.)','type' => 'text',   'placeholder' => ''],
                        // Package 4, 5, 6 (optional extra packages)
                        ['key' => 'package_4_name',      'label' => 'Paket 4 — Nama (opt.)',  'type' => 'text',     'placeholder' => ''],
                        ['key' => 'package_4_price_ori', 'label' => 'Paket 4 — Harga Asli',   'type' => 'text',     'placeholder' => ''],
                        ['key' => 'package_4_price',     'label' => 'Paket 4 — Harga Promo',  'type' => 'text',     'placeholder' => ''],
                        ['key' => 'package_4_desc',      'label' => 'Paket 4 — Deskripsi',    'type' => 'text',     'placeholder' => ''],
                        ['key' => 'package_4_badge',     'label' => 'Paket 4 — Badge',         'type' => 'text',     'placeholder' => ''],
                        ['key' => 'package_4_feature_1', 'label' => 'Paket 4 — Fitur 1',      'type' => 'text',     'placeholder' => ''],
                        ['key' => 'package_4_feature_2', 'label' => 'Paket 4 — Fitur 2',      'type' => 'text',     'placeholder' => ''],
                        ['key' => 'package_4_feature_3', 'label' => 'Paket 4 — Fitur 3',      'type' => 'text',     'placeholder' => ''],
                        ['key' => 'package_4_feature_4', 'label' => 'Paket 4 — Fitur 4',      'type' => 'text',     'placeholder' => ''],
                        ['key' => 'package_4_feature_5', 'label' => 'Paket 4 — Fitur 5',      'type' => 'text',     'placeholder' => ''],
                        ['key' => 'package_4_feature_6', 'label' => 'Paket 4 — Fitur 6',      'type' => 'text',     'placeholder' => ''],
                        ['key' => 'package_4_feature_7', 'label' => 'Paket 4 — Fitur 7',      'type' => 'text',     'placeholder' => ''],
                        ['key' => 'package_4_feature_8', 'label' => 'Paket 4 — Fitur 8',      'type' => 'text',     'placeholder' => ''],
                        // CTA Pricing
                        ['key' => 'cta_text', 'label' => 'Teks Tombol',        'type' => 'text', 'placeholder' => 'Daftar Sekarang →'],
                        ['key' => 'cta_url',  'label' => 'URL Tombol (WA)',    'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
                        ['key' => 'note',     'label' => 'Catatan Bawah Harga','type' => 'text', 'placeholder' => '* Harga dapat berubah sewaktu-waktu'],
                    ],
                ],
 
                // ── 6. CTA Penutup ──────────────────────────────────────
                'cta' => [
                    'label'  => 'CTA Penutup',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul CTA (bisa multiline dengan \\n)', 'type' => 'textarea', 'placeholder' => "SIAP JADI\nKREATOR?"],
                        ['key' => 'subtitle', 'label' => 'Subjudul / Deskripsi',                   'type' => 'textarea', 'placeholder' => 'Daftar sekarang dan mulai perjalanan kreatormu bersama HNP Communications.id.'],
                        ['key' => 'cta_text', 'label' => 'Teks Tombol',                            'type' => 'text',     'placeholder' => 'HUBUNGI KAMI SEKARANG →'],
                        ['key' => 'cta_url',  'label' => 'URL Tombol (WA)',                        'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
 
            ], // end layanan-pelatihan-konten

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
                        ['key' => 'wa1_number', 'label' => 'WA Hotline 1 — Nomor',  'type' => 'text', 'placeholder' => '6287786000919'],
                        ['key' => 'wa1_label',  'label' => 'WA Hotline 1 — Tampil', 'type' => 'text', 'placeholder' => '+62 877-8600-0919'],
                        ['key' => 'wa2_number', 'label' => 'WA Hotline 2 — Nomor',  'type' => 'text', 'placeholder' => '628121967610'],
                        ['key' => 'wa2_label',  'label' => 'WA Hotline 2 — Tampil', 'type' => 'text', 'placeholder' => '+62 812-1967-610'],
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
}