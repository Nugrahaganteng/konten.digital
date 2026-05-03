{{-- resources/views/articles/partials/form.blade.php --}}
{{-- Digunakan oleh create.blade.php dan edit.blade.php --}}
{{-- Variabel yang dibutuhkan: $action (string URL), $article (optional, untuk edit) --}}

@php $isEdit = isset($article) && $article !== null; @endphp

@push('styles')
<style>
    :root{--ink:#0e0b14;--yellow:#f5c518;--purple:#2d1b4e;--punch:#e8402a;--cream:#f7f2e8;}
    .form-hero{padding:9rem 2rem 3rem;border-bottom:5px solid var(--ink);}
    .form-hero.create-bg{background:var(--purple);}
    .form-hero.edit-bg{background:var(--punch);}
    .form-hero-tag{display:inline-block;background:var(--yellow);color:var(--purple);font-family:'Anton',sans-serif;font-size:0.75rem;letter-spacing:0.15em;padding:0.3rem 0.9rem;border:2px solid var(--ink);margin-bottom:1rem;}
    .form-hero-title{font-family:'Anton',sans-serif;font-size:clamp(2.5rem,5vw,4rem);color:white;line-height:0.95;margin-top:0.75rem;}
    .form-hero-sub{color:rgba(255,255,255,0.55);font-size:0.9rem;font-weight:600;margin-top:0.75rem;}
    .form-wrap{max-width:800px;margin:0 auto;padding:4rem 2rem;}
    .form-card{background:var(--cream);border:4px solid var(--ink);box-shadow:10px 10px 0 var(--ink);padding:2.5rem;}
    label{display:block;font-weight:700;font-size:0.78rem;text-transform:uppercase;letter-spacing:0.1em;color:var(--ink);margin-bottom:0.4rem;}
    label span{color:var(--punch);}
    .field{width:100%;border:3px solid var(--ink);background:white;padding:0.75rem 1rem;font-family:'DM Sans',sans-serif;font-weight:600;font-size:0.95rem;outline:none;transition:box-shadow 0.15s;color:var(--ink);}
    .field:focus{box-shadow:4px 4px 0 var(--purple);}
    textarea.field{resize:vertical;min-height:320px;line-height:1.7;}
    select.field{cursor:pointer;}
    .error-msg{color:var(--punch);font-size:0.8rem;font-weight:700;margin-top:0.3rem;}
    .field-group{margin-bottom:1.75rem;}
    .field-hint{font-size:0.75rem;color:rgba(14,11,20,0.45);font-weight:600;margin-top:0.4rem;}
    .form-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;}
    @media(max-width:600px){.form-grid-2{grid-template-columns:1fr;}}
    .btn-submit{background:var(--purple);color:var(--yellow);font-family:'Anton',sans-serif;font-size:1.1rem;letter-spacing:0.08em;padding:1rem 2.5rem;border:3px solid var(--ink);box-shadow:6px 6px 0 var(--ink);cursor:pointer;transition:transform 0.15s,box-shadow 0.15s;}
    .btn-submit:hover{transform:translate(4px,4px);box-shadow:2px 2px 0 var(--ink);}
    .btn-cancel{font-family:'Anton',sans-serif;font-size:0.85rem;letter-spacing:0.08em;padding:1rem 1.75rem;border:3px solid var(--ink);background:transparent;color:var(--ink);cursor:pointer;text-decoration:none;display:inline-block;box-shadow:4px 4px 0 var(--ink);transition:transform 0.15s,box-shadow 0.15s;}
    .btn-cancel:hover{transform:translate(3px,3px);box-shadow:1px 1px 0 var(--ink);}
    .char-count{font-size:0.72rem;color:rgba(14,11,20,0.4);font-weight:600;text-align:right;margin-top:0.25rem;}
    .current-thumb{border:3px solid var(--ink);max-height:150px;margin-bottom:0.75rem;display:block;}
    .upload-area{border:3px dashed var(--ink);background:white;padding:2rem;text-align:center;cursor:pointer;transition:background 0.2s;}
    .upload-area:hover{background:rgba(245,197,24,0.1);}
    .upload-area.dragging{background:rgba(245,197,24,0.2);border-style:solid;}
    #thumb-preview{max-width:100%;max-height:180px;margin:1rem auto 0;display:none;border:3px solid var(--ink);}
    .notice-box{background:rgba(245,197,24,0.15);border:2px solid var(--yellow);padding:1rem 1.25rem;margin-bottom:2rem;font-size:0.85rem;font-weight:700;color:#6b5000;line-height:1.5;}
</style>
@endpush

{{-- HERO --}}
<div class="form-hero {{ $isEdit ? 'edit-bg' : 'create-bg' }}">
    <div style="max-width:800px;margin:0 auto;">
        <a href="{{ route('articles.index') }}"
           style="display:inline-flex;align-items:center;gap:0.4rem;font-family:'Anton',sans-serif;font-size:0.75rem;letter-spacing:0.12em;color:rgba(255,255,255,0.4);text-decoration:none;margin-bottom:1.25rem;">
            ← KEMBALI
        </a>
        <span class="form-hero-tag">{{ $isEdit ? '✏️ EDIT' : '✏️ TULIS ARTIKEL' }}</span>
        <h1 class="form-hero-title">
            {{ $isEdit ? 'EDIT ARTIKEL' : "BUAT ARTIKEL BARU" }}
        </h1>
        @if(!$isEdit)
            <p class="form-hero-sub">Artikel kamu akan direview oleh admin sebelum dipublish.</p>
        @endif
    </div>
</div>

{{-- FORM BODY --}}
<div style="background:white;padding-bottom:4rem;">
    <div class="form-wrap">

        @if(!$isEdit)
            <div class="notice-box">
                ⏳ <strong>Perlu Review:</strong> Artikel yang kamu kirim akan direview dulu oleh admin sebelum tampil ke publik.
            </div>
        @endif

        @if(session('success'))
            <div style="background:rgba(0,168,150,0.15);border:2px solid #00a896;padding:1rem 1.25rem;margin-bottom:1.5rem;font-weight:700;font-size:0.9rem;color:#005a52;">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div class="form-card">
            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($isEdit) @method('PUT') @endif

                {{-- Title --}}
                <div class="field-group">
                    <label for="title">Judul Artikel <span>*</span></label>
                    <input id="title" name="title" type="text" class="field"
                           value="{{ old('title', $article->title ?? '') }}"
                           required maxlength="255"
                           placeholder="Masukkan judul yang menarik..."
                           oninput="updateCount(this,'title-count',255)">
                    <div class="char-count"><span id="title-count">0</span>/255</div>
                    @error('title') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                <div class="form-grid-2">
                    {{-- Category --}}
                    <div class="field-group">
                        <label for="category">Kategori <span>*</span></label>
                        <select id="category" name="category" class="field" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach(['Digital Marketing','Social Media','SEO','Content Strategy','Branding','Tips & Trick','Press Release','Lainnya'] as $cat)
                                <option value="{{ $cat }}"
                                    {{ old('category', $article->category ?? '') === $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                        @error('category') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    {{-- Thumbnail --}}
                    <div class="field-group">
                        <label>Thumbnail</label>
                        @if($isEdit && ($article->thumbnail ?? false))
                            <img src="{{ asset('storage/' . $article->thumbnail) }}"
                                 alt="thumbnail saat ini" class="current-thumb">
                            <div class="field-hint" style="margin-bottom:0.5rem;">Upload baru untuk mengganti.</div>
                            <input type="file" id="thumbnail" name="thumbnail"
                                   accept="image/*" class="field" style="padding:0.4rem;"
                                   onchange="previewThumb(this)">
                        @else
                            <div class="upload-area" id="upload-area"
                                 onclick="document.getElementById('thumbnail').click()">
                                <div style="font-size:2rem;margin-bottom:0.4rem;">🖼️</div>
                                <div id="upload-text" style="font-size:0.8rem;font-weight:700;color:rgba(14,11,20,0.5);">
                                    Klik atau drag foto di sini<br>
                                    <small>JPG, PNG, WEBP — Maks 2MB</small>
                                </div>
                            </div>
                            <img id="thumb-preview" src="" alt="Preview">
                            <input type="file" id="thumbnail" name="thumbnail"
                                   accept="image/*" style="display:none;"
                                   onchange="previewThumb(this)">
                        @endif
                        @error('thumbnail') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Excerpt --}}
                <div class="field-group">
                    <label for="excerpt">Ringkasan</label>
                    <textarea id="excerpt" name="excerpt" class="field" style="min-height:80px;"
                              maxlength="300" placeholder="Ringkasan singkat (maks 300 karakter)..."
                              oninput="updateCount(this,'excerpt-count',300)">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
                    <div class="char-count"><span id="excerpt-count">0</span>/300</div>
                    <div class="field-hint">Kosongkan untuk auto-generate dari isi artikel.</div>
                    @error('excerpt') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                {{-- Content --}}
                <div class="field-group">
                    <label for="content">Isi Artikel <span>*</span></label>
                    <textarea id="content" name="content" class="field" required
                              placeholder="Tulis isi artikel kamu di sini. Minimal 50 karakter..."
                              oninput="updateCount(this,'content-count',null)">{{ old('content', $article->content ?? '') }}</textarea>
                    <div class="char-count"><span id="content-count">0</span> karakter</div>
                    @error('content') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                <div style="display:flex;gap:1rem;align-items:center;flex-wrap:wrap;">
                    <button type="submit" class="btn-submit">
                        {{ $isEdit ? 'SIMPAN PERUBAHAN →' : 'KIRIM ARTIKEL →' }}
                    </button>
                    <a href="{{ route('articles.index') }}" class="btn-cancel">BATAL</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function updateCount(el, id, max) {
    document.getElementById(id).textContent = el.value.length;
}

function previewThumb(input) {
    if (!input.files?.length) return;
    const reader = new FileReader();
    reader.onload = e => {
        const preview = document.getElementById('thumb-preview');
        if (preview) { preview.src = e.target.result; preview.style.display = 'block'; }
        const txt = document.getElementById('upload-text');
        if (txt) txt.innerHTML = '✅ ' + input.files[0].name;
    };
    reader.readAsDataURL(input.files[0]);
}

// Drag & drop
const ua = document.getElementById('upload-area');
if (ua) {
    ['dragenter', 'dragover'].forEach(ev =>
        ua.addEventListener(ev, e => { e.preventDefault(); ua.classList.add('dragging'); })
    );
    ['dragleave', 'drop'].forEach(ev =>
        ua.addEventListener(ev, e => {
            e.preventDefault();
            ua.classList.remove('dragging');
            if (ev === 'drop' && e.dataTransfer.files.length) {
                const fi = document.getElementById('thumbnail');
                fi.files = e.dataTransfer.files;
                previewThumb(fi);
            }
        })
    );
}

// Init char counts on page load
['title', 'excerpt', 'content'].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.dispatchEvent(new Event('input'));
});
</script>
@endpush