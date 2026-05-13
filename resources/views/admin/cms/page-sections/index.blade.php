@extends('layouts.admin')

@section('title', 'CMS — ' . strtoupper($page))

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<style>
    /* ── Base ─────────────────────────────────────── */
    :root {
        --bg:        #0f0f13;
        --surface:   #18181f;
        --surface2:  #22222d;
        --border:    #2e2e3a;
        --accent:    #7c6af7;
        --accent2:   #f7c26a;
        --danger:    #f76a6a;
        --success:   #6af7a8;
        --text:      #e8e8f0;
        --muted:     #7a7a95;
        --radius:    10px;
    }

    body { background: var(--bg); color: var(--text); font-family: 'DM Sans', 'Segoe UI', sans-serif; }

    /* ── Page Header ──────────────────────────────── */
    .cms-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 2rem;
    }
    .cms-title {
        font-family: 'DM Mono', monospace;
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: .04em;
        color: var(--text);
        display: flex;
        align-items: center;
        gap: .6rem;
    }
    .cms-title span.tag {
        font-size: .65rem;
        background: var(--accent);
        color: #fff;
        border-radius: 4px;
        padding: 2px 8px;
        letter-spacing: .08em;
        text-transform: uppercase;
        font-family: 'DM Mono', monospace;
    }

    /* ── Page Tabs ────────────────────────────────── */
    .page-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: .4rem;
        margin-bottom: 2rem;
    }
    .page-tab {
        font-family: 'DM Mono', monospace;
        font-size: .72rem;
        font-weight: 600;
        letter-spacing: .06em;
        text-transform: uppercase;
        padding: .45rem 1rem;
        border-radius: 6px;
        border: 1.5px solid var(--border);
        background: var(--surface);
        color: var(--muted);
        text-decoration: none;
        transition: all .2s;
    }
    .page-tab:hover { border-color: var(--accent); color: var(--accent); }
    .page-tab.active { background: var(--accent); border-color: var(--accent); color: #fff; }

    /* ── Section Cards Grid ───────────────────────── */
    .sections-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 1.25rem;
    }

    /* ── Section Card ─────────────────────────────── */
    .section-card {
        background: var(--surface);
        border: 1.5px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        transition: border-color .25s, box-shadow .25s, transform .2s;
        cursor: grab;
        position: relative;
    }
    .section-card:active { cursor: grabbing; }
    .section-card.dragging {
        opacity: .45;
        transform: scale(.97);
        border-color: var(--accent);
    }
    .section-card.drag-over { border-color: var(--accent2); box-shadow: 0 0 0 2px var(--accent2); }
    .section-card:hover { border-color: #4b4b62; box-shadow: 0 6px 28px rgba(0,0,0,.35); }

    /* inactive */
    .section-card.inactive { opacity: .55; }
    .section-card.inactive .card-header { background: var(--surface2); }

    /* Card Header */
    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: .85rem 1.1rem;
        background: var(--surface2);
        border-bottom: 1.5px solid var(--border);
        gap: .75rem;
    }
    .card-header-left {
        display: flex;
        align-items: center;
        gap: .6rem;
        min-width: 0;
    }
    .drag-handle {
        color: var(--muted);
        font-size: .85rem;
        cursor: grab;
        flex-shrink: 0;
        padding: 2px 4px;
        border-radius: 4px;
        transition: color .2s;
    }
    .drag-handle:hover { color: var(--text); }
    .order-badge {
        font-family: 'DM Mono', monospace;
        font-size: .65rem;
        font-weight: 700;
        background: var(--border);
        color: var(--muted);
        padding: 2px 7px;
        border-radius: 4px;
        flex-shrink: 0;
    }
    .section-label {
        font-weight: 700;
        font-size: .88rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .section-key-badge {
        font-family: 'DM Mono', monospace;
        font-size: .65rem;
        color: var(--muted);
        white-space: nowrap;
    }
    .card-actions {
        display: flex;
        align-items: center;
        gap: .4rem;
        flex-shrink: 0;
    }

    /* Toggle Switch */
    .toggle-form { display: inline-flex; }
    .toggle {
        position: relative;
        width: 38px;
        height: 20px;
        cursor: pointer;
    }
    .toggle input { opacity: 0; width: 0; height: 0; }
    .toggle-track {
        position: absolute;
        inset: 0;
        background: var(--border);
        border-radius: 999px;
        transition: background .2s;
    }
    .toggle input:checked ~ .toggle-track { background: var(--success); }
    .toggle-thumb {
        position: absolute;
        top: 3px;
        left: 3px;
        width: 14px;
        height: 14px;
        background: #fff;
        border-radius: 50%;
        transition: transform .2s;
        pointer-events: none;
    }
    .toggle input:checked ~ .toggle-thumb { transform: translateX(18px); }

    /* Edit Button */
    .btn-edit {
        font-size: .75rem;
        font-weight: 600;
        padding: .35rem .8rem;
        border-radius: 6px;
        background: transparent;
        border: 1.5px solid var(--border);
        color: var(--text);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: .35rem;
        transition: all .2s;
    }
    .btn-edit:hover { background: var(--accent); border-color: var(--accent); color: #fff; }

    /* Card Body — Field Preview */
    .card-body { padding: 1rem 1.1rem; }
    .field-previews {
        display: flex;
        flex-direction: column;
        gap: .45rem;
    }
    .field-row {
        display: flex;
        align-items: flex-start;
        gap: .6rem;
        font-size: .78rem;
    }
    .field-label {
        color: var(--muted);
        min-width: 110px;
        flex-shrink: 0;
        font-family: 'DM Mono', monospace;
        font-size: .7rem;
        padding-top: 1px;
    }
    .field-value {
        color: var(--text);
        word-break: break-word;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    .field-value.empty { color: var(--muted); font-style: italic; }
    .field-img-thumb {
        width: 48px;
        height: 36px;
        object-fit: cover;
        border-radius: 4px;
        border: 1.5px solid var(--border);
    }
    .field-color-dot {
        display: inline-block;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        border: 1.5px solid var(--border);
        flex-shrink: 0;
        margin-top: 2px;
    }
    .more-fields {
        font-size: .7rem;
        color: var(--muted);
        font-family: 'DM Mono', monospace;
        margin-top: .3rem;
    }

    /* ── Alert / Toast ────────────────────────────── */
    .alert {
        padding: .85rem 1.1rem;
        border-radius: var(--radius);
        border-left: 4px solid;
        margin-bottom: 1.5rem;
        font-size: .88rem;
        font-weight: 600;
    }
    .alert-success { background: rgba(106,247,168,.08); border-color: var(--success); color: var(--success); }
    .alert-error   { background: rgba(247,106,106,.08); border-color: var(--danger);  color: var(--danger); }

    /* ── Empty State ──────────────────────────────── */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--muted);
    }
    .empty-state i { font-size: 3rem; margin-bottom: 1rem; display: block; opacity: .4; }

    /* ── Reorder Save Bar ─────────────────────────── */
    .reorder-bar {
        display: none;
        position: fixed;
        bottom: 1.5rem;
        left: 50%;
        transform: translateX(-50%);
        background: var(--surface2);
        border: 1.5px solid var(--accent);
        border-radius: 999px;
        padding: .65rem 1.5rem;
        display: none;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 8px 32px rgba(0,0,0,.5);
        z-index: 999;
        font-size: .85rem;
        font-weight: 600;
    }
    .reorder-bar.visible { display: flex; }
    .btn-save-order {
        background: var(--accent);
        color: #fff;
        border: none;
        border-radius: 999px;
        padding: .4rem 1.2rem;
        font-size: .82rem;
        font-weight: 700;
        cursor: pointer;
        transition: opacity .2s;
    }
    .btn-save-order:hover { opacity: .85; }

    /* ── Responsive ───────────────────────────────── */
    @media (max-width: 640px) {
        .sections-grid { grid-template-columns: 1fr; }
        .cms-header { flex-direction: column; align-items: flex-start; }
    }
</style>
@endpush

@section('content')

{{-- Alert --}}
@if(session('success'))
<div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-error"><i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}</div>
@endif

{{-- Header --}}
<div class="cms-header">
    <div class="cms-title">
        <i class="fas fa-layer-group" style="color:var(--accent)"></i>
        CMS Page Sections
        <span class="tag">{{ $page }}</span>
    </div>
    <div style="font-size:.78rem; color:var(--muted)">
        <i class="fas fa-arrows-up-down me-1"></i> Drag card untuk ubah urutan
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
    <i class="fas fa-inbox"></i>
    <p>Belum ada section untuk halaman <strong>{{ $page }}</strong>.</p>
</div>
@else
<div class="sections-grid" id="sortable-grid">
    @foreach($sections as $section)
    @php
        $fields   = $section->getFields();
        $content  = $section->content ?? [];
        $preview  = array_slice($fields, 0, 5); // tampilkan max 5 field
        $more     = count($fields) - count($preview);
    @endphp

    <div class="section-card {{ !$section->is_active ? 'inactive' : '' }}"
         data-id="{{ $section->id }}">

        {{-- Card Header --}}
        <div class="card-header">
            <div class="card-header-left">
                <span class="drag-handle"><i class="fas fa-grip-vertical"></i></span>
                <span class="order-badge">#{{ $section->order }}</span>
                <div>
                    <div class="section-label">{{ $section->label }}</div>
                    <div class="section-key-badge">{{ $section->section_key }}</div>
                </div>
            </div>
            <div class="card-actions">
                {{-- Toggle Active --}}
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

                {{-- Edit --}}
                <a href="{{ route('admin.cms.page-sections.edit', $section) }}" class="btn-edit">
                    <i class="fas fa-pen"></i> Edit
                </a>
            </div>
        </div>

        {{-- Card Body: field preview --}}
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
                    <span class="field-label">{{ Str::limit($label, 20) }}</span>

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
                            <span class="field-value">{{ Str::limit(strip_tags($val), 60) }}</span>
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
    <span><i class="fas fa-arrows-up-down me-1" style="color:var(--accent)"></i> Urutan berubah</span>
    <button class="btn-save-order" id="btn-save-order">Simpan Urutan</button>
    <span id="reorder-status" style="font-size:.75rem; color:var(--muted)"></span>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const grid      = document.getElementById('sortable-grid');
    const bar       = document.getElementById('reorder-bar');
    const btnSave   = document.getElementById('btn-save-order');
    const statusEl  = document.getElementById('reorder-status');

    if (!grid) return;

    let dragged    = null;
    let orderChanged = false;

    // ── Drag & Drop ──────────────────────────────────────
    grid.querySelectorAll('.section-card').forEach(card => {
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
            if (dragged && dragged !== card) {
                const cards   = [...grid.querySelectorAll('.section-card')];
                const fromIdx = cards.indexOf(dragged);
                const toIdx   = cards.indexOf(card);
                if (fromIdx < toIdx) {
                    grid.insertBefore(dragged, card.nextSibling);
                } else {
                    grid.insertBefore(dragged, card);
                }
                orderChanged = true;
                bar.classList.add('visible');
                // Update #order badges
                updateBadges();
            }
        });
        card.setAttribute('draggable', 'true');
    });

    function updateBadges() {
        grid.querySelectorAll('.section-card').forEach((c, i) => {
            const badge = c.querySelector('.order-badge');
            if (badge) badge.textContent = '#' + (i + 1);
        });
    }

    // ── Save Reorder ─────────────────────────────────────
    btnSave.addEventListener('click', () => {
        const ids = [...grid.querySelectorAll('.section-card')].map(c => c.dataset.id);
        statusEl.textContent = 'Menyimpan...';
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
                    statusEl.style.color = '';
                    btnSave.disabled = false;
                }, 1800);
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