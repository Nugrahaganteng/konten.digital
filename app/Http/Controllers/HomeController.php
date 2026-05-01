<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function services()
    {
        $services = [
            [
                'slug'  => 'press-release',
                'icon'  => '✦',
                'title' => 'Press Release',
                'badge' => 'TERPOPULER',
                'short' => 'Publikasi berita perusahaan ke 200+ media online nasional ternama Indonesia.',
                'desc'  => 'Berbagai urusan publikasi bisnis — launching produk, event, CSR, hingga klarifikasi masalah perusahaan — kini bisa dilakukan dengan mudah dan cepat melalui jasa press release kami.',
                'benefits' => [
                    'Garansi tayang atau full refund',
                    'Terbit dalam 1–3 hari kerja',
                    'Gratis pembuatan artikel jika belum punya',
                    'Revisi sepuasnya jika ada kesalahan dari kami',
                    '200+ pilihan media nasional & daerah',
                ],
            ],
            [
                'slug'  => 'backlink-media',
                'icon'  => '◈',
                'title' => 'Backlink Media Nasional',
                'badge' => 'SEO BOOST',
                'short' => 'Backlink berkualitas dari portal berita nasional untuk SEO website Anda.',
                'desc'  => 'Backlink media nasional adalah tautan hyperlink dari website media berita ternama ke website Anda. Meningkatkan otoritas domain, peringkat SEO, dan visibilitas di mesin pencari Google.',
                'benefits' => [
                    'Backlink dari media DA tinggi',
                    'Permanent link (tidak dihapus)',
                    'Pilihan media sesuai niche bisnis',
                    'Laporan URL penempatan backlink',
                    'Konsultasi pemilihan media gratis',
                ],
            ],
            [
                'slug'  => 'penulisan-artikel',
                'icon'  => '❋',
                'title' => 'Penulisan Artikel',
                'badge' => '',
                'short' => 'Artikel SEO berkualitas oleh penulis berpengalaman 15+ tahun.',
                'desc'  => 'Kami menyediakan berbagai jenis konten, mulai dari artikel ringan hingga yang membutuhkan riset mendalam. Penulis berpengalaman kami memastikan konten Anda relevan, informatif, dan SEO-friendly.',
                'benefits' => [
                    'Penulis berpengalaman 15+ tahun',
                    'SEO-optimized & terstruktur',
                    'Riset mendalam sesuai topik',
                    'Revisi gratis hingga puas',
                    'Pengerjaan cepat sesuai deadline',
                ],
            ],
            [
                'slug'  => 'press-conference',
                'icon'  => '◉',
                'title' => 'Press Conference',
                'badge' => '',
                'short' => 'Konferensi pers yang terorganisir & profesional untuk perusahaan Anda.',
                'desc'  => 'Kami mengorganisir konferensi pers yang efektif untuk menyampaikan pesan penting perusahaan Anda kepada media dan audiens dengan cara yang paling profesional dan berdampak.',
                'benefits' => [
                    'Koordinasi undangan media',
                    'Penyusunan materi & talking points',
                    'Dokumentasi & liputan media',
                    'Follow-up distribusi press release',
                    'Tim berpengalaman di industri PR',
                ],
            ],
            [
                'slug'  => 'script-video',
                'icon'  => '◆',
                'title' => 'Script Video / TV',
                'badge' => '',
                'short' => 'Naskah video profesional untuk YouTube, TV, dan media sosial.',
                'desc'  => 'Tim kami terdiri dari penulis yang telah berpengalaman lebih dari 15 tahun dalam industri video dan televisi. Kami siap memberikan konsep-konsep baru yang menarik dan disesuaikan kebutuhan Anda.',
                'benefits' => [
                    'Pengalaman 15+ tahun industri TV',
                    'Konsep orisinal & kreatif',
                    'Disesuaikan karakter brand Anda',
                    'Cocok untuk iklan, YouTube, TikTok',
                    'Revisi hingga sesuai visi Anda',
                ],
            ],
            [
                'slug'  => 'pelatihan',
                'icon'  => '✧',
                'title' => 'Pelatihan Konten Kreator',
                'badge' => 'BARU',
                'short' => 'Tingkatkan skill tim konten Anda dengan pelatihan dari praktisi media.',
                'desc'  => 'Program pelatihan konten kreator yang dipandu langsung oleh praktisi media berpengalaman. Materi mencakup penulisan, storytelling, SEO, dan strategi distribusi konten digital.',
                'benefits' => [
                    'Trainer praktisi media berpengalaman',
                    'Materi up-to-date & praktis',
                    'Online & offline tersedia',
                    'Sertifikat pelatihan',
                    'Materi disesuaikan kebutuhan tim',
                ],
            ],
        ];

        return view('services', compact('services'));
    }

    public function pricing()
    {
        $packages = [
            [
                'name'     => 'Starter',
                'price'    => '299.000',
                'period'   => '/ press release',
                'highlight'=> false,
                'badge'    => '',
                'features' => [
                    '1 Media Online Daerah',
                    'Gratis Pembuatan Artikel',
                    'Terbit 1–3 Hari Kerja',
                    'Laporan URL Tayang',
                    'Garansi Tayang / Refund',
                ],
                'cta'      => 'Pesan Sekarang',
            ],
            [
                'name'     => 'Reguler',
                'price'    => '599.000',
                'period'   => '/ press release',
                'highlight'=> true,
                'badge'    => 'TERPOPULER',
                'features' => [
                    '3 Media Nasional Pilihan',
                    'Gratis Pembuatan Artikel',
                    'Terbit 1–2 Hari Kerja',
                    'Laporan URL + Screenshot',
                    'Garansi Tayang / Refund',
                    'Revisi Sepuasnya',
                    'Konsultasi Pemilihan Media',
                ],
                'cta'      => 'Pesan Sekarang',
            ],
            [
                'name'     => 'Premium',
                'price'    => '1.499.000',
                'period'   => '/ press release',
                'highlight'=> false,
                'badge'    => 'BEST VALUE',
                'features' => [
                    '10 Media Nasional Tier-1',
                    'Gratis Penulisan Artikel Pro',
                    'Terbit dalam 1 Hari Kerja',
                    'Laporan URL + Screenshot',
                    'Garansi Tayang / Full Refund',
                    'Revisi Sepuasnya',
                    'Konsultasi Prioritas',
                    'Include Kompas / Detik / Tribun',
                ],
                'cta'      => 'Pesan Sekarang',
            ],
        ];

        return view('pricing', compact('packages'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:20',
            'service' => 'required|string',
            'message' => 'required|string|min:20',
        ]);

        // Kirim email / notifikasi WA di sini
        // Mail::to('hello@kontendigital.id')->send(new ContactMail($request->all()));

        return back()->with('success', 'Pesan Anda telah terkirim! Tim kami akan menghubungi Anda segera.');
    }
}