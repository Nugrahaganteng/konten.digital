@extends('layouts.admin')
@section('title', 'Pengaturan ' . strtoupper($group))

@section('content')
<div class="p-6 lg:p-8 max-w-5xl">

    {{-- ── Header ── --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="font-black text-2xl uppercase tracking-tight" style="font-family:'Unbounded',sans-serif">
                Pengaturan Konten
            </h1>
            <p class="text-sm text-gray-500 font-medium mt-1">Ubah isi website tanpa menyentuh kode.</p>
        </div>
    </div>

    {{-- ── Group Tabs ── --}}
    <div class="flex flex-wrap gap-2 mb-8">
        @php
        $groupLabels = [
            'hero'    => '🏠 Hero',
            'about'   => 'ℹ️ About',
            'contact' => '📞 Kontak',
            'footer'  => '🔻 Footer',
            'seo'     => '🔍 SEO',
            'social'  => '📱 Social Media',
        ];
        @endphp

        @foreach($allowedGroups as $g)
        <a href="{{ route('admin.cms.settings', $g) }}"
           class="px-4 py-2 font-black text-xs uppercase tracking-widest border-2 border-black transition-all
                  {{ $group === $g
                     ? 'bg-yellow-400 text-black shadow-[3px_3px_0_#000]'
                     : 'bg-white text-black/60 hover:bg-yellow-400/30 hover:shadow-[2px_2px_0_#000]' }}">
            {{ $groupLabels[$g] ?? strtoupper($g) }}
        </a>
        @endforeach
    </div>

    {{-- ── Form ── --}}
    <form action="{{ route('admin.cms.settings.update', $group) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="bg-white border-4 border-black shadow-[6px_6px_0_#000] overflow-hidden">

            {{-- Form Header --}}
            <div class="bg-purple-950 px-6 py-4 flex items-center gap-3">
                <span class="text-yellow-400 font-black text-sm uppercase tracking-widest"
                      style="font-family:'Unbounded',sans-serif">
                    {{ $groupLabels[$group] ?? strtoupper($group) }}
                </span>
                <div class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></div>
            </div>

            <div class="p-6 space-y-6">

                @forelse($settings as $key => $setting)
                <div class="border-b border-gray-100 pb-6 last:border-0 last:pb-0">

                    <label class="block font-black text-xs uppercase tracking-widest text-gray-700 mb-2">
                        {{ $setting->label ?? $key }}
                    </label>

                    @if($setting->type === 'textarea')
                        <textarea name="{{ $key }}"
                                  rows="4"
                                  class="w-full border-2 border-black px-4 py-3 font-medium text-sm
                                         focus:outline-none focus:border-yellow-400 bg-gray-50
                                         resize-y transition-colors">{{ old($key, $setting->value) }}</textarea>

                    @elseif($setting->type === 'image')
                        <div class="flex items-start gap-4">
                            {{-- Preview gambar saat ini --}}
                            @if($setting->value)
                            <div class="flex-shrink-0">
                                <img src="{{ asset('storage/' . $setting->value) }}"
                                     alt="Preview"
                                     class="w-24 h-24 object-cover border-4 border-black shadow-[4px_4px_0_#000]">
                                <p class="text-[10px] font-bold text-gray-400 uppercase mt-1 text-center">Saat ini</p>
                            </div>
                            @endif
                            <div class="flex-1">
                                <input type="file"
                                       name="{{ $key }}"
                                       accept="image/*"
                                       class="w-full border-2 border-black px-4 py-3 text-sm font-medium
                                              file:mr-4 file:py-2 file:px-4 file:border-2 file:border-black
                                              file:font-black file:text-xs file:uppercase file:tracking-widest
                                              file:bg-yellow-400 file:text-black file:cursor-pointer
                                              hover:file:bg-yellow-300 cursor-pointer bg-gray-50">
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP. Maks 2MB.</p>
                            </div>
                        </div>

                    @elseif($setting->type === 'boolean')
                        <div class="flex items-center gap-3">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="{{ $key }}" value="0">
                                <input type="checkbox"
                                       name="{{ $key }}"
                                       value="1"
                                       class="sr-only peer"
                                       {{ old($key, $setting->value) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 border-2 border-black peer-checked:bg-yellow-400
                                            after:content-[''] after:absolute after:top-[2px] after:start-[2px]
                                            after:bg-black after:border after:border-black after:h-5 after:w-5
                                            peer-checked:after:translate-x-full transition-all"></div>
                            </label>
                            <span class="text-sm font-bold text-gray-600">Aktif / Nonaktif</span>
                        </div>

                    @else
                        {{-- Default: text input --}}
                        <input type="text"
                               name="{{ $key }}"
                               value="{{ old($key, $setting->value) }}"
                               class="w-full border-2 border-black px-4 py-3 font-medium text-sm
                                      focus:outline-none focus:border-yellow-400 bg-gray-50 transition-colors">
                    @endif

                    @error($key)
                    <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                @empty
                <div class="text-center py-12 text-gray-400">
                    <p class="font-black text-lg">Belum ada pengaturan untuk grup ini.</p>
                    <p class="text-sm mt-2">Jalankan <code class="bg-gray-100 px-2 py-1 rounded">php artisan db:seed --class=CmsSeeder</code> terlebih dahulu.</p>
                </div>
                @endforelse
            </div>

            {{-- Submit --}}
            @if($settings->isNotEmpty())
            <div class="bg-gray-50 border-t-4 border-black px-6 py-4 flex items-center justify-between">
                <p class="text-xs text-gray-500 font-medium">
                    Perubahan akan langsung tampil di website setelah disimpan.
                </p>
                <button type="submit"
                        class="bg-yellow-400 text-black border-4 border-black font-black text-xs
                               uppercase tracking-widest px-8 py-3
                               shadow-[4px_4px_0_#000] hover:translate-x-1 hover:translate-y-1
                               hover:shadow-none transition-all">
                    ✓ SIMPAN PERUBAHAN
                </button>
            </div>
            @endif
        </div>

    </form>
</div>
@endsection