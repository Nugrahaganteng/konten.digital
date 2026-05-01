{{-- resources/views/home.blade.php --}}
@extends('layouts.app')
@section('title', 'Jasa Press Release & Digital Agency')

@push('styles')
<style>
@import url('https://fonts.googleapis.com/css2?family=Anton&family=DM+Sans:ital,wght@0,400;0,700;1,400&display=swap');

/* ═══ TOKENS ═══ */
:root {
    --ink    : #0e0b14;
    --cream  : #f7f2e8;
    --yellow : #f5c518;
    --purple : #2d1b4e;
    --punch  : #e8402a;
    --teal   : #00a896;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    background: var(--cream);
    color: var(--ink);
    font-family: 'DM Sans', sans-serif;
    overflow-x: hidden;
}

/* ── HERO ─────────────────────────────────── */
.hero {
    background: var(--yellow);
    border-bottom: 5px solid var(--ink);
    padding: 7rem 0 0;
    overflow: hidden;
    position: relative;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.hero-top {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    align-items: start;
    gap: 2rem;
    padding: 0 4rem;
    flex: 1;
    align-content: center;
    padding-bottom: 3rem;
}

.hero-left {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    padding-top: 3rem;
}

.tag-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--punch);
    color: var(--cream);
    font-family: 'Anton', sans-serif;
    font-size: 0.7rem;
    letter-spacing: 0.15em;
    padding: 0.4rem 1rem;
    border: 2.5px solid var(--ink);
    width: fit-content;
    transform: rotate(-1.5deg);
}

.hero-subtitle {
    font-size: 1.05rem;
    line-height: 1.65;
    color: var(--purple);
    font-weight: 700;
    max-width: 280px;
}

.hero-cta {
    display: inline-block;
    background: var(--ink);
    color: var(--yellow);
    font-family: 'Anton', sans-serif;
    font-size: 1rem;
    letter-spacing: 0.08em;
    padding: 0.9rem 2rem;
    border: 3px solid var(--ink);
    box-shadow: 6px 6px 0 var(--purple);
    text-decoration: none;
    transition: transform 0.15s, box-shadow 0.15s;
    width: fit-content;
}
.hero-cta:hover { transform: translate(4px,4px); box-shadow: 2px 2px 0 var(--purple); }

.hero-center {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0;
}

.hero-wordmark {
    font-family: 'Anton', sans-serif;
    font-size: clamp(5.5rem, 10vw, 9rem);
    line-height: 0.9;
    letter-spacing: -0.01em;
    text-align: center;
    color: var(--purple);
    text-shadow: 5px 5px 0 var(--punch);
    white-space: nowrap;
}
.hero-wordmark .line2 {
    color: transparent;
    -webkit-text-stroke: 3px var(--purple);
}

.hero-right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 1.5rem;
    padding-top: 3rem;
}

.stat-box {
    background: var(--purple);
    color: var(--yellow);
    border: 3px solid var(--ink);
    box-shadow: 5px 5px 0 var(--ink);
    padding: 1rem 1.5rem;
    text-align: right;
}
.stat-box .num {
    font-family: 'Anton', sans-serif;
    font-size: 2.8rem;
    line-height: 1;
    display: block;
}
.stat-box .lbl {
    font-size: 0.7rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: rgba(245,197,24,0.65);
    display: block;
    margin-top: 0.2rem;
}

.hero-mountain {
    width: 100%;
    display: block;
    margin-top: auto;
}

/* ── MARQUEE ───────────────────────────────── */
.marquee-wrap {
    background: var(--punch);
    border-top: 4px solid var(--ink);
    border-bottom: 4px solid var(--ink);
    overflow: hidden;
    padding: 0.75rem 0;
}
.marquee-track {
    display: flex;
    width: max-content;
    animation: marquee 22s linear infinite;
}
@keyframes marquee { to { transform: translateX(-50%); } }
.marquee-item {
    font-family: 'Anton', sans-serif;
    font-size: 0.85rem;
    letter-spacing: 0.15em;
    color: var(--cream);
    padding: 0 2.5rem;
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: 2.5rem;
}
.marquee-dot { width: 6px; height: 6px; background: var(--yellow); border-radius: 50%; flex-shrink: 0; }

/* ── ABOUT ─────────────────────────────────── */
.about {
    background: var(--purple);
    padding: 5rem 4rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 5rem;
    align-items: center;
    border-bottom: 5px solid var(--ink);
}

.sec-eyebrow {
    display: inline-block;
    background: var(--yellow);
    color: var(--purple);
    font-family: 'Anton', sans-serif;
    font-size: 0.75rem;
    letter-spacing: 0.15em;
    padding: 0.35rem 1rem;
    border: 2.5px solid var(--ink);
    margin-bottom: 1.5rem;
}

.about-title {
    font-family: 'Anton', sans-serif;
    font-size: clamp(3rem, 5vw, 5rem);
    color: var(--cream);
    line-height: 0.92;
    letter-spacing: -0.01em;
    margin-bottom: 1.5rem;
}
.about-title em {
    font-style: normal;
    color: var(--yellow);
    display: block;
}

.about-body {
    color: rgba(247,242,232,0.72);
    line-height: 1.75;
    font-size: 1rem;
    margin-bottom: 2rem;
}

.about-metrics {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1px;
    background: rgba(255,255,255,0.12);
    border: 2px solid rgba(255,255,255,0.12);
}
.metric {
    background: rgba(255,255,255,0.04);
    padding: 1.25rem;
}
.metric .val {
    font-family: 'Anton', sans-serif;
    font-size: 2.4rem;
    color: var(--yellow);
    line-height: 1;
}
.metric .lbl {
    font-size: 0.75rem;
    color: rgba(247,242,232,0.5);
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-top: 0.25rem;
}

.about-image-col { position: relative; }
.about-img-frame {
    border: 5px solid var(--yellow);
    background: var(--yellow);
    overflow: hidden;
    aspect-ratio: 4/3;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 14px 14px 0 var(--punch);
}
.about-float-card {
    position: absolute;
    bottom: -2rem;
    right: -2rem;
    background: var(--punch);
    border: 3px solid var(--ink);
    padding: 1rem 1.25rem;
    box-shadow: 5px 5px 0 var(--ink);
}
.about-float-card .fc-num {
    font-family: 'Anton', sans-serif;
    font-size: 2.2rem;
    color: var(--cream);
    line-height: 1;
}
.about-float-card .fc-lbl {
    font-size: 0.65rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: rgba(247,242,232,0.65);
}

/* ── CLIENTS ───────────────────────────────── */
.clients {
    background: var(--ink);
    padding: 5rem 4rem;
    border-bottom: 5px solid var(--ink);
}
.sec-header {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 3rem;
}
.sec-header-title {
    font-family: 'Anton', sans-serif;
    font-size: 1.4rem;
    color: var(--cream);
    letter-spacing: 0.03em;
    white-space: nowrap;
}
.sec-header-line {
    flex: 1;
    height: 2px;
    background: repeating-linear-gradient(
        90deg,
        rgba(245,197,24,0.4) 0, rgba(245,197,24,0.4) 8px,
        transparent 8px, transparent 16px
    );
}
.sec-header-badge {
    width: 22px; height: 22px;
    background: var(--punch);
    border-radius: 50%;
    flex-shrink: 0;
}

.clients-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    border: 3px solid rgba(245,197,24,0.25);
}
@media(max-width:900px){ .clients-grid { grid-template-columns: repeat(3,1fr); } }
@media(max-width:500px){ .clients-grid { grid-template-columns: repeat(2,1fr); } }

.client-tile {
    border: 1px solid rgba(245,197,24,0.15);
    aspect-ratio: 16/9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Anton', sans-serif;
    font-size: 0.75rem;
    letter-spacing: 0.1em;
    color: rgba(245,197,24,0.3);
    text-transform: uppercase;
    transition: background 0.2s, color 0.2s;
    cursor: pointer;
    padding: 0.5rem;
    text-align: center;
}
.client-tile:hover { background: var(--yellow); color: var(--purple); }

.clients-cta { margin-top: 2.5rem; text-align: center; }
.outline-btn {
    display: inline-block;
    border: 2.5px solid rgba(245,197,24,0.4);
    color: rgba(245,197,24,0.7);
    font-family: 'Anton', sans-serif;
    font-size: 0.85rem;
    letter-spacing: 0.12em;
    padding: 0.65rem 2.5rem;
    text-decoration: none;
    transition: border-color 0.2s, color 0.2s, background 0.2s;
    cursor: pointer;
    background: transparent;
}
.outline-btn:hover { border-color: var(--yellow); color: var(--purple); background: var(--yellow); }

/* ── SERVICES ──────────────────────────────── */
.services {
    background: var(--cream);
    padding: 5rem 4rem;
    border-bottom: 5px solid var(--ink);
}
.services .sec-header-title { color: var(--ink); }
.services .sec-header-line {
    background: none;
    background-image: repeating-linear-gradient(
        90deg,
        rgba(14,11,20,0.25) 0, rgba(14,11,20,0.25) 8px,
        transparent 8px, transparent 16px
    );
}
.services .sec-header-badge { background: var(--teal); }

.service-tabs {
    display: flex;
    gap: 0;
    border: 3px solid var(--ink);
    margin-bottom: 0;
    overflow: auto;
}
.stab {
    font-family: 'Anton', sans-serif;
    font-size: 0.78rem;
    letter-spacing: 0.1em;
    padding: 0.85rem 1.5rem;
    border: none;
    background: transparent;
    color: rgba(14,11,20,0.4);
    cursor: pointer;
    border-right: 2px solid var(--ink);
    transition: background 0.15s, color 0.15s;
    white-space: nowrap;
    text-transform: uppercase;
}
.stab:last-child { border-right: none; }
.stab.active, .stab:hover { background: var(--ink); color: var(--yellow); }

.service-panel {
    display: none;
    grid-template-columns: 1fr 1fr;
    border: 3px solid var(--ink);
    border-top: none;
}
.service-panel.active { display: grid; }
@media(max-width:700px){ .service-panel { grid-template-columns: 1fr; } }

.sp-text { padding: 3rem; }
.sp-title {
    font-family: 'Anton', sans-serif;
    font-size: clamp(2.5rem, 4vw, 4rem);
    color: var(--purple);
    line-height: 0.95;
    margin-bottom: 1.25rem;
}
.sp-body {
    font-size: 1rem;
    line-height: 1.72;
    color: rgba(14,11,20,0.65);
    margin-bottom: 2rem;
}
.sp-cta {
    display: inline-block;
    background: var(--purple);
    color: var(--cream);
    font-family: 'Anton', sans-serif;
    font-size: 0.9rem;
    letter-spacing: 0.08em;
    padding: 0.75rem 2rem;
    box-shadow: 4px 4px 0 var(--ink);
    text-decoration: none;
    cursor: pointer;
    border: none;
    transition: transform 0.15s, box-shadow 0.15s;
}
.sp-cta:hover { transform: translate(3px,3px); box-shadow: 1px 1px 0 var(--ink); }

.sp-visual {
    background: var(--purple);
    min-height: 340px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    border-left: 3px solid var(--ink);
}
.sp-emoji { font-size: 7rem; animation: sway 3s ease-in-out infinite; position: relative; z-index: 2; }
@keyframes sway { 0%,100%{transform:translateY(0) rotate(-3deg)} 50%{transform:translateY(-16px) rotate(3deg)} }
.sp-bg-word {
    position: absolute;
    font-family: 'Anton', sans-serif;
    font-size: 8.5rem;
    color: rgba(255,255,255,0.05);
    right: -0.5rem;
    bottom: -1rem;
    line-height: 1;
    pointer-events: none;
}
@media(max-width:700px){ .sp-visual { border-left:none; border-top: 3px solid var(--ink); } }

.sdots { display: flex; justify-content: flex-start; gap: 0.5rem; padding: 1.25rem 0 0; }
.sdot {
    width: 28px; height: 5px;
    background: rgba(14,11,20,0.15);
    border: none; cursor: pointer;
    transition: background 0.2s, width 0.2s;
}
.sdot.active { background: var(--purple); width: 48px; }

/* ── CONTACT ───────────────────────────────── */
.contact {
    background: var(--punch);
    padding: 5rem 4rem;
    border-bottom: 5px solid var(--ink);
}
.contact-inner {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 3rem;
    align-items: center;
}
@media(max-width:640px){ .contact-inner { grid-template-columns: 1fr; } }

.contact-tag {
    display: inline-block;
    background: var(--ink);
    color: var(--yellow);
    font-family: 'Anton', sans-serif;
    font-size: 0.7rem;
    letter-spacing: 0.15em;
    padding: 0.35rem 1rem;
    margin-bottom: 1.25rem;
}
.contact-title {
    font-family: 'Anton', sans-serif;
    font-size: clamp(2.5rem, 5vw, 5rem);
    color: var(--cream);
    line-height: 0.92;
    margin-bottom: 1.25rem;
}
.contact-body {
    color: rgba(247,242,232,0.75);
    font-size: 1rem;
    line-height: 1.65;
    max-width: 480px;
}
.contact-btn {
    display: inline-block;
    background: var(--yellow);
    color: var(--purple);
    font-family: 'Anton', sans-serif;
    font-size: 1rem;
    letter-spacing: 0.08em;
    padding: 1rem 2.5rem;
    border: 3px solid var(--ink);
    box-shadow: 6px 6px 0 var(--ink);
    text-decoration: none;
    white-space: nowrap;
    transition: transform 0.15s, box-shadow 0.15s;
}
.contact-btn:hover { transform: translate(4px,4px); box-shadow: 2px 2px 0 var(--ink); }

.contact-icons {
    display: flex;
    justify-content: center;
    gap: 3rem;
    padding: 2.5rem 0 0;
    border-top: 3px solid rgba(14,11,20,0.2);
    margin-top: 3rem;
}
.ci { font-size: 2.5rem; animation: sway 3s ease-in-out infinite; }
.ci:nth-child(2){ animation-delay:.4s; }
.ci:nth-child(3){ animation-delay:.8s; }
.ci:nth-child(4){ animation-delay:1.2s; }
.ci:nth-child(5){ animation-delay:1.6s; }

/* ── FOOTER ────────────────────────────────── */
.footer { background: var(--ink); padding: 4rem 4rem 2rem; }
.footer-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 3rem;
    margin-bottom: 3rem;
}
@media(max-width:900px){ .footer-grid { grid-template-columns: 1fr 1fr; } }
@media(max-width:500px){ .footer-grid { grid-template-columns: 1fr; } }

.footer-brand {
    font-family: 'Anton', sans-serif;
    font-size: 2.2rem;
    color: var(--cream);
    letter-spacing: -0.01em;
    line-height: 1;
    margin-bottom: 1rem;
}
.footer-brand span { color: var(--yellow); }
.footer-tagline {
    font-size: 0.85rem;
    color: rgba(247,242,232,0.4);
    line-height: 1.6;
    margin-bottom: 1.5rem;
    max-width: 240px;
}
.footer-socials { display: flex; gap: 0.65rem; }
.fsoc {
    width: 36px; height: 36px;
    border: 1.5px solid rgba(247,242,232,0.2);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: rgba(247,242,232,0.45);
    font-family: 'Anton', sans-serif;
    font-size: 0.7rem;
    text-decoration: none;
    transition: border-color 0.2s, color 0.2s, background 0.2s;
}
.fsoc:hover { border-color: var(--yellow); color: var(--purple); background: var(--yellow); }

.footer-col-title {
    font-family: 'Anton', sans-serif;
    font-size: 0.75rem;
    letter-spacing: 0.15em;
    color: rgba(245,197,24,0.6);
    text-transform: uppercase;
    margin-bottom: 1.25rem;
}
.footer-col ul { list-style: none; }
.footer-col li { margin-bottom: 0.55rem; }
.footer-col a {
    color: rgba(247,242,232,0.45);
    font-size: 0.875rem;
    text-decoration: none;
    transition: color 0.2s;
}
.footer-col a:hover { color: var(--yellow); }

.footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.07);
    padding-top: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}
.footer-copy {
    font-size: 0.7rem;
    color: rgba(247,242,232,0.25);
    letter-spacing: 0.1em;
    text-transform: uppercase;
}
.footer-line { width: 48px; height: 3px; background: var(--yellow); }

/* ── SCROLL REVEAL ─────────────────────────── */
.rv { opacity:0; transform:translateY(36px); transition: opacity .65s ease, transform .65s ease; }
.rv.on { opacity:1; transform:none; }
.rv1 { transition-delay:.12s; }
.rv2 { transition-delay:.24s; }
.rv3 { transition-delay:.36s; }

/* ── RESPONSIVE ────────────────────────────── */
@media(max-width:900px){
    .hero-top { grid-template-columns: 1fr; padding: 0 2rem; text-align:center; }
    .hero-left, .hero-right { align-items: center; }
    .hero-right { flex-direction: row; flex-wrap:wrap; justify-content: center; }
    .about { grid-template-columns: 1fr; padding: 3rem 2rem; gap: 3rem; }
    .clients, .services, .contact, .footer { padding-left:2rem; padding-right:2rem; }
}
</style>
@endpush

@section('content')

{{-- ══ HERO ═════════════════════════════════════════════ --}}
<section class="hero">
    <div class="hero-top">

        <div class="hero-left rv">
            <span class="tag-pill">✦ DIGITAL AGENCY</span>
            <p class="hero-subtitle">
                Kami bukan agensi biasa.<br>
                Kami adalah <strong>partner kreatif</strong> yang bikin brand kamu berkesan.
            </p>
            <a href="https://wa.me/6281234567890" class="hero-cta">MULAI SEKARANG →</a>
        </div>

        <div class="hero-center rv rv1">
            <div class="hero-wordmark">
                <div class="line1">KONTEN</div>
                <div class="line2">DIGITAL</div>
            </div>
            <svg width="220" height="175" viewBox="0 0 220 175" fill="none" xmlns="http://www.w3.org/2000/svg"
                 style="margin-top:1rem;filter:drop-shadow(0 8px 0 #0e0b14);">
                <polygon points="75,112 145,112 185,170 35,170" fill="rgba(14,11,20,0.12)"/>
                <ellipse cx="110" cy="108" rx="68" ry="20" fill="#0e0b14"/>
                <ellipse cx="110" cy="104" rx="68" ry="20" fill="#2d1b4e" stroke="#f5c518" stroke-width="3"/>
                <ellipse cx="110" cy="88" rx="40" ry="26" fill="#00a896"/>
                <ellipse cx="110" cy="84" rx="36" ry="22" fill="#0dcfba"/>
                <circle cx="97" cy="84" r="7" fill="#f5c518"/>
                <circle cx="110" cy="79" r="7" fill="#f5c518"/>
                <circle cx="123" cy="84" r="7" fill="#f5c518"/>
                <circle cx="97" cy="84" r="3.5" fill="#0e0b14"/>
                <circle cx="110" cy="79" r="3.5" fill="#0e0b14"/>
                <circle cx="123" cy="84" r="3.5" fill="#0e0b14"/>
                <line x1="110" y1="62" x2="110" y2="48" stroke="#f5c518" stroke-width="3" stroke-linecap="round"/>
                <circle cx="110" cy="44" r="6" fill="#e8402a" stroke="#0e0b14" stroke-width="2"/>
                <line x1="88" y1="120" x2="62" y2="165" stroke="rgba(14,11,20,0.2)" stroke-width="2" stroke-dasharray="5,5"/>
                <line x1="110" y1="122" x2="110" y2="168" stroke="rgba(14,11,20,0.2)" stroke-width="2" stroke-dasharray="5,5"/>
                <line x1="132" y1="120" x2="158" y2="165" stroke="rgba(14,11,20,0.2)" stroke-width="2" stroke-dasharray="5,5"/>
            </svg>
        </div>

        <div class="hero-right rv rv2">
            <div class="stat-box">
                <span class="num">200+</span>
                <span class="lbl">Media Partner</span>
            </div>
            <div class="stat-box" style="background:var(--punch);">
                <span class="num">5+</span>
                <span class="lbl">Tahun Pengalaman</span>
            </div>
            <div class="stat-box" style="background:var(--teal);color:var(--ink);">
                <span class="num" style="color:var(--ink);">1K+</span>
                <span class="lbl" style="color:rgba(14,11,20,0.6);">Klien Puas</span>
            </div>
        </div>
    </div>

    <svg class="hero-mountain" viewBox="0 0 1440 160" fill="none" preserveAspectRatio="none">
        <path d="M0,160 L0,90 L60,30 L120,90 L200,10 L280,70 L360,0 L440,60 L520,15 L600,70 L680,5 L760,65 L840,20 L920,80 L1000,15 L1080,75 L1160,25 L1240,80 L1320,35 L1380,70 L1440,40 L1440,160 Z"
              fill="#2d1b4e"/>
    </svg>
</section>

{{-- ══ MARQUEE ════════════════════════════════════════════ --}}
<div class="marquee-wrap">
    <div class="marquee-track">
        @for($i=0;$i<8;$i++)
        <div class="marquee-item">
            PRESS RELEASE <span class="marquee-dot"></span>
            200+ MEDIA NASIONAL <span class="marquee-dot"></span>
            GARANSI TAYANG <span class="marquee-dot"></span>
            PROSES CEPAT <span class="marquee-dot"></span>
            KONTEN DIGITAL <span class="marquee-dot"></span>
        </div>
        @endfor
    </div>
</div>

{{-- ══ ABOUT ══════════════════════════════════════════════ --}}
<section class="about">
    <div class="about-image-col rv">
        <div class="about-img-frame">
            <svg width="380" height="280" viewBox="0 0 380 280" fill="none">
                <circle cx="190" cy="140" r="120" fill="#f5c518" opacity="0.15"/>
                <circle cx="190" cy="100" r="65" fill="#3b82f6"/>
                <circle cx="190" cy="100" r="52" fill="#60a5fa"/>
                <circle cx="172" cy="95" r="9" fill="white"/>
                <circle cx="208" cy="95" r="9" fill="white"/>
                <circle cx="175" cy="97" r="5" fill="#1e3a8a"/>
                <circle cx="211" cy="97" r="5" fill="#1e3a8a"/>
                <path d="M175 112 Q190 124 205 112" stroke="white" stroke-width="3.5" fill="none" stroke-linecap="round"/>
                <ellipse cx="190" cy="205" rx="58" ry="52" fill="#3b82f6"/>
                <path d="M132 190 Q95 165 82 135" stroke="#3b82f6" stroke-width="20" stroke-linecap="round" fill="none"/>
                <path d="M248 190 Q285 165 298 135" stroke="#3b82f6" stroke-width="20" stroke-linecap="round" fill="none"/>
                <circle cx="55" cy="70" r="22" fill="#e8402a" opacity="0.85"/>
                <circle cx="325" cy="60" r="15" fill="#22c55e" opacity="0.85"/>
                <rect x="28" y="170" width="42" height="42" rx="10" fill="#f5c518" stroke="#2d1b4e" stroke-width="3"/>
                <circle cx="350" cy="190" r="26" fill="#a855f7" opacity="0.7"/>
            </svg>
        </div>
        <div class="about-float-card">
            <div class="fc-num">98%</div>
            <div class="fc-lbl">Tingkat Kepuasan</div>
        </div>
    </div>

    <div class="rv rv1">
        <span class="sec-eyebrow">ABOUT US</span>
        <h2 class="about-title">
            Wish
            <em>Granted!</em>
        </h2>
        <p class="about-body">
            Berbasis di Bogor, Indonesia, kami adalah agensi digital kreatif yang berspesialisasi memberikan solusi dengan formula ideal — sebagai wujud nyata impian brand kamu. Mengutamakan kekeluargaan sebagai kunci membawa brand ke fase pertumbuhan yang luar biasa.
        </p>
        <div class="about-metrics">
            <div class="metric"><div class="val">200+</div><div class="lbl">Media Partner</div></div>
            <div class="metric"><div class="val">1K+</div><div class="lbl">Happy Clients</div></div>
            <div class="metric"><div class="val">5+</div><div class="lbl">Tahun Berdiri</div></div>
            <div class="metric"><div class="val">8</div><div class="lbl">Jenis Layanan</div></div>
        </div>
    </div>
</section>

{{-- ══ CLIENTS ════════════════════════════════════════════ --}}
<section class="clients">
    <div class="sec-header rv">
        <div class="sec-header-title">Our Clients.</div>
        <div class="sec-header-line"></div>
        <div class="sec-header-badge"></div>
    </div>

    @php
    $clients = [
        'Wardah','Good Day','Milo','Hoko Krunch','Hometown','Kopi Kenangan',
        'Relaxa','Cerelac','Sasa','Lactogrow','TotalCare','Daikin',
        'Vaseline','Excelso','Indomaret','Dancow','Nestle','Sampoerna'
    ];
    @endphp

    <div class="clients-grid rv rv1">
        @foreach($clients as $c)
        <div class="client-tile">{{ $c }}</div>
        @endforeach
    </div>
    <div class="clients-cta rv rv2">
        <button class="outline-btn">VIEW MORE</button>
    </div>
</section>

{{-- ══ SERVICES ════════════════════════════════════════════ --}}
<section class="services">
    <div class="sec-header rv">
        <div class="sec-header-title" style="color:var(--ink)">Our Services</div>
        <div class="sec-header-line"></div>
        <div class="sec-header-badge"></div>
    </div>

    @php
    $svcs = [
        ['tab'=>'Social Media','title'=>"Social Media\nManagement",'body'=>'Tingkatkan engagement brand kamu bersama kami di media sosial! Brand kamu akan menjadi lebih dikenal dan menjangkau lebih banyak orang dengan konten berkualitas tinggi.','emoji'=>'📱','bg'=>'SOCIAL'],
        ['tab'=>'Press Release','title'=>"Press\nRelease",'body'=>'Publikasikan brand kamu ke 200+ media nasional terpercaya. Tingkatkan kredibilitas dan awareness dengan artikel press release profesional yang tepat sasaran.','emoji'=>'📰','bg'=>'NEWS'],
        ['tab'=>'Visual Design','title'=>"Visual\nDesign",'body'=>'Desain visual yang bold, unik, dan berkesan untuk identitas brand kamu. Dari logo hingga konten media sosial, kami siap bantu tampil beda dari kompetitor.','emoji'=>'🎨','bg'=>'ART'],
        ['tab'=>'SEO','title'=>"SEO\nManagement",'body'=>'Optimalkan kehadiran online brand kamu di mesin pencari. Strategi SEO kami memastikan website kamu mudah ditemukan oleh target audiens yang tepat.','emoji'=>'🔍','bg'=>'GROW'],
        ['tab'=>'Digital Ads','title'=>"Digital\nAds",'body'=>'Iklan digital yang tepat sasaran dan efisien. Kami kelola campaign kamu di berbagai platform untuk hasil yang maksimal, terukur, dan sesuai budget.','emoji'=>'📊','bg'=>'ADS'],
    ];
    @endphp

    <div class="rv rv1">
        <div class="service-tabs" id="stabs">
            @foreach($svcs as $i => $s)
            <button class="stab {{ $i===0?'active':'' }}" data-idx="{{ $i }}">{{ $s['tab'] }}</button>
            @endforeach
        </div>

        @foreach($svcs as $i => $s)
        <div class="service-panel {{ $i===0?'active':'' }}" id="spanel-{{ $i }}">
            <div class="sp-text">
                <div class="sp-title">{!! nl2br(e($s['title'])) !!}</div>
                <p class="sp-body">{{ $s['body'] }}</p>
                <button class="sp-cta">READ MORE</button>
            </div>
            <div class="sp-visual">
                <div class="sp-emoji">{{ $s['emoji'] }}</div>
                <div class="sp-bg-word">{{ $s['bg'] }}</div>
            </div>
        </div>
        @endforeach

        <div class="sdots">
            @foreach($svcs as $i => $s)
            <button class="sdot {{ $i===0?'active':'' }}" data-idx="{{ $i }}"></button>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ CONTACT ════════════════════════════════════════════ --}}
<section class="contact">
    <div class="contact-inner rv">
        <div>
            <span class="contact-tag">✦ HUBUNGI KAMI</span>
            <h2 class="contact-title">Let's Build<br>Something<br>Different.</h2>
            <p class="contact-body">
                Punya ide gila untuk brand kamu? Kami siap dengar dan wujudkan. Hubungi kami sekarang dan mulai perjalanan pertumbuhan brand kamu bersama KontenDigital.id
            </p>
        </div>
        <a href="https://wa.me/6281234567890" class="contact-btn">LET'S CHAT →</a>
    </div>
    <div class="contact-icons">
        <div class="ci">🛸</div>
        <div class="ci">📡</div>
        <div class="ci">🚀</div>
        <div class="ci">⭐</div>
        <div class="ci">🎯</div>
    </div>
</section>


@endsection

@push('scripts')
<script>
const tabs   = document.querySelectorAll('.stab');
const panels = document.querySelectorAll('.service-panel');
const sdots  = document.querySelectorAll('.sdot');
let cur = 0, timer;

function goSvc(n) {
    panels[cur].classList.remove('active');
    tabs[cur].classList.remove('active');
    sdots[cur].classList.remove('active');
    cur = (n + tabs.length) % tabs.length;
    panels[cur].classList.add('active');
    tabs[cur].classList.add('active');
    sdots[cur].classList.add('active');
}

tabs.forEach(t => t.addEventListener('click', () => { clearInterval(timer); goSvc(+t.dataset.idx); startTimer(); }));
sdots.forEach(d => d.addEventListener('click', () => { clearInterval(timer); goSvc(+d.dataset.idx); startTimer(); }));
function startTimer() { timer = setInterval(() => goSvc(cur + 1), 4500); }
startTimer();

const rvEls = document.querySelectorAll('.rv');
const rvObs = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('on'); rvObs.unobserve(e.target); } });
}, { threshold: 0.1 });
rvEls.forEach(el => rvObs.observe(el));
</script>
@endpush