<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

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

        // Simpan ke database agar muncul di admin panel
        ContactSubmission::create([
            'name'       => $validated['name'],
            'whatsapp'   => $validated['phone'],
            'email'      => $validated['email'],
            'service'    => $validated['service'],
            'message'    => $validated['message'],
            'ip_address' => $request->ip(),
            'status'     => 'new',
        ]);

        // Redirect ke WhatsApp dengan pesan otomatis
        $text = "Halo, ada pesan masuk dari website:%0A%0A"
              . "*Nama:* {$validated['name']}%0A"
              . "*No. WA:* {$validated['phone']}%0A"
              . "*Email:* {$validated['email']}%0A"
              . "*Layanan:* {$validated['service']}%0A"
              . "*Pesan:* {$validated['message']}";

        return redirect("https://wa.me/6285693795510?text={$text}");
    }

    public function pressRelease()
    {
        return view('layanan.press-release');
    }

    public function backlink()
    {
        return view('layanan.backlink');
    }

    public function pressConference()
    {
        return view('layanan.press-conference');
    }

    public function penulisanArtikel()
    {
        return view('layanan.penulisan-artikel');
    }

    public function scriptVideo()
    {
        return view('layanan.script-video');
    }

    public function pelatihanKonten()
    {
        return view('layanan.pelatihan-konten');
    }

    public function caraOrder()
    {
        return view('pages.cara-order');
    }

    public function syaratKetentuan()
    {
        return view('pages.syarat-ketentuan');
    }
}