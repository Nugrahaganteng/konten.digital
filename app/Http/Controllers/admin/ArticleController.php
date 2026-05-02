<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    // ── Semua artikel (semua status) ──
    public function index(Request $request)
    {
        $query = Article::with('user')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->paginate(15);
        $counts   = [
            'all'       => Article::count(),
            'draft'     => Article::where('status', 'draft')->count(),
            'published' => Article::where('status', 'published')->count(),
            'rejected'  => Article::where('status', 'rejected')->count(),
        ];

        return view('admin.articles.index', compact('articles', 'counts'));
    }

    // ── Form buat artikel (admin) ──
    public function create()
    {
        return view('admin.articles.create');
    }

    // ── Simpan artikel baru oleh admin ──
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'category'  => 'required|string|max:100',
            'content'   => 'required|string|min:50',
            'excerpt'   => 'nullable|string|max:300',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'    => 'required|in:draft,published,rejected',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('articles', 'public');
        }

        $article = auth()->user()->articles()->create([
            'title'        => $validated['title'],
            'category'     => $validated['category'],
            'content'      => $validated['content'],
            'excerpt'      => $validated['excerpt'] ?? null,
            'thumbnail'    => $thumbnailPath,
            'status'       => $validated['status'],
            'published_at' => $validated['status'] === 'published' ? now() : null,
        ]);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dibuat.');
    }

    // ── Form edit artikel ──
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    // ── Update artikel ──
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'category'  => 'required|string|max:100',
            'content'   => 'required|string|min:50',
            'excerpt'   => 'nullable|string|max:300',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'    => 'required|in:draft,published,rejected',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) Storage::disk('public')->delete($article->thumbnail);
            $validated['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        // Set published_at saat pertama kali dipublish
        if ($validated['status'] === 'published' && !$article->published_at) {
            $validated['published_at'] = now();
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    // ── Approve (publish) artikel user ──
    public function publish(Article $article)
    {
        $article->update([
            'status'       => 'published',
            'published_at' => $article->published_at ?? now(),
        ]);

        return back()->with('success', 'Artikel berhasil dipublish!');
    }

    // ── Reject artikel user ──
    public function reject(Article $article)
    {
        $article->update(['status' => 'rejected']);
        return back()->with('success', 'Artikel ditolak.');
    }

    // ── Hapus artikel ──
    public function destroy(Article $article)
    {
        if ($article->thumbnail) Storage::disk('public')->delete($article->thumbnail);
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}