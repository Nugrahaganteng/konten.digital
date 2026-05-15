@extends('layouts.admin')

@section('title', 'Edit — ' . $section->label)

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=IBM+Plex+Mono:wght@400;600;700&family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
/* ══════════════════════════════════════════════════════
   DARK RETRO ARCADE — EDIT SECTION
   ═════════════════════════════════════════════════════ */
:root {
    --bg:        #0A0A14;
    --bg2:       #0F0F1E;
    --bg3:       #141428;
    --panel:     #12121F;
    --panel2:    #1A1A2E;
    --panel3:    #1E1E35;
    --border:    #2A2A4A;
    --border2:   #3A3A60;
    --yellow:    #F5E642;
    --magenta:   #FF2D6B;
    --cyan:      #00E5FF;
    --lime:      #B8FF00;
    --orange:    #FF6B00;
    --text:      #E8E8F0;
    --text2:     #9090B8;
    --muted:     #50507A;
    --r:         6px;
    --r-lg:      10px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    background: var(--bg);
    color: var(--text);
    font-family: 'Barlow', sans-serif;
    font-size: 13px;
    line-height: 1.5;
    -webkit-font-smoothing: antialiased;
    overflow-x: hidden;
}

/* ── Noise + Scanlines ─────────────────────────────── */
body::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
    background-size: 200px 200px;
    pointer-events: none;
    z-index: 0;
    opacity: .5;
}
body::after {
    content: '';
    position: fixed;
    inset: 0;
    background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,0,0,.07) 2px, rgba(0,0,0,.07) 4px);
    pointer-events: none;
    z-index: 0;
}

/* ── Page Wrap ─────────────────────────────────────── */
.page-wrap {
    position: relative;
    z-index: 1;
    animation: wakeUp .4s ease both;
    min-height: 100vh;
}
@keyframes wakeUp {
    from { opacity: 0; transform: translateY(6px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ── Ticker ─────────────────────────────────────────── */
.ticker-bar {
    background: var(--yellow);
    padding: 3px 0;
    overflow: hidden;
    white-space: nowrap;
}
.ticker-inner {
    display: inline-block;
    animation: ticker 16s linear infinite;
    font-family: 'IBM Plex Mono', monospace;
    font-size: .58rem;
    font-weight: 700;
    color: var(--bg);
    letter-spacing: .12em;
    text-transform: uppercase;
}
@keyframes ticker { from { transform: translateX(0); } to { transform: translateX(-50%); } }

/* ── Top Nav Bar ───────────────────────────────────── */
.top-nav {
    background: var(--panel);
    border-bottom: 1px solid var(--border2);
    padding: .75rem 1.5rem;
    display: flex;
    align-items: center;
    gap: .75rem;
    flex-wrap: wrap;
    position: relative;
}
.top-nav::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 1px;
    background: linear-gradient(90deg, var(--yellow), transparent);
    opacity: .4;
}
.btn-back {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    font-family: 'IBM Plex Mono', monospace;
    font-size: .62rem;
    font-weight: 700;
    color: var(--text2);
    text-decoration: none;
    padding: .4rem .85rem;
    border-radius: 3px;
    border: 1px solid var(--border2);
    background: var(--panel2);
    text-transform: uppercase;
    letter-spacing: .05em;
    transition: all .15s;
}
.btn-back:hover {
    border-color: var(--cyan);
    color: var(--cyan);
    background: rgba(0,229,255,.06);
}
.breadcrumb-sep {
    color: var(--muted);
    font-family: 'IBM Plex Mono', monospace;
    font-size: .65rem;
}
.page-title-wrap {
    display: flex;
    align-items: center;
    gap: .6rem;
    flex: 1;
}
.page-heading {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.3rem;
    letter-spacing: .1em;
    color: var(--yellow);
    line-height: 1;
}
.pill {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .58rem;
    font-weight: 700;
    padding: 2px 7px;
    border-radius: 2px;
    text-transform: uppercase;
    letter-spacing: .06em;
}
.pill-page {
    background: var(--panel2);
    border: 1px solid var(--border2);
    color: var(--text2);
}
.pill-key {
    background: rgba(245,230,66,.12);
    border: 1px solid rgba(245,230,66,.3);
    color: var(--yellow);
}

/* ── Alerts ─────────────────────────────────────────── */
.alerts-wrap {
    padding: .75rem 1.5rem 0;
}
.alert {
    display: flex;
    align-items: center;
    gap: .5rem;
    padding: .65rem .9rem;
    border-radius: var(--r);
    border: 1px solid;
    margin-bottom: .6rem;
    font-family: 'IBM Plex Mono', monospace;
    font-size: .68rem;
    font-weight: 600;
    letter-spacing: .03em;
    animation: slideDown .25s ease;
}
.alert-success { background: rgba(184,255,0,.05); border-color: rgba(184,255,0,.25); color: var(--lime); }
.alert-error   { background: rgba(255,45,107,.05); border-color: rgba(255,45,107,.25); color: var(--magenta); }
.alert-warning { background: rgba(245,230,66,.05); border-color: rgba(245,230,66,.25); color: var(--yellow); }
@keyframes slideDown { from { opacity:0; transform:translateY(-6px); } to { opacity:1; transform:translateY(0); } }

/* ── Form Layout ───────────────────────────────────── */
.form-layout {
    display: grid;
    grid-template-columns: 1fr 260px;
    gap: 1.1rem;
    align-items: start;
    padding: 1.25rem 1.5rem 5rem;
}
@media (max-width: 860px) {
    .form-layout { grid-template-columns: 1fr; padding: 1rem; }
    .form-sidebar { order: -1; }
}

/* ── Card Shell ────────────────────────────────────── */
.card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    overflow: hidden;
    transition: border-color .2s;
}
.card:hover { border-color: var(--border2); }

.card-head {
    display: flex;
    align-items: center;
    gap: .6rem;
    padding: .7rem 1rem;
    background: var(--panel2);
    border-bottom: 1px solid var(--border);
    position: relative;
}
.card-head::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 1px;
    background: linear-gradient(90deg, var(--yellow), var(--cyan), transparent);
    opacity: .4;
}
.card-head-label {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.05rem;
    letter-spacing: .08em;
    color: var(--text);
}
.card-head i { color: var(--yellow); font-size: .8rem; }
.field-count-chip {
    margin-left: auto;
    font-family: 'IBM Plex Mono', monospace;
    font-size: .58rem;
    font-weight: 700;
    background: rgba(245,230,66,.1);
    border: 1px solid rgba(245,230,66,.25);
    color: var(--yellow);
    padding: 1px 7px;
    border-radius: 3px;
    letter-spacing: .06em;
}

.card-body {
    padding: 1.1rem;
    display: flex;
    flex-direction: column;
    gap: 1.1rem;
}

/* ── Field Group ───────────────────────────────────── */
.field-group { display: flex; flex-direction: column; gap: .45rem; }
.field-group + .field-group {
    padding-top: 1.1rem;
    border-top: 1px solid var(--border);
}
.field-label {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .68rem;
    font-weight: 600;
    color: var(--text2);
    display: flex;
    align-items: center;
    gap: .4rem;
    text-transform: uppercase;
    letter-spacing: .06em;
}
.type-chip {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .55rem;
    background: var(--panel2);
    border: 1px solid var(--border2);
    color: var(--muted);
    padding: 1px 5px;
    border-radius: 2px;
    letter-spacing: .04em;
}

/* ── Inputs ─────────────────────────────────────────── */
.inp {
    width: 100%;
    background: var(--bg3);
    border: 1px solid var(--border2);
    border-radius: var(--r);
    color: var(--text);
    font-size: .82rem;
    padding: .6rem .85rem;
    outline: none;
    transition: border-color .15s, box-shadow .15s;
    font-family: 'Barlow', sans-serif;
    resize: none;
}
.inp:focus {
    border-color: var(--yellow);
    box-shadow: 0 0 0 2px rgba(245,230,66,.12), 0 0 12px rgba(245,230,66,.08);
}
.inp::placeholder { color: var(--muted); }
textarea.inp { min-height: 90px; line-height: 1.65; font-family: 'Barlow', sans-serif; }

/* ── Color Picker ───────────────────────────────────── */
.color-wrap { display: flex; align-items: center; gap: .6rem; }
.color-swatch-btn {
    width: 40px; height: 40px;
    border-radius: var(--r);
    border: 1px solid var(--border2);
    cursor: pointer;
    flex-shrink: 0;
    position: relative;
    overflow: hidden;
    transition: border-color .15s, box-shadow .15s;
}
.color-swatch-btn:hover { border-color: var(--yellow); box-shadow: 0 0 10px rgba(245,230,66,.2); }
.color-swatch-btn input[type="color"] {
    position: absolute;
    inset: 0; width: 100%; height: 100%;
    opacity: 0; cursor: pointer; border: none; padding: 0;
}
.color-hex { font-family: 'IBM Plex Mono', monospace; font-size: .75rem; flex: 1; }

/* ── Image Upload ───────────────────────────────────── */
.image-upload-area {
    border: 1px dashed var(--border2);
    border-radius: var(--r);
    padding: 1.35rem 1rem;
    text-align: center;
    transition: border-color .15s, background .15s, box-shadow .15s;
    cursor: pointer;
    position: relative;
    background: var(--bg3);
}
.image-upload-area:hover,
.image-upload-area.drag-over {
    border-color: var(--cyan);
    background: rgba(0,229,255,.04);
    box-shadow: inset 0 0 20px rgba(0,229,255,.04);
}
.image-upload-area input[type="file"] {
    position: absolute;
    inset: 0; opacity: 0; cursor: pointer;
    width: 100%; height: 100%;
}
.upload-icon { font-size: 1.3rem; color: var(--muted); margin-bottom: .4rem; }
.upload-text { font-family: 'IBM Plex Mono', monospace; font-size: .65rem; color: var(--muted); line-height: 1.7; }
.upload-text strong { color: var(--cyan); font-weight: 700; }

.img-preview-wrap { position: relative; display: inline-block; margin-bottom: .4rem; }
.img-preview {
    max-width: 100%;
    max-height: 150px;
    border-radius: var(--r);
    border: 1px solid var(--border2);
    object-fit: cover;
    display: block;
}
.img-remove-btn {
    position: absolute;
    top: -8px; right: -8px;
    width: 20px; height: 20px;
    background: var(--magenta);
    border: 1px solid var(--bg);
    border-radius: 50%;
    color: #fff;
    font-size: .55rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform .15s, box-shadow .15s;
}
.img-remove-btn:hover { transform: scale(1.2); box-shadow: 0 0 8px var(--magenta); }
.img-filename {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .6rem;
    color: var(--muted);
    margin-top: .3rem;
    word-break: break-all;
}

/* ── Sidebar ────────────────────────────────────────── */
.form-sidebar { display: flex; flex-direction: column; gap: .85rem; }
.sidebar-sticky { position: sticky; top: 1.25rem; display: flex; flex-direction: column; gap: .85rem; }

/* Status row */
.status-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: .7rem 1rem;
    background: var(--panel2);
    border-bottom: 1px solid var(--border);
}
.status-label {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .65rem;
    font-weight: 700;
    color: var(--text2);
    text-transform: uppercase;
    letter-spacing: .06em;
    display: flex;
    align-items: center;
    gap: .4rem;
}
.s-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
}
.s-dot.on  { background: var(--lime); box-shadow: 0 0 6px var(--lime); animation: pipOn 2s ease infinite; }
.s-dot.off { background: var(--border2); }
@keyframes pipOn { 0%,100% { opacity:1; } 50% { opacity:.3; } }

/* Sidebar toggle (reuse same vars) */
.toggle { position: relative; width: 34px; height: 18px; cursor: pointer; display: inline-block; }
.toggle input { opacity: 0; width: 0; height: 0; }
.toggle-track {
    position: absolute; inset: 0;
    background: var(--border);
    border-radius: 999px;
    border: 1px solid var(--border2);
    transition: all .2s;
}
.toggle input:checked ~ .toggle-track { background: var(--lime); border-color: var(--lime); box-shadow: 0 0 8px rgba(184,255,0,.3); }
.toggle-thumb {
    position: absolute;
    top: 3px; left: 3px;
    width: 12px; height: 12px;
    background: var(--muted);
    border-radius: 50%;
    transition: transform .2s, background .2s;
    pointer-events: none;
}
.toggle input:checked ~ .toggle-thumb { transform: translateX(16px); background: var(--bg); }

/* Sidebar info block */
.sidebar-info { padding: .9rem 1rem; display: flex; flex-direction: column; gap: .7rem; }
.info-row { display: flex; flex-direction: column; gap: 2px; }
.info-k {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .55rem;
    text-transform: uppercase;
    letter-spacing: .1em;
    color: var(--muted);
}
.info-v {
    font-size: .8rem;
    font-weight: 600;
    color: var(--text);
}
.info-v.mono {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .7rem;
    color: var(--cyan);
    background: rgba(0,229,255,.06);
    border: 1px solid rgba(0,229,255,.15);
    padding: 1px 6px;
    border-radius: 3px;
    display: inline-block;
}

/* Submit Button */
.btn-submit {
    width: 100%;
    position: relative;
    overflow: hidden;
    background: var(--yellow);
    color: var(--bg);
    border: none;
    border-radius: var(--r);
    padding: .7rem;
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1rem;
    letter-spacing: .12em;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    transition: background .2s, box-shadow .2s;
    margin-top: .2rem;
}
.btn-submit::before {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--cyan);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform .25s ease;
}
.btn-submit:hover::before { transform: scaleX(1); }
.btn-submit:hover { box-shadow: 0 0 20px rgba(0,229,255,.35); }
.btn-submit > * { position: relative; z-index: 1; }
.btn-submit:active { transform: scale(.98); }

.link-cancel {
    display: block;
    text-align: center;
    font-family: 'IBM Plex Mono', monospace;
    font-size: .62rem;
    color: var(--muted);
    text-decoration: none;
    padding: .4rem;
    transition: color .15s;
    text-transform: uppercase;
    letter-spacing: .06em;
}
.link-cancel:hover { color: var(--magenta); }

/* ── History Panel ──────────────────────────────────── */
.history-hd {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: .7rem 1rem;
    cursor: pointer;
    user-select: none;
    font-family: 'IBM Plex Mono', monospace;
    font-size: .65rem;
    font-weight: 700;
    color: var(--text2);
    text-transform: uppercase;
    letter-spacing: .06em;
    background: var(--panel2);
    border-bottom: 1px solid var(--border);
    transition: background .15s;
}
.history-hd:hover { background: var(--panel3); }
.history-hd-left { display: flex; align-items: center; gap: .5rem; }
.history-hd i { color: var(--yellow); }
.history-badge {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .58rem;
    font-weight: 700;
    background: rgba(245,230,66,.1);
    border: 1px solid rgba(245,230,66,.25);
    color: var(--yellow);
    padding: 1px 6px;
    border-radius: 3px;
    letter-spacing: .04em;
}
.history-chevron { color: var(--muted); font-size: .65rem; transition: transform .2s; }
.history-chevron.open { transform: rotate(180deg); }

.history-body { display: none; flex-direction: column; }
.history-body.open { display: flex; }

.history-item {
    padding: .75rem 1rem;
    border-top: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    gap: .4rem;
    transition: background .15s;
}
.history-item:hover { background: rgba(245,230,66,.03); }

.history-item-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: .5rem;
}
.h-time-abs { font-family: 'IBM Plex Mono', monospace; font-size: .68rem; font-weight: 700; color: var(--text); }
.h-time-rel { font-family: 'IBM Plex Mono', monospace; font-size: .6rem; color: var(--muted); margin-top: 1px; }
.h-status {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .56rem;
    padding: 1px 6px;
    border-radius: 3px;
    font-weight: 700;
    letter-spacing: .04em;
}
.h-status.on  { background: rgba(184,255,0,.08); color: var(--lime);   border: 1px solid rgba(184,255,0,.2); }
.h-status.off { background: var(--panel2);        color: var(--muted);  border: 1px solid var(--border); }

.h-preview { font-family: 'IBM Plex Mono', monospace; font-size: .6rem; display: flex; gap: .35rem; }
.h-pk { color: var(--muted); min-width: 55px; flex-shrink: 0; }
.h-pv { color: var(--text2); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 120px; }

.btn-restore {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .35rem;
    width: 100%;
    padding: .38rem;
    border-radius: 3px;
    border: 1px solid rgba(245,230,66,.25);
    background: rgba(245,230,66,.06);
    color: var(--yellow);
    font-family: 'IBM Plex Mono', monospace;
    font-size: .6rem;
    font-weight: 700;
    cursor: pointer;
    letter-spacing: .05em;
    text-transform: uppercase;
    transition: all .15s;
    margin-top: .1rem;
}
.btn-restore:hover {
    background: rgba(245,230,66,.12);
    border-color: var(--yellow);
    box-shadow: 0 0 10px rgba(245,230,66,.15);
}
.history-empty {
    padding: 1.5rem 1rem;
    text-align: center;
    color: var(--muted);
    font-family: 'IBM Plex Mono', monospace;
    font-size: .65rem;
    line-height: 1.8;
}
.history-empty i { display: block; font-size: 1.2rem; margin-bottom: .4rem; color: var(--border2); }

/* ── Modal ─────────────────────────────────────────── */
.modal-overlay {
    position: fixed; inset: 0;
    background: rgba(0,0,0,.75);
    backdrop-filter: blur(4px);
    z-index: 9998;
    display: none;
    align-items: center;
    justify-content: center;
}
.modal-overlay.open { display: flex; }
.modal-box {
    background: var(--panel2);
    border: 1px solid var(--yellow);
    border-radius: var(--r-lg);
    padding: 1.75rem;
    max-width: 360px;
    width: 90%;
    text-align: center;
    box-shadow: 0 0 60px rgba(245,230,66,.15), 0 30px 80px rgba(0,0,0,.6);
    animation: modalBounce .3s cubic-bezier(.34,1.56,.64,1);
}
@keyframes modalBounce {
    from { transform: scale(.85) translateY(20px); opacity: 0; }
    to   { transform: scale(1) translateY(0); opacity: 1; }
}
.modal-icon {
    width: 50px; height: 50px;
    background: rgba(245,230,66,.08);
    border: 1px solid rgba(245,230,66,.25);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.2rem;
    color: var(--yellow);
}
.modal-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.3rem;
    letter-spacing: .1em;
    color: var(--text);
    margin-bottom: .4rem;
}
.modal-desc { font-size: .78rem; color: var(--text2); margin-bottom: .9rem; line-height: 1.65; }
.modal-time {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .72rem;
    background: rgba(245,230,66,.06);
    border: 1px solid rgba(245,230,66,.2);
    border-radius: var(--r);
    padding: .45rem .8rem;
    margin-bottom: 1.1rem;
    color: var(--yellow);
    font-weight: 700;
}
.modal-actions { display: flex; gap: .6rem; }
.btn-modal-cancel {
    flex: 1; padding: .55rem;
    border-radius: var(--r);
    border: 1px solid var(--border2);
    background: var(--panel);
    color: var(--text2);
    font-family: 'IBM Plex Mono', monospace;
    font-size: .68rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .05em;
    cursor: pointer;
    transition: all .15s;
}
.btn-modal-cancel:hover { border-color: var(--magenta); color: var(--magenta); }
.btn-modal-confirm {
    flex: 1; padding: .55rem;
    border-radius: var(--r);
    border: none;
    background: var(--yellow);
    color: var(--bg);
    font-family: 'Bebas Neue', sans-serif;
    font-size: .9rem;
    letter-spacing: .1em;
    cursor: pointer;
    transition: all .15s;
}
.btn-modal-confirm:hover { background: var(--cyan); box-shadow: 0 0 16px rgba(0,229,255,.3); }

/* ── Scrollbar ─────────────────────────────────────── */
::-webkit-scrollbar { width: 4px; }
::-webkit-scrollbar-track { background: var(--bg); }
::-webkit-scrollbar-thumb { background: var(--border2); border-radius: 2px; }

/* Unsaved indicator */
.unsaved-pip {
    display: none;
    width: 7px; height: 7px;
    background: var(--magenta);
    border-radius: 50%;
    box-shadow: 0 0 6px var(--magenta);
    animation: pipBlink .8s step-end infinite;
}
body.has-changes .unsaved-pip { display: inline-block; }
@keyframes pipBlink { 0%,100% { opacity:1; } 50% { opacity:0; } }
</style>
@endpush

@section('content')
<div class="page-wrap">

    {{-- Ticker --}}
    <div class="ticker-bar">
        <div class="ticker-inner">
            ◆ EDIT SECTION MODE &nbsp;&nbsp; ◆ HNP COMMUNICATIONS ADMIN &nbsp;&nbsp; ◆ {{ strtoupper($section->section_key) }} &nbsp;&nbsp; ◆ EDIT SECTION MODE &nbsp;&nbsp; ◆ HNP COMMUNICATIONS ADMIN &nbsp;&nbsp; ◆ {{ strtoupper($section->section_key) }} &nbsp;&nbsp;
        </div>
    </div>

    {{-- Top Nav --}}
    <div class="top-nav">
        <a href="{{ route('admin.cms.page-sections.index', ['page' => $section->page]) }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> KEMBALI
        </a>
        <span class="breadcrumb-sep">/</span>
        <div class="page-title-wrap">
            <div class="page-heading">
                EDIT <span style="color:var(--text2)">SECTION</span>
            </div>
            <span class="unsaved-pip" title="Ada perubahan belum disimpan"></span>
        </div>
        <span class="pill pill-page">{{ $section->page }}</span>
        <span class="pill pill-key">{{ $section->section_key }}</span>
    </div>

    {{-- Alerts --}}
    <div class="alerts-wrap">
        @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session('warning'))
        <div class="alert alert-warning"><i class="fas fa-clock-rotate-left"></i> {{ session('warning') }}</div>
        @endif
        @if($errors->any())
        <div class="alert alert-error"><i class="fas fa-circle-exclamation"></i> {{ $errors->first() }}</div>
        @endif
    </div>

    {{-- Form --}}
    <form method="POST"
        action="{{ route('admin.cms.page-sections.update', $section) }}"
        enctype="multipart/form-data"
        id="section-form">
        @csrf
        @method('PUT')

        <div class="form-layout">

            {{-- MAIN FIELDS --}}
            <div class="card">
                <div class="card-head">
                    <i class="fas fa-sliders"></i>
                    <span class="card-head-label">{{ $section->label }}</span>
                    <span class="field-count-chip">{{ count($fields) }} FIELDS</span>
                </div>
                <div class="card-body">

                    @if(empty($fields))
                    <p style="font-family:'IBM Plex Mono',monospace;font-size:.65rem;color:var(--muted);text-align:center;padding:2rem 0">
                        NO FIELDS FOR THIS SECTION.
                    </p>
                    @else

                    @foreach($fields as $idx => $field)
                    @php
                        $key         = $field['key'];
                        $label       = $field['label'];
                        $type        = $field['type'];
                        $placeholder = $field['placeholder'] ?? '';
                        $currentVal  = $section->get($key, '');
                        $inputId     = 'field_' . $key;
                    @endphp

                    <div class="field-group" id="group_{{ $key }}">
                        <label class="field-label" for="{{ $inputId }}">
                            {{ strtoupper($label) }}
                            <span class="type-chip">{{ strtoupper($type) }}</span>
                        </label>

                        @if($type === 'text')
                            <input type="text" id="{{ $inputId }}" name="{{ $key }}"
                                value="{{ old($key, $currentVal) }}"
                                placeholder="{{ $placeholder }}"
                                class="inp">

                        @elseif($type === 'textarea')
                            <textarea id="{{ $inputId }}" name="{{ $key }}"
                                    placeholder="{{ $placeholder }}"
                                    class="inp" rows="4">{{ old($key, $currentVal) }}</textarea>

                        @elseif($type === 'color')
                            @php $colorVal = old($key, $currentVal ?: '#F5E642'); @endphp
                            <div class="color-wrap">
                                <label class="color-swatch-btn" style="background:{{ $colorVal }}">
                                    <input type="color" name="{{ $key }}" value="{{ $colorVal }}" id="{{ $inputId }}"
                                        onchange="
                                            this.closest('.color-swatch-btn').style.background = this.value;
                                            document.getElementById('hex_{{ $key }}').value = this.value;
                                        ">
                                </label>
                                <input type="text" id="hex_{{ $key }}" value="{{ $colorVal }}"
                                    placeholder="#000000" class="inp color-hex" maxlength="7"
                                    oninput="syncColorFromHex(this, '{{ $inputId }}')">
                            </div>

                        @elseif($type === 'image')
                            <div class="image-upload-area" id="drop_{{ $key }}"
                                ondragover="handleDragOver(event, this)"
                                ondragleave="handleDragLeave(event, this)"
                                ondrop="handleFileDrop(event, '{{ $key }}')">

                                @if($currentVal)
                                <div class="img-preview-wrap" id="preview_wrap_{{ $key }}">
                                    <img src="{{ Storage::url($currentVal) }}" alt="" class="img-preview" id="preview_{{ $key }}">
                                    <button type="button" class="img-remove-btn" onclick="clearImage('{{ $key }}')" title="Hapus">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <p class="img-filename" id="filename_{{ $key }}">{{ basename($currentVal) }}</p>
                                </div>
                                @else
                                <div id="preview_wrap_{{ $key }}" style="display:none">
                                    <img src="" alt="" class="img-preview" id="preview_{{ $key }}">
                                    <button type="button" class="img-remove-btn" onclick="clearImage('{{ $key }}')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <p class="img-filename" id="filename_{{ $key }}"></p>
                                </div>
                                @endif

                                <div id="upload_prompt_{{ $key }}" {{ $currentVal ? 'style=display:none' : '' }}>
                                    <div class="upload-icon"><i class="fas fa-cloud-arrow-up"></i></div>
                                    <div class="upload-text">
                                        <strong>KLIK UNTUK PILIH</strong> ATAU DRAG & DROP<br>
                                        <span style="font-size:.6rem;color:var(--border2)">PNG · JPG · WEBP — MAX 2MB</span>
                                    </div>
                                </div>

                                <input type="file" name="{{ $key }}" id="{{ $inputId }}" accept="image/*"
                                    onchange="handleImageChange(this, '{{ $key }}')">
                            </div>
                        @endif
                    </div>
                    @endforeach

                    @endif
                </div>
            </div>

            {{-- SIDEBAR --}}
            <div class="form-sidebar">
                <div class="sidebar-sticky">

                    {{-- Publish Card --}}
                    <div class="card">
                        <div class="status-row">
                            <span class="status-label">
                                <span class="s-dot {{ $section->is_active ? 'on' : 'off' }}"></span>
                                STATUS
                            </span>
                            <label class="toggle">
                                <input type="checkbox" name="is_active" value="1" {{ $section->is_active ? 'checked' : '' }}>
                                <span class="toggle-track"></span>
                                <span class="toggle-thumb"></span>
                            </label>
                        </div>

                        <div class="sidebar-info">
                            <div class="info-row">
                                <span class="info-k">HALAMAN</span>
                                <span class="info-v">{{ strtoupper($section->page) }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-k">SECTION KEY</span>
                                <span class="info-v mono">{{ $section->section_key }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-k">URUTAN</span>
                                <span class="info-v">#{{ $section->order }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-k">LAST UPDATE</span>
                                <span class="info-v" style="font-size:.72rem">{{ $section->updated_at->diffForHumans() }}</span>
                            </div>

                            <button type="submit" class="btn-submit">
                                <i class="fas fa-floppy-disk"></i>
                                <span>SIMPAN PERUBAHAN</span>
                            </button>

                            <a href="{{ route('admin.cms.page-sections.index', ['page' => $section->page]) }}" class="link-cancel">
                                BATAL & KEMBALI
                            </a>
                        </div>
                    </div>

                    {{-- History Card --}}
                    <div class="card">
                        <div class="history-hd" onclick="toggleHistory()">
                            <div class="history-hd-left">
                                <i class="fas fa-clock-rotate-left"></i>
                                RIWAYAT
                                @if($histories->isNotEmpty())
                                <span class="history-badge">{{ $histories->count() }}</span>
                                @endif
                            </div>
                            <i class="fas fa-chevron-down history-chevron" id="history-chevron"></i>
                        </div>

                        <div class="history-body" id="history-body">
                            @if($histories->isEmpty())
                            <div class="history-empty">
                                <i class="fas fa-history"></i>
                                BELUM ADA RIWAYAT.<br>
                                TERSIMPAN OTOMATIS SAAT SAVE.
                            </div>
                            @else
                            @foreach($histories as $history)
                            <div class="history-item">
                                <div class="history-item-top">
                                    <div>
                                        <div class="h-time-abs">{{ $history->saved_at->format('d M Y, H:i') }}</div>
                                        <div class="h-time-rel">{{ $history->saved_at->diffForHumans() }}</div>
                                    </div>
                                    <span class="h-status {{ $history->is_active ? 'on' : 'off' }}">
                                        {{ $history->is_active ? 'ON' : 'OFF' }}
                                    </span>
                                </div>

                                @php
                                    $pfs = array_slice($section->getFields(), 0, 3);
                                    $pc  = $history->content ?? [];
                                @endphp
                                @foreach($pfs as $pf)
                                @php
                                    $pv = $pc[$pf['key']] ?? null;
                                    $sv = ($pv && !in_array($pf['type'], ['image','color'])) ? Str::limit(strip_tags($pv), 30) : null;
                                @endphp
                                @if($sv)
                                <div class="h-preview">
                                    <span class="h-pk">{{ Str::limit($pf['label'], 8) }}</span>
                                    <span class="h-pv">{{ $sv }}</span>
                                </div>
                                @endif
                                @endforeach

                                <button type="button" class="btn-restore"
                                    onclick="confirmRestore({{ $history->id }}, '{{ $history->saved_at->format('d M Y, H:i') }}', '{{ $history->saved_at->diffForHumans() }}')">
                                    <i class="fas fa-rotate-left"></i> PULIHKAN
                                </button>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </form>

    {{-- Modal --}}
    <div class="modal-overlay" id="restore-modal">
        <div class="modal-box">
            <div class="modal-icon"><i class="fas fa-rotate-left"></i></div>
            <div class="modal-title">PULIHKAN VERSI?</div>
            <div class="modal-desc">Data saat ini akan digantikan. Versi ini akan otomatis disimpan ke riwayat.</div>
            <div class="modal-time" id="modal-time-display">—</div>
            <div class="modal-actions">
                <button type="button" class="btn-modal-cancel" onclick="closeRestoreModal()">BATAL</button>
                <button type="button" class="btn-modal-confirm" id="btn-confirm-restore">
                    <i class="fas fa-rotate-left"></i> PULIHKAN
                </button>
            </div>
        </div>
    </div>

    @foreach($histories as $history)
    <form method="POST"
        action="{{ route('admin.cms.page-sections.restore', [$section, $history]) }}"
        id="restore-form-{{ $history->id }}"
        style="display:none">
        @csrf
    </form>
    @endforeach

</div>
@endsection

@push('scripts')
<script>
function handleImageChange(input, key) {
    const file = input.files[0];
    if (!file) return;
    if (file.size > 2 * 1024 * 1024) { alert('File melebihi 2MB'); input.value = ''; return; }
    showImagePreview(key, file);
}
function handleFileDrop(e, key) {
    e.preventDefault();
    document.getElementById('drop_' + key).classList.remove('drag-over');
    const file = e.dataTransfer.files[0];
    if (!file || !file.type.startsWith('image/')) return;
    const input = document.getElementById('field_' + key);
    const dt = new DataTransfer(); dt.items.add(file); input.files = dt.files;
    showImagePreview(key, file);
}
function handleDragOver(e, area) { e.preventDefault(); area.classList.add('drag-over'); }
function handleDragLeave(e, area) { if (!area.contains(e.relatedTarget)) area.classList.remove('drag-over'); }
function showImagePreview(key, file) {
    const reader = new FileReader();
    reader.onload = ev => {
        document.getElementById('preview_' + key).src = ev.target.result;
        document.getElementById('filename_' + key).textContent = file.name;
        document.getElementById('preview_wrap_' + key).style.display = 'inline-block';
        const p = document.getElementById('upload_prompt_' + key);
        if (p) p.style.display = 'none';
    };
    reader.readAsDataURL(file);
}
function clearImage(key) {
    document.getElementById('preview_' + key).src = '';
    document.getElementById('filename_' + key).textContent = '';
    document.getElementById('field_' + key).value = '';
    document.getElementById('preview_wrap_' + key).style.display = 'none';
    const p = document.getElementById('upload_prompt_' + key);
    if (p) p.style.display = 'block';
}
function syncColorFromHex(hexInput, id) {
    const v = hexInput.value;
    if (/^#[0-9a-fA-F]{6}$/.test(v)) {
        const c = document.getElementById(id);
        c.value = v;
        c.closest('.color-swatch-btn').style.background = v;
    }
}
function toggleHistory() {
    document.getElementById('history-body').classList.toggle('open');
    document.getElementById('history-chevron').classList.toggle('open');
}
document.addEventListener('DOMContentLoaded', () => {
    @if($histories->isNotEmpty()) toggleHistory(); @endif
});
let pendingRestoreId = null;
function confirmRestore(id, abs, rel) {
    pendingRestoreId = id;
    document.getElementById('modal-time-display').textContent = abs + ' (' + rel + ')';
    document.getElementById('restore-modal').classList.add('open');
}
function closeRestoreModal() {
    document.getElementById('restore-modal').classList.remove('open');
    pendingRestoreId = null;
}
document.getElementById('btn-confirm-restore').addEventListener('click', () => {
    if (!pendingRestoreId) return;
    document.getElementById('restore-form-' + pendingRestoreId)?.submit();
});
document.getElementById('restore-modal').addEventListener('click', function(e) {
    if (e.target === this) closeRestoreModal();
});
let formChanged = false;
const form = document.getElementById('section-form');
if (form) {
    form.addEventListener('change', () => { formChanged = true; document.body.classList.add('has-changes'); });
    form.addEventListener('submit', () => { formChanged = false; document.body.classList.remove('has-changes'); });
    window.addEventListener('beforeunload', e => { if (formChanged) { e.preventDefault(); e.returnValue = ''; } });
}
</script>
@endpush