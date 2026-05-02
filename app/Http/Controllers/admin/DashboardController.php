<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total'     => Article::count(),
            'published' => Article::where('status', 'published')->count(),
            'draft'     => Article::where('status', 'draft')->count(),
            'rejected'  => Article::where('status', 'rejected')->count(),
            'users'     => User::count(),
        ];

        $pendingArticles = Article::with('user')
            ->where('status', 'draft')
            ->latest()
            ->limit(5)
            ->get();

        $recentArticles = Article::with('user')
            ->where('status', 'published')
            ->latest('published_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'pendingArticles', 'recentArticles'));
    }
}