@extends('layouts.app')

@section('title', $title)

@section('content')

<!-- Hero Section: Lebih Bold & Terstruktur -->
<section class="relative pt-32 pb-24 overflow-hidden">
    <div class="max-w-5xl mx-auto px-6 text-center relative z-10">
        <div class="inline-block bg-black text-white px-4 py-1 rotate-[-2deg] mb-8 font-black tracking-widest text-sm uppercase">
            ✦ LAYANAN
        </div>

        <h1 class="text-6xl md:text-8xl font-black mt-2 mb-8 uppercase leading-none tracking-tighter italic">
            {{ $title }}
        </h1>

        <div class="max-w-2xl mx-auto bg-white border-4 border-black p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            <p class="text-xl font-bold leading-relaxed">
                {{ $subtitle }}
            </p>
        </div>
    </div>
</section>

<!-- Benefits Section: Grid dengan Karakter Kuat -->
<section class="py-24 bg-retro-grid border-y-4 border-black">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($benefits as $index => $b)
            <div class="card-retro group hover:-translate-y-2 transition-transform">
                <div class="flex flex-col h-full">
                    <span class="text-5xl font-black opacity-20 mb-4 group-hover:opacity-100 transition-opacity">
                        0{{ $index + 1 }}
                    </span>
                    <h3 class="text-2xl font-black leading-tight uppercase">
                        {{ $b }}
                    </h3>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section: Marquee Style atau High Contrast -->
<section class="py-24 bg-yellow-400">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-5xl md:text-6xl font-black mb-10 uppercase tracking-tighter">
            Siap Melejit Bersama?
        </h2>
        
        <div class="relative inline-block group">
            <!-- Shadow Layer -->
            <div class="absolute inset-0 bg-black translate-x-2 translate-y-2 group-hover:translate-x-1 group-hover:translate-y-1 transition-transform"></div>
            
            <a href="https://api.whatsapp.com/send?phone=6287786000919"
               class="relative inline-flex items-center gap-3 bg-white border-4 border-black px-10 py-5 text-2xl font-black uppercase hover:bg-black hover:text-white transition-colors">
                KONSULTASI GRATIS 
                <span class="text-3xl">→</span>
            </a>
        </div>
        
        <p class="mt-8 font-black uppercase text-sm tracking-widest opacity-80">
            *Respon cepat via WhatsApp
        </p>
    </div>
</section>

@endsection