@extends('layouts.admin')

@section('title', 'CMS — ' . strtoupper($page))

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@400;600;700&family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    /* ── Variables ────────────────────────────────── */
    :root {
        --bg:        #090910;
        --surface:   #111118;
        --surface2:  #1a1a24;
        --surface3:  #20202c;
        --border:    #252532;
        --border2:   #2e2e40;
        --accent:    #6366f1;
        --accent-soft: rgba(99,102,241,.12);
        --accent-glow: rgba(99,102,241,.25);
        --amber:     #f59e0b;
        --amber-soft: rgba(245,158,11,.12);
        --danger:    #ef4444;
        --danger-soft: rgba(239,68,68,.08);
        --success:   #22c55e;
        --success-soft: rgba(34,197,94,.08);
        --text:      #e2e2ee;
        --text2:     #a0a0b8;
        --muted:     #5c5c78;
        --radius-sm: 6px;
        --radius:    10px;
        --radius-lg: 14px;
    }

    *, *::before, *::after { box-sizing: border-box; }

    body {
        background: var(--bg);
        color: var(--text);
        font-family: 'Geist', sans-serif;
        font-size: 14px;
        line-height: 1.5;
        -webkit-font-smoothing: antialiased;
    }

    /* ── Subtle Grid Background ───────────────────── */
    body::before {
        content: '';
        position: fixed;
        inset: 0;
        background-image:
            linear-gradient(var(--border) 1px, transparent 1px),
            linear-gradient(90deg, var(--border) 1px, transparent 1px);
        background-size: 48px 48px;
        opacity: .3;
        pointer-events: none;
        z-index: 0;
    }

    .cms-wrap {
        position: relative;
        z-index: 1;
    }

    /* ── Alerts ───────────────────────────────────── */
    .alert {
        display: flex;
        align-items: center;
        gap: .6rem;
        padding: .75rem 1rem;
        border-radius: var(--radius);
        border: 1px solid;
        margin-bottom: 1.5rem;
        font-size: .82rem;
        font-weight: 500;
        animation: slideDown .25s ease;
    }
    .alert-success {
        background: var(--success-soft);
        border-color: rgba(34,197,94,.25);
        color: var(--success);
    }
    .alert-error {
        background: var(--danger-soft);
        border-color: rgba(239,68,68,.2);
        color: var(--danger);
    }
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-6px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Page Header ──────────────────────────────── */
    .cms-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.75rem;
    }
    .cms-title {
        font-family: 'Geist Mono', monospace;
        font-size: 1.15rem;
        font-weight: 700;
        letter-spacing: -.01em;
        color: var(--text);
        display: flex;
        align-items: center;
        gap: .6rem;
    }
    .cms-title-icon {
        width: 32px;
        height: 32px;
        border-radius: var(--radius-sm);
        background: var(--accent-soft);
        border: 1px solid var(--accent-glow);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        font-size: .85rem;
        flex-shrink: 0;
    }
    .cms-title-tag {
        font-size: .65rem;
        background: var(--accent-soft);
        border: 1px solid var(--accent-glow);
        color: var(--accent);
        border-radius: var(--radius-sm);
        padding: 2px 8px;
        letter-spacing: .08em;
        text-transform: uppercase;
    }
    .cms-hint {
        font-size: .75rem;
        color: var(--muted);
        display: flex;
        align-items: center;
        gap: .4rem;
    }

    /* ── Page Tabs ────────────────────────────────── */
    .page-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: .35rem;
        margin-bottom: 1.75rem;
        padding-bottom: 1.75rem;
        border-bottom: 1px solid var(--border);
    }
    .page-tab {
        font-family: 'Geist Mono', monospace;
        font-size: .68rem;
        font-weight: 600;
        letter-spacing: .06em;
        text-transform: uppercase;
        padding: .38rem .9rem;
        border-radius: var(--radius-sm);
        border: 1px solid var(--border2);
        background: var(--surface);
        color: var(--muted);
        text-decoration: none;
        transition: all .18s ease;
    }
    .page-tab:hover {
        border-color: var(--accent);
        color: var(--accent);
        background: var(--accent-soft);
    }
    .page-tab.active {
        background: var(--accent);
        border-color: var(--accent);
        color: #fff;
        box-shadow: 0 0 16px var(--accent-glow);
    }

    /* ── Sections Grid ────────────────────────────── */
    .sections-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1rem;
    }

    /* ── Section Card ─────────────────────────────── */
    .section-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: border-color .2s, box-shadow .2s, transform .15s, opacity .2s;
        cursor: grab;
        position: relative;
    }
    .section-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent-glow), transparent);
        opacity: 0;
        transition: opacity .2s;
    }
    .section-card:hover { border-color: var(--border2); box-shadow: 0 8px 32px rgba(0,0,0,.4); transform: translateY(-1px); }
    .section-card:hover::before { opacity: 1; }
    .section-card:active { cursor: grabbing; }
    .section-card.dragging { opacity: .4; transform: scale(.97); border-color: var(--accent); box-shadow: 0 0 0 2px var(--accent-glow); }
    .section-card.drag-over { border-color: var(--amber); box-shadow: 0 0 0 2px var(--amber-soft); }
    .section-card.inactive { opacity: .5; }

    /* Card Header */
    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: .75rem 1rem;
        background: var(--surface2);
        border-bottom: 1px solid var(--border);
        gap: .75rem;
    }
    .card-header-left {
        display: flex;
        align-items: center;
        gap: .55rem;
        min-width: 0;
        flex: 1;
    }
    .drag-handle {
        color: var(--muted);
        font-size: .75rem;
        cursor: grab;
        flex-shrink: 0;
        width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        transition: color .18s, background .18s;
    }
    .drag-handle:hover { color: var(--text2); background: var(--surface3); }
    .order-badge {
        font-family: 'Geist Mono', monospace;
        font-size: .6rem;
        font-weight: 700;
        background: var(--surface3);
        border: 1px solid var(--border2);
        color: var(--muted);
        padding: 2px 6px;
        border-radius: 4px;
        flex-shrink: 0;
    }
    .section-info { min-width: 0; }
    .section-label {
        font-weight: 600;
        font-size: .82rem;
        color: var(--text);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.3;
    }
    .section-key-badge {
        font-family: 'Geist Mono', monospace;
        font-size: .62rem;
        color: var(--muted);
        margin-top: 1px;
    }
    .card-actions {
        display: flex;
        align-items: center;
        gap: .5rem;
        flex-shrink: 0;
    }

    /* Toggle */
    .toggle-form { display: inline-flex; align-items: center; }
    .toggle {
        position: relative;
        width: 36px;
        height: 19px;
        cursor: pointer;
        display: block;
    }
    .toggle input { opacity: 0; width: 0; height: 0; position: absolute; }
    .toggle-track {
        position: absolute;
        inset: 0;
        background: var(--surface3);
        border: 1px solid var(--border2);
        border-radius: 999px;
        transition: all .2s;
    }
    .toggle input:checked ~ .toggle-track {
        background: var(--success);
        border-color: var(--success);
        box-shadow: 0 0 10px rgba(34,197,94,.3);
    }
    .toggle-thumb {
        position: absolute;
        top: 3px;
        left: 3px;
        width: 13px;
        height: 13px;
        background: var(--muted);
        border-radius: 50%;
        transition: transform .2s, background .2s;
        pointer-events: none;
    }
    .toggle input:checked ~ .toggle-thumb {
        transform: translateX(17px);
        background: #fff;
    }

    /* Edit Button */
    .btn-edit {
        font-size: .72rem;
        font-weight: 600;
        padding: .32rem .75rem;
        border-radius: var(--radius-sm);
        background: var(--surface3);
        border: 1px solid var(--border2);
        color: var(--text2);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: .3rem;
        transition: all .18s;
        white-space: nowrap;
    }
    .btn-edit:hover {
        background: var(--accent);
        border-color: var(--accent);
        color: #fff;
        box-shadow: 0 0 12px var(--accent-glow);
    }

    /* Card Body */
    .card-body { padding: .85rem 1rem; }
    .field-previews { display: flex; flex-direction: column; gap: .4rem; }
    .field-row {
        display: flex;
        align-items: flex-start;
        gap: .5rem;
        font-size: .76rem;
        line-height: 1.4;
    }
    .field-label {
        color: var(--muted);
        min-width: 100px;
        flex-shrink: 0;
        font-family: 'Geist Mono', monospace;
        font-size: .65rem;
        padding-top: 1px;
    }
    .field-value {
        color: var(--text2);
        word-break: break-word;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    .field-value.empty { color: var(--muted); font-style: italic; }
    .field-img-thumb {
        width: 44px;
        height: 32px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid var(--border2);
    }
    .field-color-dot {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 3px;
        border: 1px solid var(--border2);
        flex-shrink: 0;
        margin-top: 2px;
    }
    .more-fields {
        font-size: .65rem;
        color: var(--muted);
        font-family: 'Geist Mono', monospace;
        margin-top: .25rem;
        padding-top: .5rem;
        border-top: 1px dashed var(--border);
    }

    /* ── Empty State ──────────────────────────────── */
    .empty-state {
        text-align: center;
        padding: 5rem 2rem;
        color: var(--muted);
    }
    .empty-state-icon {
        width: 56px;
        height: 56px;
        border-radius: var(--radius);
        background: var(--surface2);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: var(--muted);
        margin: 0 auto 1.25rem;
        opacity: .6;
    }
    .empty-state p { font-size: .85rem; margin: 0; }
    .empty-state strong { color: var(--text2); font-weight: 600; }

    /* ── Reorder Bar ──────────────────────────────── */
    .reorder-bar {
        position: fixed;
        bottom: 1.75rem;
        left: 50%;
        transform: translateX(-50%) translateY(80px);
        background: var(--surface2);
        border: 1px solid var(--border2);
        border-radius: 999px;
        padding: .6rem .6rem .6rem 1.25rem;
        display: flex;
        align-items: center;
        gap: .85rem;
        box-shadow: 0 16px 48px rgba(0,0,0,.6), 0 0 0 1px var(--accent-glow);
        z-index: 999;
        font-size: .8rem;
        font-weight: 500;
        color: var(--text2);
        transition: transform .3s cubic-bezier(.34,1.56,.64,1), opacity .3s;
        opacity: 0;
        pointer-events: none;
    }
    .reorder-bar.visible {
        transform: translateX(-50%) translateY(0);
        opacity: 1;
        pointer-events: auto;
    }
    .reorder-bar-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: var(--accent);
        box-shadow: 0 0 8px var(--accent);
        flex-shrink: 0;
        animation: pulse 1.5s infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: .4; }
    }
    .btn-save-order {
        background: var(--accent);
        color: #fff;
        border: none;
        border-radius: 999px;
        padding: .42rem 1.1rem;
        font-size: .78rem;
        font-weight: 700;
        cursor: pointer;
        transition: opacity .18s, box-shadow .18s;
        font-family: 'Geist', sans-serif;
        letter-spacing: .01em;
    }
    .btn-save-order:hover { opacity: .88; box-shadow: 0 0 18px var(--accent-glow); }
    .btn-save-order:disabled { opacity: .5; cursor: not-allowed; }
    #reorder-status {
        font-size: .72rem;
        font-family: 'Geist Mono', monospace;
        min-width: 70px;
        color: var(--muted);
    }

    /* ── Responsive ───────────────────────────────── */
    @media (max-width: 640px) {
        .sections-grid { grid-template-columns: 1fr; }
        .cms-header { flex-direction: column; align-items: flex-start; }
    }
</style>
@endpush

@section('content')
<div class="cms-wrap">

    {{-- Alerts --}}
    @if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        {{ session('error') }}
    </div>
    @endif

    {{-- Header --}}
    <div class="cms-header">
        <div class="cms-title">
            <div class="cms-title-icon">
                <i class="fas fa-layer-group"></i>
            </div>
            CMS Page Sections
            <span class="cms-title-tag">{{ $page }}</span>
        </div>
        <div class="cms-hint">
            <i class="fas fa-grip-vertical"></i>
            Drag card untuk ubah urutan
        </div>
    </div>

    {{-- Page Tabs --}}
    <div class="page-tabs">
        @foreach($availablePages as $p)
        <a href="{{ route('admin.cms.page-sections.index', ['page' => $p]) }}"
           class="page-tab {{ $p === $page ? 'active' : '' }}">
            {{ $p }}
        </a>
        @endforeach
    </div>

    {{-- Sections Grid --}}
    @if($sections->isEmpty())
    <div class="empty-state">
        <div class="empty-state-icon">
            <i class="fas fa-inbox"></i>
        </div>
        <p>Belum ada section untuk halaman <strong>{{ $page }}</strong>.</p>
    </div>
    @else
    <div class="sections-grid" id="sortable-grid">
        @foreach($sections as $section)
        @php
            $fields  = $section->getFields();
            $content = $section->content ?? [];
            $preview = array_slice($fields, 0, 5);
            $more    = count($fields) - count($preview);
        @endphp

        <div class="section-card {{ !$section->is_active ? 'inactive' : '' }}"
             data-id="{{ $section->id }}">

            {{-- Header --}}
            <div class="card-header">
                <div class="card-header-left">
                    <span class="drag-handle" title="Drag untuk reorder">
                        <i class="fas fa-grip-vertical"></i>
                    </span>
                    <span class="order-badge">#{{ $section->order }}</span>
                    <div class="section-info">
                        <div class="section-label">{{ $section->label }}</div>
                        <div class="section-key-badge">{{ $section->section_key }}</div>
                    </div>
                </div>
                <div class="card-actions">
                    <form method="POST"
                          action="{{ route('admin.cms.page-sections.toggle', $section) }}"
                          class="toggle-form">
                        @csrf @method('PATCH')
                        <label class="toggle" title="{{ $section->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                            <input type="checkbox"
                                   {{ $section->is_active ? 'checked' : '' }}
                                   onchange="this.closest('form').submit()">
                            <span class="toggle-track"></span>
                            <span class="toggle-thumb"></span>
                        </label>
                    </form>
                    <a href="{{ route('admin.cms.page-sections.edit', $section) }}" class="btn-edit">
                        <i class="fas fa-pen"></i> Edit
                    </a>
                </div>
            </div>

            {{-- Body --}}
            <div class="card-body">
                <div class="field-previews">
                    @foreach($preview as $field)
                    @php
                        $key   = $field['key'];
                        $val   = $content[$key] ?? null;
                        $label = $field['label'];
                        $type  = $field['type'];
                    @endphp
                    <div class="field-row">
                        <span class="field-label">{{ Str::limit($label, 18) }}</span>

                        @if($type === 'image')
                            @if($val)
                                <img src="{{ Storage::url($val) }}" alt="" class="field-img-thumb">
                            @else
                                <span class="field-value empty">— belum ada gambar</span>
                            @endif

                        @elseif($type === 'color')
                            @if($val)
                                <span class="field-color-dot" style="background:{{ $val }}"></span>
                                <span class="field-value">{{ $val }}</span>
                            @else
                                <span class="field-value empty">—</span>
                            @endif

                        @else
                            @if($val)
                                <span class="field-value">{{ Str::limit(strip_tags($val), 55) }}</span>
                            @else
                                <span class="field-value empty">—</span>
                            @endif
                        @endif
                    </div>
                    @endforeach

                    @if($more > 0)
                    <div class="more-fields">+{{ $more }} field lainnya</div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- Reorder Save Bar --}}
    <div class="reorder-bar" id="reorder-bar">
        <div class="reorder-bar-dot"></div>
        <span>Urutan berubah</span>
        <button class="btn-save-order" id="btn-save-order">Simpan Urutan</button>
        <span id="reorder-status"></span>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const grid    = document.getElementById('sortable-grid');
    const bar     = document.getElementById('reorder-bar');
    const btnSave = document.getElementById('btn-save-order');
    const statusEl = document.getElementById('reorder-status');

    if (!grid) return;

    let dragged = null;

    grid.querySelectorAll('.section-card').forEach(card => {
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

            const cards   = [...grid.querySelectorAll('.section-card')];
            const fromIdx = cards.indexOf(dragged);
            const toIdx   = cards.indexOf(card);

            grid.insertBefore(dragged, fromIdx < toIdx ? card.nextSibling : card);

            updateBadges();
            bar.classList.add('visible');
        });
    });

    function updateBadges() {
        grid.querySelectorAll('.section-card').forEach((c, i) => {
            const badge = c.querySelector('.order-badge');
            if (badge) badge.textContent = '#' + (i + 1);
        });
    }

    btnSave.addEventListener('click', () => {
        const ids = [...grid.querySelectorAll('.section-card')].map(c => c.dataset.id);
        statusEl.textContent = 'Menyimpan...';
        statusEl.style.color = '';
        btnSave.disabled = true;

        fetch('{{ route('admin.cms.page-sections.reorder') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ order: ids }),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                statusEl.textContent = '✓ Tersimpan';
                statusEl.style.color = 'var(--success)';
                setTimeout(() => {
                    bar.classList.remove('visible');
                    statusEl.textContent = '';
                    btnSave.disabled = false;
                }, 2000);
            } else {
                throw new Error();
            }
        })
        .catch(() => {
            statusEl.textContent = '✗ Gagal';
            statusEl.style.color = 'var(--danger)';
            btnSave.disabled = false;
        });
    });
});
</script>
@endpush