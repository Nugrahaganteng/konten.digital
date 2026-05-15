{{--
    SITE FOOTER — CMS-Driven
    Membaca data dari PageSection model (page: 'footer')
    Sections: main, contact, social
--}}

@php
    use App\Models\PageSection;

    // Ambil semua section footer sekaligus (di-cache per request via static)
    static $footerSections = null;
    if ($footerSections === null) {
        $footerSections = PageSection::ofPage('footer');
    }

    $fMain    = $footerSections->get('main');
    $fContact = $footerSections->get('contact');
    $fSocial  = $footerSections->get('social');

    // Helper: get value atau fallback ke placeholder dari schema
    $get = fn($section, $key, $fallback = '') =>
        optional($section)->get($key, '') ?: $fallback;

    // ── MAIN ──────────────────────────────────────────────
    $headline1  = $get($fMain, 'headline_1',  'Bersama Kami,');
    $headline2  = $get($fMain, 'headline_2',  'Raih Kesuksesan');
    $headline3  = $get($fMain, 'headline_3',  'di Era Digital');
    $desc       = $get($fMain, 'description', 'Bergabunglah dengan ratusan klien yang puas dan rasakan perbedaan dengan konten berkualitas dari HNP Communications.');
    $copyright  = $get($fMain, 'copyright',   '© ' . date('Y') . ' HNP Communications.id — ALL RIGHTS RESERVED');

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

    // Navigasi layanan (statis — bisa diextend ke CMS kalau perlu)
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

<footer class="hnp-footer">

    {{-- ── Neon Top Border ──────────────────────────────────────────── --}}
    <div class="footer-top-strip"></div>

    {{-- ── Main Grid ───────────────────────────────────────────────── --}}
    <div class="footer-inner">

        {{-- Col 1: Brand + Headline --}}
        <div class="footer-brand-col">
            <div class="footer-logo-mark">
                <span class="logo-letters">HC</span>
            </div>
            <div class="footer-brand-name">HNP<br><span>Communications</span></div>

            <div class="footer-headline">
                <span class="fh-line fh-normal">{{ $headline1 }}</span>
                <span class="fh-line fh-accent">{{ $headline2 }}</span>
                <span class="fh-line fh-normal">{{ $headline3 }}</span>
            </div>

            <p class="footer-desc">{{ $desc }}</p>

            {{-- Social Icons --}}
            <div class="footer-socials">
                @if($instagram && $instagram !== '#')
                <a href="{{ $instagram }}" target="_blank" rel="noopener" class="social-btn" aria-label="Instagram">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                </a>
                @endif
                @if($facebook && $facebook !== '#')
                <a href="{{ $facebook }}" target="_blank" rel="noopener" class="social-btn" aria-label="Facebook">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
                @endif
                @if($youtube && $youtube !== '#')
                <a href="{{ $youtube }}" target="_blank" rel="noopener" class="social-btn" aria-label="YouTube">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="white"/></svg>
                </a>
                @endif
                @if($tiktok && $tiktok !== '#')
                <a href="{{ $tiktok }}" target="_blank" rel="noopener" class="social-btn" aria-label="TikTok">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.34-6.34V8.69a8.27 8.27 0 0 0 4.83 1.55V6.79a4.86 4.86 0 0 1-1.07-.1z"/></svg>
                </a>
                @endif
            </div>
        </div>

        {{-- Col 2: Layanan --}}
        <div class="footer-nav-col">
            <div class="footer-col-label">
                <span class="col-label-dot"></span>
                LAYANAN
            </div>
            <ul class="footer-nav-list">
                @foreach($services as $svc)
                <li>
                    <a href="{{ route($svc['route']) }}" class="footer-nav-link">
                        <span class="nav-arrow">→</span>
                        {{ $svc['name'] }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

        {{-- Col 3: Navigasi --}}
        <div class="footer-nav-col">
            <div class="footer-col-label">
                <span class="col-label-dot"></span>
                NAVIGASI
            </div>
            <ul class="footer-nav-list">
                @foreach($navLinks as $nl)
                <li>
                    <a href="{{ route($nl['route']) }}" class="footer-nav-link">
                        <span class="nav-arrow">→</span>
                        {{ $nl['name'] }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

        {{-- Col 4: Kontak / WhatsApp --}}
        <div class="footer-contact-col">
            <div class="footer-col-label">
                <span class="col-label-dot"></span>
                HUBUNGI KAMI
            </div>

            <div class="wa-cards">
                @if($wa1Number)
                <a href="https://wa.me/{{ $wa1Number }}" target="_blank" rel="noopener" class="wa-card">
                    <div class="wa-icon">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                    </div>
                    <div class="wa-info">
                        <span class="wa-label-text">WhatsApp Hotline 1</span>
                        <span class="wa-number">{{ $wa1Label }}</span>
                    </div>
                    <div class="wa-arrow">↗</div>
                </a>
                @endif

                @if($wa2Number)
                <a href="https://wa.me/{{ $wa2Number }}" target="_blank" rel="noopener" class="wa-card wa-card-alt">
                    <div class="wa-icon">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                    </div>
                    <div class="wa-info">
                        <span class="wa-label-text">WhatsApp Hotline 2</span>
                        <span class="wa-number">{{ $wa2Label }}</span>
                    </div>
                    <div class="wa-arrow">↗</div>
                </a>
                @endif
            </div>

            {{-- Fast Response Badge --}}
            <div class="response-badge">
                <span class="response-dot"></span>
                RESPON CEPAT &lt; 1 JAM
            </div>
        </div>

    </div>

    {{-- ── Divider ──────────────────────────────────────────────────── --}}
    <div class="footer-divider"></div>

    {{-- ── Bottom Bar ───────────────────────────────────────────────── --}}
    <div class="footer-bottom">
        <span class="copyright-text">{{ $copyright }}</span>
        <div class="footer-bottom-links">
            <a href="{{ route('syarat-ketentuan') }}" class="bottom-link">Syarat & Ketentuan</a>
            <span class="bottom-sep">·</span>
            <a href="{{ route('contact') }}" class="bottom-link">Kontak</a>
        </div>
    </div>

</footer>

<style>
/* ══════════════════════════════════════════════════════════
   HNP FOOTER — CMS-Driven
   Dark Retro Arcade · Neon Noir
   ══════════════════════════════════════════════════════════ */

.hnp-footer {
    --f-bg:       #070712;
    --f-bg2:      #0D0D20;
    --f-panel:    #111120;
    --f-border:   #1E1E38;
    --f-border2:  #2C2C50;
    --f-yellow:   #F5E642;
    --f-cyan:     #00E5FF;
    --f-lime:     #B8FF00;
    --f-magenta:  #FF2D6B;
    --f-text:     #E8E8F0;
    --f-text2:    #8888B0;
    --f-muted:    #44446A;

    background: var(--f-bg);
    color: var(--f-text);
    font-family: 'Barlow', 'Segoe UI', sans-serif;
    position: relative;
    overflow: hidden;
}

/* Noise texture */
.hnp-footer::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
    background-size: 200px 200px;
    pointer-events: none;
    z-index: 0;
}

/* Scanlines */
.hnp-footer::after {
    content: '';
    position: absolute;
    inset: 0;
    background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,0,0,.06) 2px, rgba(0,0,0,.06) 4px);
    pointer-events: none;
    z-index: 0;
}

/* Top neon strip */
.footer-top-strip {
    height: 3px;
    background: linear-gradient(90deg, var(--f-yellow) 0%, var(--f-cyan) 40%, var(--f-magenta) 70%, transparent 100%);
    position: relative;
    z-index: 1;
}

/* ── Inner layout ───────────────────────────────────────── */
.footer-inner {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1.4fr;
    gap: 2.5rem;
    padding: 3.5rem 5vw 3rem;
    max-width: 1400px;
    margin: 0 auto;
}

@media (max-width: 1100px) {
    .footer-inner { grid-template-columns: 1fr 1fr; gap: 2rem; }
}
@media (max-width: 640px) {
    .footer-inner { grid-template-columns: 1fr; gap: 2rem; padding: 2.5rem 1.5rem 2rem; }
}

/* ── Brand Col ──────────────────────────────────────────── */
.footer-brand-col { display: flex; flex-direction: column; gap: .9rem; }

.footer-logo-mark {
    width: 52px; height: 52px;
    background: var(--f-yellow);
    display: flex;
    align-items: center;
    justify-content: center;
    clip-path: polygon(10px 0%, 100% 0%, calc(100% - 10px) 100%, 0% 100%);
    flex-shrink: 0;
}
.logo-letters {
    font-family: 'Bebas Neue', 'Impact', sans-serif;
    font-size: 1.3rem;
    color: #0A0A14;
    font-weight: 900;
    letter-spacing: .05em;
}
.footer-brand-name {
    font-family: 'Bebas Neue', 'Impact', sans-serif;
    font-size: 1.4rem;
    letter-spacing: .1em;
    line-height: 1.1;
    color: var(--f-text);
}
.footer-brand-name span { color: var(--f-yellow); }

.footer-headline {
    display: flex;
    flex-direction: column;
    gap: 0;
    margin: .5rem 0 .2rem;
}
.fh-line {
    font-family: 'Bebas Neue', 'Impact', sans-serif;
    font-size: 1.75rem;
    letter-spacing: .06em;
    line-height: 1.05;
    display: block;
}
.fh-normal { color: var(--f-text); }
.fh-accent { color: var(--f-yellow); }

.footer-desc {
    font-size: .78rem;
    color: var(--f-text2);
    line-height: 1.7;
    max-width: 320px;
}

/* Social buttons */
.footer-socials {
    display: flex;
    gap: .5rem;
    flex-wrap: wrap;
    margin-top: .25rem;
}
.social-btn {
    width: 36px; height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--f-border2);
    border-radius: 4px;
    background: var(--f-panel);
    color: var(--f-text2);
    transition: all .15s;
    flex-shrink: 0;
}
.social-btn svg { width: 16px; height: 16px; }
.social-btn:hover {
    border-color: var(--f-yellow);
    color: var(--f-yellow);
    background: rgba(245,230,66,.08);
    box-shadow: 0 0 10px rgba(245,230,66,.2);
    transform: translateY(-2px);
}

/* ── Nav Cols ───────────────────────────────────────────── */
.footer-nav-col { display: flex; flex-direction: column; gap: .85rem; }

.footer-col-label {
    font-family: 'IBM Plex Mono', 'Courier New', monospace;
    font-size: .6rem;
    font-weight: 700;
    color: var(--f-muted);
    text-transform: uppercase;
    letter-spacing: .15em;
    display: flex;
    align-items: center;
    gap: .5rem;
    padding-bottom: .6rem;
    border-bottom: 1px solid var(--f-border);
    position: relative;
}
.footer-col-label::after {
    content: '';
    position: absolute;
    bottom: -1px; left: 0;
    width: 30px; height: 1px;
    background: var(--f-yellow);
}
.col-label-dot {
    width: 5px; height: 5px;
    background: var(--f-yellow);
    border-radius: 50%;
    flex-shrink: 0;
}

.footer-nav-list {
    list-style: none;
    margin: 0; padding: 0;
    display: flex;
    flex-direction: column;
    gap: .3rem;
}
.footer-nav-link {
    font-size: .78rem;
    color: var(--f-text2);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: .45rem;
    padding: .3rem 0;
    transition: all .15s;
    border-bottom: 1px solid transparent;
}
.footer-nav-link:hover {
    color: var(--f-cyan);
    padding-left: .3rem;
}
.nav-arrow {
    font-size: .65rem;
    color: var(--f-muted);
    transition: all .15s;
    flex-shrink: 0;
    opacity: 0;
}
.footer-nav-link:hover .nav-arrow {
    opacity: 1;
    color: var(--f-cyan);
    transform: translateX(2px);
}

/* ── Contact Col ────────────────────────────────────────── */
.footer-contact-col { display: flex; flex-direction: column; gap: .85rem; }

.wa-cards { display: flex; flex-direction: column; gap: .6rem; }

.wa-card {
    display: flex;
    align-items: center;
    gap: .75rem;
    padding: .7rem .9rem;
    border: 1px solid var(--f-border2);
    border-radius: 6px;
    background: var(--f-panel);
    text-decoration: none;
    transition: all .2s;
    position: relative;
    overflow: hidden;
}
.wa-card::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    background: #25D366;
    transform: scaleY(0);
    transform-origin: bottom;
    transition: transform .2s;
}
.wa-card:hover::before { transform: scaleY(1); }
.wa-card:hover {
    border-color: #25D366;
    background: rgba(37,211,102,.06);
    box-shadow: 0 0 16px rgba(37,211,102,.15);
    transform: translateX(3px);
}
.wa-card-alt::before { background: var(--f-cyan); }
.wa-card-alt:hover {
    border-color: var(--f-cyan);
    background: rgba(0,229,255,.06);
    box-shadow: 0 0 16px rgba(0,229,255,.12);
}

.wa-icon {
    width: 34px; height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #25D366;
    flex-shrink: 0;
}
.wa-card-alt .wa-icon { color: var(--f-cyan); }
.wa-icon svg { width: 22px; height: 22px; }

.wa-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 1px;
}
.wa-label-text {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .55rem;
    color: var(--f-muted);
    text-transform: uppercase;
    letter-spacing: .08em;
}
.wa-number {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .78rem;
    font-weight: 700;
    color: var(--f-text);
}
.wa-arrow {
    font-size: .9rem;
    color: var(--f-muted);
    transition: all .15s;
}
.wa-card:hover .wa-arrow {
    color: #25D366;
    transform: translate(2px, -2px);
}
.wa-card-alt:hover .wa-arrow { color: var(--f-cyan); }

.response-badge {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    font-family: 'IBM Plex Mono', monospace;
    font-size: .62rem;
    font-weight: 700;
    color: var(--f-lime);
    background: rgba(184,255,0,.06);
    border: 1px solid rgba(184,255,0,.2);
    border-radius: 4px;
    padding: .4rem .75rem;
    letter-spacing: .06em;
    text-transform: uppercase;
    width: fit-content;
    margin-top: .25rem;
}
.response-dot {
    width: 7px; height: 7px;
    background: var(--f-lime);
    border-radius: 50%;
    box-shadow: 0 0 6px var(--f-lime);
    animation: respPip 2s ease infinite;
    flex-shrink: 0;
}
@keyframes respPip { 0%,100% { opacity:1; } 50% { opacity:.25; } }

/* ── Divider ────────────────────────────────────────────── */
.footer-divider {
    position: relative;
    z-index: 1;
    height: 1px;
    background: var(--f-border);
    margin: 0 5vw;
}
.footer-divider::after {
    content: '';
    position: absolute;
    left: 0; top: 0;
    width: 120px; height: 1px;
    background: linear-gradient(90deg, var(--f-yellow), transparent);
}

/* ── Bottom Bar ─────────────────────────────────────────── */
.footer-bottom {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: .75rem;
    padding: 1.1rem 5vw;
    max-width: 1400px;
    margin: 0 auto;
}
.copyright-text {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .62rem;
    color: var(--f-muted);
    letter-spacing: .06em;
    text-transform: uppercase;
}
.footer-bottom-links {
    display: flex;
    align-items: center;
    gap: .5rem;
}
.bottom-link {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .62rem;
    color: var(--f-muted);
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: .06em;
    transition: color .15s;
}
.bottom-link:hover { color: var(--f-yellow); }
.bottom-sep { color: var(--f-border2); font-size: .65rem; }
</style>