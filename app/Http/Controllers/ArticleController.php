<?php
// app/Http/Controllers/ArticleController.php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    // ── List semua artikel published (publik) ──
    public function index(Request $request)
    {
        $query = Article::published()->with('user')->latest('published_at');
    // ── Daftar artikel published (public) ──────────────────────
    public function index(Request $request)
    {
        $query = Article::with('user')
            ->published()
            ->latest('published_at');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
            $query->where(function ($q) use ($request) {
                $q->where('title',   'like', '%'.$request->search.'%')
                  ->orWhere('excerpt','like', '%'.$request->search.'%');
            });
        }

        $articles   = $query->paginate(9);
        $categories = Article::published()->distinct()->pluck('category');

        return view('articles.index', compact('articles', 'categories'));
    }

    // ── Detail artikel (publik) ──
    public function show($slug)
        $article = Article::published()
            ->where('slug', $slug)
            ->with('user')
            ->firstOrFail();

        $related = Article::published()
            ->where('category', $article->category)
            ->where('id', '!=', $article->id)
    // ── Detail artikel ─────────────────────────────────────────
    public function show(string $slug)
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
        return view('articles.show', compact('article', 'related'));
    }

    // ── Form buat artikel (user login) ──
    // ── Form buat artikel (harus login) ────────────────────────
    public function create()
    {
        return view('articles.create');
    }

    // ── Simpan artikel user (status = draft, menunggu review admin) ──
    // ── Simpan artikel baru ────────────────────────────────────
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

        auth()->user()->articles()->create([
            'title'     => $validated['title'],
            'category'  => $validated['category'],
            'content'   => $validated['content'],
            'excerpt'   => $validated['excerpt'] ?? null,
            'thumbnail' => $thumbnailPath,
            'status'    => 'draft', // selalu draft, admin yang publish
        ]);

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil dikirim dan menunggu review admin!');
    }

    // ── Form edit (hanya pemilik artikel) ──
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

    // ── Form edit (hanya pemilik atau admin) ───────────────────
    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    // ── Update artikel ──
    // ── Update artikel ─────────────────────────────────────────
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
            if ($article->thumbnail) Storage::disk('public')->delete($article->thumbnail);
            $validated['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        // Reset ke draft jika user edit (perlu review ulang)
        $validated['status'] = 'draft';
        $article->update($validated);

        return redirect()->route('articles.index')
            ->with('success', 'Artikel diperbarui dan menunggu review ulang.');
    }

    // ── Hapus artikel (hanya pemilik) ──
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        $article->update(array_merge($validated, ['status' => 'draft']));

        return redirect()->route('articles.index')
            ->with('success', 'Artikel diperbarui dan menunggu review admin.');
    }

    // ── Hapus artikel ──────────────────────────────────────────
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        if ($article->thumbnail) Storage::disk('public')->delete($article->thumbnail);
        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}
}
