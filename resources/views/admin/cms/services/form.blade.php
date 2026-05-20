{{-- resources/views/admin/cms/services/form.blade.php --}}
{{-- Digunakan untuk CREATE dan EDIT --}}
@extends('layouts.admin')

@section('title', $service->exists ? 'Edit — ' . $service->title : 'Tambah Service Baru')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Syne:wght@700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
<style>
:root {
    --w:#F5F0E8;--blk:#0D0D0D;--yel:#F5C800;--cor:#FF5A36;--mnt:#00C48C;
    --blu:#1A56FF;--txt:#0D0D0D;--txt2:#3D3D3D;--mu:#7A7A7A;
    --bd:3px solid #0D0D0D;--sh:4px 4px 0 #0D0D0D;--shlg:6px 6px 0 #0D0D0D;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

/* Ticker */
.ticker-bar{background:var(--blk);padding:5px 0;overflow:hidden;white-space:nowrap;border-bottom:var(--bd);width:100%}
.ticker-inner{display:inline-block;animation:ticker 18s linear infinite;font-family:'JetBrains Mono',monospace;font-size:.56rem;font-weight:700;color:var(--yel);letter-spacing:.13em;text-transform:uppercase;padding-left:100%}
@keyframes ticker{from{transform:translateX(0)}to{transform:translateX(-50%)}}

/* Top Nav */
.top-nav{background:var(--yel);border-bottom:var(--bd);padding:.8rem 1.25rem;display:flex;align-items:center;gap:.6rem;overflow:hidden;width:100%;flex-wrap:nowrap}
.btn-back{display:inline-flex;align-items:center;gap:.35rem;font-family:'JetBrains Mono',monospace;font-size:.6rem;font-weight:700;color:var(--blk);text-decoration:none;padding:.4rem .8rem;border:var(--bd);background:var(--w);text-transform:uppercase;letter-spacing:.04em;box-shadow:var(--sh);flex-shrink:0;white-space:nowrap;transition:all .12s;min-height:34px}
.btn-back:hover{background:var(--blk);color:var(--yel)}
.nav-sep{color:var(--blk);font-family:'JetBrains Mono',monospace;font-weight:700;flex-shrink:0}
.page-heading{font-family:'Syne',sans-serif;font-size:clamp(.9rem,4vw,1.4rem);font-weight:800;color:var(--blk);letter-spacing:-.02em;line-height:1;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;flex:1;min-width:0}
.unsaved-pip{display:none;width:8px;height:8px;border-radius:50%;background:var(--cor);border:2px solid var(--blk);animation:pipBlink .8s step-end infinite;flex-shrink:0}
body.has-changes .unsaved-pip{display:inline-block}
@keyframes pipBlink{0%,100%{opacity:1}50%{opacity:0}}
.pill{font-family:'JetBrains Mono',monospace;font-size:.55rem;font-weight:700;padding:2px 8px;border:2px solid var(--blk);text-transform:uppercase;letter-spacing:.05em;flex-shrink:0;background:var(--blk);color:var(--yel)}

/* Alerts */
.alerts-wrap{padding:.65rem 1.25rem 0}
.alert{display:flex;align-items:center;gap:.5rem;padding:.6rem .85rem;border:var(--bd);box-shadow:var(--sh);margin-bottom:.5rem;font-family:'JetBrains Mono',monospace;font-size:.66rem;font-weight:600;animation:slideDown .22s ease}
.alert-success{background:#D4F5E4;color:#005C33}
.alert-error{background:#FFE0D9;color:#8B1A00}
@keyframes slideDown{from{opacity:0;transform:translateY(-4px)}to{opacity:1;transform:translateY(0)}}

/* Layout */
.form-layout{display:grid;grid-template-columns:1fr 260px;gap:1rem;align-items:start;padding:1.1rem 1.25rem 5rem;overflow-x:hidden;width:100%}

/* Card */
.card{background:var(--w);border:var(--bd);box-shadow:var(--sh);width:100%;overflow:hidden}
.card-head{display:flex;align-items:center;gap:.55rem;padding:.7rem .95rem;background:var(--blk);border-bottom:var(--bd);overflow:hidden;min-width:0}
.card-head-label{font-family:'Syne',sans-serif;font-size:.95rem;font-weight:700;color:var(--w);flex:1;min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.card-head i{color:var(--yel);font-size:.82rem;flex-shrink:0}
.card-body{padding:.95rem;display:flex;flex-direction:column;gap:.95rem}

/* Field */
.field-group{display:flex;flex-direction:column;gap:.38rem}
.field-group+.field-group{padding-top:.95rem;border-top:2px solid rgba(0,0,0,.08)}
.field-label{font-family:'JetBrains Mono',monospace;font-size:.65rem;font-weight:700;color:var(--txt);display:flex;align-items:center;gap:.35rem;text-transform:uppercase;letter-spacing:.06em;flex-wrap:wrap}
.field-hint{font-family:'JetBrains Mono',monospace;font-size:.55rem;color:var(--mu);margin-top:2px}
.required-star{color:var(--cor)}

/* Inputs */
.inp{width:100%;background:var(--w);border:var(--bd);color:var(--txt);font-size:.85rem;padding:.58rem .8rem;outline:none;transition:box-shadow .12s;font-family:'Space Grotesk',sans-serif;resize:vertical;border-radius:0;box-shadow:var(--sh);-webkit-appearance:none;appearance:none;max-width:100%}
.inp:focus{box-shadow:5px 5px 0 var(--blu)}
.inp::placeholder{color:#aaa}
textarea.inp{min-height:90px;line-height:1.65}
select.inp{cursor:pointer;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%230D0D0D' stroke-width='3'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right .8rem center;background-size:14px;padding-right:2.5rem}
.inp-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:.6rem}

/* Image upload */
.image-upload-area{border:3px dashed var(--blk);padding:1.25rem 1rem;text-align:center;transition:background .12s;cursor:pointer;position:relative;background:var(--w);width:100%;overflow:hidden}
.image-upload-area:hover,.image-upload-area.drag-over{background:#EDE8DC;box-shadow:var(--sh)}
.image-upload-area input[type="file"]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}
.upload-icon{font-size:1.25rem;color:var(--mu);margin-bottom:.35rem}
.upload-text{font-family:'JetBrains Mono',monospace;font-size:.6rem;color:var(--mu);line-height:1.75}
.upload-text strong{color:var(--blk);font-weight:700}
.img-preview-wrap{position:relative;display:inline-block;margin-bottom:.35rem;max-width:100%}
.img-preview{max-width:100%;max-height:150px;border:var(--bd);box-shadow:var(--sh);object-fit:cover;display:block}
.img-remove-btn{position:absolute;top:-9px;right:-9px;width:22px;height:22px;background:var(--cor);border:2px solid var(--blk);color:var(--w);font-size:.55rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:transform .12s}
.img-remove-btn:hover{transform:scale(1.15)}
.img-filename{font-family:'JetBrains Mono',monospace;font-size:.58rem;color:var(--mu);margin-top:.25rem;word-break:break-all}

/* Sidebar */
.form-sidebar{display:flex;flex-direction:column;gap:.8rem}
.sidebar-sticky{position:sticky;top:1rem;display:flex;flex-direction:column;gap:.8rem}
.status-row{display:flex;align-items:center;justify-content:space-between;padding:.7rem .95rem;background:var(--blk);border-bottom:var(--bd)}
.status-label{font-family:'JetBrains Mono',monospace;font-size:.62rem;font-weight:700;color:var(--w);text-transform:uppercase;letter-spacing:.06em;display:flex;align-items:center;gap:.4rem}
.s-dot{width:7px;height:7px;border-radius:50%;border:1.5px solid rgba(255,255,255,.4)}
.s-dot.on{background:var(--mnt)}.s-dot.off{background:#555}
.toggle{position:relative;width:36px;height:19px;cursor:pointer;display:inline-block}
.toggle input{opacity:0;width:0;height:0}
.toggle-track{position:absolute;inset:0;background:#555;border-radius:999px;border:2px solid #888;transition:all .2s}
.toggle input:checked~.toggle-track{background:var(--mnt);border-color:#00a078}
.toggle-thumb{position:absolute;top:3px;left:3px;width:13px;height:13px;background:#888;border-radius:50%;transition:transform .2s,background .2s;pointer-events:none}
.toggle input:checked~.toggle-thumb{transform:translateX(17px);background:var(--w)}
.sidebar-info{padding:.85rem .95rem;display:flex;flex-direction:column;gap:.65rem}
.info-row{display:flex;flex-direction:column;gap:2px}
.info-k{font-family:'JetBrains Mono',monospace;font-size:.53rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--mu)}
.info-v{font-size:.78rem;font-weight:600;color:var(--txt)}
.btn-submit{width:100%;background:var(--yel);color:var(--blk);border:var(--bd);box-shadow:var(--sh);padding:.75rem;font-family:'Syne',sans-serif;font-size:.95rem;font-weight:800;letter-spacing:.04em;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:.45rem;transition:all .12s;border-radius:0;margin-top:.15rem;min-height:44px}
.btn-submit:hover{background:var(--blk);color:var(--yel)}
.btn-submit:active{transform:translate(2px,2px);box-shadow:2px 2px 0 var(--blk)}
.link-cancel{display:block;text-align:center;font-family:'JetBrains Mono',monospace;font-size:.6rem;font-weight:700;color:var(--mu);text-decoration:none;padding:.4rem;transition:color .12s;text-transform:uppercase;letter-spacing:.05em}
.link-cancel:hover{color:var(--cor);text-decoration:underline}

/* Route option preview */
.route-preview{font-family:'JetBrains Mono',monospace;font-size:.56rem;background:rgba(26,86,255,.08);border:1.5px solid rgba(26,86,255,.25);color:var(--blu);padding:.3rem .6rem;margin-top:.3rem;display:none}
.route-preview.show{display:block}

/* Responsive */
@media(max-width:900px){.form-layout{grid-template-columns:1fr 230px;gap:.85rem;padding:.95rem 1.25rem 5rem}}
@media(max-width:720px){
    .form-layout{grid-template-columns:1fr;padding:.85rem 1rem 5rem;gap:.8rem}
    .form-sidebar{order:-1}
    .sidebar-sticky{position:static}
    .sidebar-info{display:grid;grid-template-columns:1fr 1fr;gap:.55rem .85rem;padding:.85rem}
    .btn-submit,.link-cancel{grid-column:1/-1}
    .top-nav{padding:.7rem 1rem;gap:.45rem}
    .inp-grid-2{grid-template-columns:1fr}
}
@media(max-width:480px){
    .top-nav{padding:.6rem .85rem;gap:.35rem}
    .pill{display:none}
    .card-head{padding:.55rem .75rem}
    .card-body{padding:.7rem .75rem;gap:.7rem}
    .inp{font-size:.8rem;padding:.52rem .7rem}
    .sidebar-info{grid-template-columns:1fr}
}
</style>
@endpush

@section('content')
<div style="min-height:100vh;animation:wakeUp .3s ease both;max-width:100%;overflow-x:hidden">
<style>@keyframes wakeUp{from{opacity:0;transform:translateY(4px)}to{opacity:1;transform:translateY(0)}}</style>

    {{-- Ticker --}}
    <div class="ticker-bar">
        <div class="ticker-inner">
            ◆ {{ $service->exists ? 'EDIT SERVICE — ' . strtoupper($service->title) : 'TAMBAH SERVICE BARU' }} &nbsp;&nbsp;&nbsp; ◆ HNP COMMUNICATIONS ADMIN &nbsp;&nbsp;&nbsp; ◆ CMS LAYANAN &nbsp;&nbsp;&nbsp; ◆ {{ $service->exists ? 'EDIT SERVICE — ' . strtoupper($service->title) : 'TAMBAH SERVICE BARU' }} &nbsp;&nbsp;&nbsp;
        </div>
    </div>

    {{-- Top Nav --}}
    <div class="top-nav">
        <a href="{{ route('admin.cms.services.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> KEMBALI
        </a>
        <span class="nav-sep">/</span>
        <div class="page-heading">{{ $service->exists ? 'EDIT SERVICE' : 'TAMBAH SERVICE' }}</div>
        <span class="unsaved-pip"></span>
        <span class="pill">{{ $service->exists ? 'EDIT' : 'NEW' }}</span>
    </div>

    {{-- Alerts --}}
    <div class="alerts-wrap">
        @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if($errors->any())
        <div class="alert alert-error"><i class="fas fa-circle-exclamation"></i> {{ $errors->first() }}</div>
        @endif
    </div>

    {{-- Form --}}
    <form method="POST"
          action="{{ $service->exists ? route('admin.cms.services.update', $service) : route('admin.cms.services.store') }}"
          enctype="multipart/form-data"
          id="service-form">
        @csrf
        @if($service->exists) @method('PUT') @endif

        <div class="form-layout">

            {{-- ══ SIDEBAR ══ --}}
            <div class="form-sidebar">
                <div class="sidebar-sticky">
                    <div class="card">
                        <div class="status-row">
                            <span class="status-label">
                                <span class="s-dot {{ ($service->is_active ?? true) ? 'on' : 'off' }}"></span>
                                STATUS AKTIF
                            </span>
                            <label class="toggle">
                                <input type="checkbox" name="is_active" value="1"
                                       {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
                                <span class="toggle-track"></span>
                                <span class="toggle-thumb"></span>
                            </label>
                        </div>
                        <div class="sidebar-info">
                            @if($service->exists)
                            <div class="info-row">
                                <span class="info-k">SLUG</span>
                                <span class="info-v" style="font-family:'JetBrains Mono',monospace;font-size:.65rem">/{{ $service->slug }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-k">URUTAN</span>
                                <span class="info-v">#{{ $service->order }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-k">TERAKHIR DIUBAH</span>
                                <span class="info-v" style="font-size:.7rem">{{ $service->updated_at->diffForHumans() }}</span>
                            </div>
                            @else
                            <div class="info-row">
                                <span class="info-k">MODE</span>
                                <span class="info-v">Service Baru</span>
                            </div>
                            <div class="info-row">
                                <span class="info-k">SLUG</span>
                                <span class="info-v" id="slug-preview" style="font-family:'JetBrains Mono',monospace;font-size:.65rem;color:var(--mu)">akan digenerate otomatis</span>
                            </div>
                            @endif
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-floppy-disk"></i>
                                {{ $service->exists ? 'SIMPAN PERUBAHAN' : 'TAMBAH SERVICE' }}
                            </button>
                            <a href="{{ route('admin.cms.services.index') }}" class="link-cancel">
                                BATAL & KEMBALI
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══ MAIN FIELDS ══ --}}
            <div class="card">
                <div class="card-head">
                    <i class="fas fa-briefcase"></i>
                    <span class="card-head-label">{{ $service->exists ? 'EDIT: ' . strtoupper($service->title) : 'DATA SERVICE BARU' }}</span>
                </div>
                <div class="card-body">

                    {{-- Title + Tab Label --}}
                    <div class="field-group">
                        <label class="field-label" for="title">
                            JUDUL SERVICE <span class="required-star">*</span>
                        </label>
                        <input type="text" id="title" name="title"
                               value="{{ old('title', $service->title) }}"
                               placeholder="Contoh: Press Release"
                               class="inp"
                               oninput="updateSlugPreview(this.value)"
                               required>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="tab_label">
                            LABEL TAB <span class="required-star">*</span>
                        </label>
                        <div class="field-hint">Teks pendek yang muncul di tab/tombol navigasi</div>
                        <input type="text" id="tab_label" name="tab_label"
                               value="{{ old('tab_label', $service->tab_label) }}"
                               placeholder="Contoh: Press Release"
                               class="inp" required>
                    </div>

                    {{-- Route Name --}}
                    <div class="field-group">
                        <label class="field-label" for="route_name">
                            ROUTE NAME
                        </label>
                        <div class="field-hint">Pilih route yang mengarah ke halaman layanan ini (opsional)</div>
                        <select id="route_name" name="route_name" class="inp"
                                onchange="showRoutePreview(this.value)">
                            <option value="">— Tanpa route khusus —</option>
                            @foreach($routeOptions as $routeKey => $routeLabel)
                            <option value="{{ $routeKey }}"
                                    {{ old('route_name', $service->route_name) === $routeKey ? 'selected' : '' }}>
                                {{ $routeLabel }} ({{ $routeKey }})
                            </option>
                            @endforeach
                        </select>
                        <div class="route-preview" id="route-preview"></div>
                    </div>

                    {{-- Description --}}
                    <div class="field-group">
                        <label class="field-label" for="description">
                            DESKRIPSI SINGKAT <span class="required-star">*</span>
                        </label>
                        <div class="field-hint">Ditampilkan di card/preview layanan</div>
                        <textarea id="description" name="description"
                                  placeholder="Deskripsi singkat tentang layanan ini..."
                                  class="inp" rows="3" required>{{ old('description', $service->description) }}</textarea>
                    </div>

                    {{-- Content --}}
                    <div class="field-group">
                        <label class="field-label" for="content">KONTEN DETAIL</label>
                        <div class="field-hint">Konten lengkap untuk halaman detail layanan (opsional)</div>
                        <textarea id="content" name="content"
                                  placeholder="Konten HTML atau teks panjang..."
                                  class="inp" rows="5">{{ old('content', $service->content) }}</textarea>
                    </div>

                    {{-- Image --}}
                    <div class="field-group">
                        <label class="field-label">GAMBAR LAYANAN</label>
                        <div class="field-hint">JPG, PNG, WEBP — Maks 2MB</div>
                        <div class="image-upload-area" id="drop-image"
                             ondragover="handleDragOver(event, this)"
                             ondragleave="handleDragLeave(event, this)"
                             ondrop="handleFileDrop(event)">
                            @if($service->image)
                            <div class="img-preview-wrap" id="preview-wrap">
                                <img src="{{ Storage::url($service->image) }}" alt="" class="img-preview" id="img-preview">
                                <button type="button" class="img-remove-btn" onclick="clearImage()"><i class="fas fa-times"></i></button>
                                <p class="img-filename" id="img-filename">{{ basename($service->image) }}</p>
                            </div>
                            @else
                            <div class="img-preview-wrap" id="preview-wrap" style="display:none">
                                <img src="" alt="" class="img-preview" id="img-preview">
                                <button type="button" class="img-remove-btn" onclick="clearImage()"><i class="fas fa-times"></i></button>
                                <p class="img-filename" id="img-filename"></p>
                            </div>
                            @endif
                            <div id="upload-prompt" {{ $service->image ? 'style=display:none' : '' }}>
                                <div class="upload-icon"><i class="fas fa-cloud-arrow-up"></i></div>
                                <div class="upload-text">
                                    <strong>KLIK PILIH</strong> ATAU DRAG & DROP<br>
                                    <span style="font-size:.56rem;color:#bbb">PNG · JPG · WEBP — MAX 2MB</span>
                                </div>
                            </div>
                            <input type="file" name="image" id="image-input" accept="image/*"
                                   onchange="handleImageChange(this)">
                        </div>
                    </div>

                    {{-- Icon Class + BG Label --}}
                    <div class="inp-grid-2">
                        <div class="field-group">
                            <label class="field-label" for="icon_class">ICON CLASS</label>
                            <div class="field-hint">Font Awesome, contoh: fas fa-newspaper</div>
                            <input type="text" id="icon_class" name="icon_class"
                                   value="{{ old('icon_class', $service->icon_class) }}"
                                   placeholder="fas fa-newspaper"
                                   class="inp">
                        </div>
                        <div class="field-group">
                            <label class="field-label" for="bg_label">BG LABEL</label>
                            <div class="field-hint">Label warna background (hex/nama)</div>
                            <input type="text" id="bg_label" name="bg_label"
                                   value="{{ old('bg_label', $service->bg_label) }}"
                                   placeholder="#F5C800 atau yellow"
                                   class="inp">
                        </div>
                    </div>

                    {{-- WhatsApp + Order --}}
                    <div class="inp-grid-2">
                        <div class="field-group">
                            <label class="field-label" for="whatsapp_number">NO. WHATSAPP</label>
                            <div class="field-hint">Format: 628xxx (tanpa +)</div>
                            <input type="text" id="whatsapp_number" name="whatsapp_number"
                                   value="{{ old('whatsapp_number', $service->whatsapp_number) }}"
                                   placeholder="6287786000919"
                                   class="inp">
                        </div>
                        <div class="field-group">
                            <label class="field-label" for="order">URUTAN</label>
                            <div class="field-hint">Angka kecil = tampil duluan</div>
                            <input type="number" id="order" name="order"
                                   value="{{ old('order', $service->order ?? 99) }}"
                                   min="1" max="999"
                                   class="inp">
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
const routeMap = @json($routeOptions);

function updateSlugPreview(val) {
    const el = document.getElementById('slug-preview');
    if (!el) return;
    const slug = val.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
    el.textContent = slug ? '/' + slug : 'akan digenerate otomatis';
}

function showRoutePreview(val) {
    const el = document.getElementById('route-preview');
    if (!el) return;
    if (val && routeMap[val]) {
        el.textContent = '→ ' + val;
        el.classList.add('show');
    } else {
        el.classList.remove('show');
    }
}

// Image upload
function handleImageChange(input) {
    const file = input.files[0];
    if (!file) return;
    if (file.size > 2 * 1024 * 1024) { alert('File melebihi 2MB'); input.value = ''; return; }
    showPreview(file);
}
function handleFileDrop(e) {
    e.preventDefault();
    document.getElementById('drop-image').classList.remove('drag-over');
    const file = e.dataTransfer.files[0];
    if (!file || !file.type.startsWith('image/')) return;
    const dt = new DataTransfer(); dt.items.add(file);
    document.getElementById('image-input').files = dt.files;
    showPreview(file);
}
function handleDragOver(e, area)  { e.preventDefault(); area.classList.add('drag-over'); }
function handleDragLeave(e, area) { if (!area.contains(e.relatedTarget)) area.classList.remove('drag-over'); }
function showPreview(file) {
    const reader = new FileReader();
    reader.onload = ev => {
        document.getElementById('img-preview').src = ev.target.result;
        document.getElementById('img-filename').textContent = file.name;
        document.getElementById('preview-wrap').style.display = 'inline-block';
        document.getElementById('upload-prompt').style.display = 'none';
    };
    reader.readAsDataURL(file);
}
function clearImage() {
    document.getElementById('img-preview').src = '';
    document.getElementById('img-filename').textContent = '';
    document.getElementById('image-input').value = '';
    document.getElementById('preview-wrap').style.display = 'none';
    document.getElementById('upload-prompt').style.display = 'block';
}

// Unsaved changes warning
let formChanged = false;
const form = document.getElementById('service-form');
form?.addEventListener('change', () => { formChanged = true; document.body.classList.add('has-changes'); });
form?.addEventListener('submit', () => { formChanged = false; document.body.classList.remove('has-changes'); });
window.addEventListener('beforeunload', e => { if (formChanged) { e.preventDefault(); e.returnValue = ''; } });

// Init route preview on edit
document.addEventListener('DOMContentLoaded', () => {
    const sel = document.getElementById('route_name');
    if (sel?.value) showRoutePreview(sel.value);
});
</script>
@endpush