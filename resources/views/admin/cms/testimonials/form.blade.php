@extends('layouts.admin')
@section('title', isset($testimonial->id) ? 'Edit Testimoni' : 'Tambah Testimoni')

@section('content')
<div class="p-6 lg:p-8">

    {{-- Header --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.cms.testimonials.index') }}"
           class="bg-white border-4 border-black font-black text-xs uppercase tracking-widest
                  px-4 py-2.5 shadow-[4px_4px_0_#000] hover:translate-x-1 hover:translate-y-1
                  hover:shadow-none transition-all">
            ← KEMBALI
        </a>
        <div>
            <h1 class="font-black text-2xl uppercase tracking-tight" style="font-family:'Unbounded',sans-serif">
                {{ isset($testimonial->id) ? 'Edit Testimoni' : 'Tambah Testimoni' }}
            </h1>
            <p class="text-sm text-gray-500 font-medium mt-1">
                {{ isset($testimonial->id) ? 'Perbarui data testimoni pelanggan.' : 'Tambahkan testimoni baru ke halaman utama.' }}
            </p>
        </div>
    </div>

    <form action="{{ isset($testimonial->id) ? route('admin.cms.testimonials.update', $testimonial) : route('admin.cms.testimonials.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($testimonial->id)) @method('PUT') @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Kolom Kiri: Foto Preview --}}
            <div class="lg:col-span-1">
                <div class="bg-white border-4 border-black shadow-[6px_6px_0_#000] p-6">
                    <p class="font-black text-xs uppercase tracking-widest mb-4">Foto Profil</p>

                    {{-- Preview --}}
                    <div class="flex justify-center mb-4">
                        <div id="photo-preview-wrap" class="w-32 h-32 border-4 border-black overflow-hidden rounded-full bg-purple-100 flex items-center justify-center">
                            @if(isset($testimonial->id) && $testimonial->photo)
                                <img id="photo-preview" src="{{ $testimonial->photo_url }}" alt="Preview" class="w-full h-full object-cover">
                            @else
                                <img id="photo-preview" src="" alt="Preview" class="w-full h-full object-cover hidden">
                                <span id="photo-placeholder" class="font-black text-purple-400 text-3xl">?</span>
                            @endif
                        </div>
                    </div>

                    <label class="block">
                        <span class="font-black text-xs uppercase tracking-widest text-gray-600 block mb-2">Upload Foto</span>
                        <input type="file" name="photo" id="photo-input" accept="image/*"
                               class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-4
                                      file:border-2 file:border-black file:font-black file:text-xs
                                      file:uppercase file:bg-yellow-400 file:cursor-pointer
                                      cursor-pointer">
                        <p class="text-[10px] text-gray-400 mt-1.5">JPG, PNG, WEBP. Maks 1MB.</p>
                    </label>
                    @error('photo') <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p> @enderror

                    <hr class="border-2 border-black/10 my-5">

                    {{-- Urutan & Status --}}
                    <div class="space-y-4">
                        <label class="block">
                            <span class="font-black text-xs uppercase tracking-widest text-gray-600 block mb-2">Urutan Tampil</span>
                            <input type="number" name="order" value="{{ old('order', $testimonial->order ?? 0) }}" min="0"
                                   class="w-full border-2 border-black px-3 py-2 font-bold text-sm focus:outline-none focus:border-yellow-400">
                            @error('order') <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </label>

                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1"
                                   {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}
                                   class="w-5 h-5 border-2 border-black accent-yellow-400">
                            <span class="font-black text-xs uppercase tracking-widest">Aktifkan</span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Data Testimoni --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white border-4 border-black shadow-[6px_6px_0_#000] p-6">
                    <p class="font-black text-xs uppercase tracking-widest mb-5">Data Pelanggan</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <label class="block md:col-span-2">
                            <span class="font-black text-xs uppercase tracking-widest text-gray-600 block mb-2">Nama Lengkap <span class="text-red-500">*</span></span>
                            <input type="text" name="name" value="{{ old('name', $testimonial->name ?? '') }}"
                                   placeholder="Contoh: Budi Santoso"
                                   class="w-full border-2 border-black px-3 py-2.5 font-medium text-sm focus:outline-none focus:border-yellow-400 @error('name') border-red-500 @enderror">
                            @error('name') <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </label>

                        <label class="block">
                            <span class="font-black text-xs uppercase tracking-widest text-gray-600 block mb-2">Jabatan / Posisi</span>
                            <input type="text" name="position" value="{{ old('position', $testimonial->position ?? '') }}"
                                   placeholder="Contoh: CEO, Marketing Manager"
                                   class="w-full border-2 border-black px-3 py-2.5 font-medium text-sm focus:outline-none focus:border-yellow-400">
                            @error('position') <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </label>

                        <label class="block">
                            <span class="font-black text-xs uppercase tracking-widest text-gray-600 block mb-2">Nama Perusahaan</span>
                            <input type="text" name="company" value="{{ old('company', $testimonial->company ?? '') }}"
                                   placeholder="Contoh: PT Maju Bersama"
                                   class="w-full border-2 border-black px-3 py-2.5 font-medium text-sm focus:outline-none focus:border-yellow-400">
                            @error('company') <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </label>
                    </div>
                </div>

                <div class="bg-white border-4 border-black shadow-[6px_6px_0_#000] p-6">
                    <p class="font-black text-xs uppercase tracking-widest mb-5">Isi Testimoni</p>

                    <label class="block mb-5">
                        <span class="font-black text-xs uppercase tracking-widest text-gray-600 block mb-2">Teks Testimoni <span class="text-red-500">*</span></span>
                        <textarea name="content" rows="5"
                                  placeholder="Tuliskan isi testimoni pelanggan di sini..."
                                  class="w-full border-2 border-black px-3 py-2.5 font-medium text-sm focus:outline-none focus:border-yellow-400 resize-none @error('content') border-red-500 @enderror">{{ old('content', $testimonial->content ?? '') }}</textarea>
                        @error('content') <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                    </label>

                    {{-- Rating Stars --}}
                    <div>
                        <span class="font-black text-xs uppercase tracking-widest text-gray-600 block mb-3">Rating <span class="text-red-500">*</span></span>
                        <div class="flex gap-2" id="star-rating">
                            @for($i = 1; $i <= 5; $i++)
                            <button type="button"
                                    data-value="{{ $i }}"
                                    class="star-btn text-4xl transition-all {{ $i <= old('rating', $testimonial->rating ?? 5) ? 'text-yellow-400' : 'text-gray-200' }} hover:scale-110">
                                ★
                            </button>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating-input" value="{{ old('rating', $testimonial->rating ?? 5) }}">
                        @error('rating') <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Submit --}}
                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.cms.testimonials.index') }}"
                       class="bg-white border-4 border-black font-black text-xs uppercase tracking-widest
                              px-6 py-3 shadow-[4px_4px_0_#000] hover:translate-x-1 hover:translate-y-1
                              hover:shadow-none transition-all">
                        BATAL
                    </a>
                    <button type="submit"
                            class="bg-yellow-400 border-4 border-black font-black text-xs uppercase tracking-widest
                                   px-8 py-3 shadow-[4px_4px_0_#000] hover:translate-x-1 hover:translate-y-1
                                   hover:shadow-none transition-all">
                        {{ isset($testimonial->id) ? '✓ SIMPAN PERUBAHAN' : '+ TAMBAH TESTIMONI' }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
// Star rating interaktif
const stars     = document.querySelectorAll('.star-btn');
const ratingIn  = document.getElementById('rating-input');

function setRating(val) {
    ratingIn.value = val;
    stars.forEach(s => {
        s.classList.toggle('text-yellow-400', +s.dataset.value <= val);
        s.classList.toggle('text-gray-200',   +s.dataset.value > val);
    });
}

stars.forEach(s => {
    s.addEventListener('click', () => setRating(+s.dataset.value));
    s.addEventListener('mouseenter', () => {
        stars.forEach(x => {
            x.classList.toggle('text-yellow-300', +x.dataset.value <= +s.dataset.value);
            x.classList.toggle('text-gray-200',   +x.dataset.value > +s.dataset.value);
        });
    });
});

document.getElementById('star-rating').addEventListener('mouseleave', () => {
    setRating(+ratingIn.value);
});

// Preview foto
document.getElementById('photo-input')?.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        const img = document.getElementById('photo-preview');
        const ph  = document.getElementById('photo-placeholder');
        img.src = e.target.result;
        img.classList.remove('hidden');
        if (ph) ph.classList.add('hidden');
    };
    reader.readAsDataURL(file);
});
</script>
@endpush
@endsection