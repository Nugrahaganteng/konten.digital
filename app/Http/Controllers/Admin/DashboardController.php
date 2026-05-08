<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\ContactSubmission;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistik Artikel & User
        $stats = [
            'total_articles'     => Article::count(),
            'published_articles' => Article::where('status', 'published')->count(),
            'draft_articles'     => Article::where('status', 'draft')->count(),
            'total_users'        => User::count(),
        ];

        // 2. Statistik Pesan Masuk (Untuk Badge & Info Card)
        $contactCounts = [
            'all'         => ContactSubmission::count(),
            'new'         => ContactSubmission::where('status', 'new')->count(),
            'in_progress' => ContactSubmission::where('status', 'in_progress')->count(),
            'resolved'    => ContactSubmission::where('status', 'resolved')->count(),
        ];

        // 3. Ambil 5 Artikel terbaru
        $latestArticles = Article::latest()->limit(5)->get();

        // 4. Ambil 5 Pesan terbaru
        $latestContacts = ContactSubmission::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'stats', 
            'contactCounts', 
            'latestArticles', 
            'latestContacts'
        ));
    }
}