{{-- resources/views/pricing.blade.php --}}
@extends('layouts.app')
@section('title', 'Paket Harga')

@section('content')
<section class="py-24 bg-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16 reveal">
            <p class="section-eyebrow mb-3">Investasi Terbaik untuk Brand Anda</p>
            <h1 class="headline-retro text-5xl md:text-7xl mb-4">Paket Harga</h1>
            <div class="divider-retro max-w-xs mx-auto mb-6"><span>✦</span></div>
            <p class="font-mono text-ink-light text-base max-w-xl mx-auto">
                Harga super terjangkau tanpa mengorbankan kualitas. Semua paket sudah termasuk garansi tayang dan laporan URL terbit.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            @foreach($packages as $i => $pkg)
            <div class="reveal {{ $pkg['highlight'] ? 'card-retro bg-ink scale-105 z-10' : 'card-retro bg-paper' }} p-8"
                 style="animation-delay:{{ $i * 0.15 }}s">

                @if($pkg['badge'])
                <div class="flex justify-center mb-4">
                    <span class="stamp {{ $pkg['highlight'] ? 'text-gold' : 'text-rust' }} text-xs">{{ $pkg['badge'] }}</span>
                </div>
                @endif

                <p class="font-typewriter text-xs tracking-widest {{ $pkg['highlight'] ? 'text-gold/60' : 'text-sepia' }} uppercase mb-2">Paket</p>
                <h3 class="font-display {{ $pkg['highlight'] ? 'text-gold' : 'text-ink' }} text-4xl tracking-widest mb-4">{{ strtoupper($pkg['name']) }}</h3>

                <div class="divider-retro mb-6"><span class="{{ $pkg['highlight'] ? 'text-gold/40' : 'text-gold/40' }}">✦</span></div>

                <div class="mb-6">
                    <span class="font-serif-display font-bold {{ $pkg['highlight'] ? 'text-cream' : 'text-ink' }} text-4xl">Rp {{ $pkg['price'] }}</span>
                    <span class="font-mono {{ $pkg['highlight'] ? 'text-cream/50' : 'text-ink/40' }} text-sm ml-1">{{ $pkg['period'] }}</span>
                </div>

                <ul class="space-y-2.5 mb-8">
                    @foreach($pkg['features'] as $feat)
                    <li class="flex items-start gap-2 font-mono {{ $pkg['highlight'] ? 'text-cream/80' : 'text-ink-light' }} text-sm">
                        <span class="text-gold mt-0.5 shrink-0">✓</span>
                        {{ $feat }}
                    </li>
                    @endforeach
                </ul>

                <a href="https://wa.me/6281234567890?text=Halo, saya ingin pesan paket {{ $pkg['name'] }}"
                   class="{{ $pkg['highlight'] ? 'btn-retro' : 'btn-retro btn-retro-outline' }} w-full text-center block">
                    {{ $pkg['cta'] }} →
                </a>
            </div>
            @endforeach
        </div>

        {{-- Note --}}
        <div class="text-center mt-12 reveal">
            <div class="border border-gold/30 inline-block px-8 py-4 bg-parchment">
                <p class="font-mono text-ink-light text-sm">
                    Butuh paket custom untuk volume besar? <a href="https://wa.me/6281234567890" class="text-gold hover:text-gold-light border-b border-gold/50">Hubungi kami →</a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection