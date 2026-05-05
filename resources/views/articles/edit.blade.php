{{-- resources/views/articles/edit.blade.php --}}
@extends('layouts.app')
@section('title', 'Editor Artikel')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700&family=Syne:wght@700;800&display=swap');

    :root {
        --base-ink: #1a1a1a;
        --soft-gray: #f4f4f2;
        --accent-orange: #ff5f1f;
        --accent-teal: #008080;
        --white: #ffffff;
    }

    body {
        background-color: var(--soft-gray);
        font-family: 'Space Grotesk', sans-serif;
        color: var(--base-ink);
        line-height: 1.6;
    }

    /* Container System */
    .edit-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 2rem;
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 2rem;
    }

    /* Responsivitas Grid */
    @media (max-width: 992px) {
        .edit-container { grid-template-columns: 1fr; padding: 1rem; }
        .sidebar-info { order: -1; } /* Info muncul di atas pada mobile */
    }

    /* Header Styling */
    .page-header {
        grid-column: 1 / -1;
        border-bottom: 4px solid var(--base-ink);
        padding-bottom: 1.5rem;
        margin-bottom: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-header h1 {
        font-family: 'Syne', sans-serif;
        font-size: clamp(2.5rem, 5vw, 4rem);
        text-transform: uppercase;
        line-height: 0.9;
        margin: 0;
        letter-spacing: -2px;
    }

    /* Main Form Area */
    .form-canvas {
        background: var(--white);
        border: 2px solid var(--base-ink);
        padding: 3rem;
        position: relative;
    }

    @media (max-width: 576px) {
        .form-canvas { padding: 1.5rem; }
    }

    /* Sidebar/Info Area */
    .sidebar-info {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .info-card {
        border: 2px solid var(--base-ink);
        padding: 1.5rem;
        background: var(--white);
    }

    .info-card.warning {
        background: var(--accent-orange);
        color: white;
    }

    .info-card h3 {
        font-family: 'Syne', sans-serif;
        font-size: 1.2rem;
        margin-bottom: 0.75rem;
        text-transform: uppercase;
    }

    /* Input & Form Elements Override (Masuk ke partials jika perlu) */
    .form-canvas input, 
    .form-canvas textarea, 
    .form-canvas select {
        width: 100%;
        border: 2px solid var(--base-ink) !important;
        border-radius: 0 !important;
        padding: 0.75rem !important;
        font-family: 'Space Grotesk', sans-serif;
        margin-top: 0.5rem;
    }

    .btn-save {
        background: var(--base-ink);
        color: white;
        padding: 1rem 2rem;
        font-family: 'Syne', sans-serif;
        text-transform: uppercase;
        border: none;
        cursor: pointer;
        width: 100%;
        transition: 0.2s;
        margin-top: 2rem;
    }

    .btn-save:hover {
        background: var(--accent-teal);
    }

    /* Decorative Elements */
    .corner-label {
        position: absolute;
        top: -12px;
        right: 20px;
        background: var(--base-ink);
        color: white;
        padding: 2px 12px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
    }
</style>
@endpush

@section('content')
<div class="edit-container">
    {{-- Header --}}
    <header class="page-header">
        <div>
            <span style="font-weight: 800; text-transform: uppercase; font-size: 0.8rem; color: var(--accent-orange);">Drafting Mode</span>
            <h1>Edit.<br>Artikel</h1>
        </div>
        <a href="{{ url()->previous() }}" style="text-decoration: none; color: var(--base-ink); font-weight: 700; border-bottom: 2px solid var(--base-ink);">
            ← KEMBALI
        </a>
    </header>

    {{-- Form Utama --}}
    <main class="form-canvas">
        <div class="corner-label">Workspace v.2</div>
        
        @include('articles.partials.form', [
            'article' => $article,
            'action'  => route('articles.update', $article),
            'method'  => 'PUT',
        ])
    </main>

    {{-- Sidebar Info --}}
    <aside class="sidebar-info">
        <div class="info-card warning">
            <h3>Perhatian</h3>
            <p style="font-size: 0.9rem; font-weight: 500;">
                Menyimpan perubahan akan menarik artikel dari publikasi untuk sementara waktu guna proses moderasi ulang.
            </p>
        </div>

        <div class="info-card">
            <h3>Tips Menulis</h3>
            <ul style="font-size: 0.85rem; padding-left: 1.2rem; margin: 0;">
                <li style="margin-bottom: 0.5rem;">Gunakan judul yang provokatif namun jujur.</li>
                <li style="margin-bottom: 0.5rem;">Pastikan gambar thumbnail minimal beresolusi 1200px.</li>
                <li>Gunakan heading (H2/H3) untuk memecah teks yang panjang.</li>
            </ul>
        </div>

        <div class="info-card" style="background: var(--accent-teal); color: white;">
            <h3>Bantuan?</h3>
            <p style="font-size: 0.85rem;">Hubungi tim editorial jika Anda kesulitan dengan format penulisan.</p>
        </div>
    </aside>
</div>
@endsection