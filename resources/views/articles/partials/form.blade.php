{{-- resources/views/articles/partials/form.blade.php --}}
@props(['article' => null, 'action', 'method' => 'POST'])

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    {{-- Title --}}
    <div>
        <label class="block text-sm font-semibold text-ink mb-1.5">Judul Artikel <span class="text-accent">*</span></label>
        <input type="text" name="title"
               value="{{ old('title', $article?->title) }}"
               placeholder="Tulis judul yang menarik..."
               class="w-full px-4 py-3 border rounded-xl bg-white text-ink placeholder-muted
                      focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition-all
                      @error('title') border-red-400 bg-red-50 @else border-ink/15 @enderror">
        @error('title')
            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    {{-- Category & Thumbnail row --}}
    <div class="grid sm:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-semibold text-ink mb-1.5">Kategori <span class="text-accent">*</span></label>
            <select name="category"
                    class="w-full px-4 py-3 border rounded-xl bg-white text-ink
                           focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition-all
                           @error('category') border-red-400 bg-red-50 @else border-ink/15 @enderror">
                <option value="">Pilih kategori...</option>
                @foreach(['Tech', 'Bisnis', 'Kesehatan', 'Pendidikan', 'Travel', 'Lainnya'] as $cat)
                    <option value="{{ $cat }}" {{ old('category', $article?->category) == $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
            @error('category')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-ink mb-1.5">Thumbnail</label>
            <input type="file" name="thumbnail" accept="image/*" id="thumbnail-input"
                   class="w-full px-4 py-3 border border-ink/15 rounded-xl bg-white text-ink text-sm
                          file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0
                          file:text-xs file:font-semibold file:bg-accent/10 file:text-accent
                          hover:file:bg-accent/20 transition-all
                          focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent
                          @error('thumbnail') border-red-400 bg-red-50 @enderror">
            @if($article?->thumbnail)
                <div class="mt-2 flex items-center gap-2">
                    <img src="{{ $article->thumbnail_url }}" class="w-16 h-10 object-cover rounded-lg border border-ink/10">
                    <span class="text-xs text-muted">Thumbnail saat ini</span>
                </div>
            @endif
            @error('thumbnail')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Excerpt --}}
    <div>
        <label class="block text-sm font-semibold text-ink mb-1.5">
            Ringkasan
            <span class="text-muted font-normal">(opsional, maks. 300 karakter)</span>
        </label>
        <textarea name="excerpt" rows="2"
                  placeholder="Ringkasan singkat artikel untuk ditampilkan di daftar..."
                  maxlength="300"
                  class="w-full px-4 py-3 border rounded-xl bg-white text-ink placeholder-muted resize-none
                         focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition-all
                         @error('excerpt') border-red-400 bg-red-50 @else border-ink/15 @enderror">{{ old('excerpt', $article?->excerpt) }}</textarea>
        @error('excerpt')
            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
        @enderror
    </div>

    {{-- Content --}}
    <div>
        <label class="block text-sm font-semibold text-ink mb-1.5">Konten Artikel <span class="text-accent">*</span></label>
        <textarea name="content" rows="16" id="content-editor"
                  placeholder="Tulis artikel kamu di sini... (min. 50 karakter)"
                  class="w-full px-4 py-3 border rounded-xl bg-white text-ink placeholder-muted font-mono text-sm resize-y
                         focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition-all
                         @error('content') border-red-400 bg-red-50 @else border-ink/15 @enderror">{{ old('content', $article?->content) }}</textarea>
        @error('content')
            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
        @enderror
        <p class="text-xs text-muted mt-1.5" id="word-count">0 kata</p>
    </div>

    {{-- Admin: Status selector --}}
    @if(isset($showStatus) && $showStatus)
        <div>
            <label class="block text-sm font-semibold text-ink mb-1.5">Status</label>
            <div class="flex gap-3 flex-wrap">
                @foreach(['draft' => ['Draft', 'bg-yellow-100 text-yellow-800 border-yellow-300'], 'published' => ['Published', 'bg-green-100 text-green-800 border-green-300'], 'rejected' => ['Rejected', 'bg-red-100 text-red-800 border-red-300']] as $val => [$label, $cls])
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="status" value="{{ $val }}"
                               {{ old('status', $article?->status ?? 'draft') == $val ? 'checked' : '' }}
                               class="accent-accent">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $cls }}">{{ $label }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    @else
        <input type="hidden" name="status" value="draft">
    @endif

    {{-- Submit --}}
    <div class="flex items-center justify-between pt-4 border-t border-ink/10">
        <a href="{{ url()->previous() }}"
           class="text-sm text-muted hover:text-ink transition-colors flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali
        </a>
        <button type="submit"
                class="inline-flex items-center gap-2 bg-accent text-white px-6 py-3 rounded-full font-semibold hover:bg-accent/80 transition-all hover:scale-105">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ $article ? 'Simpan Perubahan' : 'Kirim Artikel' }}
        </button>
    </div>
</form>

@push('scripts')
<script>
    // Word counter
    const editor = document.getElementById('content-editor');
    const counter = document.getElementById('word-count');

    function updateCount() {
        const words = editor.value.trim() ? editor.value.trim().split(/\s+/).length : 0;
        counter.textContent = words + ' kata';
    }

    editor.addEventListener('input', updateCount);
    updateCount();

    // Image preview
    document.getElementById('thumbnail-input')?.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(ev) {
            let preview = document.getElementById('thumb-preview');
            if (!preview) {
                preview = document.createElement('img');
                preview.id = 'thumb-preview';
                preview.className = 'w-16 h-10 object-cover rounded-lg border border-ink/10 mt-2';
                e.target.parentElement.appendChild(preview);
            }
            preview.src = ev.target.result;
        };
        reader.readAsDataURL(file);
    });
{{-- Digunakan oleh create.blade.php dan edit.blade.php --}}
{{-- Variabel: $article (opsional, untuk edit), $action, $method --}}

@php $isEdit = isset($article); @endphp

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
            {{ $isEdit ? 'EDIT ARTIKEL' : "BUAT\nARTIKEL BARU" }}
        </h1>
        @if(!$isEdit)
            <p class="form-hero-sub">Artikel kamu akan direview oleh admin sebelum dipublish.</p>
        @endif
    </div>
</div>

{{-- FORM --}}
<div style="background:white;padding-bottom:4rem;">
    <div class="form-wrap">

        @if(!$isEdit)
        <div class="notice-box">
            ⏳ <strong>Perlu Review:</strong> Artikel yang kamu kirim akan direview dulu oleh admin kami sebelum tampil ke publik. Biasanya prosesnya 1–2 hari kerja.
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
                           value="{{ old('title', $article->title ?? '') }}" required
                           maxlength="255" placeholder="Masukkan judul yang menarik..."
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
                            <img src="{{ asset('storage/'.$article->thumbnail) }}"
                                 alt="thumbnail saat ini" class="current-thumb">
                            <div class="field-hint" style="margin-bottom:0.5rem;">Upload baru untuk mengganti.</div>
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
                        @endif
                        <input type="file" id="thumbnail" name="thumbnail"
                               accept="image/*"
                               style="{{ $isEdit && ($article->thumbnail ?? false) ? 'margin-top:0.5rem;' : 'display:none;' }}"
                               onchange="previewThumb(this)"
                               {{ $isEdit && ($article->thumbnail ?? false) ? 'class="field"' : '' }}
                               style="{{ $isEdit && ($article->thumbnail ?? false) ? 'padding:0.4rem;' : '' }}">
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
    ['dragenter','dragover'].forEach(e => ua.addEventListener(e, ev => { ev.preventDefault(); ua.classList.add('dragging'); }));
    ['dragleave','drop'].forEach(e => ua.addEventListener(e, ev => {
        ev.preventDefault(); ua.classList.remove('dragging');
        if (e === 'drop' && ev.dataTransfer.files.length) {
            const fi = document.getElementById('thumbnail');
            fi.files = ev.dataTransfer.files;
            previewThumb(fi);
        }
    }));
}
// Init char counts
['title','excerpt','content'].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.dispatchEvent(new Event('input'));
});
</script>
@endpush
