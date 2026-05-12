@extends('layouts.admin')
@section('title', 'CMS — FAQ')

@section('content')
<div class="p-6 lg:p-8">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="font-black text-2xl uppercase tracking-tight" style="font-family:'Unbounded',sans-serif">Manajemen FAQ</h1>
            <p class="text-sm text-gray-500 font-medium mt-1">Kelola pertanyaan yang sering diajukan di halaman utama.</p>
        </div>
        <a href="{{ route('admin.cms.faqs.create') }}"
           class="bg-yellow-400 border-4 border-black font-black text-xs uppercase tracking-widest
                  px-6 py-3 shadow-[4px_4px_0_#000] hover:translate-x-1 hover:translate-y-1
                  hover:shadow-none transition-all whitespace-nowrap">
            + TAMBAH FAQ
        </a>
    </div>

    {{-- Per kategori --}}
    @forelse($faqs as $category => $items)
    <div class="mb-8">
        {{-- Label Kategori --}}
        <div class="flex items-center gap-3 mb-3">
            <span class="bg-purple-950 text-yellow-400 font-black text-[10px] uppercase tracking-widest px-4 py-1.5 border-2 border-black">
                {{ $category ?: 'Umum' }}
            </span>
            <span class="text-xs text-gray-400 font-bold">{{ $items->count() }} pertanyaan</span>
        </div>

        <div class="bg-white border-4 border-black shadow-[6px_6px_0_#000] overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-purple-950 text-yellow-400">
                        <th class="px-4 py-3 text-left font-black text-xs uppercase tracking-widest w-10">No</th>
                        <th class="px-4 py-3 text-left font-black text-xs uppercase tracking-widest">Pertanyaan</th>
                        <th class="px-4 py-3 text-left font-black text-xs uppercase tracking-widest hidden md:table-cell">Jawaban</th>
                        <th class="px-4 py-3 text-center font-black text-xs uppercase tracking-widest">Status</th>
                        <th class="px-4 py-3 text-center font-black text-xs uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-black/10">
                    @foreach($items as $faq)
                    <tr class="hover:bg-yellow-400/10 transition-colors">
                        <td class="px-4 py-3">
                            <span class="font-black text-lg text-gray-300">{{ $faq->order }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <p class="font-bold text-sm max-w-xs">{{ $faq->question }}</p>
                        </td>
                        <td class="px-4 py-3 hidden md:table-cell">
                            <p class="text-xs text-gray-500 max-w-sm line-clamp-2">{{ $faq->answer }}</p>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($faq->is_active)
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
                                <a href="{{ route('admin.cms.faqs.edit', $faq) }}"
                                   class="bg-yellow-400 border-2 border-black font-black text-[10px] uppercase
                                          px-3 py-1.5 hover:shadow-[2px_2px_0_#000] transition-all">
                                    EDIT
                                </a>
                                <form action="{{ route('admin.cms.faqs.destroy', $faq) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus FAQ ini?')">
                                    @csrf @method('DELETE')
                                    <button class="bg-red-500 text-white border-2 border-black font-black text-[10px] uppercase
                                                   px-3 py-1.5 hover:shadow-[2px_2px_0_#000] transition-all">
                                        HAPUS
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @empty
    <div class="bg-white border-4 border-black shadow-[6px_6px_0_#000] px-6 py-16 text-center text-gray-400">
        <p class="font-black text-lg">Belum ada FAQ.</p>
        <a href="{{ route('admin.cms.faqs.create') }}" class="text-purple-600 underline text-sm mt-2 inline-block">+ Tambah sekarang</a>
    </div>
    @endforelse

</div>
@endsection