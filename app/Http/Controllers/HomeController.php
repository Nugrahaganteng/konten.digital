<?php

namespace App\Http\Controllers;

use App\Models\PageSection;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\ClientLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    // ══════════════════════════════════════════════════════════════════
    // ── HELPER: Load PageSections untuk satu halaman
    // ══════════════════════════════════════════════════════════════════

    private function sections(string $page): \Illuminate\Support\Collection
    {
        return PageSection::ofPage($page);
    }

    // ══════════════════════════════════════════════════════════════════
    // ── HELPER: Bangun array data SEO per halaman
    //
    //  Semua parameter punya default value agar tidak pernah kosong.
    //  Variabel yang di-pass ke Blade:
    //    $seoTitle       → judul halaman
    //    $seoDescription → deskripsi 150–160 karakter
    //    $seoKeywords    → kata kunci dipisah koma
    //    $seoImage       → URL gambar OG 1200×630px
    //    $seoType        → 'website' | 'article'
    //    $seoNoindex     → true = tidak diindeks Google
    // ══════════════════════════════════════════════════════════════════

    private function seo(
        string $title       = 'HNP Communications | Jasa PR & Digital Marketing Indonesia',
        string $description = 'HNP Communications melayani jasa Press Release, Backlink, Press Conference, Penulisan Artikel SEO, Buzzer, dan Pelatihan Konten Kreator di Indonesia.',
        string $keywords    = '',
        string $image       = '',
        string $type        = 'website',
        bool   $noindex     = false
    ): array {
        return [
            'seoTitle'       => $title,
            'seoDescription' => $description,
            'seoKeywords'    => $keywords ?: 'jasa PR, press release, backlink, digital marketing Indonesia, HNP Communications',
            'seoImage'       => $image    ?: asset('images/og-default.jpg'),
            'seoType'        => $type,
            'seoNoindex'     => $noindex,
        ];
    }

    // ══════════════════════════════════════════════════════════════════
    // ── HOME
    // ══════════════════════════════════════════════════════════════════

    public function index()
    {
        $seo = $this->seo(
            title:       'Jasa PR & Digital Marketing Profesional Indonesia',
            description: 'HNP Communications melayani jasa Press Release, Backlink, Press Conference, Penulisan Artikel SEO, Buzzer Indonesia, dan Pelatihan Konten Kreator. Tingkatkan eksposur brand Anda sekarang.',
            keywords:    'jasa press release Indonesia, jasa backlink berkualitas, jasa PR profesional, digital marketing agency, penulisan artikel SEO, jasa buzzer Indonesia, pelatihan konten kreator, HNP Communications',
            image:       asset('images/og-home.jpg'),
        );

        $sections     = $this->sections('home');
        $services     = Service::where('is_active', true)->orderBy('order')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order')->get();
        $faqs         = Faq::where('is_active', true)->orderBy('order')->get();
        $clients      = ClientLogo::where('is_active', true)->orderBy('order')->get();

        return view('pages.home', array_merge(
            compact('sections', 'services', 'testimonials', 'faqs', 'clients'),
            $seo
        ));
    }

    // ══════════════════════════════════════════════════════════════════
    // ── ABOUT
    // ══════════════════════════════════════════════════════════════════

    public function about()
    {
        $seo = $this->seo(
            title:       'Tentang Kami',
            description: 'Kenali HNP Communications — tim PR dan digital marketing profesional berpengalaman yang siap membantu brand Anda tampil di media nasional dan digital Indonesia.',
            keywords:    'tentang HNP Communications, profil perusahaan PR, tim digital marketing profesional Indonesia, agency PR terpercaya Bogor',
            image:       asset('images/og-about.jpg'),
        );

        $sections = $this->sections('about');

        return view('about', array_merge(compact('sections'), $seo));
    }

    // ══════════════════════════════════════════════════════════════════
    // ── CONTACT
    // ══════════════════════════════════════════════════════════════════

    public function contact()
    {
        $seo = $this->seo(
            title:       'Hubungi Kami',
            description: 'Konsultasikan kebutuhan PR dan digital marketing Anda bersama HNP Communications. Kami siap membantu meningkatkan eksposur brand Anda di media nasional.',
            keywords:    'kontak HNP Communications, konsultasi PR gratis, hubungi digital marketing agency Indonesia, WhatsApp HNP Communications',
            image:       asset('images/og-contact.jpg'),
        );

        $sections = $this->sections('contact');

        return view('contact', array_merge(compact('sections'), $seo));
    }

    // ══════════════════════════════════════════════════════════════════
    // ── SEND CONTACT
    // ══════════════════════════════════════════════════════════════════

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => ['required', 'string', 'max:15', 'regex:/^[0-9+]+$/'],
            'service' => 'required|string',
            'message' => 'required|string|min:10',
        ], [
            'name.required'    => 'Nama lengkap wajib diisi.',
            'email.required'   => 'Alamat email wajib diisi.',
            'email.email'      => 'Format email tidak valid.',
            'phone.required'   => 'No. WhatsApp wajib diisi.',
            'phone.regex'      => 'No. WhatsApp hanya boleh berisi angka dan tanda +.',
            'service.required' => 'Pilih layanan yang dibutuhkan.',
            'message.required' => 'Detail kebutuhan wajib diisi.',
            'message.min'      => 'Detail kebutuhan minimal 10 karakter.',
        ]);

        \App\Models\ContactSubmission::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'whatsapp' => $validated['phone'],
            'service'  => $validated['service'],
            'message'  => $validated['message'],
        ]);

        $this->sendWhatsAppNotification($validated);

        $adminWaNumber = '6283871325422';
        $text = "Halo HNP Communications.id!\n\n"
              . "Saya ingin berkonsultasi mengenai layanan Anda.\n\n"
              . "*Nama*    : {$validated['name']}\n"
              . "*No. HP*  : {$validated['phone']}\n"
              . "*Email*   : {$validated['email']}\n"
              . "*Layanan* : {$validated['service']}\n\n"
              . "*Kebutuhan Saya*:\n{$validated['message']}\n\n"
              . "Mohon informasinya, terima kasih!";

        return redirect("https://wa.me/{$adminWaNumber}?text=" . urlencode($text));
    }

    private function sendWhatsAppNotification(array $data): void
    {
        $token = env('FONNTE_TOKEN');
        if (empty($token)) {
            Log::warning('FONNTE_TOKEN belum diset di .env');
            return;
        }

        $message = "📩 *PESAN BARU MASUK!*\n\n"
                 . "👤 *Nama*    : {$data['name']}\n"
                 . "📧 *Email*   : {$data['email']}\n"
                 . "📱 *No. HP*  : {$data['phone']}\n"
                 . "🛠 *Layanan* : {$data['service']}\n"
                 . "💬 *Pesan*   :\n{$data['message']}\n\n"
                 . "─────────────────────\n"
                 . "⏰ " . now()->format('d/m/Y H:i') . " WIB\n"
                 . "_HNP Communications.id_";

        try {
            $ch = curl_init('https://api.fonnte.com/send');
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST           => true,
                CURLOPT_HTTPHEADER     => ["Authorization: {$token}"],
                CURLOPT_POSTFIELDS     => [
                    'target'      => '083871325422',
                    'message'     => $message,
                    'countryCode' => '62',
                ],
            ]);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($httpCode !== 200) {
                Log::error('Fonnte API error', ['http_code' => $httpCode, 'response' => $response]);
            }
        } catch (\Exception $e) {
            Log::error('Fonnte exception: ' . $e->getMessage());
        }
    }

    // ══════════════════════════════════════════════════════════════════
    // ── CARA ORDER
    // ══════════════════════════════════════════════════════════════════

    public function caraOrder()
    {
        $seo = $this->seo(
            title:       'Cara Order',
            description: 'Pelajari cara memesan layanan PR dan digital marketing HNP Communications dengan mudah dan cepat. Proses pemesanan hanya dalam beberapa langkah sederhana.',
            keywords:    'cara order jasa PR, cara pesan press release, cara pesan backlink, cara order digital marketing HNP Communications',
            image:       asset('images/og-cara-order.jpg'),
        );

        $sections = $this->sections('cara-order');

        return view('pages.cara-order', array_merge(compact('sections'), $seo));
    }

    // ══════════════════════════════════════════════════════════════════
    // ── SYARAT & KETENTUAN
    // ══════════════════════════════════════════════════════════════════

    public function syaratKetentuan()
    {
        $seo = $this->seo(
            title:       'Syarat & Ketentuan',
            description: 'Baca syarat dan ketentuan penggunaan layanan HNP Communications sebelum melakukan pemesanan. Kami berkomitmen pada transparansi dan kepercayaan klien.',
            keywords:    'syarat ketentuan HNP Communications, kebijakan layanan PR, terms and conditions digital marketing',
            image:       asset('images/og-default.jpg'),
        );

        $sections = $this->sections('syarat-ketentuan');

        return view('pages.syarat-ketentuan', array_merge(compact('sections'), $seo));
    }

    // ══════════════════════════════════════════════════════════════════
    // ── LAYANAN: PRESS RELEASE
    // ══════════════════════════════════════════════════════════════════

    public function pressRelease()
    {
        $seo = $this->seo(
            title:       'Jasa Press Release Indonesia',
            description: 'Layanan jasa press release profesional HNP Communications. Rilis berita brand Anda ke ratusan media online terpercaya di Indonesia dengan harga terjangkau dan proses cepat.',
            keywords:    'jasa press release Indonesia, harga press release murah, distribusi press release media online, rilis berita perusahaan, press release 200 media',
            image:       asset('images/og-press-release.jpg'),
        );

        $sections = $this->sections('layanan-press-release');

        return view('layanan.press-release', array_merge(compact('sections'), $seo));
    }

    // ══════════════════════════════════════════════════════════════════
    // ── LAYANAN: BACKLINK
    // ══════════════════════════════════════════════════════════════════

    public function backlink()
    {
        $seo = $this->seo(
            title:       'Jasa Backlink Berkualitas Indonesia',
            description: 'Tingkatkan otoritas domain website Anda dengan jasa backlink berkualitas tinggi dari HNP Communications. Backlink dari media dan situs terpercaya, aman dan bergaransi.',
            keywords:    'jasa backlink Indonesia, backlink berkualitas, backlink dari media nasional, jasa SEO backlink, tingkatkan DA PA website',
            image:       asset('images/og-backlink.jpg'),
        );

        $sections = $this->sections('layanan-backlink');

        return view('layanan.backlink', array_merge(compact('sections'), $seo));
    }

    // ══════════════════════════════════════════════════════════════════
    // ── LAYANAN: PRESS CONFERENCE
    // ══════════════════════════════════════════════════════════════════

    public function pressConference()
    {
        $seo = $this->seo(
            title:       'Jasa Press Conference & Konferensi Pers',
            description: 'Organisasikan konferensi pers yang profesional bersama HNP Communications. Kami bantu undang jurnalis, menyusun materi, dan distribusi hasil liputan ke media nasional.',
            keywords:    'jasa press conference, konferensi pers Indonesia, undang jurnalis media, organizer press conference profesional',
            image:       asset('images/og-press-conference.jpg'),
        );

        $sections = $this->sections('layanan-press-conference');

        return view('layanan.press-conference', array_merge(compact('sections'), $seo));
    }

    // ══════════════════════════════════════════════════════════════════
    // ── LAYANAN: PENULISAN ARTIKEL
    // ══════════════════════════════════════════════════════════════════

    public function penulisanArtikel()
    {
        $seo = $this->seo(
            title:       'Jasa Penulisan Artikel SEO',
            description: 'Jasa penulisan artikel SEO profesional oleh HNP Communications. Konten berkualitas tinggi, riset kata kunci mendalam, dan siap tayang di website atau media Anda.',
            keywords:    'jasa penulisan artikel SEO, jasa content writer Indonesia, penulisan konten website, artikel SEO friendly, copywriting profesional',
            image:       asset('images/og-penulisan-artikel.jpg'),
        );

        $sections = $this->sections('layanan-penulisan-artikel');

        return view('layanan.penulisan-artikel', array_merge(compact('sections'), $seo));
    }

    // ══════════════════════════════════════════════════════════════════
    // ── LAYANAN: BUZZER
    // ══════════════════════════════════════════════════════════════════

    public function buzzer()
    {
        $seo = $this->seo(
            title:       'Jasa Buzzer Indonesia +20.000 Member',
            description: 'Jasa Buzzer Indonesia profesional dari HNP Communications dengan lebih dari 20.000 member aktif. Bantu branding bisnis, naikkan interaksi, trending topik, FYP TikTok, dan review marketplace.',
            keywords:    'jasa buzzer Indonesia, buzzer media sosial, buzzer trending topik Twitter, buzzer TikTok FYP, buzzer review rating marketplace, jasa viral Indonesia',
            image:       asset('images/og-buzzer.jpg'),
        );

        $sections = $this->sections('layanan-buzzer');

        return view('layanan.buzzer', array_merge(compact('sections'), $seo));
    }

    // ══════════════════════════════════════════════════════════════════
    // ── LAYANAN: PELATIHAN KONTEN
    // ══════════════════════════════════════════════════════════════════

    public function pelatihanKonten()
    {
        $seo = $this->seo(
            title:       'Pelatihan Konten Kreator Profesional',
            description: 'Ikuti pelatihan konten kreator profesional bersama HNP Communications. Pelajari strategi konten, teknik copywriting, SEO, dan cara monetisasi konten digital.',
            keywords:    'pelatihan konten kreator, kursus content creator Indonesia, training digital marketing, belajar SEO konten, workshop penulisan artikel',
            image:       asset('images/og-pelatihan-konten.jpg'),
        );

        $sections = $this->sections('layanan-pelatihan-konten');

        return view('layanan.pelatihan-konten', array_merge(compact('sections'), $seo));
    }
}