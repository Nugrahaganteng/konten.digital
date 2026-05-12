<?php

namespace App\Http\Controllers;

use App\Models\PageSection;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\ClientLogo;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $sections     = PageSection::ofPage('home');
        $services     = Service::where('is_active', true)->orderBy('order')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order')->get();
        $faqs         = Faq::where('is_active', true)->orderBy('order')->get();
        $clientLogos  = ClientLogo::where('is_active', true)->orderBy('order')->get();

        return view('pages.home', compact('sections', 'services', 'testimonials', 'faqs', 'clientLogos'));
    }

    public function about()
    {
        $sections = PageSection::ofPage('about');

        return view('about', compact('sections'));
    }

    public function contact()
    {
        $sections = PageSection::ofPage('contact');

        return view('contact', compact('sections'));
    }

    public function sendContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:100',
            'phone'   => 'required|string|max:20',
            'email'   => 'required|email|max:100',
            'service' => 'required|string|max:100',
            'message' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        ContactSubmission::create($request->only('name', 'phone', 'email', 'service', 'message'));

        return back()->with('success', 'Pesan Anda berhasil dikirim! Tim kami akan menghubungi Anda segera.');
    }

    public function caraOrder()
    {
        $sections = PageSection::ofPage('cara-order');

        return view('pages.cara-order', compact('sections'));
    }

    public function syaratKetentuan()
    {
        $sections = PageSection::ofPage('syarat-ketentuan');

        return view('pages.syarat-ketentuan', compact('sections'));
    }

    // ── Layanan Pages ────────────────────────────────────────────────────

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
}