@extends('layouts.app')

@section('title', 'Penulisan Artikel')

@section('content')

{{-- HERO --}}
<section class="pt-32 pb-20 text-center">
    <div class="max-w-4xl mx-auto px-6">
        <span class="section-eyebrow">✦ LAYANAN</span>

        <h1 class="text-5xl md:text-7xl font-black mt-6 mb-6 uppercase">
            Penulisan Artikel
        </h1>

        <p class="font-bold opacity-70">
            Artikel SEO & branding berkualitas tinggi.
        </p>
    </div>
</section>

{{-- BENEFITS --}}
<section class="py-20 bg-retro-grid border-t-4 border-black">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-6">

        <div class="card-retro">
            <h3 class="font-black mb-2">SEO optimized</h3>
        </div>
        <div class="card-retro">
            <h3 class="font-black mb-2">Penulis berpengalaman</h3>
        </div>
        <div class="card-retro">
            <h3 class="font-black mb-2">Research mendalam</h3>
        </div>
        <div class="card-retro">
            <h3 class="font-black mb-2">Plagiarism free</h3>
        </div>
        <div class="card-retro">
            <h3 class="font-black mb-2">Engaging content</h3>
        </div>

    </div>
</section>

{{-- CTA --}}
<section class="py-20 text-center">
    <h2 class="text-4xl font-black mb-6">Mulai Sekarang</h2>

    <a href="https://api.whatsapp.com/send?phone=6287786000919"
       class="btn-pop">
        HUBUNGI KAMI →
    </a>
</section>

@endsection