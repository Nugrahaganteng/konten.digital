{{-- resources/views/articles/edit.blade.php --}}
@extends('layouts.app')
@section('title', 'Editor Artikel')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700&family=Syne:wght@700;800&display=swap');

    :root {
        --base-ink: #0a0a0a;
        --soft-gray: #f0f0eb;
        --accent-orange: #ff5f1f;
        --accent-teal: #008080;
        --white: #ffffff;
        --brutal-shadow: 8px 8px 0px var(--base-ink);
        --brutal-shadow-small: 4px 4px 0px var(--base-ink);
    }

    body {
        background-color: var(--soft-gray);
        font-family: 'Space Grotesk', sans-serif;
        color: var(--base-ink);
        line-height: 1.6;
    }

    /* Container System */
    .edit-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 4rem 2rem;
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 2.5rem;
    }

    /* Responsivitas Grid */
    @media (max-width: 992px) {
        .edit-container { 
            grid-template-columns: 1fr; 
            padding: 2rem 1rem; 
        }
        .sidebar-info { order: 2; }
        .page-header { order: 1; }
        .form-canvas { order: 3; }
    }

    /* Header Styling */
    .page-header {
        grid-column: 1 / -1;
        border-bottom: 5px solid var(--base-ink);
        padding-bottom: 2rem;
        margin-bottom: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .page-header h1 {
        font-family: 'Syne', sans-serif;
        font-size: clamp(2.5rem, 6vw, 4.5rem);
        text-transform: uppercase;
        line-height: 0.95;
        margin: 0;
        letter-spacing: -3px;
        font-weight: 800;
    }

    /* Main Form Area */
    .form-canvas {
        background: var(--white);
        border: 3px solid var(--base-ink);
        padding: 3.5rem;
        position: relative;
        box-shadow: var(--brutal-shadow);
    }

    @media (max-width: 576px) {
        .form-canvas { padding: 2rem 1.5rem; }
    }

    /* Sidebar/Info Area */
    .sidebar-info {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .info-card {
        border: 3px solid var(--base-ink);
        padding: 1.5rem;
        background: var(--white);
        box-shadow: var(--brutal-shadow-small);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .info-card:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px var(--base-ink);
    }

    .info-card.warning {
        background: var(--accent-orange);
        color: var(--base-ink);
    }

    .info-card h3 {
        font-family: 'Syne', sans-serif;
        font-size: 1.25rem;
        margin-bottom: 1rem;
        text-transform: uppercase;
        font-weight: 800;
        border-bottom: 2px solid var(--base-ink);
        display: inline-block;
    }

    /* Input & Form Elements Style */
    .form-canvas label {
        font-family: 'Syne', sans-serif;
        text-transform: uppercase;
        font-weight: 800;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-canvas input, 
    .form-canvas textarea, 
    .form-canvas select {
        width: 100%;
        border: 3px solid var(--base-ink) !important;
        border-radius: 0 !important;
        padding: 1rem !important;
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 500;
        margin-bottom: 1.5rem;
        transition: all 0.2s;
    }

    .form-canvas input:focus, 
    .form-canvas textarea:focus {
        outline: none;
        background-color: #fffdf5;
        box-shadow: 4px 4px 0px var(--accent-teal);
        transform: translate(-2px, -2px);
    }

    /* Button Simpan Modern Brutalism */
    .btn-save {
        background: var(--base-ink);
        color: white;
        padding: 1.2rem 2.5rem;
        font-family: 'Syne', sans-serif;
        font-weight: 800;
        font-size: 1.1rem;
        text-transform: uppercase;
        border: 3px solid var(--base-ink);
        cursor: pointer;
        width: 100%;
        transition: all 0.1s;
        box-shadow: 6px 6px 0px var(--accent-teal);
        margin-top: 1rem;
    }

    .btn-save:hover {
        background: var(--accent-teal);
        transform: translate(-2px, -2px);
        box-shadow: 8px 8px 0px var(--base-ink);
    }

    .btn-save:active {
        transform: translate(4px, 4px);
        box-shadow: 0px 0px 0px var(--base-ink);
    }

    /* Decorative Elements */
    .corner-label {
        position: absolute;
        top: -15px;
        right: 30px;
        background: var(--accent-teal);
        color: white;
        padding: 4px 15px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        border: 2px solid var(--base-ink);
    }

    .back-link {
        text-decoration: none; 
        color: var(--base-ink); 
        font-weight: 800; 
        font-family: 'Syne', sans-serif;
        border: 3px solid var(--base-ink);
        padding: 0.5rem 1.5rem;
        text-transform: uppercase;
        transition: all 0.2s;
        background: var(--white);
    }

    .back-link:hover {
        background: var(--base-ink);
        color: var(--white);
    }
</style>
@endpush

@section('content')
<div class="edit-container">
    {{-- Header --}}
    <header class="page-header">
        <div>
            <span style="font-weight: 800; text-transform: uppercase; font-size: 0.9rem; color: var(--accent-orange); letter-spacing: 1px;">
                ● Mode Penyuntingan
            </span>
            <h1>Edit.<br>Artikel</h1>
        </div>
        <a href="{{ url()->previous() }}" class="back-link">
            ← KEMBALI
        </a>
    </header>

    {{-- Form Utama --}}
    {{-- 
        CATATAN: <form> tag ada di dalam partials/form.blade.php.
        Jangan tambahkan <form> lagi di sini supaya tidak double form.
        $action dan $article di-pass via @include.
    --}}
    <main class="form-canvas">
        <div class="corner-label">Workspace v.2.4</div>

        @include('articles.partials.form', [
            'action'  => route('articles.update', $article),
            'article' => $article,
        ])
    </main>

    {{-- Sidebar Info --}}
    <aside class="sidebar-info">
        <div class="info-card warning">
            <h3>Perhatian</h3>
            <p style="font-size: 0.95rem; font-weight: 600;">
                Menyimpan perubahan akan menarik artikel dari publikasi untuk sementara guna proses moderasi ulang sistem.
            </p>
        </div>

        <div class="info-card">
            <h3>Tips Menulis</h3>
            <ul style="font-size: 0.9rem; padding-left: 1.2rem; margin: 0; font-weight: 500;">
                <li style="margin-bottom: 0.7rem;">Gunakan judul provokatif yang jujur.</li>
                <li style="margin-bottom: 0.7rem;">Resolusi thumbnail ideal: 1200x630px.</li>
                <li>Gunakan Heading (H2) untuk poin utama.</li>
            </ul>
        </div>

        <div class="info-card" style="background: var(--accent-teal); color: white;">
            <h3 style="border-color: white;">Bantuan?</h3>
            <p style="font-size: 0.9rem; font-weight: 500;">
                Hubungi tim editorial via Slack jika Anda memerlukan bantuan format khusus.
            </p>
        </div>
        
        <div class="info-card" style="background: #e0e0e0;">
            <h3>Status</h3>
            <p style="font-size: 0.85rem; margin: 0;">
                <strong>Draft ID:</strong> #ART-{{ $article->id }}<br>
                <strong>Terakhir Update:</strong> {{ $article->updated_at->diffForHumans() }}
            </p>
        </div>
    </aside>
</div>
@endsection