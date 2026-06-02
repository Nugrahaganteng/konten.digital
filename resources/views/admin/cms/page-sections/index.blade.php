@extends('layouts.admin')

@section('title', 'CMS — ' . strtoupper($page))

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Syne:wght@700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
<style>
:root {
    --w:   #F5F0E8; --blk: #0D0D0D; --yel: #F5C800;
    --cor: #FF5A36; --mnt: #00C48C; --blu: #1A56FF;
    --txt: #0D0D0D; --txt2:#3D3D3D; --mu:  #7A7A7A;
    --bd:  3px solid #0D0D0D;
    --sh:  4px 4px 0 #0D0D0D; --shlg: 6px 6px 0 #0D0D0D;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
.cms-wrap{overflow-x:clip;max-width:100%;min-height:100vh}

/* ── Ticker ── */
.ticker-bar{background:var(--blk);padding:5px 0;overflow:hidden;white-space:nowrap;border-bottom:var(--bd);width:100%}
.ticker-inner{display:inline-block;animation:ticker 22s linear infinite;font-family:'JetBrains Mono',monospace;font-size:.56rem;font-weight:700;color:var(--yel);letter-spacing:.13em;text-transform:uppercase;padding-left:100%}
@keyframes ticker{from{transform:translateX(0)}to{transform:translateX(-50%)}}

/* ── Masthead ── */
.masthead{background:var(--yel);border-bottom:var(--bd);padding:1rem 1.25rem;width:100%;overflow:clip}
.masthead-inner{display:flex;align-items:center;justify-content:space-between;gap:.85rem}
.cms-title{display:flex;align-items:center;gap:.85rem;min-width:0;flex:1;overflow:hidden}
.title-icon-box{width:44px;height:44px;min-width:44px;background:var(--blk);border:var(--bd);box-shadow:var(--sh);display:flex;align-items:center;justify-content:center;font-size:1.1rem;color:var(--yel);flex-shrink:0}
.title-text{min-width:0;overflow:hidden}
.title-main{font-family:'Syne',sans-serif;font-size:clamp(.95rem,4.5vw,1.8rem);font-weight:800;color:var(--blk);line-height:1;letter-spacing:-.02em;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.title-page-tag{display:inline-block;background:var(--blk);color:var(--yel);font-family:'JetBrains Mono',monospace;font-size:.54rem;font-weight:700;padding:2px 7px;letter-spacing:.12em;text-transform:uppercase;margin-top:3px}
.title-sub{font-family:'JetBrains Mono',monospace;font-size:.54rem;color:var(--txt2);margin-top:2px;letter-spacing:.04em;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.hint-chip{font-family:'JetBrains Mono',monospace;font-size:.6rem;font-weight:600;color:var(--blk);display:flex;align-items:center;gap:.35rem;background:var(--w);border:var(--bd);box-shadow:var(--sh);padding:.38rem .7rem;white-space:nowrap;flex-shrink:0}

/* ── Alerts ── */
.alerts-outer{padding:.6rem 1.25rem 0}
.alert{display:flex;align-items:center;gap:.5rem;padding:.6rem .85rem;border:var(--bd);margin-bottom:.45rem;font-family:'JetBrains Mono',monospace;font-size:.65rem;font-weight:600;box-shadow:var(--sh);animation:slideDown .2s ease}
.alert-success{background:#D4F5E4;color:#005C33}
.alert-error{background:#FFE0D9;color:#8B1A00}
@keyframes slideDown{from{opacity:0;transform:translateY(-4px)}to{opacity:1;transform:translateY(0)}}

/* ── Tabs ── */
.tabs-outer{background:var(--w);border-bottom:var(--bd);position:relative}
.tabs-scroll{display:flex;align-items:center;gap:.45rem;padding:.75rem 1.25rem .85rem;overflow-x:auto;overflow-y:visible;-webkit-overflow-scrolling:touch;scroll-behavior:smooth;scrollbar-width:none;-ms-overflow-style:none;white-space:nowrap}
.tabs-scroll::-webkit-scrollbar{display:none}
.tabs-label{font-family:'JetBrains Mono',monospace;font-size:.56rem;font-weight:700;color:var(--mu);text-transform:uppercase;letter-spacing:.1em;flex-shrink:0;white-space:nowrap}
.page-tab{font-family:'JetBrains Mono',monospace;font-size:.6rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;padding:.35rem .8rem;border:2px solid var(--blk);background:var(--w);color:var(--blk);text-decoration:none;transition:all .14s;box-shadow:2px 2px 0 var(--blk);flex-shrink:0;white-space:nowrap;display:inline-block;-webkit-tap-highlight-color:transparent}
.page-tab:hover{background:var(--blk);color:var(--w)}
.page-tab.active{background:var(--blk);color:var(--yel);box-shadow:2px 2px 0 #555}
.page-tab.tab-special{border-color:var(--blu);color:var(--blu);box-shadow:2px 2px 0 var(--blu)}
.page-tab.tab-special:hover{background:var(--blu);color:var(--w);border-color:var(--blu)}
.page-tab.tab-special.active{background:var(--blu);color:var(--yel);border-color:var(--blu);box-shadow:2px 2px 0 #0a2fa0}
.tabs-fade-right{position:absolute;right:0;top:0;bottom:0;width:48px;background:linear-gradient(to right,transparent,var(--w));pointer-events:none;transition:opacity .25s}
.tabs-fade-left{position:absolute;left:0;top:0;bottom:0;width:32px;background:linear-gradient(to left,transparent,var(--w));pointer-events:none;opacity:0;transition:opacity .25s}

/* ── Grid ── */
.grid-area{padding:1.1rem 1.25rem 5.5rem;overflow-x:clip;width:100%}
.row-label{font-family:'JetBrains Mono',monospace;font-size:.57rem;font-weight:700;color:var(--mu);text-transform:uppercase;letter-spacing:.12em;margin-bottom:.75rem;display:flex;align-items:center;gap:.5rem;overflow:hidden}
.row-label::after{content:'';flex:1;height:2px;background:var(--blk);min-width:0}
.sections-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(min(100%,280px),1fr));gap:.9rem;width:100%}

/* ── Card ── */
.section-card{background:var(--w);border:var(--bd);box-shadow:var(--sh);cursor:grab;position:relative;transition:transform .12s,box-shadow .12s;animation:cardReveal .32s ease both;width:100%;overflow:hidden}
.section-card:nth-child(1){animation-delay:.03s}.section-card:nth-child(2){animation-delay:.06s}.section-card:nth-child(3){animation-delay:.09s}.section-card:nth-child(4){animation-delay:.12s}.section-card:nth-child(5){animation-delay:.15s}.section-card:nth-child(6){animation-delay:.17s}
@keyframes cardReveal{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}
@media(hover:hover){.section-card:hover{transform:translate(-2px,-2px);box-shadow:var(--shlg)}}
.section-card:active{cursor:grabbing}
.section-card.dragging{opacity:.3;transform:rotate(-1deg) scale(.97)}
.section-card.drag-over{outline:3px dashed var(--cor);outline-offset:-3px}
.section-card.inactive{opacity:.55}
.section-card:nth-child(4n+1) .card-accent{background:var(--yel)}
.section-card:nth-child(4n+2) .card-accent{background:var(--cor)}
.section-card:nth-child(4n+3) .card-accent{background:var(--mnt)}
.section-card:nth-child(4n+4) .card-accent{background:var(--blu)}
.card-accent{height:4px;border-bottom:2px solid var(--blk)}

/* Card Header */
.card-hd{display:flex;align-items:center;padding:.6rem .8rem;background:var(--blk);gap:.45rem;border-bottom:var(--bd);overflow:hidden;min-width:0}
.card-hd-left{display:flex;align-items:center;gap:.4rem;min-width:0;flex:1;overflow:hidden}
.drag-handle{color:#888;font-size:.62rem;cursor:grab;flex-shrink:0;padding:2px;min-width:20px;min-height:20px;display:flex;align-items:center;justify-content:center;transition:color .14s}
.drag-handle:hover{color:var(--yel)}
.order-num{font-family:'Syne',sans-serif;font-size:1rem;font-weight:800;color:var(--yel);line-height:1;flex-shrink:0;min-width:22px}
.card-meta{min-width:0;flex:1;overflow:hidden}
.card-label{font-family:'Syne',sans-serif;font-size:.8rem;font-weight:700;color:var(--w);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;line-height:1.15}
.card-key{font-family:'JetBrains Mono',monospace;font-size:.5rem;color:#888;margin-top:1px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.card-actions{display:flex;align-items:center;gap:.4rem;flex-shrink:0}
.status-pip{width:7px;height:7px;border-radius:50%;background:var(--mnt);border:1.5px solid rgba(255,255,255,.5);flex-shrink:0}
.status-pip.off{background:#555;border-color:#888}

/* Toggle */
.toggle-form{display:inline-flex}
.toggle{position:relative;width:34px;height:18px;cursor:pointer;display:block}
.toggle input{opacity:0;width:0;height:0;position:absolute}
.toggle-track{position:absolute;inset:0;background:#444;border-radius:999px;border:2px solid #888;transition:all .18s}
.toggle input:checked~.toggle-track{background:var(--mnt);border-color:#00a078}
.toggle-thumb{position:absolute;top:3px;left:3px;width:12px;height:12px;background:#888;border-radius:50%;transition:transform .18s,background .18s;pointer-events:none}
.toggle input:checked~.toggle-thumb{transform:translateX(16px);background:var(--w)}

.btn-edit{font-family:'JetBrains Mono',monospace;font-size:.57rem;font-weight:700;letter-spacing:.04em;padding:.3rem .6rem;background:var(--yel);border:2px solid var(--yel);color:var(--blk);text-decoration:none;display:flex;align-items:center;gap:.25rem;transition:all .14s;white-space:nowrap;text-transform:uppercase;box-shadow:2px 2px 0 rgba(255,255,255,.25);flex-shrink:0;min-height:28px;-webkit-tap-highlight-color:transparent}
.btn-edit:hover{background:var(--w);border-color:var(--w)}

/* Card Body */
.card-body{padding:.65rem .8rem;overflow:hidden}
.field-rows{display:flex;flex-direction:column}
.field-row{display:flex;align-items:flex-start;gap:.4rem;padding:.26rem 0;border-bottom:1px solid rgba(0,0,0,.06);min-width:0;overflow:hidden;transition:opacity .2s,background .2s;border-radius:2px}
.field-row:last-child{border-bottom:none}
.field-row.is-hidden-row{opacity:.4}
.field-row.is-hidden-row .f-val{text-decoration:line-through;color:var(--mu)!important}
.f-label{font-family:'JetBrains Mono',monospace;font-size:.54rem;font-weight:600;color:var(--mu);min-width:70px;max-width:70px;flex-shrink:0;padding-top:2px;text-transform:uppercase;letter-spacing:.03em;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.f-val{color:var(--txt2);word-break:break-word;overflow:hidden;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;font-weight:500;font-size:.68rem;flex:1;min-width:0}
.f-val.empty{color:#bbb;font-style:italic}
.f-img{width:32px;height:22px;object-fit:cover;border:2px solid var(--blk);flex-shrink:0}
.f-color-dot{width:12px;height:12px;border:2px solid var(--blk);flex-shrink:0;margin-top:2px}
.more-label{font-family:'JetBrains Mono',monospace;font-size:.54rem;font-weight:700;color:var(--mu);padding:.28rem 0 0;border-top:2px dashed rgba(0,0,0,.12);margin-top:.22rem;text-transform:uppercase;letter-spacing:.06em}
.field-eye-btn{flex-shrink:0;width:20px;height:20px;display:flex;align-items:center;justify-content:center;border:1.5px solid transparent;border-radius:3px;cursor:pointer;background:transparent;transition:all .15s;color:#bbb;font-size:.6rem;padding:0;-webkit-tap-highlight-color:transparent;opacity:.35}
.field-eye-btn:hover{opacity:1;border-color:var(--cor);background:rgba(255,90,54,.08);color:var(--cor)}
.field-eye-btn.is-hidden{opacity:1;color:var(--cor);border-color:var(--cor);background:rgba(255,90,54,.12)}
@media(max-width:700px){.field-eye-btn{opacity:.6}}
.field-row:hover .field-eye-btn{opacity:.7}
.hidden-badge{font-family:'JetBrains Mono',monospace;font-size:.44rem;font-weight:700;background:var(--cor);color:var(--w);padding:1px 5px;border-radius:2px;letter-spacing:.04em;display:none}
.hidden-badge.has-hidden{display:inline-block}
.btn-expand-fields{font-family:'JetBrains Mono',monospace;font-size:.5rem;font-weight:700;color:var(--mu);text-transform:uppercase;letter-spacing:.06em;background:none;border:none;cursor:pointer;padding:.22rem 0 0;text-align:left;width:100%;display:flex;align-items:center;gap:.3rem;transition:color .14s}
.btn-expand-fields:hover{color:var(--blk)}
.btn-expand-fields i{transition:transform .2s}
.btn-expand-fields.expanded i{transform:rotate(180deg)}
.hidden-fields-area{display:none;margin-top:.4rem;padding:.4rem .5rem;background:rgba(255,90,54,.04);border:1.5px dashed rgba(255,90,54,.25);border-radius:2px}
.hidden-fields-area.open{display:block}
.hidden-area-label{font-family:'JetBrains Mono',monospace;font-size:.48rem;font-weight:700;color:var(--cor);text-transform:uppercase;letter-spacing:.08em;margin-bottom:.3rem}

/* ── Empty State ── */
.empty-state{text-align:center;padding:4rem 2rem;color:var(--mu);font-family:'JetBrains Mono',monospace}
.empty-icon{font-size:2rem;margin-bottom:.8rem;display:block;opacity:.2}
.empty-state p{font-size:.7rem}

/* ── Reorder Bar ── */
.reorder-bar{position:fixed;bottom:1.25rem;left:50%;transform:translateX(-50%) translateY(120px);background:var(--blk);border:var(--bd);box-shadow:var(--shlg);padding:.6rem 1rem;display:flex;align-items:center;gap:.7rem;z-index:999;font-family:'JetBrains Mono',monospace;font-size:.65rem;color:var(--yel);opacity:0;pointer-events:none;transition:transform .35s cubic-bezier(.34,1.56,.64,1),opacity .25s;white-space:nowrap;max-width:calc(100vw - 2.5rem)}
.reorder-bar.visible{transform:translateX(-50%) translateY(0);opacity:1;pointer-events:auto}
.blink-dot{width:7px;height:7px;border-radius:50%;background:var(--cor);animation:blink .8s step-end infinite;flex-shrink:0}
@keyframes blink{0%,100%{opacity:1}50%{opacity:0}}
.bar-text{flex:1;min-width:0;overflow:hidden;text-overflow:ellipsis}
.btn-save-order{background:var(--yel);color:var(--blk);border:2px solid var(--yel);padding:.4rem .95rem;font-family:'JetBrains Mono',monospace;font-size:.62rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;cursor:pointer;transition:all .14s;flex-shrink:0}
.btn-save-order:hover{background:var(--w);border-color:var(--w)}
.btn-save-order:disabled{opacity:.4;cursor:not-allowed}
#reorder-status{font-size:.6rem;min-width:50px;text-align:right;flex-shrink:0}

/* ── Toast ── */
.field-toast{position:fixed;bottom:5rem;right:1.25rem;background:var(--blk);color:var(--yel);font-family:'JetBrains Mono',monospace;font-size:.6rem;font-weight:700;padding:.45rem .9rem;border:2px solid var(--yel);box-shadow:var(--sh);z-index:1000;opacity:0;transform:translateY(8px);transition:all .25s;pointer-events:none;letter-spacing:.06em;text-transform:uppercase}
.field-toast.show{opacity:1;transform:translateY(0)}

/* ══════════════════════════════════════════════
   SERVICES NAVBAR PAGE — DUAL PANEL LAYOUT
══════════════════════════════════════════════ */
.navbar-page-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:1.25rem;
    align-items:start;
}
@media(max-width:860px){
    .navbar-page-grid{grid-template-columns:1fr}
}

/* ── Widget shared ── */
.nb-widget{
    border:var(--bd);
    box-shadow:var(--sh);
    background:var(--w);
    overflow:hidden;
    animation:cardReveal .32s ease both;
}
.nb-widget-hd{
    border-bottom:var(--bd);
    padding:.6rem .9rem;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:.5rem;
}
.nb-widget-title{
    display:flex;align-items:center;gap:.55rem;
}
.nb-widget-title i{font-size:.75rem}
.nb-widget-title span{
    font-family:'Syne',sans-serif;
    font-size:.78rem;font-weight:800;
    letter-spacing:.03em;text-transform:uppercase;
}
.nb-widget-badge{
    font-family:'JetBrains Mono',monospace;
    font-size:.5rem;font-weight:700;
    text-transform:uppercase;letter-spacing:.1em;
    padding:2px 8px;
    background:rgba(0,0,0,.15);
}

/* ── Left panel: Services toggle ── */
.nb-widget.svc-panel .nb-widget-hd{background:var(--blu)}
.nb-widget.svc-panel .nb-widget-hd *{color:var(--w)!important}
.nb-widget.svc-panel .nb-widget-badge{color:var(--yel)!important}

.svc-row{
    display:flex;align-items:center;gap:.75rem;
    padding:.6rem .9rem;
    border-bottom:2px solid rgba(0,0,0,.07);
    transition:background .15s;
}
.svc-row:last-child{border-bottom:none}
.svc-row.is-inactive{background:rgba(0,0,0,.02)}
.svc-icon-box{
    width:30px;height:30px;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;
    font-size:.7rem;
    border:2px solid var(--blk);
    transition:background .2s;
}
.svc-icon-box.active-icon{background:var(--blk)}
.svc-icon-box.inactive-icon{background:#ddd;border-color:#ccc}
.svc-icon-box.active-icon i{color:var(--yel)}
.svc-icon-box.inactive-icon i{color:#aaa}
.svc-info{flex:1;min-width:0}
.svc-name{
    font-family:'Syne',sans-serif;
    font-size:.78rem;font-weight:700;
    white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
    transition:color .15s;
}
.svc-name.active-name{color:var(--blk)}
.svc-name.inactive-name{color:#bbb;text-decoration:line-through}
.svc-route{
    font-family:'JetBrains Mono',monospace;
    font-size:.5rem;color:#aaa;
    white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-top:1px;
}
.svc-badge{
    font-family:'JetBrains Mono',monospace;
    font-size:.45rem;font-weight:700;
    text-transform:uppercase;letter-spacing:.08em;
    padding:2px 7px;border:2px solid;flex-shrink:0;
}
.svc-badge.active-badge{color:var(--mnt);border-color:var(--mnt)}
.svc-badge.inactive-badge{color:#ccc;border-color:#ccc}
.nb-widget-ft{
    padding:.45rem .9rem;
    border-top:2px dashed rgba(0,0,0,.15);
    font-family:'JetBrains Mono',monospace;
    font-size:.5rem;font-weight:700;
    color:var(--mu);text-transform:uppercase;letter-spacing:.08em;
}

/* ── Right panel: CMS Sections edit ── */
.nb-widget.cms-panel .nb-widget-hd{background:var(--blk)}
.nb-widget.cms-panel .nb-widget-hd *{color:var(--w)!important}
.nb-widget.cms-panel .nb-widget-badge{color:var(--yel)!important}

.cms-section-row{
    display:flex;align-items:center;justify-content:space-between;gap:.6rem;
    padding:.6rem .9rem;
    border-bottom:2px solid rgba(0,0,0,.07);
    transition:background .15s;
}
.cms-section-row:last-child{border-bottom:none}
.cms-section-row:hover{background:#ECEAE0}
.cms-section-info{flex:1;min-width:0}
.cms-section-label{
    font-family:'Syne',sans-serif;
    font-size:.78rem;font-weight:700;
    white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
    color:var(--blk);
}
.cms-section-key{
    font-family:'JetBrains Mono',monospace;
    font-size:.5rem;color:#888;margin-top:1px;
}
.cms-section-row .toggle-form{flex-shrink:0}
.btn-edit-sm{
    font-family:'JetBrains Mono',monospace;
    font-size:.55rem;font-weight:700;letter-spacing:.04em;
    padding:.28rem .62rem;
    background:var(--yel);border:2px solid var(--blk);color:var(--blk);
    text-decoration:none;display:inline-flex;align-items:center;gap:.25rem;
    transition:all .14s;white-space:nowrap;text-transform:uppercase;
    box-shadow:2px 2px 0 var(--blk);flex-shrink:0;
    -webkit-tap-highlight-color:transparent;
    min-height:28px;
}
.btn-edit-sm:hover{background:var(--blk);color:var(--yel)}

.cms-section-row.cms-section-inactive{opacity:.55}

/* Empty svc */
.svc-empty{text-align:center;padding:3rem 2rem;color:var(--mu);font-family:'JetBrains Mono',monospace}
.svc-empty i{font-size:2rem;display:block;margin-bottom:.8rem;opacity:.2}
.svc-empty p{font-size:.7rem}

/* ── Responsive ── */
@media(max-width:700px){
    .masthead{padding:.8rem 1rem}
    .title-icon-box{width:38px;height:38px;min-width:38px;font-size:.95rem}
    .hint-chip{display:none}
    .grid-area{padding:.9rem 1rem 5rem}
    .alerts-outer{padding:.5rem 1rem 0}
    .tabs-scroll{padding:.65rem 1rem .75rem}
    .sections-grid{grid-template-columns:1fr;gap:.75rem}
    .reorder-bar{left:.85rem;right:.85rem;transform:translateX(0) translateY(120px);max-width:none}
    .reorder-bar.visible{transform:translateX(0) translateY(0)}
}
@media(max-width:420px){
    .masthead{padding:.65rem .85rem}
    .grid-area{padding:.75rem .85rem 5rem}
    .tabs-scroll{padding:.55rem .85rem .65rem}
    .card-hd{padding:.52rem .7rem}
    .card-body{padding:.55rem .7rem}
    .btn-edit{padding:.28rem .52rem;font-size:.55rem}
    .order-num{font-size:.9rem}
}
</style>
@endpush

@section('content')
<div class="cms-wrap">

    {{-- Ticker --}}
    <div class="ticker-bar">
        <div class="ticker-inner">
            ◆ HNP COMMUNICATIONS ADMIN PANEL &nbsp;&nbsp;&nbsp; ◆ CMS PAGE SECTIONS &nbsp;&nbsp;&nbsp; ◆ DRAG TO REORDER &nbsp;&nbsp;&nbsp; ◆ CLICK 👁 TO HIDE FIELD &nbsp;&nbsp;&nbsp; ◆ HNP COMMUNICATIONS ADMIN PANEL &nbsp;&nbsp;&nbsp; ◆ CMS PAGE SECTIONS &nbsp;&nbsp;&nbsp; ◆ DRAG TO REORDER &nbsp;&nbsp;&nbsp; ◆ CLICK 👁 TO HIDE FIELD &nbsp;&nbsp;&nbsp;
        </div>
    </div>

    {{-- Masthead --}}
    <div class="masthead">
        <div class="masthead-inner">
            <div class="cms-title">
                <div class="title-icon-box">
                    @if($page === 'services-navbar')
                        <i class="fas fa-bars-staggered"></i>
                    @else
                        <i class="fas fa-layer-group"></i>
                    @endif
                </div>
                <div class="title-text">
                    <div class="title-main">
                        @if($page === 'services-navbar') SERVICES NAVBAR
                        @else CMS SECTIONS @endif
                    </div>
                    <div class="title-page-tag">{{ $page }}</div>
                    <div class="title-sub">
                        @if($page === 'services-navbar')
                            KELOLA DROPDOWN NAVBAR — SERVICES &amp; PENGATURAN
                        @else
                            {{ $sections->count() }} SECTION DITEMUKAN
                        @endif
                    </div>
                </div>
            </div>
            @if($page !== 'services-navbar')
            <div class="hint-chip"><i class="fas fa-eye-slash"></i> KLIK 👁 SEMBUNYIKAN FIELD</div>
            @endif
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success') || session('error'))
    <div class="alerts-outer" style="margin-top:.6rem">
        @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif
    </div>
    @endif

    {{-- Tabs --}}
    <div class="tabs-outer">
        <div class="tabs-fade-left" id="tabs-fade-left"></div>
        <div class="tabs-scroll" id="tabs-scroll">
            <span class="tabs-label">PAGE&nbsp;/</span>
            @foreach($availablePages as $p)
            <a href="{{ route('admin.cms.page-sections.index', ['page' => $p]) }}"
               class="page-tab {{ $p === $page ? 'active' : '' }} {{ $p === 'services-navbar' ? 'tab-special' : '' }}"
               data-page="{{ $p }}">
                @if($p === 'services-navbar')
                    <i class="fas fa-bars-staggered" style="margin-right:.3rem;font-size:.55rem"></i>
                @endif
                {{ $p }}
            </a>
            @endforeach
        </div>
        <div class="tabs-fade-right" id="tabs-fade-right"></div>
    </div>

    {{-- ═════════════════════════════════════════════════════════
         CONTENT AREA
    ═════════════════════════════════════════════════════════ --}}
    <div class="grid-area">

        @if($page === 'services-navbar')
        {{-- ══════════════════════════════════════════════════════
             SERVICES-NAVBAR — Dual Panel:
             KIRI  = Toggle aktif/nonaktif services (dari Service model)
             KANAN = Edit CMS sections navbar (dari PageSection)
        ══════════════════════════════════════════════════════ --}}

        <div class="row-label" style="margin-bottom:1rem">NAVBAR MANAGEMENT</div>

        <div class="navbar-page-grid">

            {{-- ── PANEL KIRI: Services Toggle ── --}}
            <div>
                <div class="row-label" style="margin-bottom:.65rem">
                    <i class="fas fa-eye" style="font-size:.6rem;color:var(--blu)"></i>
                    VISIBILITAS SERVICES DI NAVBAR
                </div>

                @php $allServices = \App\Models\Service::orderBy('order')->get(); @endphp

                @if($allServices->isNotEmpty())
                <div class="nb-widget svc-panel">
                    <div class="nb-widget-hd">
                        <div class="nb-widget-title">
                            <i class="fas fa-bars-staggered"></i>
                            <span>SERVICES AKTIF</span>
                        </div>
                        <span class="nb-widget-badge" id="svc-active-count">
                            {{ $allServices->where('is_active',true)->count() }}/{{ $allServices->count() }} AKTIF
                        </span>
                    </div>

                    <div id="svc-list">
                        @foreach($allServices as $svc)
                        <div class="svc-row {{ !$svc->is_active ? 'is-inactive' : '' }}" id="svc-row-{{ $svc->id }}">
                            <div class="svc-icon-box {{ $svc->is_active ? 'active-icon' : 'inactive-icon' }}" id="svc-icon-{{ $svc->id }}">
                                <i class="{{ $svc->icon_class ?? 'fa-solid fa-circle' }}"></i>
                            </div>
                            <div class="svc-info">
                                <div class="svc-name {{ $svc->is_active ? 'active-name' : 'inactive-name' }}" id="svc-name-{{ $svc->id }}">
                                    {{ $svc->title }}
                                </div>
                                <div class="svc-route">/layanan/{{ $svc->slug }}</div>
                            </div>
                            <span class="svc-badge {{ $svc->is_active ? 'active-badge' : 'inactive-badge' }}" id="svc-badge-{{ $svc->id }}">
                                {{ $svc->is_active ? 'AKTIF' : 'OFF' }}
                            </span>
                            <label class="toggle" title="{{ $svc->is_active ? 'Nonaktifkan dari navbar' : 'Aktifkan di navbar' }}" style="flex-shrink:0;cursor:pointer">
                                <input type="checkbox" {{ $svc->is_active ? 'checked' : '' }}
                                       onchange="toggleService({{ $svc->id }}, this)">
                                <span class="toggle-track"></span>
                                <span class="toggle-thumb"></span>
                            </label>
                        </div>
                        @endforeach
                    </div>

                    <div class="nb-widget-ft">
                        <i class="fas fa-info-circle"></i>&nbsp;
                        Toggle langsung mempengaruhi dropdown Services di navbar publik.
                    </div>
                </div>
                @else
                <div class="svc-empty">
                    <i class="fas fa-bars-staggered"></i>
                    <p>BELUM ADA SERVICE TERDAFTAR.</p>
                </div>
                @endif
            </div>

            {{-- ── PANEL KANAN: CMS Sections Edit ── --}}
            <div>
                <div class="row-label" style="margin-bottom:.65rem">
                    <i class="fas fa-sliders" style="font-size:.6rem;color:var(--yel)"></i>
                    PENGATURAN CMS NAVBAR
                </div>

                @if($sections->isEmpty())
                <div class="svc-empty">
                    <i class="fas fa-sliders"></i>
                    <p>BELUM ADA CMS SECTION UNTUK NAVBAR.<br>
                       <span style="opacity:.6">Jalankan <code>php artisan db:seed --class=CmsSeeder</code></span>
                    </p>
                </div>
                @else
                <div class="nb-widget cms-panel">
                    <div class="nb-widget-hd">
                        <div class="nb-widget-title">
                            <i class="fas fa-sliders"></i>
                            <span>CMS SECTIONS</span>
                        </div>
                        <span class="nb-widget-badge">{{ $sections->count() }} SECTION</span>
                    </div>

                    @foreach($sections as $section)
                    <div class="cms-section-row {{ !$section->is_active ? 'cms-section-inactive' : '' }}">
                        <div class="cms-section-info">
                            <div class="cms-section-label">{{ $section->label }}</div>
                            <div class="cms-section-key">
                                key: <strong style="color:var(--yel);background:var(--blk);padding:0 4px;font-family:'JetBrains Mono',monospace">{{ $section->section_key }}</strong>
                            </div>
                        </div>

                        {{-- Toggle aktif --}}
                        <form method="POST"
                              action="{{ route('admin.cms.page-sections.toggle-active', $section) }}"
                              class="toggle-form">
                            @csrf @method('PATCH')
                            <label class="toggle" title="{{ $section->is_active ? 'Nonaktifkan' : 'Aktifkan' }}" style="cursor:pointer">
                                <input type="checkbox" {{ $section->is_active ? 'checked' : '' }}
                                       onchange="this.closest('form').submit()">
                                <span class="toggle-track"></span>
                                <span class="toggle-thumb"></span>
                            </label>
                        </form>

                        {{-- Edit button ── INI YANG PENTING ── --}}
                        <a href="{{ route('admin.cms.page-sections.edit', $section) }}"
                           class="btn-edit-sm">
                            <i class="fas fa-pen"></i> EDIT
                        </a>
                    </div>
                    @endforeach

                    <div class="nb-widget-ft">
                        <i class="fas fa-info-circle"></i>&nbsp;
                        Edit setiap section untuk ubah logo, menu link, dropdown, dan warna navbar.
                    </div>
                </div>
                @endif
            </div>

        </div>{{-- end navbar-page-grid --}}

        @else
        {{-- ══════════════════════════════════════════════════════
             HALAMAN BIASA — Section Grid
        ══════════════════════════════════════════════════════ --}}

            @if($sections->isEmpty())
            <div class="empty-state">
                <span class="empty-icon"><i class="fas fa-inbox"></i></span>
                <p>BELUM ADA SECTION UNTUK HALAMAN <strong>{{ strtoupper($page) }}</strong></p>
            </div>
            @else
            <div class="row-label">SECTION LIST — {{ strtoupper($page) }}</div>
            <div class="sections-grid" id="sortable-grid">

                @foreach($sections as $section)
                @php
                    $fields       = $section->getFields();
                    $content      = $section->content ?? [];
                    $hiddenFields = $section->hidden_fields ?? [];

                    // Fallback: jika schema tidak ada, bangun dari content keys
                    if (empty($fields) && !empty($content)) {
                        $fields = collect(array_keys($content))->map(function($k) {
                            return ['key' => $k, 'label' => ucwords(str_replace('_',' ',$k)), 'type' => 'text'];
                        })->values()->all();
                    }

                    $preview     = array_slice($fields, 0, 5);
                    $more        = count($fields) - count($preview);
                    $hiddenCount = count($hiddenFields);
                    $histCount   = $historyCounts[$section->id] ?? 0;
                @endphp

                <div class="section-card {{ !$section->is_active ? 'inactive' : '' }}"
                     data-id="{{ $section->id }}">

                    <div class="card-accent"></div>

                    <div class="card-hd">
                        <div class="card-hd-left">
                            <span class="drag-handle"><i class="fas fa-grip-vertical"></i></span>
                            <span class="order-num">{{ str_pad($section->order, 2, '0', STR_PAD_LEFT) }}</span>
                            <div class="card-meta">
                                <div class="card-label">{{ $section->label }}</div>
                                <div class="card-key">
                                    {{ $section->section_key }}
                                    @if($histCount > 0)
                                    <span style="font-family:'JetBrains Mono',monospace;font-size:.42rem;background:#333;color:var(--yel);padding:0 4px;margin-left:3px">
                                        <i class="fas fa-clock-rotate-left" style="font-size:.4rem"></i> {{ $histCount }}
                                    </span>
                                    @endif
                                    <span class="hidden-badge {{ $hiddenCount > 0 ? 'has-hidden' : '' }}"
                                          data-hidden-badge="{{ $section->id }}">{{ $hiddenCount }}H</span>
                                </div>
                            </div>
                            <div class="status-pip {{ !$section->is_active ? 'off' : '' }}"></div>
                        </div>
                        <div class="card-actions">
                            {{-- Toggle active --}}
                            <form method="POST"
                                  action="{{ route('admin.cms.page-sections.toggle-active', $section) }}"
                                  class="toggle-form">
                                @csrf @method('PATCH')
                                <label class="toggle" title="{{ $section->is_active ? 'Nonaktifkan' : 'Aktifkan' }}" style="cursor:pointer">
                                    <input type="checkbox" {{ $section->is_active ? 'checked' : '' }}
                                           onchange="this.closest('form').submit()">
                                    <span class="toggle-track"></span>
                                    <span class="toggle-thumb"></span>
                                </label>
                            </form>
                            <a href="{{ route('admin.cms.page-sections.edit', $section) }}" class="btn-edit">
                                <i class="fas fa-pen"></i> EDIT
                            </a>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body">
                        <div class="field-rows" id="fields-{{ $section->id }}">

                            @foreach($preview as $field)
                            @php
                                $key      = $field['key'];
                                $val      = $content[$key] ?? null;
                                $type     = $field['type'];
                                $isHidden = in_array($key, $hiddenFields);
                            @endphp
                            <div class="field-row {{ $isHidden ? 'is-hidden-row' : '' }}"
                                 data-field-key="{{ $key }}"
                                 data-section-id="{{ $section->id }}">
                                <button class="field-eye-btn {{ $isHidden ? 'is-hidden' : '' }}"
                                        title="{{ $isHidden ? 'Tampilkan field ini' : 'Sembunyikan field ini' }}"
                                        onclick="toggleFieldVisibility({{ $section->id }}, '{{ $key }}', this)"
                                        type="button">
                                    <i class="fas {{ $isHidden ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                </button>
                                <span class="f-label">{{ Str::limit($field['label'], 11) }}</span>
                                @if($type === 'image')
                                    @if($val)
                                        <img src="{{ Storage::url($val) }}" alt="" class="f-img">
                                    @else
                                        <span class="f-val empty">— no image</span>
                                    @endif
                                @elseif($type === 'color')
                                    @if($val)
                                        <span class="f-color-dot" style="background:{{ $val }}"></span>
                                        <span class="f-val" style="font-family:'JetBrains Mono',monospace;font-size:.54rem">{{ $val }}</span>
                                    @else
                                        <span class="f-val empty">—</span>
                                    @endif
                                @else
                                    <span class="f-val {{ !$val ? 'empty' : '' }}">
                                        {{ $val ? Str::limit(strip_tags((string)$val), 38) : '—' }}
                                    </span>
                                @endif
                            </div>
                            @endforeach

                            @if($more > 0)
                            <button class="btn-expand-fields"
                                    onclick="toggleExpandFields(this, {{ $section->id }})"
                                    type="button">
                                <i class="fas fa-chevron-down"></i>
                                +{{ $more }} MORE FIELDS (klik untuk lihat semua)
                            </button>
                            <div class="hidden-fields-area" id="extra-fields-{{ $section->id }}">
                                <div class="hidden-area-label">
                                    <i class="fas fa-layer-group"></i> SEMUA FIELD
                                </div>
                                @foreach(array_slice($fields, 5) as $field)
                                @php
                                    $key      = $field['key'];
                                    $val      = $content[$key] ?? null;
                                    $type     = $field['type'];
                                    $isHidden = in_array($key, $hiddenFields);
                                @endphp
                                <div class="field-row {{ $isHidden ? 'is-hidden-row' : '' }}"
                                     data-field-key="{{ $key }}"
                                     data-section-id="{{ $section->id }}">
                                    <button class="field-eye-btn {{ $isHidden ? 'is-hidden' : '' }}"
                                            title="{{ $isHidden ? 'Tampilkan' : 'Sembunyikan' }}"
                                            onclick="toggleFieldVisibility({{ $section->id }}, '{{ $key }}', this)"
                                            type="button">
                                        <i class="fas {{ $isHidden ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
                                    <span class="f-label">{{ Str::limit($field['label'], 11) }}</span>
                                    @if($type === 'image')
                                        @if($val)
                                            <img src="{{ Storage::url($val) }}" alt="" class="f-img">
                                        @else
                                            <span class="f-val empty">— no img</span>
                                        @endif
                                    @elseif($type === 'color')
                                        @if($val)
                                            <span class="f-color-dot" style="background:{{ $val }}"></span>
                                            <span class="f-val" style="font-family:'JetBrains Mono',monospace;font-size:.54rem">{{ $val }}</span>
                                        @else
                                            <span class="f-val empty">—</span>
                                        @endif
                                    @else
                                        <span class="f-val {{ !$val ? 'empty' : '' }}">
                                            {{ $val ? Str::limit(strip_tags((string)$val), 38) : '—' }}
                                        </span>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @endif

                        </div>
                    </div>

                </div>
                @endforeach

            </div>
            @endif

        @endif
        {{-- end page condition --}}

    </div>

    {{-- Reorder Bar (hanya untuk halaman non services-navbar) --}}
    @if($page !== 'services-navbar')
    <div class="reorder-bar" id="reorder-bar">
        <div class="blink-dot"></div>
        <span class="bar-text">URUTAN BERUBAH — BELUM TERSIMPAN</span>
        <button class="btn-save-order" id="btn-save-order">SIMPAN URUTAN</button>
        <span id="reorder-status"></span>
    </div>
    @endif

    {{-- Toast --}}
    <div class="field-toast" id="field-toast"></div>

</div>
@endsection

@push('scripts')
<script>
const CSRF             = '{{ csrf_token() }}';
const TOGGLE_FIELD_URL = '{{ url('admin/cms/page-sections/section') }}';
const TOGGLE_SVC_URL   = '{{ url('admin/cms/services') }}';

/* ════════════════════════════════════════════════
   TOGGLE SERVICE AKTIF / NONAKTIF
   ════════════════════════════════════════════ */
async function toggleService(svcId, checkbox) {
    checkbox.disabled = true;
    try {
        const res = await fetch(`${TOGGLE_SVC_URL}/${svcId}/toggle`, {
            method : 'PATCH',
            headers: {
                'X-CSRF-TOKEN' : CSRF,
                'Accept'       : 'application/json',
                'Content-Type' : 'application/json',
            },
        });

        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const data = await res.json();
        if (!data.success) throw new Error(data.message || 'Gagal');

        const active = data.is_active;

        document.getElementById(`svc-row-${svcId}`)?.classList.toggle('is-inactive', !active);

        const iconBox = document.getElementById(`svc-icon-${svcId}`);
        if (iconBox) {
            iconBox.classList.toggle('active-icon',   active);
            iconBox.classList.toggle('inactive-icon', !active);
        }

        const name = document.getElementById(`svc-name-${svcId}`);
        if (name) {
            name.classList.toggle('active-name',   active);
            name.classList.toggle('inactive-name', !active);
        }

        const badge = document.getElementById(`svc-badge-${svcId}`);
        if (badge) {
            badge.textContent = active ? 'AKTIF' : 'OFF';
            badge.classList.toggle('active-badge',   active);
            badge.classList.toggle('inactive-badge', !active);
        }

        const countEl = document.getElementById('svc-active-count');
        if (countEl && data.active_count !== undefined) {
            countEl.textContent = `${data.active_count}/${data.total_count} AKTIF`;
        }

        showToast(active
            ? `"${data.title}" aktif di navbar`
            : `"${data.title}" disembunyikan dari navbar`
        );
    } catch (e) {
        checkbox.checked = !checkbox.checked;
        showToast('Gagal: ' + e.message, true);
    }
    checkbox.disabled = false;
}

/* ════════════════════════════════════════════════
   TOGGLE FIELD VISIBILITY (eye icon di card)
   ════════════════════════════════════════════ */
async function toggleFieldVisibility(sectionId, fieldKey, btn) {
    btn.disabled = true;
    try {
        const res = await fetch(`${TOGGLE_FIELD_URL}/${sectionId}/toggle-field`, {
            method : 'PATCH',
            headers: {
                'Content-Type' : 'application/json',
                'X-CSRF-TOKEN' : CSRF,
                'Accept'       : 'application/json',
            },
            body: JSON.stringify({ field_key: fieldKey }),
        });

        if (!res.ok) {
            let msg = `HTTP ${res.status}`;
            try { const d = await res.json(); msg = d.error || msg; } catch(_){}
            throw new Error(msg);
        }

        const data = await res.json();
        if (!data.success) throw new Error(data.error || 'Gagal');

        const isHidden = data.is_hidden;
        const row      = btn.closest('.field-row');

        row.classList.toggle('is-hidden-row', isHidden);
        btn.classList.toggle('is-hidden', isHidden);
        btn.querySelector('i').className = `fas ${isHidden ? 'fa-eye-slash' : 'fa-eye'}`;
        btn.title = isHidden ? 'Tampilkan field ini' : 'Sembunyikan field ini';

        const badge = document.querySelector(`[data-hidden-badge="${sectionId}"]`);
        if (badge) {
            badge.textContent = data.hidden_count + 'H';
            badge.classList.toggle('has-hidden', data.hidden_count > 0);
        }

        showToast(isHidden
            ? `Field "${fieldKey}" disembunyikan`
            : `Field "${fieldKey}" ditampilkan kembali`
        );
    } catch (e) {
        showToast('Gagal: ' + e.message, true);
    }
    btn.disabled = false;
}

/* ════════════════════════════════════════════════
   EXPAND / COLLAPSE MORE FIELDS
   ════════════════════════════════════════════ */
function toggleExpandFields(btn, sectionId) {
    const area   = document.getElementById(`extra-fields-${sectionId}`);
    const isOpen = area.classList.toggle('open');
    btn.classList.toggle('expanded', isOpen);
}

/* ════════════════════════════════════════════════
   TOAST
   ════════════════════════════════════════════ */
let _toastTimer;
function showToast(msg, isError = false) {
    const t = document.getElementById('field-toast');
    if (!t) return;
    t.textContent       = msg;
    t.style.background  = isError ? '#FF5A36' : '#0D0D0D';
    t.style.color       = isError ? '#fff'    : '#F5C800';
    t.style.borderColor = isError ? '#FF5A36' : '#F5C800';
    t.classList.add('show');
    clearTimeout(_toastTimer);
    _toastTimer = setTimeout(() => t.classList.remove('show'), 2800);
}

/* ════════════════════════════════════════════════
   TABS SCROLL BEHAVIOUR
   ════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', () => {
    const tabsScroll = document.getElementById('tabs-scroll');
    const fadeRight  = document.getElementById('tabs-fade-right');
    const fadeLeft   = document.getElementById('tabs-fade-left');
    const activeTab  = tabsScroll?.querySelector('.page-tab.active');

    function updateTabsFade() {
        if (!tabsScroll) return;
        const { scrollLeft, scrollWidth, clientWidth } = tabsScroll;
        if (fadeRight) fadeRight.style.opacity = (scrollLeft + clientWidth >= scrollWidth - 2) ? '0' : '1';
        if (fadeLeft)  fadeLeft.style.opacity  = scrollLeft <= 2 ? '0' : '1';
    }

    if (activeTab && tabsScroll) {
        const target = activeTab.offsetLeft - tabsScroll.clientWidth / 2 + activeTab.offsetWidth / 2;
        tabsScroll.scrollTo({ left: Math.max(0, target), behavior: 'instant' });
    }

    tabsScroll?.addEventListener('scroll', updateTabsFade, { passive: true });
    updateTabsFade();

    // Mouse drag scroll on tabs
    let isDown = false, startX = 0, scrollStart = 0;
    tabsScroll?.addEventListener('mousedown', e => {
        isDown = true; startX = e.pageX - tabsScroll.offsetLeft; scrollStart = tabsScroll.scrollLeft;
        tabsScroll.style.cursor = 'grabbing';
    });
    window.addEventListener('mouseup', () => { isDown = false; if(tabsScroll) tabsScroll.style.cursor = ''; });
    tabsScroll?.addEventListener('mousemove', e => {
        if (!isDown) return; e.preventDefault();
        tabsScroll.scrollLeft = scrollStart - (e.pageX - tabsScroll.offsetLeft - startX) * 1.2;
    });

    /* ── DRAG & DROP REORDER (hanya untuk halaman non services-navbar) ── */
    const grid     = document.getElementById('sortable-grid');
    const bar      = document.getElementById('reorder-bar');
    const btnSave  = document.getElementById('btn-save-order');
    const statusEl = document.getElementById('reorder-status');
    if (!grid || !bar) return;

    let dragged = null, touchDragged = null, touchClone = null;
    let touchStartX = 0, touchStartY = 0, touchCardRect = null;

    function initCard(card) {
        card.setAttribute('draggable', 'true');

        card.addEventListener('dragstart', e => {
            dragged = card;
            setTimeout(() => card.classList.add('dragging'), 0);
            e.dataTransfer.effectAllowed = 'move';
        });
        card.addEventListener('dragend', () => {
            card.classList.remove('dragging');
            grid.querySelectorAll('.section-card').forEach(c => c.classList.remove('drag-over'));
            dragged = null;
        });
        card.addEventListener('dragover', e => {
            e.preventDefault();
            if (card !== dragged) {
                grid.querySelectorAll('.section-card').forEach(c => c.classList.remove('drag-over'));
                card.classList.add('drag-over');
            }
        });
        card.addEventListener('drop', e => {
            e.preventDefault();
            if (!dragged || dragged === card) return;
            const cards = [...grid.querySelectorAll('.section-card')];
            grid.insertBefore(dragged,
                cards.indexOf(dragged) < cards.indexOf(card) ? card.nextSibling : card
            );
            updateBadges();
            bar.classList.add('visible');
        });

        // Touch drag
        card.addEventListener('touchstart', e => {
            touchDragged  = card;
            const t = e.touches[0];
            touchStartX = t.clientX; touchStartY = t.clientY;
            touchCardRect = card.getBoundingClientRect();
            touchClone = card.cloneNode(true);
            Object.assign(touchClone.style, {
                position:'fixed', zIndex:'9999', opacity:'.72', pointerEvents:'none',
                width: touchCardRect.width + 'px', transform:'rotate(-1deg) scale(.97)',
                boxShadow:'6px 6px 0 #0D0D0D',
                left: touchCardRect.left + 'px', top: touchCardRect.top + 'px',
                transition:'none',
            });
            document.body.appendChild(touchClone);
            card.classList.add('dragging');
        }, { passive: true });

        card.addEventListener('touchmove', e => {
            if (!touchDragged || !touchClone) return;
            e.preventDefault();
            const t = e.touches[0];
            touchClone.style.left = (touchCardRect.left + t.clientX - touchStartX) + 'px';
            touchClone.style.top  = (touchCardRect.top  + t.clientY - touchStartY) + 'px';
            const el  = document.elementFromPoint(t.clientX, t.clientY);
            const tgt = el?.closest('.section-card');
            grid.querySelectorAll('.section-card').forEach(c => c.classList.remove('drag-over'));
            if (tgt && tgt !== touchDragged) tgt.classList.add('drag-over');
        }, { passive: false });

        card.addEventListener('touchend', e => {
            if (!touchDragged) return;
            const t   = e.changedTouches[0];
            const el  = document.elementFromPoint(t.clientX, t.clientY);
            const tgt = el?.closest('.section-card');
            if (tgt && tgt !== touchDragged) {
                const cards = [...grid.querySelectorAll('.section-card')];
                grid.insertBefore(touchDragged,
                    cards.indexOf(touchDragged) < cards.indexOf(tgt) ? tgt.nextSibling : tgt
                );
                updateBadges();
                bar.classList.add('visible');
            }
            touchDragged.classList.remove('dragging');
            grid.querySelectorAll('.section-card').forEach(c => c.classList.remove('drag-over'));
            if (touchClone) { document.body.removeChild(touchClone); touchClone = null; }
            touchDragged = null;
        }, { passive: true });
    }

    grid.querySelectorAll('.section-card').forEach(initCard);

    function updateBadges() {
        grid.querySelectorAll('.section-card').forEach((c, i) => {
            const b = c.querySelector('.order-num');
            if (b) b.textContent = String(i + 1).padStart(2, '0');
        });
    }

    btnSave?.addEventListener('click', () => {
        const ids = [...grid.querySelectorAll('.section-card')].map(c => c.dataset.id);
        if (statusEl) statusEl.textContent = 'SAVING...';
        if (btnSave)  btnSave.disabled = true;
        fetch('{{ route('admin.cms.page-sections.reorder') }}', {
            method  : 'POST',
            headers : {
                'Content-Type' : 'application/json',
                'X-CSRF-TOKEN' : CSRF,
                'Accept'       : 'application/json',
            },
            body: JSON.stringify({ order: ids }),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                if (statusEl) statusEl.textContent = '✓ TERSIMPAN';
                setTimeout(() => {
                    bar.classList.remove('visible');
                    if (statusEl) statusEl.textContent = '';
                    if (btnSave)  btnSave.disabled = false;
                }, 2200);
            } else throw new Error();
        })
        .catch(() => {
            if (statusEl) statusEl.textContent = '✗ ERROR';
            if (btnSave)  btnSave.disabled = false;
        });
    });
});
</script>
@endpush