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
    ];

    protected $casts = [
        'content'   => 'array',
        'is_active' => 'boolean',
        'order'     => 'integer',
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

    // ── Helpers ─────────────────────────────────────────────────────────

    public function get(string $key, mixed $default = null): mixed
    {
        return data_get($this->content, $key, $default);
    }

    public static function ofPage(string $page): \Illuminate\Support\Collection
    {
        return static::forPage($page)
            ->active()
            ->ordered()
            ->get()
            ->keyBy('section_key');
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
                        ['key' => 'title_line2',     'label' => 'Judul Baris 2',                 'type' => 'text',     'placeholder' => 'DIGITAL'],
                        ['key' => 'subtitle',        'label' => 'Subjudul / Tagline',            'type' => 'textarea', 'placeholder' => 'Kami bukan agensi biasa...'],
                        ['key' => 'highlight_words', 'label' => 'Kata Highlight (pisah koma)',   'type' => 'text',     'placeholder' => 'partner kreatif, yang'],
                        ['key' => 'cta_text',        'label' => 'Teks Tombol CTA',               'type' => 'text',     'placeholder' => 'MULAI SEKARANG →'],
                        ['key' => 'cta_url',         'label' => 'URL Tombol CTA',                'type' => 'text',     'placeholder' => '/contact'],
                        ['key' => 'image',           'label' => 'Gambar Maskot',                 'type' => 'image'],
                        ['key' => 'bg_color',        'label' => 'Warna Background',              'type' => 'color',    'placeholder' => '#FFD600'],
                    ],
                ],
                'stats' => [
                    'label'  => 'Stats (Angka Pencapaian)',
                    'fields' => [
                        ['key' => 'stat_1_number', 'label' => 'Angka 1',    'type' => 'text',  'placeholder' => '200+'],
                        ['key' => 'stat_1_label',  'label' => 'Label 1',    'type' => 'text',  'placeholder' => 'MEDIA PARTNER'],
                        ['key' => 'stat_1_color',  'label' => 'Warna BG 1', 'type' => 'color', 'placeholder' => '#2D1B6B'],
                        ['key' => 'stat_2_number', 'label' => 'Angka 2',    'type' => 'text',  'placeholder' => '5+'],
                        ['key' => 'stat_2_label',  'label' => 'Label 2',    'type' => 'text',  'placeholder' => 'TAHUN PENGALAMAN'],
                        ['key' => 'stat_2_color',  'label' => 'Warna BG 2', 'type' => 'color', 'placeholder' => '#FF6B6B'],
                        ['key' => 'stat_3_number', 'label' => 'Angka 3',    'type' => 'text',  'placeholder' => '1K+'],
                        ['key' => 'stat_3_label',  'label' => 'Label 3',    'type' => 'text',  'placeholder' => 'KLIEN PUAS'],
                        ['key' => 'stat_3_color',  'label' => 'Warna BG 3', 'type' => 'color', 'placeholder' => '#00D4B4'],
                    ],
                ],
                'about_agency' => [
                    'label'  => 'About Agency (Deskripsi)',
                    'fields' => [
                        ['key' => 'title',       'label' => 'Judul Section', 'type' => 'text',     'placeholder' => 'Tentang Kami'],
                        ['key' => 'description', 'label' => 'Deskripsi',     'type' => 'textarea', 'placeholder' => 'Ceritakan tentang agency kamu...'],
                        ['key' => 'image',       'label' => 'Gambar',        'type' => 'image'],
                        ['key' => 'cta_text',    'label' => 'Teks Tombol',   'type' => 'text',     'placeholder' => 'Pelajari Lebih'],
                        ['key' => 'cta_url',     'label' => 'URL Tombol',    'type' => 'text',     'placeholder' => '/about'],
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
                        ['key' => 'title',       'label' => 'Judul',       'type' => 'text',     'placeholder' => 'Mitra Digital Terpercaya'],
                        ['key' => 'description', 'label' => 'Deskripsi',   'type' => 'textarea', 'placeholder' => 'Kami adalah mitra terpercaya...'],
                        ['key' => 'image',       'label' => 'Foto Tim',    'type' => 'image'],
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
                        ['key' => 'badge_text',  'label' => 'Badge Text',   'type' => 'text',     'placeholder' => "✦ Let's Talk Business"],
                        ['key' => 'title',       'label' => 'Judul Hero',   'type' => 'text',     'placeholder' => 'KONSULTASI GRATIS!'],
                        ['key' => 'subtitle',    'label' => 'Subjudul',     'type' => 'text',     'placeholder' => 'Ubah statement menjadi berita nasional dalam sekejap.'],
                        ['key' => 'description', 'label' => 'Deskripsi',    'type' => 'textarea', 'placeholder' => 'Siap meledakkan brand Anda di media nasional?'],
                        ['key' => 'image',       'label' => 'Gambar Hero',  'type' => 'image'],
                        ['key' => 'cta_text',    'label' => 'Teks Tombol',  'type' => 'text',     'placeholder' => 'Mulai Diskusi Sekarang →'],
                    ],
                ],
                'info' => [
                    'label'  => 'Info Kontak',
                    'fields' => [
                        ['key' => 'email',      'label' => 'Email',                    'type' => 'text',     'placeholder' => 'kontendigitalid10@gmail.com'],
                        ['key' => 'whatsapp',   'label' => 'Nomor WhatsApp',           'type' => 'text',     'placeholder' => '+62 877-8600-0919'],
                        ['key' => 'address',    'label' => 'Alamat Lengkap',           'type' => 'textarea', 'placeholder' => 'Kaligawe, RT.02, Gandekan, Bantul, DIY 55711'],
                        ['key' => 'maps_embed', 'label' => 'URL Google Maps Embed',   'type' => 'text',     'placeholder' => 'https://www.google.com/maps/embed?pb=...'],
                        ['key' => 'maps_url',   'label' => 'URL Google Maps Arah',    'type' => 'text',     'placeholder' => 'https://www.google.com/maps/dir//Kontendigital.id'],
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
                        ['key' => 'badge_text',  'label' => 'Badge Text',   'type' => 'text',     'placeholder' => '✦ Panduan Pemesanan'],
                        ['key' => 'title',       'label' => 'Judul',        'type' => 'text',     'placeholder' => 'ALUR KERJA ORDER'],
                        ['key' => 'subtitle',    'label' => 'Subjudul',     'type' => 'text',     'placeholder' => 'Proses transparan, hasil maksimal untuk pesan Anda.'],
                        ['key' => 'description', 'label' => 'Deskripsi',    'type' => 'textarea', 'placeholder' => 'Kami memastikan setiap langkah pengerjaan Press Release dilakukan secara profesional.'],
                        ['key' => 'image',       'label' => 'Gambar Hero',  'type' => 'image'],
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
                        ['key' => 'badge_text',   'label' => 'Badge Text',      'type' => 'text',     'placeholder' => '✦ JASA PRESS RELEASE'],
                        ['key' => 'title_line1',  'label' => 'Judul Baris 1',   'type' => 'text',     'placeholder' => 'BERSAMA'],
                        ['key' => 'title_line2',  'label' => 'Judul Baris 2',   'type' => 'text',     'placeholder' => 'WARTAWAN DARI'],
                        ['key' => 'title_line3',  'label' => 'Judul Baris 3 (highlight)', 'type' => 'text', 'placeholder' => 'MEDIA TERNAMA'],
                        ['key' => 'quote',        'label' => 'Kutipan',          'type' => 'text',     'placeholder' => 'Ubah statement menjadi berita nasional dalam sekejap.'],
                        ['key' => 'description',  'label' => 'Deskripsi',        'type' => 'textarea', 'placeholder' => 'Selain membantu mengundang wartawan/media untuk Anda...'],
                        ['key' => 'cta_text',     'label' => 'Teks Tombol',      'type' => 'text',     'placeholder' => 'KONSULTASI SEKARANG →'],
                        ['key' => 'cta_url',      'label' => 'URL Tombol',       'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                        ['key' => 'image',        'label' => 'Gambar Hero',      'type' => 'image'],
                    ],
                ],
                'why_pr' => [
                    'label'  => 'Mengapa Harus Press Release?',
                    'fields' => [
                        ['key' => 'title',         'label' => 'Judul Section',   'type' => 'text',     'placeholder' => 'Mengapa Harus Press Release?'],
                        ['key' => 'subtitle',      'label' => 'Subjudul',        'type' => 'text',     'placeholder' => 'Press release memiliki peran penting dalam strategi pemasaran...'],
                        ['key' => 'reason_1_title','label' => 'Alasan 1 — Judul','type' => 'text',     'placeholder' => 'Sarana Promosi Bisnis yang Efektif'],
                        ['key' => 'reason_1_desc', 'label' => 'Alasan 1 — Desc', 'type' => 'textarea', 'placeholder' => 'Press release dapat menjadi sarana promosi produk dan jasa Anda.'],
                        ['key' => 'reason_2_title','label' => 'Alasan 2 — Judul','type' => 'text',     'placeholder' => 'Media Branding yang Powerfull'],
                        ['key' => 'reason_2_desc', 'label' => 'Alasan 2 — Desc', 'type' => 'textarea', 'placeholder' => 'Tampil eksklusif dan diliput banyak media besar akan membuat reputasi bisnis Anda meroket.'],
                        ['key' => 'reason_3_title','label' => 'Alasan 3 — Judul','type' => 'text',     'placeholder' => 'Memudahkan Urusan Public Relation'],
                        ['key' => 'reason_3_desc', 'label' => 'Alasan 3 — Desc', 'type' => 'textarea', 'placeholder' => 'Berbagai urusan publikasi bisnis kini bisa dilakukan dengan mudah & cepat.'],
                        ['key' => 'reason_4_title','label' => 'Alasan 4 — Judul','type' => 'text',     'placeholder' => 'Syarat Verifikasi di Media Sosial dan Marketplace'],
                        ['key' => 'reason_4_desc', 'label' => 'Alasan 4 — Desc', 'type' => 'textarea', 'placeholder' => 'Tunjukkan bahwa brand Anda populer dan pernah muncul di media-media online ternama.'],
                        ['key' => 'reason_5_title','label' => 'Alasan 5 — Judul','type' => 'text',     'placeholder' => 'Konten Iklan yang Sangat Kuat'],
                        ['key' => 'reason_5_desc', 'label' => 'Alasan 5 — Desc', 'type' => 'textarea', 'placeholder' => 'Anda bisa memaksimalkan press release yang sudah terbit sebagai konten iklan di berbagai platform.'],
                    ],
                ],
                'pricing' => [
                    'label'  => 'Paket Harga',
                    'fields' => [
                        ['key' => 'title',               'label' => 'Judul Section',            'type' => 'text', 'placeholder' => 'Paket Harga Jasa Press Release Media Online'],
                        ['key' => 'bronze_price_ori',    'label' => 'Bronze — Harga Asli',      'type' => 'text', 'placeholder' => 'Rp 3.750.000,-'],
                        ['key' => 'bronze_price',        'label' => 'Bronze — Harga Promo',     'type' => 'text', 'placeholder' => 'Rp 3.000.000'],
                        ['key' => 'bronze_media_count',  'label' => 'Bronze — Jumlah Media',    'type' => 'text', 'placeholder' => '3'],
                        ['key' => 'silver_price_ori',    'label' => 'Silver — Harga Asli',      'type' => 'text', 'placeholder' => 'Rp 5.750.000,-'],
                        ['key' => 'silver_price',        'label' => 'Silver — Harga Promo',     'type' => 'text', 'placeholder' => 'Rp 4.750.000'],
                        ['key' => 'silver_media_count',  'label' => 'Silver — Jumlah Media',    'type' => 'text', 'placeholder' => '5'],
                        ['key' => 'gold_price_ori',      'label' => 'Gold — Harga Asli',        'type' => 'text', 'placeholder' => 'Rp 11.000.000,-'],
                        ['key' => 'gold_price',          'label' => 'Gold — Harga Promo',       'type' => 'text', 'placeholder' => 'Rp 9.000.000'],
                        ['key' => 'gold_media_count',    'label' => 'Gold — Jumlah Media',      'type' => 'text', 'placeholder' => '10'],
                        ['key' => 'platinum_price_ori',  'label' => 'Platinum — Harga Asli',    'type' => 'text', 'placeholder' => 'Rp 15.750.000,-'],
                        ['key' => 'platinum_price',      'label' => 'Platinum — Harga Promo',   'type' => 'text', 'placeholder' => 'Rp 12.750.000'],
                        ['key' => 'platinum_media_count','label' => 'Platinum — Jumlah Media',  'type' => 'text', 'placeholder' => '15'],
                        ['key' => 'cta_url',             'label' => 'URL Tombol Konsultasi',    'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
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
            // LAYANAN: BACKLINK
            // ════════════════════════════════════════════════════════════
            'layanan-backlink' => [
                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'badge_text',  'label' => 'Badge Text',     'type' => 'text',     'placeholder' => '✦ JASA BACKLINK MEDIA NASIONAL'],
                        ['key' => 'title',       'label' => 'Judul Utama',    'type' => 'text',     'placeholder' => 'KONTENDIGITAL.ID'],
                        ['key' => 'description', 'label' => 'Deskripsi',      'type' => 'textarea', 'placeholder' => 'Mitra terpercaya dalam komunikasi dan pemasaran digital.'],
                        ['key' => 'cta_text',    'label' => 'Teks Tombol',    'type' => 'text',     'placeholder' => 'Konsultasi Sekarang'],
                        ['key' => 'cta_url',     'label' => 'URL Tombol',     'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                    ],
                ],
                'benefits' => [
                    'label'  => 'Manfaat Backlink',
                    'fields' => [
                        ['key' => 'title',          'label' => 'Judul Section',   'type' => 'text',     'placeholder' => 'Manfaat Backlink Media Nasional'],
                        ['key' => 'subtitle',       'label' => 'Subjudul',        'type' => 'text',     'placeholder' => 'Backlink media nasional memiliki beberapa manfaat sebagai berikut:'],
                        ['key' => 'benefit_1_title','label' => 'Manfaat 1 — Judul','type' => 'text',    'placeholder' => 'Meningkatkan Jumlah Pengunjung (Visitor)'],
                        ['key' => 'benefit_1_desc', 'label' => 'Manfaat 1 — Desc','type' => 'textarea', 'placeholder' => 'Backlink dapat meningkatkan visibilitas di kalangan audiens yang lebih luas.'],
                        ['key' => 'benefit_2_title','label' => 'Manfaat 2 — Judul','type' => 'text',    'placeholder' => 'Memudahkan Google Menemukan Website Anda'],
                        ['key' => 'benefit_2_desc', 'label' => 'Manfaat 2 — Desc','type' => 'textarea', 'placeholder' => 'Memudahkan mesin pencarian Google dalam menemukan website yang Anda miliki.'],
                        ['key' => 'benefit_3_title','label' => 'Manfaat 3 — Judul','type' => 'text',    'placeholder' => 'Meningkatkan Authority Website'],
                        ['key' => 'benefit_3_desc', 'label' => 'Manfaat 3 — Desc','type' => 'textarea', 'placeholder' => 'Meningkatkan reputasi yang tinggi dan dianggap sebagai sumber berita terpercaya.'],
                    ],
                ],
                'what_is' => [
                    'label'  => 'Apa Itu Backlink?',
                    'fields' => [
                        ['key' => 'title',       'label' => 'Judul',          'type' => 'text',     'placeholder' => 'APA ITU BACKLINK'],
                        ['key' => 'subtitle',    'label' => 'Subtitle',        'type' => 'text',     'placeholder' => 'Media Nasional Expertise'],
                        ['key' => 'point_1',     'label' => 'Poin 1',          'type' => 'textarea', 'placeholder' => 'Tautan atau hyperlink strategis yang ditempatkan pada portal berita raksasa di Indonesia.'],
                        ['key' => 'point_2',     'label' => 'Poin 2',          'type' => 'textarea', 'placeholder' => 'Senjata utama untuk memicu algoritma Google agar mengenali website Anda sebagai Otoritas Tinggi.'],
                        ['key' => 'image',       'label' => 'Gambar',          'type' => 'image'],
                    ],
                ],
                'why_us' => [
                    'label'  => 'Mengapa Klien Memilih Kami?',
                    'fields' => [
                        ['key' => 'title',        'label' => 'Judul Section',   'type' => 'text',     'placeholder' => 'Mengapa Klien Memilih Jasa Kontendigital.id?'],
                        ['key' => 'reason_1',     'label' => 'Alasan 1 — Judul','type' => 'text',     'placeholder' => 'Proses Cepat dan Mudah'],
                        ['key' => 'reason_1_desc','label' => 'Alasan 1 — Desc', 'type' => 'textarea', 'placeholder' => 'Tim kami berpengalaman dan profesional sehingga prosesnya bisa dilakukan dengan cepat.'],
                        ['key' => 'reason_2',     'label' => 'Alasan 2 — Judul','type' => 'text',     'placeholder' => 'Garansi 100% Tayang'],
                        ['key' => 'reason_2_desc','label' => 'Alasan 2 — Desc', 'type' => 'textarea', 'placeholder' => 'Garansi tayang di media online, jika tidak bisa tayang kami berikan alternatif media atau full refund.'],
                        ['key' => 'reason_3',     'label' => 'Alasan 3 — Judul','type' => 'text',     'placeholder' => 'Revisi Sepuasnya'],
                        ['key' => 'reason_3_desc','label' => 'Alasan 3 — Desc', 'type' => 'textarea', 'placeholder' => 'Kami memberikan garansi revisi sepuasnya, terutama dalam penulisan artikel jika ada kesalahan dari kami.'],
                        ['key' => 'reason_4',     'label' => 'Alasan 4 — Judul','type' => 'text',     'placeholder' => 'Biaya Murah'],
                        ['key' => 'reason_4_desc','label' => 'Alasan 4 — Desc', 'type' => 'textarea', 'placeholder' => 'Memberikan harga yang super murah tanpa mengorbankan kualitas press release Anda.'],
                        ['key' => 'reason_5',     'label' => 'Alasan 5 — Judul','type' => 'text',     'placeholder' => 'Banyak Pilihan Media'],
                        ['key' => 'reason_5_desc','label' => 'Alasan 5 — Desc', 'type' => 'textarea', 'placeholder' => 'Memiliki lebih dari 200 list media sehingga Anda bisa memilih media sesuai kebutuhan.'],
                        ['key' => 'reason_6',     'label' => 'Alasan 6 — Judul','type' => 'text',     'placeholder' => 'Gratis Penulisan Draft'],
                        ['key' => 'reason_6_desc','label' => 'Alasan 6 — Desc', 'type' => 'textarea', 'placeholder' => 'Jika Anda belum memiliki artikel, kami akan membuatkan draft artikel tanpa biaya tambahan.'],
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
            // LAYANAN: PRESS CONFERENCE
            // ════════════════════════════════════════════════════════════
            'layanan-press-conference' => [
                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'badge_text',  'label' => 'Badge Text',     'type' => 'text',     'placeholder' => '✦ JASA KONFERENSI PERS (KHUSUS JOGJA)'],
                        ['key' => 'title_line1', 'label' => 'Judul Baris 1',  'type' => 'text',     'placeholder' => 'Bersama Wartawan dari'],
                        ['key' => 'title_highlight', 'label' => 'Highlight',  'type' => 'text',     'placeholder' => 'Media Ternama'],
                        ['key' => 'quote',       'label' => 'Kutipan',         'type' => 'text',     'placeholder' => 'Ubah statement menjadi berita nasional dalam sekejap.'],
                        ['key' => 'description', 'label' => 'Deskripsi',       'type' => 'textarea', 'placeholder' => 'Selain membantu mengundang wartawan/media untuk Anda...'],
                        ['key' => 'cta_text',    'label' => 'Teks Tombol',     'type' => 'text',     'placeholder' => 'Konsultasi Sekarang →'],
                        ['key' => 'cta_url',     'label' => 'URL Tombol',      'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                        ['key' => 'image',       'label' => 'Foto Utama',      'type' => 'image'],
                        ['key' => 'badge_1',     'label' => 'Badge Kiri Bawah','type' => 'text',     'placeholder' => '✦ Launching Produk'],
                        ['key' => 'badge_2',     'label' => 'Badge Kanan Atas','type' => 'text',     'placeholder' => '✦ Press Release'],
                    ],
                ],
                'why_needed' => [
                    'label'  => 'Mengapa Dibutuhkan Konferensi Pers?',
                    'fields' => [
                        ['key' => 'title',       'label' => 'Judul Section',  'type' => 'text',     'placeholder' => 'Mengapa Dibutuhkan Konferensi Pers?'],
                        ['key' => 'description', 'label' => 'Deskripsi',      'type' => 'textarea', 'placeholder' => 'Dalam konferensi pers, narasumber bisa menjawab pertanyaan secara langsung dari para wartawan.'],
                        ['key' => 'benefit_1_title','label' => 'Manfaat 1',   'type' => 'text',     'placeholder' => 'Statement / Informasi'],
                        ['key' => 'benefit_1_desc', 'label' => 'Desc 1',      'type' => 'textarea', 'placeholder' => 'Menyatakan suatu statement/informasi ke publik dan menyebarkannya secara luas melalui media.'],
                        ['key' => 'benefit_2_title','label' => 'Manfaat 2',   'type' => 'text',     'placeholder' => 'Launching Produk/Brand'],
                        ['key' => 'benefit_2_desc', 'label' => 'Desc 2',      'type' => 'textarea', 'placeholder' => 'Ingin me-launching produk atau brand dan mengenalkan ke masyarakat luas.'],
                        ['key' => 'benefit_3_title','label' => 'Manfaat 3',   'type' => 'text',     'placeholder' => 'Ajakan Kegiatan Sosial'],
                        ['key' => 'benefit_3_desc', 'label' => 'Desc 3',      'type' => 'textarea', 'placeholder' => 'Mengadakan kegiatan sosial/kemasyarakatan dan mengajak masyarakat luas ikut serta.'],
                        ['key' => 'benefit_4_title','label' => 'Manfaat 4',   'type' => 'text',     'placeholder' => 'Promosi & Pengenalan'],
                        ['key' => 'benefit_4_desc', 'label' => 'Desc 4',      'type' => 'textarea', 'placeholder' => 'Ingin melakukan promosi suatu produk, perusahaan, seminar, atau acara kampus.'],
                        ['key' => 'benefit_5_title','label' => 'Manfaat 5',   'type' => 'text',     'placeholder' => 'Media Laporan Keuangan'],
                        ['key' => 'benefit_5_desc', 'label' => 'Desc 5',      'type' => 'textarea', 'placeholder' => 'Mengumumkan laporan keuangan suatu perusahaan.'],
                        ['key' => 'benefit_6_title','label' => 'Manfaat 6',   'type' => 'text',     'placeholder' => 'Pengumuman Pemerintah'],
                        ['key' => 'benefit_6_desc', 'label' => 'Desc 6',      'type' => 'textarea', 'placeholder' => 'Mengumumkan kebijakan baru pemerintahan.'],
                    ],
                ],
                'prep' => [
                    'label'  => 'Apa yang Perlu Disiapkan?',
                    'fields' => [
                        ['key' => 'title',  'label' => 'Judul Section', 'type' => 'text', 'placeholder' => 'Apa yang Perlu Disiapkan?'],
                        ['key' => 'prep_1', 'label' => 'Persiapan 1',   'type' => 'text', 'placeholder' => 'Menyiapkan ruang press conference (Hotel, Meeting Room, atau Event Hall).'],
                        ['key' => 'prep_2', 'label' => 'Persiapan 2',   'type' => 'text', 'placeholder' => 'Menetapkan Narasumber & Moderator utama.'],
                        ['key' => 'prep_3', 'label' => 'Persiapan 3',   'type' => 'text', 'placeholder' => 'Menyiapkan Key Points atau informasi inti yang akan disampaikan.'],
                        ['key' => 'prep_4', 'label' => 'Persiapan 4',   'type' => 'text', 'placeholder' => 'Fasilitas teknis pendukung (Meja, Sound System, Mic, dll).'],
                    ],
                ],
                'our_work' => [
                    'label'  => 'Apa yang Kami Kerjakan?',
                    'fields' => [
                        ['key' => 'title',  'label' => 'Judul Section', 'type' => 'text', 'placeholder' => 'Apa Saja yang Kami Kerjakan?'],
                        ['key' => 'work_1', 'label' => 'Pekerjaan 1',   'type' => 'text', 'placeholder' => 'Mengatur persiapan & mengundang media.'],
                        ['key' => 'work_2', 'label' => 'Pekerjaan 2',   'type' => 'text', 'placeholder' => 'Distribusi Press Release ke Jaringan Media.'],
                        ['key' => 'work_3', 'label' => 'Pekerjaan 3',   'type' => 'text', 'placeholder' => 'Pembuatan naskah Press Release profesional.'],
                        ['key' => 'work_4', 'label' => 'Pekerjaan 4',   'type' => 'text', 'placeholder' => 'Media monitoring (Follow up penayangan).'],
                        ['key' => 'work_5', 'label' => 'Pekerjaan 5',   'type' => 'text', 'placeholder' => 'Report Link URL & dokumentasi berita.'],
                        ['key' => 'work_6', 'label' => 'Pekerjaan 6',   'type' => 'text', 'placeholder' => 'Konsultasi strategi media.'],
                    ],
                ],
                'cta' => [
                    'label'  => 'CTA Penutup',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul CTA',   'type' => 'text', 'placeholder' => 'Siap Menjadi Headline Besok Pagi?'],
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
                        ['key' => 'badge_text',   'label' => 'Badge Text',      'type' => 'text',     'placeholder' => '✦ JASA PENULIS ARTIKEL SEO'],
                        ['key' => 'title_line1',  'label' => 'Judul Baris 1',   'type' => 'text',     'placeholder' => 'DAPATKAN'],
                        ['key' => 'title_line2',  'label' => 'Judul Baris 2',   'type' => 'text',     'placeholder' => 'KONTEN'],
                        ['key' => 'title_highlight','label' => 'Highlight',     'type' => 'text',     'placeholder' => 'BERKUALITAS'],
                        ['key' => 'quote',         'label' => 'Kutipan',         'type' => 'text',     'placeholder' => 'Ubah ide Anda menjadi konten yang merajai Google.'],
                        ['key' => 'description',   'label' => 'Deskripsi',       'type' => 'textarea', 'placeholder' => 'Jasa penulis artikel SEO, konten media, copywriter, dan script video YouTube/Social Media.'],
                        ['key' => 'cta_text',      'label' => 'Teks Tombol',     'type' => 'text',     'placeholder' => 'KONSULTASI SEKARANG →'],
                        ['key' => 'cta_url',       'label' => 'URL Tombol',      'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                        ['key' => 'image',         'label' => 'Gambar Hero',     'type' => 'image'],
                        ['key' => 'image_2',       'label' => 'Gambar Masalah',  'type' => 'image'],
                        ['key' => 'image_3',       'label' => 'Gambar Topik',    'type' => 'image'],
                    ],
                ],
                'problems' => [
                    'label'  => 'Masalah yang Kami Selesaikan',
                    'fields' => [
                        ['key' => 'title',     'label' => 'Judul Section', 'type' => 'text', 'placeholder' => 'Apakah Anda Mengalami Hal Ini?'],
                        ['key' => 'problem_1', 'label' => 'Masalah 1',     'type' => 'text', 'placeholder' => 'Tidak tahu cara riset kata kunci'],
                        ['key' => 'problem_2', 'label' => 'Masalah 2',     'type' => 'text', 'placeholder' => 'Harga jasa penulisan artikel sangat mahal'],
                        ['key' => 'problem_3', 'label' => 'Masalah 3',     'type' => 'text', 'placeholder' => 'Butuh banyak artikel dalam waktu cepat'],
                        ['key' => 'problem_4', 'label' => 'Masalah 4',     'type' => 'text', 'placeholder' => 'Trauma dengan jasa penulis asal-asalan'],
                        ['key' => 'problem_5', 'label' => 'Masalah 5',     'type' => 'text', 'placeholder' => 'Tidak punya waktu untuk konsisten posting'],
                    ],
                ],
                'why_us' => [
                    'label'  => 'Mengapa Harus Kami?',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul Section', 'type' => 'text', 'placeholder' => 'Mengapa Harus Kami?'],
                        ['key' => 'trust_1',  'label' => 'Keunggulan 1',  'type' => 'text', 'placeholder' => 'Konsultasi Gratis'],
                        ['key' => 'trust_2',  'label' => 'Keunggulan 2',  'type' => 'text', 'placeholder' => 'Penulis Profesional'],
                        ['key' => 'trust_3',  'label' => 'Keunggulan 3',  'type' => 'text', 'placeholder' => 'Lolos Copyright'],
                        ['key' => 'trust_4',  'label' => 'Keunggulan 4',  'type' => 'text', 'placeholder' => 'Revisi Sepuasnya'],
                        ['key' => 'trust_5',  'label' => 'Keunggulan 5',  'type' => 'text', 'placeholder' => 'Harga Kompetitif'],
                        ['key' => 'trust_6',  'label' => 'Keunggulan 6',  'type' => 'text', 'placeholder' => 'Pengerjaan Cepat'],
                    ],
                ],
                'topics' => [
                    'label'  => 'Topik Penulisan',
                    'fields' => [
                        ['key' => 'title',   'label' => 'Judul Section', 'type' => 'text', 'placeholder' => 'Topik Penulisan'],
                        ['key' => 'topic_1', 'label' => 'Topik 1',       'type' => 'text', 'placeholder' => 'Teknologi'],
                        ['key' => 'topic_2', 'label' => 'Topik 2',       'type' => 'text', 'placeholder' => 'Kesehatan'],
                        ['key' => 'topic_3', 'label' => 'Topik 3',       'type' => 'text', 'placeholder' => 'Parenting'],
                        ['key' => 'topic_4', 'label' => 'Topik 4',       'type' => 'text', 'placeholder' => 'Pendidikan'],
                        ['key' => 'topic_5', 'label' => 'Topik 5',       'type' => 'text', 'placeholder' => 'Travel'],
                        ['key' => 'topic_6', 'label' => 'Topik 6',       'type' => 'text', 'placeholder' => 'Otomotif'],
                        ['key' => 'topic_7', 'label' => 'Topik 7',       'type' => 'text', 'placeholder' => 'Kuliner'],
                        ['key' => 'topic_8', 'label' => 'Topik 8',       'type' => 'text', 'placeholder' => 'Lifestyle'],
                    ],
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // LAYANAN: SCRIPT VIDEO
            // ════════════════════════════════════════════════════════════
            'layanan-script-video' => [
                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'badge_text',    'label' => 'Badge Text',       'type' => 'text',     'placeholder' => '✦ JASA SCRIPT VIDEO PROFESIONAL'],
                        ['key' => 'title_line1',   'label' => 'Judul Baris 1',    'type' => 'text',     'placeholder' => 'BUAT VIDEO'],
                        ['key' => 'title_line2',   'label' => 'Judul Baris 2',    'type' => 'text',     'placeholder' => 'YANG LEBIH'],
                        ['key' => 'title_highlight','label' => 'Highlight',       'type' => 'text',     'placeholder' => 'BERPENGARUH'],
                        ['key' => 'quote',          'label' => 'Kutipan',          'type' => 'text',     'placeholder' => 'Ubah konsep Anda menjadi naskah yang menginspirasi audiens.'],
                        ['key' => 'description',    'label' => 'Deskripsi',        'type' => 'textarea', 'placeholder' => 'Kontendigital.id menciptakan script video yang tidak hanya menarik perhatian...'],
                        ['key' => 'cta_text',       'label' => 'Teks Tombol',      'type' => 'text',     'placeholder' => 'KONSULTASI SEKARANG →'],
                        ['key' => 'cta_url',        'label' => 'URL Tombol',       'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                        ['key' => 'image',          'label' => 'Gambar Hero',      'type' => 'image'],
                        ['key' => 'bubble_text',    'label' => 'Teks Bubble Chat', 'type' => 'text',     'placeholder' => 'GREAT SCRIPT!!!'],
                    ],
                ],
                'why_us' => [
                    'label'  => 'Kenapa Memilih Kami?',
                    'fields' => [
                        ['key' => 'title',         'label' => 'Judul Section',   'type' => 'text',     'placeholder' => 'Kenapa Memilih Kami?'],
                        ['key' => 'reason_1_title','label' => 'Alasan 1 — Judul','type' => 'text',     'placeholder' => 'Penulis Berpengalaman'],
                        ['key' => 'reason_1_desc', 'label' => 'Alasan 1 — Desc', 'type' => 'textarea', 'placeholder' => 'Tim kami terdiri dari penulis yang telah berpengalaman lebih dari 15 tahun.'],
                        ['key' => 'reason_2_title','label' => 'Alasan 2 — Judul','type' => 'text',     'placeholder' => 'Tim Kreatif'],
                        ['key' => 'reason_2_desc', 'label' => 'Alasan 2 — Desc', 'type' => 'textarea', 'placeholder' => 'Kami mengerti betapa pentingnya ide-ide segar dan orisinal dalam dunia hiburan.'],
                        ['key' => 'reason_3_title','label' => 'Alasan 3 — Judul','type' => 'text',     'placeholder' => 'Sesuai Kebutuhan'],
                        ['key' => 'reason_3_desc', 'label' => 'Alasan 3 — Desc', 'type' => 'textarea', 'placeholder' => 'Kami menyesuaikan penulisan sesuai dengan gaya Anda, baik iklan maupun YouTube.'],
                        ['key' => 'reason_4_title','label' => 'Alasan 4 — Judul','type' => 'text',     'placeholder' => 'Kolaboratif'],
                        ['key' => 'reason_4_desc', 'label' => 'Alasan 4 — Desc', 'type' => 'textarea', 'placeholder' => 'Kami selalu terbuka untuk feedback dan revisi demi hasil yang sempurna.'],
                    ],
                ],
                'services_list' => [
                    'label'  => 'Daftar Layanan Script',
                    'fields' => [
                        ['key' => 'title',        'label' => 'Judul Section',    'type' => 'text',     'placeholder' => 'Layanan Kami'],
                        ['key' => 'service_1',    'label' => 'Layanan 1 — Judul','type' => 'text',     'placeholder' => 'Script Video Pendek'],
                        ['key' => 'service_1_desc','label' => 'Layanan 1 — Desc','type' => 'textarea', 'placeholder' => 'Buat video pendek yang mengesankan dengan naskah yang kuat.'],
                        ['key' => 'service_2',    'label' => 'Layanan 2 — Judul','type' => 'text',     'placeholder' => 'Script Perusahaan'],
                        ['key' => 'service_2_desc','label' => 'Layanan 2 — Desc','type' => 'textarea', 'placeholder' => 'Menciptakan script yang menggambarkan nilai dan visi perusahaan.'],
                        ['key' => 'service_3',    'label' => 'Layanan 3 — Judul','type' => 'text',     'placeholder' => 'Script Video Iklan'],
                        ['key' => 'service_3_desc','label' => 'Layanan 3 — Desc','type' => 'textarea', 'placeholder' => 'Buat iklan yang mencuri perhatian dan meningkatkan konversi.'],
                        ['key' => 'service_4',    'label' => 'Layanan 4 — Judul','type' => 'text',     'placeholder' => 'Script YouTube'],
                        ['key' => 'service_4_desc','label' => 'Layanan 4 — Desc','type' => 'textarea', 'placeholder' => 'Script yang tepat untuk vlog, tutorial, atau cerita konten Anda.'],
                        ['key' => 'service_5',    'label' => 'Layanan 5 — Judul','type' => 'text',     'placeholder' => 'Script Sosmed'],
                        ['key' => 'service_5_desc','label' => 'Layanan 5 — Desc','type' => 'textarea', 'placeholder' => 'Script menarik yang mendukung video sosial media Anda viral.'],
                        ['key' => 'service_6',    'label' => 'Layanan 6 — Judul','type' => 'text',     'placeholder' => 'Script Dokumenter'],
                        ['key' => 'service_6_desc','label' => 'Layanan 6 — Desc','type' => 'textarea', 'placeholder' => 'Penulisan naskah video dokumenter yang informatif.'],
                    ],
                ],
                'process' => [
                    'label'  => 'Proses Kerja',
                    'fields' => [
                        ['key' => 'title',       'label' => 'Judul Section',    'type' => 'text',     'placeholder' => 'Proses Kerja'],
                        ['key' => 'step_1_title','label' => 'Langkah 1 — Judul','type' => 'text',     'placeholder' => 'KONSULTASI AWAL'],
                        ['key' => 'step_1_desc', 'label' => 'Langkah 1 — Desc', 'type' => 'textarea', 'placeholder' => 'Memahami visi, tujuan, dan target audiens Anda.'],
                        ['key' => 'step_2_title','label' => 'Langkah 2 — Judul','type' => 'text',     'placeholder' => 'RANCANG KONSEP'],
                        ['key' => 'step_2_desc', 'label' => 'Langkah 2 — Desc', 'type' => 'textarea', 'placeholder' => 'Mengembangkan konsep cerita dan struktur naskah.'],
                        ['key' => 'step_3_title','label' => 'Langkah 3 — Judul','type' => 'text',     'placeholder' => 'PENULISAN DRAFT'],
                        ['key' => 'step_3_desc', 'label' => 'Langkah 3 — Desc', 'type' => 'textarea', 'placeholder' => 'Menulis draft pertama naskah untuk review Anda.'],
                        ['key' => 'step_4_title','label' => 'Langkah 4 — Judul','type' => 'text',     'placeholder' => 'REVISI & FINAL'],
                        ['key' => 'step_4_desc', 'label' => 'Langkah 4 — Desc', 'type' => 'textarea', 'placeholder' => 'Melakukan revisi hingga naskah siap untuk produksi.'],
                        ['key' => 'step_5_title','label' => 'Langkah 5 — Judul','type' => 'text',     'placeholder' => 'DUKUNGAN PRODUKSI'],
                        ['key' => 'step_5_desc', 'label' => 'Langkah 5 — Desc', 'type' => 'textarea', 'placeholder' => 'Mendampingi proses produksi untuk hasil sempurna.'],
                    ],
                ],
            ],

            // ════════════════════════════════════════════════════════════
            // LAYANAN: PELATIHAN KONTEN KREATOR
            // ════════════════════════════════════════════════════════════
            'layanan-pelatihan-konten' => [
                'hero' => [
                    'label'  => 'Hero Section',
                    'fields' => [
                        ['key' => 'badge_text',   'label' => 'Badge Text',       'type' => 'text',     'placeholder' => '✦ UPGRADE SKILL KONTEN KREATORMU'],
                        ['key' => 'title_line1',  'label' => 'Judul Baris 1',    'type' => 'text',     'placeholder' => 'Ciptakan Konten'],
                        ['key' => 'title_highlight','label' => 'Highlight',      'type' => 'text',     'placeholder' => 'Inovatif'],
                        ['key' => 'title_line2',  'label' => 'Judul Baris 2',    'type' => 'text',     'placeholder' => 'dengan Smartphone'],
                        ['key' => 'quote',         'label' => 'Kutipan',          'type' => 'text',     'placeholder' => 'Ubah perangkat harian Anda menjadi mesin produksi konten profesional.'],
                        ['key' => 'description',   'label' => 'Deskripsi',        'type' => 'textarea', 'placeholder' => 'Ikuti pelatihan konten kreator bersama Kontendigital.id.'],
                        ['key' => 'cta_text',      'label' => 'Teks Tombol',      'type' => 'text',     'placeholder' => 'KONSULTASI SEKARANG →'],
                        ['key' => 'cta_url',       'label' => 'URL Tombol',       'type' => 'text',     'placeholder' => 'https://wa.me/6287786000919'],
                        ['key' => 'image',         'label' => 'Gambar Hero',      'type' => 'image'],
                        ['key' => 'badge_cert',    'label' => 'Badge Sertifikasi','type' => 'text',     'placeholder' => 'Pengajar Bersertifikasi BNSP'],
                        ['key' => 'badge_live',    'label' => 'Badge Live',       'type' => 'text',     'placeholder' => '✦ LIVE WORKSHOP'],
                    ],
                ],
                'why_join' => [
                    'label'  => 'Mengapa Harus Ikut?',
                    'fields' => [
                        ['key' => 'title',         'label' => 'Judul Section',   'type' => 'text',     'placeholder' => 'Mengapa Harus Ikut Pelatihan Kami?'],
                        ['key' => 'reason_1_title','label' => 'Alasan 1 — Judul','type' => 'text',     'placeholder' => 'Belajar Dari Ahlinya'],
                        ['key' => 'reason_1_desc', 'label' => 'Alasan 1 — Desc', 'type' => 'textarea', 'placeholder' => 'Tim pengajar kami adalah mantan produser senior TV nasional dengan pengalaman lebih dari 20 tahun.'],
                        ['key' => 'reason_2_title','label' => 'Alasan 2 — Judul','type' => 'text',     'placeholder' => 'Pengajar BNSP'],
                        ['key' => 'reason_2_desc', 'label' => 'Alasan 2 — Desc', 'type' => 'textarea', 'placeholder' => 'Tim bersertifikasi Badan Nasional Sertifikasi Profesi (BNSP) dengan gelar Certified Content Creator.'],
                        ['key' => 'reason_3_title','label' => 'Alasan 3 — Judul','type' => 'text',     'placeholder' => 'Materi Komprehensif'],
                        ['key' => 'reason_3_desc', 'label' => 'Alasan 3 — Desc', 'type' => 'textarea', 'placeholder' => 'Mencakup seluruh aspek creation mulai dari teknik pengambilan gambar hingga strategi engagement.'],
                        ['key' => 'reason_4_title','label' => 'Alasan 4 — Judul','type' => 'text',     'placeholder' => 'Metode Fleksibel'],
                        ['key' => 'reason_4_desc', 'label' => 'Alasan 4 — Desc', 'type' => 'textarea', 'placeholder' => 'Tersedia format kolektif maupun privat, cocok untuk perusahaan, instansi, maupun UMKM.'],
                    ],
                ],
                'modules' => [
                    'label'  => 'Modul Materi Pelatihan',
                    'fields' => [
                        ['key' => 'title',        'label' => 'Judul Section',   'type' => 'text',     'placeholder' => 'Apa Saja Materi Pelatihan Kami?'],
                        ['key' => 'module_1_title','label' => 'Modul 1 — Judul','type' => 'text',     'placeholder' => 'Modul 1: Pengenalan Dunia Konten Kreator'],
                        ['key' => 'module_1_desc', 'label' => 'Modul 1 — Desc', 'type' => 'textarea', 'placeholder' => 'Niche content, personal branding, dan peran kreator di industri digital.'],
                        ['key' => 'module_2_title','label' => 'Modul 2 — Judul','type' => 'text',     'placeholder' => 'Modul 2: Persiapan dan Perencanaan'],
                        ['key' => 'module_2_desc', 'label' => 'Modul 2 — Desc', 'type' => 'textarea', 'placeholder' => 'Ide konten, scriptwriting yang efektif, riset audiens, dan pembuatan storyboard.'],
                        ['key' => 'module_3_title','label' => 'Modul 3 — Judul','type' => 'text',     'placeholder' => 'Modul 3: Produksi Konten'],
                        ['key' => 'module_3_desc', 'label' => 'Modul 3 — Desc', 'type' => 'textarea', 'placeholder' => 'Teknik kamera (angle, framing, lighting) dan penggunaan aksesoris smartphone.'],
                        ['key' => 'module_4_title','label' => 'Modul 4 — Judul','type' => 'text',     'placeholder' => 'Modul 4: Editing Video dengan Smartphone'],
                        ['key' => 'module_4_desc', 'label' => 'Modul 4 — Desc', 'type' => 'textarea', 'placeholder' => 'Pengenalan aplikasi CapCut, dasar editing, transisi, musik, dan color correction.'],
                        ['key' => 'module_5_title','label' => 'Modul 5 — Judul','type' => 'text',     'placeholder' => 'Modul 5: Distribusi dan Promosi Video'],
                        ['key' => 'module_5_desc', 'label' => 'Modul 5 — Desc', 'type' => 'textarea', 'placeholder' => 'Optimasi video untuk platform YouTube, Instagram, TikTok, dan Facebook.'],
                        ['key' => 'module_6_title','label' => 'Modul 6 — Judul','type' => 'text',     'placeholder' => 'Modul 6: Cuan dari Ngonten'],
                        ['key' => 'module_6_desc', 'label' => 'Modul 6 — Desc', 'type' => 'textarea', 'placeholder' => 'Strategi monetisasi, affiliate marketing, endorse, dan penjualan produk/jasa.'],
                    ],
                ],
                'targets' => [
                    'label'  => 'Siapa yang Cocok?',
                    'fields' => [
                        ['key' => 'title',        'label' => 'Judul Section',    'type' => 'text',     'placeholder' => 'Siapa Saja yang Cocok?'],
                        ['key' => 'target_1',     'label' => 'Target 1 — Judul', 'type' => 'text',     'placeholder' => 'Perusahaan Profesional'],
                        ['key' => 'target_1_desc','label' => 'Target 1 — Desc',  'type' => 'textarea', 'placeholder' => 'Perusahaan yang concern terhadap konten (properti, travel, RS, dsb).'],
                        ['key' => 'target_2',     'label' => 'Target 2 — Judul', 'type' => 'text',     'placeholder' => 'Instansi & Lembaga'],
                        ['key' => 'target_2_desc','label' => 'Target 2 — Desc',  'type' => 'textarea', 'placeholder' => 'Sekolah, ponpes, universitas, dan lembaga pemerintahan.'],
                        ['key' => 'target_3',     'label' => 'Target 3 — Judul', 'type' => 'text',     'placeholder' => 'Individu Kreator'],
                        ['key' => 'target_3_desc','label' => 'Target 3 — Desc',  'type' => 'textarea', 'placeholder' => 'Individu yang ingin menjadi kreator profesional atau meningkatkan kompetensi.'],
                        ['key' => 'target_4',     'label' => 'Target 4 — Judul', 'type' => 'text',     'placeholder' => 'Business Owner & UMKM'],
                        ['key' => 'target_4_desc','label' => 'Target 4 — Desc',  'type' => 'textarea', 'placeholder' => 'Pemilik bisnis yang ingin mempromosikan produk melalui konten kreatif.'],
                    ],
                ],
                'cta' => [
                    'label'  => 'CTA Penutup',
                    'fields' => [
                        ['key' => 'title',    'label' => 'Judul CTA',   'type' => 'text', 'placeholder' => 'SIAP JADI KREATOR?'],
                        ['key' => 'cta_text', 'label' => 'Teks Tombol', 'type' => 'text', 'placeholder' => 'HUBUNGI KAMI SEKARANG →'],
                        ['key' => 'cta_url',  'label' => 'URL Tombol',  'type' => 'text', 'placeholder' => 'https://wa.me/6287786000919'],
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