@extends('layouts.admin')

@section('title', 'CMS — ' . strtoupper($page))

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Syne:wght@700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
<style>
/* ══════════════════════════════════════════════════════
   NEOBRUTALISM CMS — HNP COMMUNICATIONS
   Palette: Off-white #F5F0E8 · Black #0D0D0D · Yellow #F5C800
            Coral #FF5A36 · Mint #00C48C · Blue #1A56FF
   Font: Syne (headers) · Space Grotesk (ui) · JetBrains Mono (code)
   ═════════════════════════════════════════════════════ */
:root {
    --white:     #F5F0E8;
    --black:     #0D0D0D;
    --yellow:    #F5C800;
    --coral:     #FF5A36;
    --mint:      #00C48C;
    --blue:      #1A56FF;
    --purple:    #7B2FFF;
    --text:      #0D0D0D;
    --text2:     #3D3D3D;
    --muted:     #7A7A7A;
    --border:    3px solid #0D0D0D;
    --shadow:    4px 4px 0px #0D0D0D;
    --shadow-lg: 6px 6px 0px #0D0D0D;
    --r:         4px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    background: var(--white);
    color: var(--text);
    font-family: 'Space Grotesk', sans-serif;
    font-size: 13px;
    line-height: 1.5;
    -webkit-font-smoothing: antialiased;
    overflow-x: hidden;
    min-height: 100vh;
}

/* ── Ticker Bar ─────────────────────────────────────── */
.ticker-bar {
    background: var(--black);
    padding: 6px 0;
    overflow: hidden;
    white-space: nowrap;
    border-bottom: var(--border);
}
.ticker-inner {
    display: inline-block;
    animation: ticker 20s linear infinite;
    font-family: 'JetBrains Mono', monospace;
    font-size: .62rem;
    font-weight: 700;
    color: var(--yellow);
    letter-spacing: .14em;
    text-transform: uppercase;
}
@keyframes ticker { from { transform: translateX(0); } to { transform: translateX(-50%); } }

/* ── Masthead ──────────────────────────────────────── */
.masthead {
    background: var(--yellow);
    border-bottom: var(--border);
    padding: 1.1rem 1.5rem;
}
.masthead-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
}
.cms-title {
    display: flex;
    align-items: center;
    gap: 1rem;
}
.title-icon-box {
    width: 52px; height: 52px;
    background: var(--black);
    border: var(--border);
    box-shadow: var(--shadow);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    color: var(--yellow);
    flex-shrink: 0;
}
.title-main {
    font-family: 'Syne', sans-serif;
    font-size: 2rem;
    font-weight: 800;
    color: var(--black);
    line-height: 1;
    letter-spacing: -.02em;
}
.title-page-tag {
    display: inline-block;
    background: var(--black);
    color: var(--yellow);
    font-family: 'JetBrains Mono', monospace;
    font-size: .6rem;
    font-weight: 700;
    padding: 2px 8px;
    letter-spacing: .12em;
    text-transform: uppercase;
    margin-top: 4px;
    border: 2px solid var(--black);
}
.title-sub {
    font-family: 'JetBrains Mono', monospace;
    font-size: .6rem;
    color: var(--text2);
    margin-top: 2px;
    letter-spacing: .04em;
}
.masthead-right { display: flex; align-items: center; gap: .75rem; }
.hint-chip {
    font-family: 'JetBrains Mono', monospace;
    font-size: .65rem;
    font-weight: 600;
    color: var(--black);
    display: flex;
    align-items: center;
    gap: .4rem;
    background: var(--white);
    border: var(--border);
    box-shadow: var(--shadow);
    padding: .4rem .85rem;
}

/* ── Alerts ────────────────────────────────────────── */
.alerts-outer { padding: .75rem 1.5rem 0; }
.alert {
    display: flex;
    align-items: center;
    gap: .6rem;
    padding: .7rem 1rem;
    border: var(--border);
    margin-bottom: .6rem;
    font-family: 'JetBrains Mono', monospace;
    font-size: .72rem;
    font-weight: 600;
    box-shadow: var(--shadow);
}
.alert-success { background: #D4F5E4; color: #005C33; }
.alert-error   { background: #FFE0D9; color: #8B1A00; }

/* ── Page Tabs ─────────────────────────────────────── */
.tabs-wrap {
    background: var(--white);
    border-bottom: var(--border);
    padding: .85rem 1.5rem;
    display: flex;
    flex-wrap: wrap;
    gap: .5rem;
    align-items: center;
}
.tabs-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: .6rem;
    font-weight: 700;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .1em;
    margin-right: .35rem;
}
.page-tab {
    font-family: 'JetBrains Mono', monospace;
    font-size: .62rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    padding: .38rem .85rem;
    border: 2px solid var(--black);
    background: var(--white);
    color: var(--black);
    text-decoration: none;
    transition: all .12s;
    position: relative;
    top: 0;
    box-shadow: 2px 2px 0 var(--black);
}
.page-tab:hover {
    background: var(--black);
    color: var(--white);
    top: -1px;
    box-shadow: 3px 3px 0 #7A7A7A;
}
.page-tab.active {
    background: var(--black);
    color: var(--yellow);
    box-shadow: 3px 3px 0 #7A7A7A;
}

/* ── Grid Area ─────────────────────────────────────── */
.grid-area { padding: 1.35rem 1.5rem 5rem; }

.row-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: .6rem;
    font-weight: 700;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .12em;
    margin-bottom: .75rem;
    display: flex;
    align-items: center;
    gap: .5rem;
}
.row-label::after { content: ''; flex: 1; height: 2px; background: var(--black); }

.sections-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(285px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

/* ── Section Card ──────────────────────────────────── */
.section-card {
    background: var(--white);
    border: var(--border);
    box-shadow: var(--shadow);
    cursor: grab;
    position: relative;
    transition: transform .1s, box-shadow .1s;
    animation: cardReveal .35s ease both;
}
.section-card:hover {
    transform: translate(-2px, -2px);
    box-shadow: var(--shadow-lg);
}
.section-card:active { cursor: grabbing; }
.section-card.dragging { opacity: .35; transform: rotate(-1deg) scale(.97); box-shadow: 2px 2px 0 var(--black); }
.section-card.drag-over { outline: 3px dashed var(--coral); outline-offset: -3px; }
.section-card.inactive { opacity: .5; }

/* Color accent strip per card — cycles through palette */
.section-card:nth-child(4n+1) .card-accent { background: var(--yellow); }
.section-card:nth-child(4n+2) .card-accent { background: var(--coral); }
.section-card:nth-child(4n+3) .card-accent { background: var(--mint); }
.section-card:nth-child(4n+4) .card-accent { background: var(--blue); }

.card-accent { height: 5px; border-bottom: 2px solid var(--black); }

@keyframes cardReveal {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}
.section-card:nth-child(1) { animation-delay: .03s; }
.section-card:nth-child(2) { animation-delay: .06s; }
.section-card:nth-child(3) { animation-delay: .09s; }
.section-card:nth-child(4) { animation-delay: .12s; }
.section-card:nth-child(5) { animation-delay: .15s; }
.section-card:nth-child(6) { animation-delay: .18s; }

/* Card Header */
.card-hd {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: .65rem .85rem;
    background: var(--black);
    gap: .6rem;
    border-bottom: var(--border);
}
.card-hd-left {
    display: flex;
    align-items: center;
    gap: .5rem;
    min-width: 0;
    flex: 1;
}
.drag-handle {
    color: var(--muted);
    font-size: .7rem;
    cursor: grab;
    flex-shrink: 0;
    transition: color .12s;
    color: #999;
}
.drag-handle:hover { color: var(--yellow); }
.order-num {
    font-family: 'Syne', sans-serif;
    font-size: 1.15rem;
    font-weight: 800;
    color: var(--yellow);
    line-height: 1;
    flex-shrink: 0;
    min-width: 24px;
}
.card-meta { min-width: 0; }
.card-label {
    font-family: 'Syne', sans-serif;
    font-size: .88rem;
    font-weight: 700;
    color: var(--white);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.1;
    letter-spacing: -.01em;
}
.card-key {
    font-family: 'JetBrains Mono', monospace;
    font-size: .56rem;
    color: #888;
    margin-top: 1px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.card-actions { display: flex; align-items: center; gap: .45rem; flex-shrink: 0; }

/* Status pip */
.status-pip {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: var(--mint);
    border: 1.5px solid #fff;
    flex-shrink: 0;
    margin-left: auto;
}
.status-pip.off { background: #555; border-color: #888; }

/* Toggle */
.toggle-form { display: inline-flex; }
.toggle { position: relative; width: 34px; height: 18px; cursor: pointer; display: block; }
.toggle input { opacity: 0; width: 0; height: 0; position: absolute; }
.toggle-track {
    position: absolute; inset: 0;
    background: #444;
    border-radius: 999px;
    border: 2px solid #888;
    transition: all .18s;
}
.toggle input:checked ~ .toggle-track { background: var(--mint); border-color: #00a078; }
.toggle-thumb {
    position: absolute;
    top: 3px; left: 3px;
    width: 12px; height: 12px;
    background: #888;
    border-radius: 50%;
    transition: transform .18s, background .18s;
    pointer-events: none;
}
.toggle input:checked ~ .toggle-thumb { transform: translateX(16px); background: var(--white); }

/* Edit Btn */
.btn-edit {
    font-family: 'JetBrains Mono', monospace;
    font-size: .6rem;
    font-weight: 700;
    letter-spacing: .05em;
    padding: .32rem .75rem;
    background: var(--yellow);
    border: 2px solid var(--yellow);
    color: var(--black);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: .3rem;
    transition: all .12s;
    white-space: nowrap;
    text-transform: uppercase;
    box-shadow: 2px 2px 0 rgba(255,255,255,.3);
}
.btn-edit:hover {
    background: var(--white);
    border-color: var(--white);
    color: var(--black);
    box-shadow: none;
}

/* Card Body */
.card-body { padding: .75rem .85rem; }
.field-rows { display: flex; flex-direction: column; }
.field-row {
    display: flex;
    align-items: flex-start;
    gap: .5rem;
    font-size: .72rem;
    padding: .28rem 0;
    border-bottom: 1px solid rgba(0,0,0,.06);
    transition: background .1s;
}
.field-row:last-child { border-bottom: none; }
.f-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: .58rem;
    font-weight: 600;
    color: var(--muted);
    min-width: 90px;
    flex-shrink: 0;
    padding-top: 1px;
    text-transform: uppercase;
    letter-spacing: .04em;
}
.f-val { color: var(--text2); word-break: break-word; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; font-weight: 500; }
.f-val.empty { color: #bbb; font-style: italic; }
.f-img {
    width: 38px; height: 28px;
    object-fit: cover;
    border: 2px solid var(--black);
}
.f-color-dot {
    width: 14px; height: 14px;
    border: 2px solid var(--black);
    flex-shrink: 0;
    margin-top: 1px;
}
.more-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: .58rem;
    font-weight: 700;
    color: var(--muted);
    padding: .35rem 0 0;
    border-top: 2px dashed rgba(0,0,0,.12);
    margin-top: .3rem;
    text-transform: uppercase;
    letter-spacing: .06em;
}

/* ── Empty State ───────────────────────────────────── */
.empty-state {
    text-align: center;
    padding: 5rem 2rem;
    color: var(--muted);
    font-family: 'JetBrains Mono', monospace;
}
.empty-icon { font-size: 2.5rem; margin-bottom: 1rem; display: block; opacity: .25; }
.empty-state p { font-size: .78rem; }

/* ── Reorder Float Bar ─────────────────────────────── */
.reorder-bar {
    position: fixed;
    bottom: 1.5rem;
    left: 50%;
    transform: translateX(-50%) translateY(80px);
    background: var(--black);
    border: var(--border);
    box-shadow: var(--shadow-lg);
    padding: .7rem .7rem .7rem 1.2rem;
    display: flex;
    align-items: center;
    gap: .85rem;
    z-index: 999;
    font-family: 'JetBrains Mono', monospace;
    font-size: .72rem;
    color: var(--yellow);
    transition: transform .35s cubic-bezier(.34,1.56,.64,1), opacity .3s;
    opacity: 0;
    pointer-events: none;
}
.reorder-bar.visible { transform: translateX(-50%) translateY(0); opacity: 1; pointer-events: auto; }
.blink-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--coral); animation: blink .8s step-end infinite; flex-shrink: 0; }
@keyframes blink { 0%,100% { opacity:1; } 50% { opacity:0; } }
.btn-save-order {
    background: var(--yellow);
    color: var(--black);
    border: 2px solid var(--yellow);
    padding: .4rem 1.1rem;
    font-family: 'JetBrains Mono', monospace;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    cursor: pointer;
    transition: all .12s;
}
.btn-save-order:hover { background: var(--white); border-color: var(--white); }
.btn-save-order:disabled { opacity: .4; cursor: not-allowed; }
#reorder-status { font-size: .65rem; min-width: 65px; }

/* ── Responsive ────────────────────────────────────── */
@media (max-width: 640px) {
    .sections-grid { grid-template-columns: 1fr; }
    .masthead-inner { flex-direction: column; align-items: flex-start; }
    .grid-area, .tabs-wrap, .masthead, .alerts-outer { padding-left: 1rem; padding-right: 1rem; }
}
</style>
@endpush

@section('content')
<div class="cms-wrap">

    {{-- Ticker --}}
    <div class="ticker-bar">
        <div class="ticker-inner">
            ◆ HNP COMMUNICATIONS ADMIN PANEL &nbsp;&nbsp;&nbsp; ◆ CMS PAGE SECTIONS &nbsp;&nbsp;&nbsp; ◆ DRAG TO REORDER &nbsp;&nbsp;&nbsp; ◆ CLICK EDIT TO MODIFY &nbsp;&nbsp;&nbsp; ◆ HNP COMMUNICATIONS ADMIN PANEL &nbsp;&nbsp;&nbsp; ◆ CMS PAGE SECTIONS &nbsp;&nbsp;&nbsp; ◆ DRAG TO REORDER &nbsp;&nbsp;&nbsp; ◆ CLICK EDIT TO MODIFY &nbsp;&nbsp;&nbsp;
        </div>
    </div>

    {{-- Masthead --}}
    <div class="masthead">
        <div class="masthead-inner">
            <div class="cms-title">
                <div class="title-icon-box">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div>
                    <div class="title-main">CMS SECTIONS</div>
                    <div class="title-page-tag">{{ $page }}</div>
                    <div class="title-sub">KELOLA KONTEN HALAMAN · {{ $sections->count() ?? 0 }} SECTION DITEMUKAN</div>
                </div>
            </div>
            <div class="masthead-right">
                <div class="hint-chip">
                    <i class="fas fa-grip-vertical"></i>
                    DRAG UNTUK REORDER
                </div>
            </div>
        </div>
    </div>

    {{-- Alerts --}}
    <div class="alerts-outer" style="margin-top:.75rem">
        @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif
    </div>

    {{-- Tabs --}}
    <div class="tabs-wrap">
        <span class="tabs-label">PAGE /</span>
        @foreach($availablePages as $p)
        <a href="{{ route('admin.cms.page-sections.index', ['page' => $p]) }}"
           class="page-tab {{ $p === $page ? 'active' : '' }}">
            {{ $p }}
        </a>
        @endforeach
    </div>

    {{-- Grid --}}
    <div class="grid-area">
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
                $fields  = $section->getFields();
                $content = $section->content ?? [];
                $preview = array_slice($fields, 0, 5);
                $more    = count($fields) - count($preview);
            @endphp
            <div class="section-card {{ !$section->is_active ? 'inactive' : '' }}" data-id="{{ $section->id }}">
                <div class="card-accent"></div>
                <div class="card-hd">
                    <div class="card-hd-left">
                        <span class="drag-handle"><i class="fas fa-grip-vertical"></i></span>
                        <span class="order-num">{{ str_pad($section->order, 2, '0', STR_PAD_LEFT) }}</span>
                        <div class="card-meta">
                            <div class="card-label">{{ $section->label }}</div>
                            <div class="card-key">{{ $section->section_key }}</div>
                        </div>
                        <div class="status-pip {{ !$section->is_active ? 'off' : '' }}"></div>
                    </div>
                    <div class="card-actions">
                        <form method="POST" action="{{ route('admin.cms.page-sections.toggle', $section) }}" class="toggle-form">
                            @csrf @method('PATCH')
                            <label class="toggle" title="{{ $section->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                <input type="checkbox" {{ $section->is_active ? 'checked' : '' }} onchange="this.closest('form').submit()">
                                <span class="toggle-track"></span>
                                <span class="toggle-thumb"></span>
                            </label>
                        </form>
                        <a href="{{ route('admin.cms.page-sections.edit', $section) }}" class="btn-edit">
                            <i class="fas fa-pen"></i> EDIT
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="field-rows">
                        @foreach($preview as $field)
                        @php $key = $field['key']; $val = $content[$key] ?? null; $type = $field['type']; @endphp
                        <div class="field-row">
                            <span class="f-label">{{ Str::limit($field['label'], 16) }}</span>
                            @if($type === 'image')
                                @if($val) <img src="{{ Storage::url($val) }}" alt="" class="f-img">
                                @else <span class="f-val empty">— no image</span> @endif
                            @elseif($type === 'color')
                                @if($val)
                                    <span class="f-color-dot" style="background:{{ $val }}"></span>
                                    <span class="f-val" style="font-family:'JetBrains Mono',monospace;font-size:.58rem">{{ $val }}</span>
                                @else <span class="f-val empty">—</span> @endif
                            @else
                                <span class="f-val {{ !$val ? 'empty' : '' }}">{{ $val ? Str::limit(strip_tags($val), 48) : '—' }}</span>
                            @endif
                        </div>
                        @endforeach
                        @if($more > 0)
                        <div class="more-label">+{{ $more }} more fields</div>
                        @endif
                    </div>
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
        <button class="btn-save-order" id="btn-save-order">SIMPAN</button>
        <span id="reorder-status"></span>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const grid = document.getElementById('sortable-grid');
    const bar = document.getElementById('reorder-bar');
    const btnSave = document.getElementById('btn-save-order');
    const statusEl = document.getElementById('reorder-status');
    if (!grid) return;
    let dragged = null;
    grid.querySelectorAll('.section-card').forEach(card => {
        card.setAttribute('draggable', 'true');
        card.addEventListener('dragstart', e => { dragged = card; setTimeout(() => card.classList.add('dragging'), 0); e.dataTransfer.effectAllowed = 'move'; });
        card.addEventListener('dragend', () => { card.classList.remove('dragging'); grid.querySelectorAll('.section-card').forEach(c => c.classList.remove('drag-over')); dragged = null; });
        card.addEventListener('dragover', e => { e.preventDefault(); if (card !== dragged) { grid.querySelectorAll('.section-card').forEach(c => c.classList.remove('drag-over')); card.classList.add('drag-over'); } });
        card.addEventListener('drop', e => { e.preventDefault(); if (!dragged || dragged === card) return; const cards = [...grid.querySelectorAll('.section-card')]; const fromIdx = cards.indexOf(dragged); const toIdx = cards.indexOf(card); grid.insertBefore(dragged, fromIdx < toIdx ? card.nextSibling : card); updateBadges(); bar.classList.add('visible'); });
    });
    function updateBadges() { grid.querySelectorAll('.section-card').forEach((c, i) => { const b = c.querySelector('.order-num'); if (b) b.textContent = String(i + 1).padStart(2, '0'); }); }
    btnSave.addEventListener('click', () => {
        const ids = [...grid.querySelectorAll('.section-card')].map(c => c.dataset.id);
        statusEl.textContent = 'SAVING...'; btnSave.disabled = true;
        fetch('{{ route('admin.cms.page-sections.reorder') }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
            body: JSON.stringify({ order: ids }),
        }).then(r => r.json()).then(data => {
            if (data.success) {
                statusEl.textContent = '✓ TERSIMPAN';
                setTimeout(() => { bar.classList.remove('visible'); statusEl.textContent = ''; btnSave.disabled = false; }, 2000);
            } else { throw new Error(); }
        }).catch(() => { statusEl.textContent = '✗ ERROR'; btnSave.disabled = false; });
    });
});
</script>
@endpush