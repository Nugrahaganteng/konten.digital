{{--
    SITE FOOTER — CMS-Driven (Neon Noir / Cyber Brutalist Style)
    Membaca data dari PageSection model (page: 'footer')
    Sections: main, contact, social
--}}

@php
    use App\Models\PageSection;

    static $footerSections = null;
    if ($footerSections === null) {
        $footerSections = PageSection::ofPage('footer');
    }

    $fMain    = $footerSections->get('main');
    $fContact = $footerSections->get('contact');
    $fSocial  = $footerSections->get('social');

    $get = fn($section, $key, $fallback = '') =>
        optional($section)->get($key, '') ?: $fallback;

    // ── MAIN ──────────────────────────────────────────────
    $headline1  = $get($fMain, 'headline_1',  'Bersama Kami,');
    $headline2  = $get($fMain, 'headline_2',  'Raih Kesuksesan');
    $headline3  = $get($fMain, 'headline_3',  'di Era Digital');
    $desc       = $get($fMain, 'description', 'Bergabunglah dengan ratusan klien yang puas dan rasakan perbedaan dengan konten berkualitas dari HNP Communications. Mulailah sekarang dan bawa bisnis Anda ke level berikutnya.');
    $copyright  = $get($fMain, 'copyright',   '© ' . date('Y') . ' HNP Communications.id — ALL RIGHTS RESERVED NUGRAHA & WILDAN');

    // ── CONTACT ───────────────────────────────────────────
    $wa1Number  = $get($fContact, 'wa1_number', '6287786000919');
    $wa1Label   = $get($fContact, 'wa1_label',  '+62 877-8600-0919');
    $wa2Number  = $get($fContact, 'wa2_number', '628121967610');
    $wa2Label   = $get($fContact, 'wa2_label',  '+62 812-1967-610');

    // ── SOCIAL ────────────────────────────────────────────
    $instagram  = $get($fSocial, 'instagram', '#');
    $facebook   = $get($fSocial, 'facebook',  '#');
    $youtube    = $get($fSocial, 'youtube',   '#');
    $tiktok     = $get($fSocial, 'tiktok',    '#');

    $services = [
        ['name' => 'Press Release',       'route' => 'layanan.press.release'],
        ['name' => 'Backlink Media',       'route' => 'layanan.backlink'],
        ['name' => 'Press Conference',     'route' => 'layanan.press.conference'],
        ['name' => 'Penulisan Artikel',    'route' => 'layanan.penulisan.artikel'],
        ['name' => 'Script Video',         'route' => 'layanan.script.video'],
        ['name' => 'Pelatihan Konten',     'route' => 'layanan.pelatihan.konten'],
    ];

    $navLinks = [
        ['name' => 'Beranda',          'route' => 'home'],
        ['name' => 'Tentang Kami',     'route' => 'about'],
        ['name' => 'Cara Order',       'route' => 'cara-order'],
        ['name' => 'Syarat Ketentuan', 'route' => 'syarat-ketentuan'],
        ['name' => 'Blog / Artikel',   'route' => 'articles.index'],
        ['name' => 'Kontak',           'route' => 'contact'],
    ];
@endphp

<footer class="hnp-footer-modern text-white overflow-hidden relative">

    {{-- Neon Strip Top Border --}}
    <div class="footer-top-strip"></div>

    {{-- Glow blobs --}}
    <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-96 h-96 bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 translate-y-1/3 -translate-x-1/4 w-80 h-80 bg-yellow-500/5 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10 pt-20 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start mb-16">

            {{-- ═══════════════════════════════════════
                 Column 1: Brand & Headline
            ════════════════════════════════════════ --}}
            <div class="lg:col-span-7 space-y-8">

                {{-- ── LOGO PURE TAILWIND CSS (no icon) ── --}}
                <div class="brand-wrapper flex items-center gap-3">

                    {{-- Logo Mark: huruf HNP dalam kotak jajaran genjang kuning --}}
                    <div class="logo-mark-wrap relative flex-shrink-0">
                        {{-- Kotak kuning miring (clip-path parallelogram) --}}
                        <div class="logo-bg-shape"></div>
                        {{-- Teks "HNP" di atasnya --}}
                        <span class="logo-mark-text">HNP</span>
                    </div>

                    {{-- Nama brand di sebelah kanan logo --}}
                    <div class="logo-brand-block">
                        <div class="logo-brand-main">Communications</div>
                        <div class="logo-brand-sub">
                            <span class="logo-brand-dot"></span>
                            <span>Media &amp; Content Agency</span>
                        </div>
                    </div>
                </div>
                {{-- ── END LOGO ── --}}

                <h2 class="text-4xl md:text-6xl font-black leading-[1.1] tracking-tighter uppercase" style="font-family:'Unbounded',sans-serif">
                    {{ $headline1 }} <br>
                    <span class="text-yellow-400">{{ $headline2 }}</span> <br>
                    {{ $headline3 }}
                </h2>

                <p class="text-slate-400 text-lg md:text-xl font-medium max-w-xl leading-relaxed font-plus">
                    {{ $desc }}
                </p>

                {{-- Social Media Icons --}}
                <div class="flex items-center gap-5">
                    @if($instagram && $instagram !== '#')
                    <a href="{{ $instagram }}" target="_blank" rel="noopener" class="social-btn" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif
                    @if($facebook && $facebook !== '#')
                    <a href="{{ $facebook }}" target="_blank" rel="noopener" class="social-btn" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    @endif
                    @if($youtube && $youtube !== '#')
                    <a href="{{ $youtube }}" target="_blank" rel="noopener" class="social-btn" aria-label="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    @endif
                    @if($tiktok && $tiktok !== '#')
                    <a href="{{ $tiktok }}" target="_blank" rel="noopener" class="social-btn" aria-label="TikTok">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    @endif
                </div>
            </div>

            {{-- ═══════════════════════════════════════
                 Column 2: Nav, Layanan & WhatsApp
            ════════════════════════════════════════ --}}
            <div class="lg:col-span-5 flex flex-col gap-8 font-plus">

                {{-- Quick Links: Layanan & Navigasi berdampingan --}}
                <div class="grid grid-cols-2 gap-6">

                    {{-- LAYANAN --}}
                    <div>
                        <div class="footer-col-label mb-3">
                            <span class="col-label-dot"></span> LAYANAN
                        </div>
                        <ul class="footer-nav-list">
                            @foreach($services as $i => $svc)
                            <li>
                                <a href="{{ route($svc['route']) }}" class="footer-nav-link group">
                                    <span class="footer-nav-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    <span class="footer-nav-text">{{ $svc['name'] }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- NAVIGASI --}}
                    <div>
                        <div class="footer-col-label mb-3">
                            <span class="col-label-dot"></span> NAVIGASI
                        </div>
                        <ul class="footer-nav-list">
                            @foreach($navLinks as $nl)
                            <li>
                                <a href="{{ route($nl['route']) }}" class="footer-nav-link group">
                                    <span class="footer-nav-dash">—</span>
                                    <span class="footer-nav-text">{{ $nl['name'] }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- HUBUNGI KAMI --}}
                <div>
                    <div class="footer-col-label mb-3">
                        <span class="col-label-dot"></span> HUBUNGI KAMI
                    </div>
                    <div class="space-y-3">

                        @if($wa1Number)
                        <a href="https://wa.me/{{ $wa1Number }}" target="_blank" rel="noopener" class="wa-card-modern p-4 rounded-xl flex items-center justify-between group">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-green-500/10 rounded-full flex items-center justify-center text-green-400 group-hover:bg-green-500/20 transition-all flex-shrink-0">
                                    <i class="fab fa-whatsapp text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest font-mono">Whatsapp Hotline 1</p>
                                    <p class="text-sm font-bold tracking-tight text-slate-200 group-hover:text-white transition-colors font-mono">{{ $wa1Label }}</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-arrow-right text-slate-600 group-hover:translate-x-1 group-hover:text-cyan-400 transition-all text-xs"></i>
                        </a>
                        @endif

                        @if($wa2Number)
                        <a href="https://wa.me/{{ $wa2Number }}" target="_blank" rel="noopener" class="wa-card-modern wa-card-alt p-4 rounded-xl flex items-center justify-between group">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-cyan-500/10 rounded-full flex items-center justify-center text-cyan-400 group-hover:bg-cyan-500/20 transition-all flex-shrink-0">
                                    <i class="fab fa-whatsapp text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest font-mono">Whatsapp Hotline 2</p>
                                    <p class="text-sm font-bold tracking-tight text-slate-200 group-hover:text-white transition-colors font-mono">{{ $wa2Label }}</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-arrow-right text-slate-600 group-hover:translate-x-1 group-hover:text-cyan-400 transition-all text-xs"></i>
                        </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom Footer Bar --}}
        <div class="pt-8 border-t border-slate-800/60 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest text-center md:text-left font-mono">
                {{ $copyright }}
            </p>
            <a href="#"
               class="w-10 h-10 border border-slate-800 bg-slate-900/40 rounded-full flex items-center justify-center hover:bg-yellow-400 hover:text-black hover:border-yellow-400 transition-all group"
               onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;"
               aria-label="Kembali ke atas">
                <i class="fa-solid fa-arrow-up text-sm transform group-hover:-translate-y-0.5 transition-transform"></i>
            </a>
        </div>
    </div>
</footer>

<style>
/* ══════════════════════════════════════════════════════════
   HNP FOOTER — Neon Noir / Deep Purple Theme
   ══════════════════════════════════════════════════════════ */

.hnp-footer-modern {
    background-color: #1a0033;
    position: relative;
    color: #ffffff;
    overflow: hidden;
    padding: 60px 0 30px 0;
}

/* Neon strip top */
.footer-top-strip {
    height: 4px;
    background: linear-gradient(90deg, #F5E642 0%, #FF2D6B 50%, #00E5FF 100%);
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
}

/* Noise texture */
.hnp-footer-modern::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 1;
}

/* ─────────────────────────────────────────
   LOGO — Pure CSS, no icon dependency
   ───────────────────────────────────────── */

.brand-wrapper {
    display: flex;
    align-items: center;
    gap: 14px;
}

/* Wrapper posisi relative agar text bisa ditumpuk di atas shape */
.logo-mark-wrap {
    position: relative;
    width: 62px;
    height: 48px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Kotak kuning berbentuk jajaran genjang (parallelogram) */
.logo-bg-shape {
    position: absolute;
    inset: 0;
    background: #F5E642;
    clip-path: polygon(10px 0%, 100% 0%, calc(100% - 10px) 100%, 0% 100%);
    border-radius: 2px;
}

/* Shadow/layer kedua di belakang untuk efek depth */
.logo-bg-shape::after {
    content: '';
    position: absolute;
    inset: 0;
    background: #c9bb2a;
    clip-path: polygon(10px 0%, 100% 0%, calc(100% - 10px) 100%, 0% 100%);
    transform: translate(3px, 3px);
    z-index: -1;
    border-radius: 2px;
}

/* Teks "HNP" di atas shape kuning */
.logo-mark-text {
    position: relative;
    z-index: 2;
    font-family: 'Bebas Neue', 'Impact', 'Arial Black', sans-serif;
    font-size: 1.35rem;
    font-weight: 900;
    color: #1a0033;
    letter-spacing: 0.08em;
    line-height: 1;
    user-select: none;
}

/* Nama brand di sebelah kanan */
.logo-brand-block {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.logo-brand-main {
    font-family: 'Bebas Neue', 'Impact', sans-serif;
    font-size: 1.4rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #ffffff;
    line-height: 1;
}

.logo-brand-sub {
    display: flex;
    align-items: center;
    gap: 5px;
    font-family: 'IBM Plex Mono', monospace;
    font-size: 0.55rem;
    font-weight: 600;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: #a389bd;
}

.logo-brand-dot {
    display: inline-block;
    width: 4px;
    height: 4px;
    background: #F5E642;
    border-radius: 50%;
    box-shadow: 0 0 4px #F5E642;
    flex-shrink: 0;
}

/* ─────────────────────────────────────────
   NAVIGASI LIST
   ───────────────────────────────────────── */

.footer-nav-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
}

.footer-nav-list li {
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.footer-nav-list li:last-child {
    border-bottom: none;
}

.footer-nav-link {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 7px 0;
    text-decoration: none;
    transition: all 0.18s ease;
    white-space: nowrap;
}

.footer-nav-link:hover {
    padding-left: 5px;
}

.footer-nav-num {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 0.58rem;
    font-weight: 700;
    color: #4b0082;
    min-width: 18px;
    transition: color 0.18s;
}

.footer-nav-dash {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 0.65rem;
    color: #4b0082;
    min-width: 18px;
    transition: color 0.18s;
}

.footer-nav-text {
    font-size: 0.72rem;
    color: #94a3b8;
    transition: color 0.18s;
    letter-spacing: 0.01em;
}

.footer-nav-link:hover .footer-nav-num,
.footer-nav-link:hover .footer-nav-dash {
    color: #F5E642;
}

.footer-nav-link:hover .footer-nav-text {
    color: #F5E642;
}

/* ─────────────────────────────────────────
   LABEL KOLOM
   ───────────────────────────────────────── */

.footer-col-label {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 0.58rem;
    font-weight: 700;
    color: #a389bd;
    text-transform: uppercase;
    letter-spacing: 0.18em;
    display: flex;
    align-items: center;
    gap: 6px;
    padding-bottom: 0.6rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    margin-bottom: 0.75rem;
}

.col-label-dot {
    width: 5px;
    height: 5px;
    background: #F5E642;
    border-radius: 50%;
    box-shadow: 0 0 5px #F5E642;
    flex-shrink: 0;
}

/* ─────────────────────────────────────────
   SOCIAL BUTTONS
   ───────────────────────────────────────── */

.social-btn {
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #4b0082;
    border-radius: 8px;
    background: #2d0059;
    color: #F5E642;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
}

.social-btn:hover {
    border-color: #F5E642;
    color: #ffffff;
    background: #4b0082;
    box-shadow: 0 0 15px rgba(245, 230, 66, 0.25);
    transform: translateY(-3px) rotate(5deg);
}

/* ─────────────────────────────────────────
   WHATSAPP CARDS
   ───────────────────────────────────────── */

.wa-card-modern {
    background: #2d0059;
    border: 1px solid #4b0082;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    text-decoration: none;
    position: relative;
    overflow: hidden;
}

.wa-card-modern::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background: #25D366;
    transform: scaleY(0);
    transform-origin: bottom;
    transition: transform 0.3s;
}

.wa-card-modern:hover::before {
    transform: scaleY(1);
}

.wa-card-modern:hover {
    background: #390070;
    border-color: #25D366;
    transform: translateX(4px);
    box-shadow: 0 8px 20px -10px rgba(37, 211, 102, 0.3);
}

.wa-card-alt::before {
    background: #00E5FF;
}

.wa-card-alt:hover {
    border-color: #00E5FF;
    box-shadow: 0 8px 20px -10px rgba(0, 229, 255, 0.3);
}
</style>