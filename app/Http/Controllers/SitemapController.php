<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate XML sitemap otomatis.
     * Akses via: https://konten.hostspot.my.id/sitemap.xml
     */
    public function index(): Response
    {
        $baseUrl = rtrim(config('app.url'), '/');

        // ── Halaman statis ────────────────────────────────────────
        $staticPages = [
            ['url' => '/',                          'priority' => '1.0', 'freq' => 'daily'],
            ['url' => '/about',                     'priority' => '0.8', 'freq' => 'monthly'],
            ['url' => '/kontak',                    'priority' => '0.8', 'freq' => 'monthly'],
            ['url' => '/cara-order',                'priority' => '0.7', 'freq' => 'monthly'],
            ['url' => '/syarat-ketentuan',          'priority' => '0.5', 'freq' => 'yearly'],
            ['url' => '/artikel',                   'priority' => '0.9', 'freq' => 'daily'],
            ['url' => '/layanan/press-release',     'priority' => '0.9', 'freq' => 'weekly'],
            ['url' => '/layanan/backlink',          'priority' => '0.9', 'freq' => 'weekly'],
            ['url' => '/layanan/press-conference',  'priority' => '0.9', 'freq' => 'weekly'],
            ['url' => '/layanan/penulisan-artikel', 'priority' => '0.9', 'freq' => 'weekly'],
            ['url' => '/layanan/buzzer',            'priority' => '0.9', 'freq' => 'weekly'],
            ['url' => '/layanan/pelatihan-konten',  'priority' => '0.9', 'freq' => 'weekly'],
        ];

        // ── Artikel dinamis dari DB ───────────────────────────────
        $articles = [];
        if (class_exists(\App\Models\Article::class)) {
            $articles = \App\Models\Article::where('status', 'published')
                ->select('slug', 'updated_at')
                ->latest('updated_at')
                ->get();
        }

        $now = now()->toAtomString();

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($staticPages as $page) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>{$baseUrl}{$page['url']}</loc>\n";
            $xml .= "    <lastmod>{$now}</lastmod>\n";
            $xml .= "    <changefreq>{$page['freq']}</changefreq>\n";
            $xml .= "    <priority>{$page['priority']}</priority>\n";
            $xml .= "  </url>\n";
        }

        foreach ($articles as $article) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>{$baseUrl}/artikel/{$article->slug}</loc>\n";
            $xml .= "    <lastmod>" . $article->updated_at->toAtomString() . "</lastmod>\n";
            $xml .= "    <changefreq>weekly</changefreq>\n";
            $xml .= "    <priority>0.7</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}