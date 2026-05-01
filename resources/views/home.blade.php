{{-- resources/views/home.blade.php --}}
@extends('layouts.app')
@section('title', 'Jasa Press Release Profesional Indonesia')

@section('content')

{{-- ══ HERO ══════════════════════════════════════ --}}
<section class="relative bg-ink overflow-hidden grain-overlay" style="min-height: 92vh;">

    {{-- Background ornamental lines --}}
    <div class="absolute inset-0 opacity-5">
        @for($i = 0; $i < 12; $i++)
        <div class="absolute border-t border-gold" style="top: {{ $i * 9 }}%; width: 100%;"></div>
        @endfor
    </div>

    {{-- Floating decorative circles --}}
    <div class="absolute top-20 right-16 w-48 h-48 border border-gold/20 rounded-full animate-spin-slow"></div>
    <div class="absolute top-24 right-20 w-36 h-36 border border-gold/10 rounded-full animate-spin-slow" style="animation-direction: reverse;"></div>
    <div class="absolute bottom-24 left-10 w-32 h-32 border border-gold/15 rounded-full animate-float-slow"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            {{-- Left: Text --}}
            <div>
                {{-- Eyebrow --}}
                <div class="divider-retro mb-6" style="max-width:320px;">
                    <span class="text-gold font-typewriter text-xs tracking-widest">EST. 2004 — JAKARTA</span>
                </div>

                {{-- Big Headline --}}
                <h1 class="font-display text-cream leading-none mb-2" style="font-size: clamp(3.5rem, 8vw, 7rem);">
                    JASA
                </h1>
                <h1 class="font-serif-display font-black italic text-gold leading-none mb-2" style="font-size: clamp(2.5rem, 6vw, 5.5rem);">
                    Press Release
                </h1>
                <h1 class="font-display text-cream leading-none mb-6" style="font-size: clamp(2rem, 5vw, 4rem); letter-spacing: 0.1em;">
                    PROFESIONAL
                </h1>

                {{-- Sub --}}
                <p class="font-mono text-cream/70 text-base leading-relaxed max-w-lg mb-8">
                    Tingkatkan popularitas & kredibilitas bisnis Anda melalui jaringan <span class="text-gold font-bold">200+ media online nasional</span> ternama Indonesia. Proses mudah, cepat, dan bergaransi penuh.
                </p>

                {{-- Stats row --}}
                <div class="flex flex-wrap gap-6 mb-10">
                    @foreach([['200+','Media Nasional'],['20+','Tahun Pengalaman'],['100%','Garansi Tayang']] as [$num,$label])
                    <div class="text-center">
                        <p class="font-display text-gold text-3xl leading-none">{{ $num }}</p>
                        <p class="font-typewriter text-cream/50 text-xs tracking-widest mt-1">{{ $label }}</p>
                    </div>
                    @endforeach
                </div>

                {{-- CTA Buttons --}}
                <div class="flex flex-wrap gap-4">
                    <a href="https://wa.me/6281234567890" class="btn-retro animate-pulse-gold">Konsultasi Gratis →</a>
                    <a href="{{ route('services') }}" class="btn-retro btn-retro-outline">Lihat Layanan</a>
                </div>
            </div>

            {{-- Right: Vintage newspaper card --}}
            <div class="flex justify-center lg:justify-end">
                <div class="card-retro p-8 max-w-sm w-full relative animate-float">
                    <div class="corner-ornament tl"></div>
                    <div class="corner-ornament tr"></div>
                    <div class="corner-ornament bl"></div>
                    <div class="corner-ornament br"></div>

                    <p class="font-typewriter text-sepia text-xs tracking-widest uppercase mb-3 border-b border-gold/30 pb-3">
                        Edisi Khusus — {{ now()->format('d M Y') }}
                    </p>
                    <h3 class="font-serif-display font-bold text-ink text-2xl mb-3 leading-tight">
                        Brand Anda Tampil di Media Nasional Ternama
                    </h3>
                    <p class="font-mono text-ink-light text-sm leading-relaxed mb-4">
                        Ribuan brand telah mempercayakan publikasi press release mereka kepada KontenDigital.id — dari startup hingga perusahaan Fortune 500.
                    </p>
                    <div class="border-t border-gold/30 pt-4 flex items-center justify-between">
                        <span class="stamp text-rust text-xs">TERPERCAYA</span>
                        <span class="font-mono text-sepia text-xs">kontendigital.id</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══ MARQUEE BRAND ══════════════════════════════ --}}
<div class="bg-gold border-y-2 border-sepia py-3 overflow-hidden">
    <div class="flex whitespace-nowrap animate-marquee">
        @foreach(array_fill(0, 8, ['Tokopedia','SANF','Tugu Jogja','Kompas.com','Detik.com','Liputan6','Tribun','Okezone','CNN Indonesia','Bisnis.com']) as $group)
            @foreach($group as $brand)
            <span class="font-display text-ink text-sm tracking-widest mx-8">{{ strtoupper($brand) }}</span>
            <span class="text-ink/40 mx-4">◆</span>
            @endforeach
        @endforeach
    </div>
</div>

{{-- ══ WHY US ═════════════════════════════════════ --}}
<section class="py-24 bg-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16 reveal">
            <p class="section-eyebrow mb-3">Mengapa Memilih Kami</p>
            <h2 class="headline-retro text-5xl md:text-6xl mb-4">Keunggulan Kami</h2>
            <div class="divider-retro max-w-xs mx-auto"><span>✦</span></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach([
                ['✦','Garansi Tayang 100%','Press release Anda dijamin tayang di media pilihan. Jika tidak tayang karena kebijakan redaksi, kami berikan media alternatif sepadan atau full refund tanpa potongan.'],
                ['◈','200+ Pilihan Media','Kami memiliki jaringan lebih dari 200 media online nasional. Anda bebas memilih media sesuai target audiens dan kebutuhan bisnis Anda.'],
                ['❋','Tim Profesional 20 Tahun','Tim kami berpengalaman lebih dari 20 tahun di industri media dan jurnalisme, memastikan setiap press release ditulis dengan standar redaksional terbaik.'],
                ['◉','Revisi Sepuasnya','Kami memberikan garansi revisi tanpa batas. Kepuasan Anda adalah prioritas utama kami dalam setiap pengerjaan naskah press release.'],
                ['✧','Harga Super Terjangkau','Kontendigital.id memberikan harga yang kompetitif tanpa mengorbankan kualitas. Investasi terbaik untuk reputasi brand Anda.'],
                ['⬡','Respon Cepat & Tanggap','Admin kami siap merespon pertanyaan dan permintaan Anda dengan cepat. Karena sudah menjadi standar pelayanan kami sejak awal.'],
            ] as $i => [$icon, $title, $desc])
            <div class="card-retro p-7 reveal" style="animation-delay: {{ $i * 0.1 }}s">
                <div class="w-12 h-12 border-2 border-gold flex items-center justify-center mb-5">
                    <span class="text-gold text-xl">{{ $icon }}</span>
                </div>
                <h3 class="font-serif-display font-bold text-ink text-xl mb-3">{{ $title }}</h3>
                <p class="font-mono text-ink-light text-sm leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ SERVICES PREVIEW ═══════════════════════════ --}}
<section class="py-24 bg-parchment relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        @for($i=0;$i<8;$i++)<div class="absolute border-t border-ink" style="top:{{$i*14}}%;width:100%;"></div>@endfor
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <p class="section-eyebrow mb-3">Layanan Lengkap</p>
            <h2 class="headline-retro text-5xl md:text-6xl mb-4">Apa yang Kami Tawarkan</h2>
            <div class="divider-retro max-w-xs mx-auto"><span>✦</span></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach([
                ['Press Release','Publikasikan berita perusahaan Anda ke 200+ media online nasional. Cocok untuk launching produk, event, CSR, rebranding, dan keperluan publikasi lainnya.','POPULER'],
                ['Backlink Media Nasional','Dapatkan backlink berkualitas tinggi dari portal berita nasional untuk meningkatkan peringkat SEO dan otoritas website Anda di mesin pencari Google.','SEO'],
                ['Penulisan Artikel','Artikel berkualitas tinggi yang ditulis oleh penulis berpengalaman. Tersedia untuk blog, website, deskripsi produk, dan berbagai kebutuhan konten digital Anda.',''],
                ['Press Conference','Kami mengorganisir konferensi pers yang efektif untuk menyampaikan pesan penting perusahaan Anda kepada media dan audiens secara profesional.',''],
            ] as $i => [$svc, $desc, $badge])
            <div class="card-retro p-8 reveal" style="animation-delay:{{$i*0.12}}s">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="font-serif-display font-bold text-ink text-2xl">{{ $svc }}</h3>
                    @if($badge)
                    <span class="stamp text-rust text-xs">{{ $badge }}</span>
                    @endif
                </div>
                <p class="font-mono text-ink-light text-sm leading-relaxed mb-5">{{ $desc }}</p>
                <a href="{{ route('services') }}" class="btn-retro btn-retro-outline text-xs">Pelajari Lebih →</a>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12 reveal">
            <a href="{{ route('services') }}" class="btn-retro">Lihat Semua Layanan →</a>
        </div>
    </div>
</section>

{{-- ══ HOW IT WORKS ════════════════════════════════ --}}
<section class="py-24 bg-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <p class="section-eyebrow mb-3">Cara Kerja</p>
            <h2 class="headline-retro text-5xl md:text-6xl mb-4">Proses Mudah & Cepat</h2>
            <div class="divider-retro max-w-xs mx-auto"><span>✦</span></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['01','Konsultasi','Ceritakan rencana dan tujuan press release Anda. CSR? Launching produk? Event? Artis? Rebranding? Semua bisa kami tangani.'],
                ['02','Pilih Paket','Pilih paket layanan press release sesuai kebutuhan dan anggaran Anda. Isi form order via WhatsApp dan lakukan pembayaran.'],
                ['03','Pembuatan Artikel','Kirimkan materi atau biarkan tim penulis kami membuat naskah press release yang profesional dan menarik perhatian redaksi.'],
                ['04','Terbit & Laporan','Press release terbit di media pilihan dalam 1–3 hari kerja. Anda mendapatkan laporan URL tayang dari setiap media.'],
            ] as $i => [$num, $step, $desc])
            <div class="reveal" style="animation-delay:{{$i*0.15}}s">
                <div class="border-retro p-6 bg-paper relative">
                    <div class="corner-ornament tl"></div>
                    <div class="corner-ornament tr"></div>
                    <div class="corner-ornament bl"></div>
                    <div class="corner-ornament br"></div>
                    <p class="font-display text-gold/30 text-6xl leading-none mb-3">{{ $num }}</p>
                    <h4 class="font-serif-display font-bold text-ink text-xl mb-3">{{ $step }}</h4>
                    <p class="font-mono text-ink-light text-sm leading-relaxed">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ CTA BANNER ══════════════════════════════════ --}}
<section class="py-20 bg-ink relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background: repeating-linear-gradient(45deg, transparent, transparent 20px, rgba(201,168,76,0.15) 20px, rgba(201,168,76,0.15) 21px);"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-4 text-center reveal">
        <p class="section-eyebrow text-gold mb-4">Mulai Sekarang</p>
        <h2 class="font-serif-display font-black italic text-cream text-4xl md:text-6xl mb-6 leading-tight">
            Siap Tampil di Media Nasional?
        </h2>
        <p class="font-mono text-cream/70 text-base mb-10 max-w-xl mx-auto">
            Konsultasikan kebutuhan press release Anda sekarang. Tim kami siap membantu Anda meningkatkan visibilitas dan kredibilitas brand di mata publik.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="https://wa.me/6281234567890" class="btn-retro text-base px-10 py-4 animate-pulse-gold">Konsultasi via WhatsApp →</a>
            <a href="{{ route('pricing') }}" class="btn-retro btn-retro-outline text-base px-10 py-4">Lihat Harga Paket</a>
        </div>
    </div>
</section>

@endsection