<?php

namespace App\Http\Controllers;

use App\Models\PageSection;
use App\Models\SiteSetting;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\ClientLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    // ── Helper: load sections untuk satu halaman ─────────────────────
    private function sections(string $page): \Illuminate\Support\Collection
    {
        return PageSection::ofPage($page);
    }

    // ── HOME ──────────────────────────────────────────────────────────
    public function index()
    {
        $sections     = $this->sections('home');
        $services     = Service::where('is_active', true)->orderBy('order')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order')->get();
        $faqs         = Faq::where('is_active', true)->orderBy('order')->get();
        $clients      = ClientLogo::where('is_active', true)->orderBy('order')->get();

        return view('pages.home', compact('sections', 'services', 'testimonials', 'faqs', 'clients'));
    }

    // ── ABOUT ─────────────────────────────────────────────────────────
    public function about()
    {
        $sections = $this->sections('about');
        return view('about', compact('sections'));
    }

    // ── CONTACT ───────────────────────────────────────────────────────
    public function contact()
    {
        $sections = $this->sections('contact');
        return view('contact', compact('sections'));
    }

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:20',
            'service' => 'required|string',
            'message' => 'required|string|min:10',
        ]);

        // Simpan ke DB (ContactSubmission)
        \App\Models\ContactSubmission::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'whatsapp' => $validated['phone'], // remap phone → whatsapp
            'service'  => $validated['service'],
            'message'  => $validated['message'],
        ]);

        // Kirim notifikasi WhatsApp via Fonnte
        $this->sendWhatsAppNotification($validated);

        // Kirim email notif (opsional)
        // Mail::to('hello@kontendigital.id')->send(new \App\Mail\ContactMail($validated));

        return back()->with('success', 'Pesan Anda berhasil dikirim! Tim kami akan menghubungi Anda segera.');
    }

    /**
     * Kirim notifikasi WhatsApp ke nomor admin via Fonnte API.
     * Daftar token gratis di https://fonnte.com
     */
    private function sendWhatsAppNotification(array $data): void
    {
        $token = env('FONNTE_TOKEN');

        if (empty($token)) {
            Log::warning('FONNTE_TOKEN belum diset di .env, notifikasi WhatsApp tidak terkirim.');
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
                CURLOPT_HTTPHEADER     => [
                    "Authorization: {$token}",
                ],
                CURLOPT_POSTFIELDS     => [
                    'target'  => '083871325422', // nomor HP admin
                    'message' => $message,
                    'countryCode' => '62',       // kode negara Indonesia
                ],
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode !== 200) {
                Log::error('Fonnte API error', [
                    'http_code' => $httpCode,
                    'response'  => $response,
                ]);
            } else {
                Log::info('WhatsApp notifikasi terkirim', ['response' => $response]);
            }

        } catch (\Exception $e) {
            // Jangan sampai error WA mengganggu user experience
            Log::error('Fonnte exception: ' . $e->getMessage());
        }
    }

    // ── CARA ORDER ────────────────────────────────────────────────────
    public function caraOrder()
    {
        $sections = $this->sections('cara-order');
        return view('pages.cara-order', compact('sections'));
    }

    // ── SYARAT & KETENTUAN ────────────────────────────────────────────
    public function syaratKetentuan()
    {
        $sections = $this->sections('syarat-ketentuan');
        return view('pages.syarat-ketentuan', compact('sections'));
    }

    // ══════════════════════════════════════════════════════════════════
    // ── LAYANAN PAGES ─────────────────────────────────────────────────
    // ══════════════════════════════════════════════════════════════════

    public function pressRelease()
    {
        $sections = $this->sections('layanan-press-release');
        return view('layanan.press-release', compact('sections'));
    }

    public function backlink()
    {
        $sections = $this->sections('layanan-backlink');
        return view('layanan.backlink', compact('sections'));
    }

    public function pressConference()
    {
        $sections = $this->sections('layanan-press-conference');
        return view('layanan.press-conference', compact('sections'));
    }

    public function penulisanArtikel()
    {
        $sections = $this->sections('layanan-penulisan-artikel');
        return view('layanan.penulisan-artikel', compact('sections'));
    }

    public function scriptVideo()
    {
        $sections = $this->sections('layanan-script-video');
        return view('layanan.script-video', compact('sections'));
    }

    public function pelatihanKonten()
    {
        $sections = $this->sections('layanan-pelatihan-konten');
        return view('layanan.pelatihan-konten', compact('sections'));
    }
}