<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $latestArticles = Article::published()->latest('published_at')->limit(6)->get();
        return view('home', compact('latestArticles'));
    }

    public function services()
    {
        $services = [
            ['title' => 'Jasa Press Release',   'slug' => 'press-release'],
            ['title' => 'Jasa Backlink Media',  'slug' => 'backlink'],
            ['title' => 'Press Conference',     'slug' => 'press-conference'],
            ['title' => 'Penulisan Artikel',    'slug' => 'penulisan-artikel'],
            ['title' => 'Script Video',         'slug' => 'script-video'],
            ['title' => 'Pelatihan Konten',     'slug' => 'pelatihan-konten'],
        ];

        return view('layanan.index', compact('services'));
    }

    public function pricing()
    {
        $packages = [
            [
                'name'      => 'Starter',
                'price'     => '299.000',
                'period'    => '/ bulan',
                'badge'     => null,
                'highlight' => false,
                'cta'       => 'Pesan Sekarang',
                'features'  => [
                    '5 artikel per bulan',
                    'DA 20–40',
                    'Garansi tayang 7 hari',
                    'Laporan URL terbit',
                ],
            ],
            [
                'name'      => 'Pro',
                'price'     => '699.000',
                'period'    => '/ bulan',
                'badge'     => '⭐ Terlaris',
                'highlight' => true,
                'cta'       => 'Pilih Paket Pro',
                'features'  => [
                    '15 artikel per bulan',
                    'DA 40–60',
                    'Garansi tayang 3 hari',
                    'Laporan URL terbit',
                    'Konsultasi SEO 1x/bulan',
                ],
            ],
            [
                'name'      => 'Enterprise',
                'price'     => '1.499.000',
                'period'    => '/ bulan',
                'badge'     => null,
                'highlight' => false,
                'cta'       => 'Hubungi Kami',
                'features'  => [
                    '40 artikel per bulan',
                    'DA 60+',
                    'Garansi tayang 24 jam',
                    'Laporan URL terbit',
                    'Dedicated account manager',
                    'Konsultasi SEO unlimited',
                ],
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
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'required|string|max:20',
            'email'   => 'required|email|max:150',
            'service' => 'required|string',
            'message' => 'required|string|min:10',
        ]);

        Mail::to('nugrahafirizki@gmail.com')
            ->send(new ContactMail(
                senderName:  $validated['name'],
                senderEmail: $validated['email'],
                senderPhone: $validated['phone'],
                service:     $validated['service'],
                userMessage: $validated['message'],
            ));

        return back()->with('success', '✅ Pesan berhasil dikirim! Kami akan menghubungi Anda segera.');
    }
}