<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Article;
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
        [
            'title' => 'Jasa Press Release',
            'slug'  => 'press-release',
        ],
        [
            'title' => 'Jasa Backlink Media',
            'slug'  => 'backlink',
        ],
        [
            'title' => 'Press Conference',
            'slug'  => 'press-conference',
        ],
        [
            'title' => 'Penulisan Artikel',
            'slug'  => 'penulisan-artikel',
        ],
        [
            'title' => 'Script Video',
            'slug'  => 'script-video',
        ],
        [
            'title' => 'Pelatihan Konten',
            'slug'  => 'pelatihan-konten',
        ],
    ];

    return view('layanan.index', compact('services'));
}

    public function pricing()
    {
        return view('pricing');
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
            'message' => 'required|string|min:10',
        ]);

        // TODO: kirim email / simpan ke DB
        return back()->with('success', 'Pesan berhasil dikirim!');
    }
}