{{-- resources/views/admin/cms/services/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'CMS — SERVICES')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Syne:wght@700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
<style>
:root {
    --w:   #F5F0E8; --blk: #0D0D0D; --yel: #F5C800;
    --cor: #FF5A36; --mnt: #00C48C; --blu: #1A56FF;
    --pur: #7B2FFF;
    --txt: #0D0D0D; --txt2:#3D3D3D; --mu:  #7A7A7A;
    --bd:  3px solid #0D0D0D;
    --sh:  4px 4px 0 #0D0D0D; --shlg: 6px 6px 0 #0D0D0D;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
.cms-wrap{overflow-x:clip;max-width:100%;min-height:100vh}

/* Ticker */
.ticker-bar{background:var(--blk);padding:5px 0;overflow:hidden;white-space:nowrap;border-bottom:var(--bd);width:100%}
.ticker-inner{display:inline-block;animation:ticker 22s linear infinite;font-family:'JetBrains Mono',monospace;font-size:.56rem;font-weight:700;color:var(--yel);letter-spacing:.13em;text-transform:uppercase;padding-left:100%}
@keyframes ticker{from{transform:translateX(0)}to{transform:translateX(-50%)}}

/* Masthead */
.masthead{background:var(--yel);border-bottom:var(--bd);padding:1rem 1.25rem;width:100%;overflow:clip}
.masthead-inner{display:flex;align-items:center;justify-content:space-between;gap:.85rem;flex-wrap:wrap}
.cms-title{display:flex;align-items:center;gap:.85rem;min-width:0;flex:1;overflow:hidden}
.title-icon-box{width:44px;height:44px;min-width:44px;background:var(--blk);border:var(--bd);box-shadow:var(--sh);display:flex;align-items:center;justify-content:center;font-size:1.1rem;color:var(--yel);flex-shrink:0}
.title-text{min-width:0;overflow:hidden}
.title-main{font-family:'Syne',sans-serif;font-size:clamp(.95rem,4.5vw,1.8rem);font-weight:800;color:var(--blk);line-height:1;letter-spacing:-.02em;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.title-sub{font-family:'JetBrains Mono',monospace;font-size:.54rem;color:var(--txt2);margin-top:4px;letter-spacing:.04em;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.btn-add{display:inline-flex;align-items:center;gap:.4rem;font-family:'JetBrains Mono',monospace;font-size:.62rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;padding:.55rem 1rem;background:var(--blk);border:var(--bd);color:var(--yel);text-decoration:none;box-shadow:var(--sh);transition:all .14s;white-space:nowrap;flex-shrink:0}
.btn-add:hover{background:#222;transform:translate(-2px,-2px);box-shadow:var(--shlg)}

/* Alerts */
.alerts-outer{padding:.6rem 1.25rem 0}
.alert{display:flex;align-items:center;gap:.5rem;padding:.6rem .85rem;border:var(--bd);margin-bottom:.45rem;font-family:'JetBrains Mono',monospace;font-size:.65rem;font-weight:600;box-shadow:var(--sh);animation:slideDown .2s ease}
.alert-success{background:#D4F5E4;color:#005C33}
.alert-error{background:#FFE0D9;color:#8B1A00}
@keyframes slideDown{from{opacity:0;transform:translateY(-4px)}to{opacity:1;transform:translateY(0)}}

/* Stats bar */
.stats-bar{display:flex;align-items:stretch;gap:0;border:var(--bd);background:var(--blk);overflow:hidden;margin:1rem 1.25rem 0;box-shadow:var(--sh)}
.stat-item{flex:1;padding:.65rem .9rem;display:flex;flex-direction:column;gap:2px;border-right:2px solid rgba(255,255,255,.1)}
.stat-item:last-child{border-right:none}
.stat-num{font-family:'Syne',sans-serif;font-size:1.5rem;font-weight:800;color:var(--yel);line-height:1}
.stat-lbl{font-family:'JetBrains Mono',monospace;font-size:.52rem;font-weight:700;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:.1em}

/* Grid area */
.grid-area{padding:1.1rem 1.25rem 5.5rem;overflow-x:clip;width:100%}
.row-label{font-family:'JetBrains Mono',monospace;font-size:.57rem;font-weight:700;color:var(--mu);text-transform:uppercase;letter-spacing:.12em;margin-bottom:.75rem;display:flex;align-items:center;gap:.5rem;overflow:hidden}
.row-label::after{content:'';flex:1;height:2px;background:var(--blk);min-width:0}
.services-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(min(100%,300px),1fr));gap:.9rem;width:100%}

/* Card */
.service-card{background:var(--w);border:var(--bd);box-shadow:var(--sh);position:relative;transition:transform .12s,box-shadow .12s;animation:cardReveal .32s ease both;width:100%;overflow:hidden;cursor:grab}
@keyframes cardReveal{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}
.service-card:nth-child(1){animation-delay:.03s}.service-card:nth-child(2){animation-delay:.06s}
.service-card:nth-child(3){animation-delay:.09s}.service-card:nth-child(4){animation-delay:.12s}
.service-card:nth-child(5){animation-delay:.15s}.service-card:nth-child(6){animation-delay:.17s}
@media(hover:hover){.service-card:hover{transform:translate(-2px,-2px);box-shadow:var(--shlg)}}
.service-card:active{cursor:grabbing}
.service-card.dragging{opacity:.3;transform:rotate(-1deg) scale(.97)}
.service-card.drag-over{outline:3px dashed var(--cor);outline-offset:-3px}
.service-card.inactive .card-body-inner{opacity:.55}

/* Accent bar — warna bergantian */
.service-card:nth-child(6n+1) .card-accent{background:var(--yel)}
.service-card:nth-child(6n+2) .card-accent{background:var(--cor)}
.service-card:nth-child(6n+3) .card-accent{background:var(--mnt)}
.service-card:nth-child(6n+4) .card-accent{background:var(--blu)}
.service-card:nth-child(6n+5) .card-accent{background:var(--pur)}
.service-card:nth-child(6n+6) .card-accent{background:#FF9500}
.card-accent{height:5px;border-bottom:2px solid var(--blk)}

/* Card Header */
.card-hd{display:flex;align-items:center;padding:.6rem .8rem;background:var(--blk);gap:.5rem;border-bottom:var(--bd);overflow:hidden;min-width:0}
.card-hd-left{display:flex;align-items:center;gap:.4rem;min-width:0;flex:1;overflow:hidden}
.drag-handle{color:#888;font-size:.65rem;cursor:grab;flex-shrink:0;display:flex;align-items:center;justify-content:center;width:20px;height:20px;transition:color .14s}
.drag-handle:hover{color:var(--yel)}
.order-badge{font-family:'Syne',sans-serif;font-size:1rem;font-weight:800;color:var(--yel);line-height:1;flex-shrink:0;min-width:24px}
.card-meta{min-width:0;flex:1;overflow:hidden}
.card-title{font-family:'Syne',sans-serif;font-size:.82rem;font-weight:700;color:var(--w);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;line-height:1.15}
.card-slug{font-family:'JetBrains Mono',monospace;font-size:.5rem;color:#888;margin-top:1px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.status-pip{width:7px;height:7px;border-radius:50%;background:var(--mnt);border:1.5px solid rgba(255,255,255,.5);flex-shrink:0}
.status-pip.off{background:#555;border-color:#888}
.card-actions{display:flex;align-items:center;gap:.4rem;flex-shrink:0}

/* Toggle AJAX */
.toggle-wrap{display:inline-flex}
.svc-toggle{position:relative;width:34px;height:18px;cursor:pointer;display:block}
.svc-toggle input{opacity:0;width:0;height:0;position:absolute}
.toggle-track{position:absolute;inset:0;background:#444;border-radius:999px;border:2px solid #888;transition:all .18s}
.svc-toggle input:checked~.toggle-track{background:var(--mnt);border-color:#00a078}
.toggle-thumb{position:absolute;top:3px;left:3px;width:12px;height:12px;background:#888;border-radius:50%;transition:transform .18s,background .18s;pointer-events:none}
.svc-toggle input:checked~.toggle-thumb{transform:translateX(16px);background:var(--w)}

.btn-edit{font-family:'JetBrains Mono',monospace;font-size:.55rem;font-weight:700;letter-spacing:.04em;padding:.3rem .6rem;background:var(--yel);border:2px solid var(--yel);color:var(--blk);text-decoration:none;display:flex;align-items:center;gap:.25rem;transition:all .14s;white-space:nowrap;text-transform:uppercase;box-shadow:2px 2px 0 rgba(255,255,255,.2);flex-shrink:0;min-height:28px}
.btn-edit:hover{background:var(--w);border-color:var(--w)}
.btn-del{font-family:'JetBrains Mono',monospace;font-size:.55rem;font-weight:700;padding:.3rem .55rem;background:transparent;border:2px solid #555;color:#888;display:flex;align-items:center;gap:.25rem;transition:all .14s;white-space:nowrap;text-transform:uppercase;cursor:pointer;flex-shrink:0;min-height:28px}
.btn-del:hover{background:var(--cor);border-color:var(--cor);color:var(--w)}

/* Card Body */
.card-body-inner{padding:.7rem .8rem}
.field-row{display:flex;align-items:flex-start;gap:.5rem;padding:.22rem 0;border-bottom:1px solid rgba(0,0,0,.05)}
.field-row:last-child{border-bottom:none}
.f-label{font-family:'JetBrains Mono',monospace;font-size:.52rem;font-weight:700;color:var(--mu);min-width:72px;max-width:72px;flex-shrink:0;padding-top:2px;text-transform:uppercase;letter-spacing:.03em;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.f-val{color:var(--txt2);word-break:break-word;overflow:hidden;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;font-weight:500;font-size:.68rem;flex:1;min-width:0}
.f-val.empty{color:#bbb;font-style:italic}
.f-img{width:44px;height:30px;object-fit:cover;border:2px solid var(--blk);flex-shrink:0}
.inactive-banner{background:var(--cor);color:var(--w);font-family:'JetBrains Mono',monospace;font-size:.5rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:3px 8px;border-bottom:2px solid var(--blk);display:flex;align-items:center;gap:.3rem}

/* Route chip */
.route-chip{font-family:'JetBrains Mono',monospace;font-size:.48rem;font-weight:700;background:var(--blu);color:var(--w);padding:2px 6px;letter-spacing:.04em;display:inline-block;max-width:100%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}

/* Empty state */
.empty-state{text-align:center;padding:4rem 2rem;color:var(--mu);font-family:'JetBrains Mono',monospace}
.empty-icon{font-size:2.5rem;margin-bottom:.8rem;display:block;opacity:.2}
.empty-state p{font-size:.7rem;line-height:1.8}
.empty-state .btn-add-lg{display:inline-flex;align-items:center;gap:.4rem;margin-top:1.25rem;font-family:'JetBrains Mono',monospace;font-size:.65rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;padding:.65rem 1.25rem;background:var(--blk);border:var(--bd);color:var(--yel);text-decoration:none;box-shadow:var(--sh);transition:all .14s}
.empty-state .btn-add-lg:hover{background:#222}

/* Reorder bar */
.reorder-bar{position:fixed;bottom:1.25rem;left:50%;transform:translateX(-50%) translateY(120px);background:var(--blk);border:var(--bd);box-shadow:var(--shlg);padding:.6rem 1rem;display:flex;align-items:center;gap:.7rem;z-index:999;font-family:'JetBrains Mono',monospace;font-size:.65rem;color:var(--yel);opacity:0;pointer-events:none;transition:transform .35s cubic-bezier(.34,1.56,.64,1),opacity .25s;white-space:nowrap;max-width:calc(100vw - 2.5rem)}
.reorder-bar.visible{transform:translateX(-50%) translateY(0);opacity:1;pointer-events:auto}
.blink-dot{width:7px;height:7px;border-radius:50%;background:var(--cor);animation:blink .8s step-end infinite;flex-shrink:0}
@keyframes blink{0%,100%{opacity:1}50%{opacity:0}}
.btn-save-order{background:var(--yel);color:var(--blk);border:2px solid var(--yel);padding:.4rem .95rem;font-family:'JetBrains Mono',monospace;font-size:.62rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;cursor:pointer;transition:all .14s;flex-shrink:0}
.btn-save-order:hover{background:var(--w);border-color:var(--w)}
.btn-save-order:disabled{opacity:.4;cursor:not-allowed}
#reorder-status{font-size:.6rem;min-width:50px;text-align:right;flex-shrink:0}

/* Toast */
.svc-toast{position:fixed;bottom:5rem;right:1.25rem;background:var(--blk);color:var(--yel);font-family:'JetBrains Mono',monospace;font-size:.6rem;font-weight:700;padding:.45rem .9rem;border:2px solid var(--yel);box-shadow:var(--sh);z-index:1000;opacity:0;transform:translateY(8px);transition:all .25s;pointer-events:none;letter-spacing:.06em;text-transform:uppercase}
.svc-toast.show{opacity:1;transform:translateY(0)}

/* Delete modal */
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,.65);z-index:9998;display:none;align-items:center;justify-content:center;padding:1rem}
.modal-overlay.open{display:flex}
.modal-box{background:var(--w);border:var(--bd);box-shadow:var(--shlg);padding:1.5rem;max-width:340px;width:100%;text-align:center;animation:modalPop .25s cubic-bezier(.34,1.56,.64,1)}
@keyframes modalPop{from{transform:scale(.88) translateY(12px);opacity:0}to{transform:scale(1) translateY(0);opacity:1}}
.modal-icon{width:48px;height:48px;background:var(--cor);border:var(--bd);box-shadow:var(--sh);display:flex;align-items:center;justify-content:center;margin:0 auto .9rem;font-size:1.1rem;color:var(--w)}
.modal-title{font-family:'Syne',sans-serif;font-size:1.2rem;font-weight:800;letter-spacing:-.02em;color:var(--blk);margin-bottom:.35rem}
.modal-desc{font-size:.78rem;color:var(--txt2);margin-bottom:1rem;line-height:1.65}
.modal-name{font-family:'JetBrains Mono',monospace;font-size:.7rem;background:#FFE0D9;border:var(--bd);padding:.4rem .75rem;margin-bottom:1rem;color:#8B1A00;font-weight:700;word-break:break-word}
.modal-actions{display:flex;gap:.5rem}
.btn-modal-cancel{flex:1;padding:.52rem;border:var(--bd);background:var(--w);color:var(--txt);font-family:'JetBrains Mono',monospace;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.04em;cursor:pointer;transition:all .12s;box-shadow:2px 2px 0 var(--blk)}
.btn-modal-cancel:hover{background:var(--blk);color:var(--w)}
.btn-modal-del{flex:1;padding:.52rem;border:var(--bd);background:var(--cor);color:var(--w);font-family:'Syne',sans-serif;font-size:.9rem;font-weight:800;cursor:pointer;transition:all .12s;box-shadow:2px 2px 0 var(--blk)}
.btn-modal-del:hover{background:#cc3a20}

/* Responsive */
@media(max-width:700px){
    .masthead{padding:.8rem 1rem}
    .title-icon-box{width:38px;height:38px;min-width:38px;font-size:.95rem}
    .grid-area{padding:.9rem 1rem 5rem}
    .alerts-outer{padding:.5rem 1rem 0}
    .stats-bar{margin:.75rem 1rem 0}
    .services-grid{grid-template-columns:1fr;gap:.75rem}
    .reorder-bar{left:.85rem;right:.85rem;transform:translateX(0) translateY(120px);max-width:none}
    .reorder-bar.visible{transform:translateX(0) translateY(0)}
}
@media(max-width:420px){
    .masthead{padding:.65rem .85rem}
    .grid-area{padding:.75rem .85rem 5rem}
    .stats-bar{margin:.6rem .85rem 0}
    .stat-num{font-size:1.2rem}
    .card-hd{padding:.52rem .7rem}
    .card-body-inner{padding:.55rem .7rem}
}
</style>
@endpush

@section('content')
<div class="cms-wrap">

    {{-- Ticker --}}
    <div class="ticker-bar">
        <div class="ticker-inner">
            ◆ HNP COMMUNICATIONS ADMIN PANEL &nbsp;&nbsp;&nbsp; ◆ CMS LAYANAN / SERVICES &nbsp;&nbsp;&nbsp; ◆ DRAG TO REORDER &nbsp;&nbsp;&nbsp; ◆ TOGGLE AKTIF/NONAKTIF &nbsp;&nbsp;&nbsp; ◆ HNP COMMUNICATIONS ADMIN PANEL &nbsp;&nbsp;&nbsp; ◆ CMS LAYANAN / SERVICES &nbsp;&nbsp;&nbsp; ◆ DRAG TO REORDER &nbsp;&nbsp;&nbsp; ◆ TOGGLE AKTIF/NONAKTIF &nbsp;&nbsp;&nbsp;
        </div>
    </div>

    {{-- Masthead --}}
    <div class="masthead">
        <div class="masthead-inner">
            <div class="cms-title">
                <div class="title-icon-box"><i class="fas fa-briefcase"></i></div>
                <div class="title-text">
                    <div class="title-main">CMS LAYANAN</div>
                    <div class="title-sub">{{ $services->count() }} SERVICE TERDAFTAR — {{ $services->where('is_active', true)->count() }} AKTIF</div>
                </div>
            </div>
            <a href="{{ route('admin.cms.services.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> TAMBAH SERVICE
            </a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="stats-bar">
        <div class="stat-item">
            <span class="stat-num">{{ $services->count() }}</span>
            <span class="stat-lbl">Total</span>
        </div>
        <div class="stat-item">
            <span class="stat-num" style="color:#00C48C">{{ $services->where('is_active', true)->count() }}</span>
            <span class="stat-lbl">Aktif</span>
        </div>
        <div class="stat-item">
            <span class="stat-num" style="color:#FF5A36">{{ $services->where('is_active', false)->count() }}</span>
            <span class="stat-lbl">Nonaktif</span>
        </div>
        <div class="stat-item">
            <span class="stat-num" style="color:#1A56FF">{{ $services->whereNotNull('route_name')->count() }}</span>
            <span class="stat-lbl">Punya Route</span>
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

    {{-- Grid --}}
    <div class="grid-area">
        @if($services->isEmpty())
        <div class="empty-state">
            <span class="empty-icon"><i class="fas fa-briefcase"></i></span>
            <p>BELUM ADA SERVICE TERDAFTAR.<br>Tambahkan service pertama kamu.</p>
            <a href="{{ route('admin.cms.services.create') }}" class="btn-add-lg">
                <i class="fas fa-plus"></i> TAMBAH SERVICE BARU
            </a>
        </div>
        @else
        <div class="row-label">DAFTAR LAYANAN</div>
        <div class="services-grid" id="sortable-grid">
            @foreach($services as $service)
            <div class="service-card {{ !$service->is_active ? 'inactive' : '' }}"
                 data-id="{{ $service->id }}">
                <div class="card-accent"></div>

                {{-- Banner nonaktif --}}
                @if(!$service->is_active)
                <div class="inactive-banner">
                    <i class="fas fa-eye-slash"></i> DISEMBUNYIKAN DARI NAVBAR & FRONTEND
                </div>
                @endif

                {{-- Card Header --}}
                <div class="card-hd">
                    <div class="card-hd-left">
                        <span class="drag-handle"><i class="fas fa-grip-vertical"></i></span>
                        <span class="order-badge">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div class="card-meta">
                            <div class="card-title">{{ $service->title }}</div>
                            <div class="card-slug">{{ $service->tab_label }} · /{{ $service->slug }}</div>
                        </div>
                        <div class="status-pip {{ !$service->is_active ? 'off' : '' }}"
                             id="pip-{{ $service->id }}"></div>
                    </div>
                    <div class="card-actions">
                        {{-- AJAX Toggle --}}
                        <label class="svc-toggle" title="{{ $service->is_active ? 'Nonaktifkan' : 'Aktifkan' }}"
                               onclick="toggleService({{ $service->id }}, this)">
                            <input type="checkbox" {{ $service->is_active ? 'checked' : '' }}
                                   id="tog-{{ $service->id }}">
                            <span class="toggle-track"></span>
                            <span class="toggle-thumb"></span>
                        </label>
                        <a href="{{ route('admin.cms.services.edit', $service) }}" class="btn-edit">
                            <i class="fas fa-pen"></i> EDIT
                        </a>
                        <button type="button" class="btn-del"
                                onclick="confirmDelete({{ $service->id }}, '{{ addslashes($service->title) }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                {{-- Card Body --}}
                <div class="card-body-inner">
                    <div class="field-row">
                        <span class="f-label">TAB LABEL</span>
                        <span class="f-val {{ !$service->tab_label ? 'empty' : '' }}">{{ $service->tab_label ?: '—' }}</span>
                    </div>
                    <div class="field-row">
                        <span class="f-label">DESKRIPSI</span>
                        <span class="f-val {{ !$service->description ? 'empty' : '' }}">{{ $service->description ? Str::limit(strip_tags($service->description), 55) : '—' }}</span>
                    </div>
                    <div class="field-row">
                        <span class="f-label">ROUTE</span>
                        @if($service->route_name)
                            <span class="route-chip">{{ $service->route_name }}</span>
                        @else
                            <span class="f-val empty">— belum diset</span>
                        @endif
                    </div>
                    <div class="field-row">
                        <span class="f-label">GAMBAR</span>
                        @if($service->image)
                            <img src="{{ Storage::url($service->image) }}" alt="" class="f-img">
                        @else
                            <span class="f-val empty">— no image</span>
                        @endif
                    </div>
                    @if($service->whatsapp_number)
                    <div class="field-row">
                        <span class="f-label">WHATSAPP</span>
                        <span class="f-val">{{ $service->whatsapp_number }}</span>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Reorder Bar --}}
    <div class="reorder-bar" id="reorder-bar">
        <div class="blink-dot"></div>
        <span>URUTAN BERUBAH</span>
        <button class="btn-save-order" id="btn-save-order">SIMPAN URUTAN</button>
        <span id="reorder-status"></span>
    </div>

    {{-- Toast --}}
    <div class="svc-toast" id="svc-toast"></div>

    {{-- Delete Modal --}}
    <div class="modal-overlay" id="delete-modal">
        <div class="modal-box">
            <div class="modal-icon"><i class="fas fa-trash"></i></div>
            <div class="modal-title">HAPUS SERVICE?</div>
            <div class="modal-desc">Tindakan ini tidak bisa dibatalkan. Gambar terkait juga akan ikut terhapus.</div>
            <div class="modal-name" id="modal-service-name">—</div>
            <div class="modal-actions">
                <button type="button" class="btn-modal-cancel" onclick="closeDeleteModal()">BATAL</button>
                <button type="button" class="btn-modal-del" id="btn-confirm-delete">
                    <i class="fas fa-trash"></i> HAPUS
                </button>
            </div>
        </div>
    </div>

    {{-- Hidden delete forms --}}
    @foreach($services as $service)
    <form method="POST"
          action="{{ route('admin.cms.services.destroy', $service) }}"
          id="delete-form-{{ $service->id }}"
          style="display:none">
        @csrf @method('DELETE')
    </form>
    @endforeach

</div>
@endsection

@push('scripts')
<script>
const CSRF            = '{{ csrf_token() }}';
const TOGGLE_SVC_URL  = '{{ url('admin/cms/services') }}';
const REORDER_URL     = '{{ route('admin.cms.services.reorder') }}';

/* ════════════════════════════════
   AJAX TOGGLE AKTIF/NONAKTIF
   ════════════════════════════════ */
async function toggleService(id, labelEl) {
    const checkbox = document.getElementById(`tog-${id}`);
    const card     = labelEl.closest('.service-card');
    const pip      = document.getElementById(`pip-${id}`);

    try {
        const res = await fetch(`${TOGGLE_SVC_URL}/${id}/toggle`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF,
                'Accept': 'application/json',
            },
        });

        const data = await res.json();
        if (!data.success) throw new Error();

        const isActive = data.is_active;

        // Update checkbox
        checkbox.checked = isActive;

        // Update card style
        card.classList.toggle('inactive', !isActive);

        // Update pip
        pip.classList.toggle('off', !isActive);

        // Update / remove banner
        let banner = card.querySelector('.inactive-banner');
        if (!isActive) {
            if (!banner) {
                banner = document.createElement('div');
                banner.className = 'inactive-banner';
                banner.innerHTML = '<i class="fas fa-eye-slash"></i> DISEMBUNYIKAN DARI NAVBAR & FRONTEND';
                card.querySelector('.card-accent').after(banner);
            }
        } else {
            banner?.remove();
        }

        showToast(isActive ? `"${data.id ? id : id}" diaktifkan — muncul di navbar` : `Service dinonaktifkan — hilang dari navbar`);
    } catch (e) {
        // Revert checkbox jika gagal
        checkbox.checked = !checkbox.checked;
        showToast('Gagal mengubah status service', true);
    }
}

/* ════════════════════════════
   DELETE MODAL
   ════════════════════════════ */
let pendingDeleteId = null;
function confirmDelete(id, name) {
    pendingDeleteId = id;
    document.getElementById('modal-service-name').textContent = name;
    document.getElementById('delete-modal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeDeleteModal() {
    document.getElementById('delete-modal').classList.remove('open');
    document.body.style.overflow = '';
    pendingDeleteId = null;
}
document.getElementById('btn-confirm-delete').addEventListener('click', () => {
    if (!pendingDeleteId) return;
    document.getElementById(`delete-form-${pendingDeleteId}`)?.submit();
});
document.getElementById('delete-modal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeDeleteModal(); });

/* ════════════════════════
   TOAST
   ════════════════════════ */
let _toastTimer;
function showToast(msg, isError = false) {
    const t = document.getElementById('svc-toast');
    t.textContent = msg;
    t.style.background  = isError ? '#FF5A36' : '#0D0D0D';
    t.style.color       = isError ? '#fff'    : '#F5C800';
    t.style.borderColor = isError ? '#FF5A36' : '#F5C800';
    t.classList.add('show');
    clearTimeout(_toastTimer);
    _toastTimer = setTimeout(() => t.classList.remove('show'), 2800);
}

/* ════════════════════════════════
   DRAG & DROP REORDER
   ════════════════════════════════ */
document.addEventListener('DOMContentLoaded', () => {
    const grid     = document.getElementById('sortable-grid');
    const bar      = document.getElementById('reorder-bar');
    const btnSave  = document.getElementById('btn-save-order');
    const statusEl = document.getElementById('reorder-status');
    if (!grid) return;

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
            grid.querySelectorAll('.service-card').forEach(c => c.classList.remove('drag-over'));
            dragged = null;
        });
        card.addEventListener('dragover', e => {
            e.preventDefault();
            if (card !== dragged) {
                grid.querySelectorAll('.service-card').forEach(c => c.classList.remove('drag-over'));
                card.classList.add('drag-over');
            }
        });
        card.addEventListener('drop', e => {
            e.preventDefault();
            if (!dragged || dragged === card) return;
            const cards = [...grid.querySelectorAll('.service-card')];
            grid.insertBefore(dragged, cards.indexOf(dragged) < cards.indexOf(card) ? card.nextSibling : card);
            updateOrderBadges();
            bar.classList.add('visible');
        });

        // Touch support
        card.addEventListener('touchstart', e => {
            touchDragged = card;
            const t = e.touches[0];
            touchStartX = t.clientX; touchStartY = t.clientY;
            touchCardRect = card.getBoundingClientRect();
            touchClone = card.cloneNode(true);
            Object.assign(touchClone.style, {
                position:'fixed', zIndex:'9999', opacity:'.72', pointerEvents:'none',
                width: touchCardRect.width + 'px', transform: 'rotate(-1deg) scale(.97)',
                boxShadow: '6px 6px 0 #0D0D0D', left: touchCardRect.left + 'px', top: touchCardRect.top + 'px', transition:'none',
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
            const tgt = el?.closest('.service-card');
            grid.querySelectorAll('.service-card').forEach(c => c.classList.remove('drag-over'));
            if (tgt && tgt !== touchDragged) tgt.classList.add('drag-over');
        }, { passive: false });

        card.addEventListener('touchend', e => {
            if (!touchDragged) return;
            const t   = e.changedTouches[0];
            const el  = document.elementFromPoint(t.clientX, t.clientY);
            const tgt = el?.closest('.service-card');
            if (tgt && tgt !== touchDragged) {
                const cards = [...grid.querySelectorAll('.service-card')];
                grid.insertBefore(touchDragged, cards.indexOf(touchDragged) < cards.indexOf(tgt) ? tgt.nextSibling : tgt);
                updateOrderBadges();
                bar.classList.add('visible');
            }
            touchDragged.classList.remove('dragging');
            grid.querySelectorAll('.service-card').forEach(c => c.classList.remove('drag-over'));
            if (touchClone) { document.body.removeChild(touchClone); touchClone = null; }
            touchDragged = null;
        }, { passive: true });
    }

    grid.querySelectorAll('.service-card').forEach(initCard);

    function updateOrderBadges() {
        grid.querySelectorAll('.service-card').forEach((c, i) => {
            const b = c.querySelector('.order-badge');
            if (b) b.textContent = String(i + 1).padStart(2, '0');
        });
    }

    btnSave?.addEventListener('click', () => {
        const ids = [...grid.querySelectorAll('.service-card')].map(c => c.dataset.id);
        statusEl.textContent = 'SAVING...';
        btnSave.disabled = true;

        fetch(REORDER_URL, {
            method: 'POST',
            headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            body: JSON.stringify({ order: ids }),
        }).then(r => r.json()).then(data => {
            if (data.success) {
                statusEl.textContent = '✓ TERSIMPAN';
                showToast('Urutan layanan berhasil disimpan!');
                setTimeout(() => {
                    bar.classList.remove('visible');
                    statusEl.textContent = '';
                    btnSave.disabled = false;
                }, 2200);
            } else throw new Error();
        }).catch(() => {
            statusEl.textContent = '✗ ERROR';
            btnSave.disabled = false;
            showToast('Gagal menyimpan urutan', true);
        });
    });
});
</script>
@endpush