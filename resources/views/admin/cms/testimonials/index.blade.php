@extends('layouts.admin')
@section('title', 'CMS — Testimoni')

@section('content')
<div class="p-6 lg:p-8">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="font-black text-2xl uppercase tracking-tight" style="font-family:'Unbounded',sans-serif">Manajemen Testimoni</h1>
            <p class="text-sm text-gray-500 font-medium mt-1">Kelola testimoni pelanggan yang tampil di halaman utama.</p>
        </div>
        <a href="{{ route('admin.cms.testimonials.create') }}"
           class="bg-yellow-400 border-4 border-black font-black text-xs uppercase tracking-widest
                  px-6 py-3 shadow-[4px_4px_0_#000] hover:translate-x-1 hover:translate-y-1
                  hover:shadow-none transition-all whitespace-nowrap">
            + TAMBAH TESTIMONI
        </a>
    </div>

    {{-- Tabel --}}
    <div class="bg-white border-4 border-black shadow-[6px_6px_0_#000] overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-purple-950 text-yellow-400">
                    <th class="px-4 py-3 text-left font-black text-xs uppercase tracking-widest">Urutan</th>
                    <th class="px-4 py-3 text-left font-black text-xs uppercase tracking-widest">Foto</th>
                    <th class="px-4 py-3 text-left font-black text-xs uppercase tracking-widest">Nama / Posisi</th>
                    <th class="px-4 py-3 text-left font-black text-xs uppercase tracking-widest hidden md:table-cell">Isi Testimoni</th>
                    <th class="px-4 py-3 text-center font-black text-xs uppercase tracking-widest">Rating</th>
                    <th class="px-4 py-3 text-center font-black text-xs uppercase tracking-widest">Status</th>
                    <th class="px-4 py-3 text-center font-black text-xs uppercase tracking-widest">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y-2 divide-black/10">
                @forelse($testimonials as $testimonial)
                <tr class="hover:bg-yellow-400/10 transition-colors">
                    <td class="px-4 py-3">
                        <span class="font-black text-lg text-gray-300">{{ $testimonial->order }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <img src="{{ $testimonial->photo_url }}"
                             alt="{{ $testimonial->name }}"
                             class="w-12 h-12 object-cover border-2 border-black rounded-full">
                    </td>
                    <td class="px-4 py-3">
                        <p class="font-black text-sm">{{ $testimonial->name }}</p>
                        <p class="text-xs text-gray-400 font-medium mt-0.5">
                            {{ $testimonial->position }}{{ $testimonial->company ? ' — ' . $testimonial->company : '' }}
                        </p>
                    </td>
                    <td class="px-4 py-3 hidden md:table-cell">
                        <p class="text-xs text-gray-500 max-w-xs line-clamp-2">{{ $testimonial->content }}</p>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <span class="text-yellow-500 font-black text-sm tracking-tight">
                            {{ str_repeat('★', $testimonial->rating) }}<span class="text-gray-300">{{ str_repeat('★', 5 - $testimonial->rating) }}</span>
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center">
                        @if($testimonial->is_active)
                        <span class="inline-block bg-green-100 text-green-700 border border-green-400 font-black text-[10px] uppercase px-3 py-1">
                            AKTIF
                        </span>
                        @else
                        <span class="inline-block bg-red-100 text-red-700 border border-red-400 font-black text-[10px] uppercase px-3 py-1">
                            NONAKTIF
                        </span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.cms.testimonials.edit', $testimonial) }}"
                               class="bg-yellow-400 border-2 border-black font-black text-[10px] uppercase
                                      px-3 py-1.5 hover:shadow-[2px_2px_0_#000] transition-all">
                                EDIT
                            </a>
                            <form action="{{ route('admin.cms.testimonials.destroy', $testimonial) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus testimoni ini?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 text-white border-2 border-black font-black text-[10px] uppercase
                                               px-3 py-1.5 hover:shadow-[2px_2px_0_#000] transition-all">
                                    HAPUS
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-16 text-center text-gray-400">
                        <p class="font-black text-lg">Belum ada testimoni.</p>
                        <a href="{{ route('admin.cms.testimonials.create') }}" class="text-purple-600 underline text-sm mt-2 inline-block">+ Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection