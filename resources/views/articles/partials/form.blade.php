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
</script>
@endpush
