<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    // ══════════════════════════════════════════════════════════════════
    // ── Daftar artikel published (public)
    // ══════════════════════════════════════════════════════════════════

    public function index(Request $request)
    {
        $query = Article::with('user')
            ->published()
            ->latest('published_at');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title',   'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        $articles   = $query->paginate(9);
        $categories = Article::published()->distinct()->pluck('category');

        // ── SEO Halaman Blog ──────────────────────────────────────
        $seoTitle       = 'Blog & Artikel Seputar PR dan Digital Marketing';
        $seoDescription = 'Baca artikel terbaru seputar PR, press release, SEO, digital marketing, dan konten kreator dari tim HNP Communications. Update rutin setiap minggu.';
        $seoKeywords    = 'blog PR, artikel digital marketing, tips press release, strategi SEO, konten kreator Indonesia, HNP Communications blog';
        $seoImage       = asset('images/og-blog.jpg');
        $seoType        = 'website';
        $seoNoindex     = false;

        return view('articles.index', compact(
            'articles', 'categories',
            'seoTitle', 'seoDescription', 'seoKeywords', 'seoImage', 'seoType', 'seoNoindex'
        ));
    }

    // ══════════════════════════════════════════════════════════════════
    // ── Detail artikel
    // ══════════════════════════════════════════════════════════════════

    public function show(string $slug)
    {
        $article = Article::with('user')
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $related = Article::with('user')
            ->published()
            ->where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->limit(3)
            ->get();

        // ── SEO dinamis per artikel ───────────────────────────────
        $seoTitle       = $article->title;
        $seoDescription = $article->excerpt
                            ? Str::limit(strip_tags($article->excerpt), 155)
                            : Str::limit(strip_tags($article->content), 155);
        $seoKeywords    = $article->tags
                            ?? ($article->category . ', artikel HNP Communications, digital marketing');
        $seoImage       = $article->thumbnail
                            ? asset('storage/' . $article->thumbnail)
                            : asset('images/og-blog.jpg');
        $seoType        = 'article';
        $seoNoindex     = false;

        return view('articles.show', compact(
            'article', 'related',
            'seoTitle', 'seoDescription', 'seoKeywords', 'seoImage', 'seoType', 'seoNoindex'
        ));
    }

    // ══════════════════════════════════════════════════════════════════
    // ── Form buat artikel (harus login)
    // ══════════════════════════════════════════════════════════════════

    public function create()
    {
        return view('articles.create');
    }

    // ══════════════════════════════════════════════════════════════════
    // ── Simpan artikel baru
    // ══════════════════════════════════════════════════════════════════

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'category'  => 'required|string|max:100',
            'content'   => 'required|string|min:50',
            'excerpt'   => 'nullable|string|max:300',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('articles', 'public');
        }

        Auth::user()->articles()->create([
            'title'        => $validated['title'],
            'category'     => $validated['category'],
            'content'      => $validated['content'],
            'excerpt'      => $validated['excerpt'] ?? null,
            'thumbnail'    => $thumbnailPath,
            'status'       => 'draft',
            'published_at' => null,
        ]);

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil dikirim! Sedang menunggu review dari admin.');
    }

    // ══════════════════════════════════════════════════════════════════
    // ── Form edit (hanya pemilik atau admin)
    // ══════════════════════════════════════════════════════════════════

    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    // ══════════════════════════════════════════════════════════════════
    // ── Update artikel
    // ══════════════════════════════════════════════════════════════════

    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'category'  => 'required|string|max:100',
            'content'   => 'required|string|min:50',
            'excerpt'   => 'nullable|string|max:300',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        $article->update($validated);

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    // ══════════════════════════════════════════════════════════════════
    // ── Hapus artikel
    // ══════════════════════════════════════════════════════════════════

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}