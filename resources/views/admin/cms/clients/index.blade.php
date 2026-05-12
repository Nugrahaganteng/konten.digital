@extends('layouts.admin')
@section('title', 'CMS — Logo Klien')

@section('content')
<div class="p-6 lg:p-8">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="font-black text-2xl uppercase tracking-tight" style="font-family:'Unbounded',sans-serif">Logo Klien</h1>
            <p class="text-sm text-gray-500 font-medium mt-1">Kelola logo klien/partner yang tampil di halaman utama.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Form Tambah --}}
        <div class="lg:col-span-1">
            <div class="bg-white border-4 border-black shadow-[6px_6px_0_#000] p-6 sticky top-24">
                <p class="font-black text-xs uppercase tracking-widest mb-5">Tambah Logo Baru</p>

                <form action="{{ route('admin.cms.clients.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <label class="block">
                        <span class="font-black text-xs uppercase tracking-widest text-gray-600 block mb-2">Nama Klien <span class="text-red-500">*</span></span>
                        <input type="text" name="name" value="{{ old('name') }}"
                               placeholder="Contoh: PT Maju Bersama"
                               class="w-full border-2 border-black px-3 py-2.5 font-medium text-sm focus:outline-none focus:border-yellow-400 @error('name') border-red-500 @enderror">
                        @error('name') <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                    </label>

                    <label class="block">
                        <span class="font-black text-xs uppercase tracking-widest text-gray-600 block mb-2">Upload Logo <span class="text-red-500">*</span></span>

                        {{-- Preview area --}}
                        <div id="logo-preview-wrap"
                             class="w-full h-28 border-4 border-dashed border-black mb-3 flex items-center justify-center bg-gray-50 overflow-hidden">
                            <img id="logo-preview" src="" alt="Preview" class="max-h-24 max-w-full object-contain hidden">
                            <span id="logo-placeholder" class="text-gray-400 font-bold text-xs uppercase tracking-widest">Pilih gambar...</span>
                        </div>

                        <input type="file" name="logo" id="logo-input" accept="image/*"
                               class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-4
                                      file:border-2 file:border-black file:font-black file:text-xs
                                      file:uppercase file:bg-yellow-400 file:cursor-pointer cursor-pointer
                                      @error('logo') border-red-500 @enderror">
                        <p class="text-[10px] text-gray-400 mt-1.5">JPG, PNG, WEBP, SVG. Maks 1MB.</p>
                        @error('logo') <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                    </label>

                    <label class="block">
                        <span class="font-black text-xs uppercase tracking-widest text-gray-600 block mb-2">Website (opsional)</span>
                        <input type="url" name="website" value="{{ old('website') }}"
                               placeholder="https://example.com"
                               class="w-full border-2 border-black px-3 py-2.5 font-medium text-sm focus:outline-none focus:border-yellow-400 @error('website') border-red-500 @enderror">
                        @error('website') <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                    </label>

                    <label class="block">
                        <span class="font-black text-xs uppercase tracking-widest text-gray-600 block mb-2">Urutan Tampil</span>
                        <input type="number" name="order" value="{{ old('order', 0) }}" min="0"
                               class="w-full border-2 border-black px-3 py-2 font-bold text-sm focus:outline-none focus:border-yellow-400">
                    </label>

                    <button type="submit"
                            class="w-full bg-yellow-400 border-4 border-black font-black text-xs uppercase tracking-widest
                                   px-6 py-3 shadow-[4px_4px_0_#000] hover:translate-x-1 hover:translate-y-1
                                   hover:shadow-none transition-all">
                        + TAMBAH LOGO
                    </button>
                </form>
            </div>
        </div>

        {{-- Daftar Logo --}}
        <div class="lg:col-span-2">
            <div class="bg-white border-4 border-black shadow-[6px_6px_0_#000] overflow-hidden">
                <div class="bg-purple-950 text-yellow-400 px-5 py-3">
                    <p class="font-black text-xs uppercase tracking-widest">Daftar Logo ({{ $clients->count() }})</p>
                </div>

                @if($clients->isEmpty())
                <div class="px-6 py-16 text-center text-gray-400">
                    <p class="font-black text-lg">Belum ada logo klien.</p>
                    <p class="text-sm mt-1">Tambahkan melalui form di sebelah kiri.</p>
                </div>
                @else
                <div class="divide-y-2 divide-black/10">
                    @foreach($clients as $client)
                    <div class="flex items-center gap-4 px-5 py-4 hover:bg-yellow-400/10 transition-colors">

                        {{-- Logo --}}
                        <div class="w-20 h-14 border-2 border-black bg-gray-50 flex items-center justify-center shrink-0 overflow-hidden p-1">
                            <img src="{{ $client->logo_url }}" alt="{{ $client->name }}"
                                 class="max-h-full max-w-full object-contain">
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <p class="font-black text-sm truncate">{{ $client->name }}</p>
                            @if($client->website)
                            <a href="{{ $client->website }}" target="_blank"
                               class="text-xs text-purple-600 hover:underline truncate block mt-0.5">
                                {{ $client->website }}
                            </a>
                            @endif
                            <p class="text-[10px] text-gray-400 font-bold mt-1">URUTAN: {{ $client->order }}</p>
                        </div>

                        {{-- Status & Aksi --}}
                        <div class="flex items-center gap-2 shrink-0">
                            {{-- Toggle aktif --}}
                            <form action="{{ route('admin.cms.clients.toggle', $client) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit"
                                        class="{{ $client->is_active
                                            ? 'bg-green-100 text-green-700 border-green-400'
                                            : 'bg-gray-100 text-gray-500 border-gray-300' }}
                                               border-2 font-black text-[10px] uppercase px-3 py-1.5 hover:opacity-80 transition-all">
                                    {{ $client->is_active ? 'AKTIF' : 'NONAKTIF' }}
                                </button>
                            </form>

                            {{-- Hapus --}}
                            <form action="{{ route('admin.cms.clients.destroy', $client) }}" method="POST"
                                  onsubmit="return confirm('Hapus logo {{ $client->name }}?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 text-white border-2 border-black font-black text-[10px] uppercase
                                               px-3 py-1.5 hover:shadow-[2px_2px_0_#000] transition-all">
                                    HAPUS
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
document.getElementById('logo-input')?.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        const img = document.getElementById('logo-preview');
        const ph  = document.getElementById('logo-placeholder');
        img.src = e.target.result;
        img.classList.remove('hidden');
        ph.classList.add('hidden');
    };
    reader.readAsDataURL(file);
});
</script>
@endpush
@endsection