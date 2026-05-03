<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_articles'     => Article::count(),
            'published_articles' => Article::where('status', 'published')->count(),
            'draft_articles'     => Article::where('status', 'draft')->count(),
            'total_users'        => User::where('role', 'user')->count(),
        ];

        $latestArticles = Article::with('user')->latest()->limit(8)->get();

        return view('admin.dashboard', compact('stats', 'latestArticles'));
    }
}