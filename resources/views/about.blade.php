{{-- ════════════════════════════════════════════════════ --}}
{{-- resources/views/about.blade.php                   --}}
{{-- ════════════════════════════════════════════════════ --}}
@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-16">

    <div class="text-center mb-16">
        <p class="text-accent text-xs font-semibold tracking-widest uppercase mb-3">Siapa Kami</p>
        <h1 class="font-display text-5xl font-black text-ink mb-4">Tentang MyBlog</h1>
        <p class="text-muted text-lg max-w-xl mx-auto">Platform berbagi artikel, pengetahuan, dan inspirasi untuk semua kalangan.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-12 items-center mb-16">
        <div>
            <h2 class="font-display text-3xl font-bold text-ink mb-4">Visi Kami</h2>
            <p class="text-muted leading-relaxed mb-4">
                MyBlog lahir dari keinginan sederhana: memberikan ruang bagi semua orang untuk berbagi pemikiran dan cerita mereka kepada dunia.
            </p>
            <p class="text-muted leading-relaxed">
                Kami percaya bahwa setiap orang memiliki perspektif unik yang berharga untuk dibagikan. Platform ini hadir untuk mewujudkan hal tersebut.
            </p>
        </div>
        <div class="bg-ink text-cream rounded-2xl p-8">
            <div class="grid grid-cols-2 gap-6 text-center">
                <div>
                    <p class="font-display text-4xl font-black text-accent">100+</p>
                    <p class="text-cream/60 text-sm mt-1">Artikel Diterbitkan</p>
                </div>
                <div>
                    <p class="font-display text-4xl font-black text-accent">50+</p>
                    <p class="text-cream/60 text-sm mt-1">Penulis Aktif</p>
                </div>
                <div>
                    <p class="font-display text-4xl font-black text-accent">5</p>
                    <p class="text-cream/60 text-sm mt-1">Kategori Topik</p>
                </div>
                <div>
                    <p class="font-display text-4xl font-black text-accent">∞</p>
                    <p class="text-cream/60 text-sm mt-1">Inspirasi</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-accent/5 border border-accent/20 rounded-2xl p-8 text-center">
        <h2 class="font-display text-2xl font-bold text-ink mb-3">Bergabung Bersama Kami</h2>
        <p class="text-muted mb-6">Mulai tulis artikel pertamamu hari ini. Gratis selamanya.</p>
        <a href="{{ route('register') }}"
           class="inline-flex items-center gap-2 bg-accent text-white px-6 py-3 rounded-full font-semibold hover:bg-accent/80 transition-all hover:scale-105">
            Daftar Sekarang
        </a>
    </div>
</div>
@endsection
