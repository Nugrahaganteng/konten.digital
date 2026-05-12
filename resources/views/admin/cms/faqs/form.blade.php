@extends('layouts.admin')
@section('title', isset($faq->id) ? 'Edit FAQ' : 'Tambah FAQ')

@section('content')
<div class="p-6 lg:p-8">

    {{-- Header --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.cms.faqs.index') }}"
           class="bg-white border-4 border-black font-black text-xs uppercase tracking-widest
                  px-4 py-2.5 shadow-[4px_4px_0_#000] hover:translate-x-1 hover:translate-y-1
                  hover:shadow-none transition-all">
            ← KEMBALI
        </a>
        <div>
            <h1 class="font-black text-2xl uppercase tracking-tight" style="font-family:'Unbounded',sans-serif">
                {{ isset($faq->id) ? 'Edit FAQ' : 'Tambah FAQ' }}
            </h1>
            <p class="text-sm text-gray-500 font-medium mt-1">
                {{ isset($faq->id) ? 'Perbarui pertanyaan dan jawaban.' : 'Tambahkan FAQ baru ke halaman utama.' }}
            </p>
        </div>
    </div>

    <form action="{{ isset($faq->id) ? route('admin.cms.faqs.update', $faq) : route('admin.cms.faqs.store') }}"
          method="POST">
        @csrf
        @if(isset($faq->id)) @method('PUT') @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Kolom Kanan: Pengaturan --}}
            <div class="lg:col-span-1 lg:order-2">
                <div class="bg-white border-4 border-black shadow-[6px_6px_0_#000] p-6">
                    <p class="font-black text-xs uppercase tracking-widest mb-5">Pengaturan</p>

                    <div class="space-y-5">
                        <label class="block">
                            <span class="font-black text-xs uppercase tracking-widest text-gray-600 block mb-2">Kategori <span class="text-red-500">*</span></span>
                            <input type="text" name="category"
                                   value="{{ old('category', $faq->category ?? 'Umum') }}"
                                   placeholder="Contoh: Umum, Layanan, Pembayaran"
                                   list="category-list"
                                   class="w-full border-2 border-black px-3 py-2.5 font-medium text-sm focus:outline-none focus:border-yellow-400 @error('category') border-red-500 @enderror">
                            <datalist id="category-list">
                                <option value="Umum">
                                <option value="Layanan">
                                <option value="Pembayaran">
                                <option value="Teknis">
                            </datalist>
                            @error('category') <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </label>

                        <label class="block">
                            <span class="font-black text-xs uppercase tracking-widest text-gray-600 block mb-2">Urutan Tampil</span>
                            <input type="number" name="order" value="{{ old('order', $faq->order ?? 0) }}" min="0"
                                   class="w-full border-2 border-black px-3 py-2 font-bold text-sm focus:outline-none focus:border-yellow-400">
                            @error('order') <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </label>

                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1"
                                   {{ old('is_active', $faq->is_active ?? true) ? 'checked' : '' }}
                                   class="w-5 h-5 border-2 border-black accent-yellow-400">
                            <span class="font-black text-xs uppercase tracking-widest">Aktifkan</span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Kolom Kiri: Pertanyaan & Jawaban --}}
            <div class="lg:col-span-2 lg:order-1 space-y-6">
                <div class="bg-white border-4 border-black shadow-[6px_6px_0_#000] p-6">
                    <p class="font-black text-xs uppercase tracking-widest mb-5">Pertanyaan & Jawaban</p>

                    <div class="space-y-5">
                        <label class="block">
                            <span class="font-black text-xs uppercase tracking-widest text-gray-600 block mb-2">Pertanyaan <span class="text-red-500">*</span></span>
                            <input type="text" name="question"
                                   value="{{ old('question', $faq->question ?? '') }}"
                                   placeholder="Tuliskan pertanyaan yang sering diajukan..."
                                   class="w-full border-2 border-black px-3 py-2.5 font-medium text-sm focus:outline-none focus:border-yellow-400 @error('question') border-red-500 @enderror">
                            @error('question') <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </label>

                        <label class="block">
                            <span class="font-black text-xs uppercase tracking-widest text-gray-600 block mb-2">Jawaban <span class="text-red-500">*</span></span>
                            <textarea name="answer" rows="8"
                                      placeholder="Tuliskan jawaban yang jelas dan informatif..."
                                      class="w-full border-2 border-black px-3 py-2.5 font-medium text-sm focus:outline-none focus:border-yellow-400 resize-y @error('answer') border-red-500 @enderror">{{ old('answer', $faq->answer ?? '') }}</textarea>
                            @error('answer') <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </label>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.cms.faqs.index') }}"
                       class="bg-white border-4 border-black font-black text-xs uppercase tracking-widest
                              px-6 py-3 shadow-[4px_4px_0_#000] hover:translate-x-1 hover:translate-y-1
                              hover:shadow-none transition-all">
                        BATAL
                    </a>
                    <button type="submit"
                            class="bg-yellow-400 border-4 border-black font-black text-xs uppercase tracking-widest
                                   px-8 py-3 shadow-[4px_4px_0_#000] hover:translate-x-1 hover:translate-y-1
                                   hover:shadow-none transition-all">
                        {{ isset($faq->id) ? '✓ SIMPAN PERUBAHAN' : '+ TAMBAH FAQ' }}
                    </button>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection