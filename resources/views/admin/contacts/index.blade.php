@extends('layouts.admin')

@section('title', 'Manajemen Kontak')

@push('styles')
<style>
    :root {
        --neo-border: 4px solid #000;
        --neo-shadow: 6px 6px 0px #000;
        --neo-shadow-sm: 4px 4px 0px #000;
    }

    /* Tab Style */
    .ftab { 
        padding: 1rem; 
        font-family: 'Unbounded', sans-serif; 
        font-weight: 900;
        text-decoration: none; 
        color: #000; 
        border-right: 4px solid #000; 
        flex: 1; 
        text-align: center; 
        font-size: 0.7rem; 
        transition: all 0.2s;
    }
    .ftab:last-child { border-right: none; }
    .ftab.active { background: #FFD200; color: #000; }
    .ftab:hover:not(.active) { background: #f3f4f6; }

    /* Button Style */
    .btn-neo { 
        font-family: 'Unbounded', sans-serif; 
        font-weight: 900; 
        font-size: 0.65rem; 
        padding: 0.5rem 1rem; 
        border: 3px solid #000; 
        box-shadow: 3px 3px 0 #000; 
        text-transform: uppercase;
        transition: all 0.1s;
    }
    .btn-neo:active { transform: translate(2px, 2px); box-shadow: 1px 1px 0 #000; }

    /* Input Style */
    .neo-input {
        border: 4px solid #000;
        box-shadow: 4px 4px 0px #000;
        outline: none;
    }
    .neo-input:focus { border-color: #300066; }
</style>
@endpush

@section('content')
<div class="p-8">
    {{-- Header Section --}}
    <div class="mb-8">
        <h1 class="font-black text-3xl uppercase tracking-tighter text-black leading-none" style="font-family:'Unbounded',sans-serif">Manajemen Pesan</h1>
        <p class="text-[0.65rem] font-bold text-gray-400 uppercase tracking-widest mt-1">KontenDigital / Admin / Contacts</p>
    </div>

    {{-- Tabs Navigation --}}
    <div class="flex border-4 border-black mb-8 bg-white shadow-[6px_6px_0_#000] overflow-hidden">
        <a href="{{ route('admin.contacts.index') }}" class="ftab {{ !request('status') ? 'active' : '' }}">
            SEMUA <span class="ml-1 opacity-50">({{ $counts['all'] }})</span>
        </a>
        <a href="{{ route('admin.contacts.index', ['status'=>'new']) }}" class="ftab {{ request('status')==='new' ? 'active' : '' }}">
            BARU <span class="ml-1 opacity-50">({{ $counts['new'] }})</span>
        </a>
        <a href="{{ route('admin.contacts.index', ['status'=>'resolved']) }}" class="ftab {{ request('status')==='resolved' ? 'active' : '' }}">
            SELESAI <span class="ml-1 opacity-50">({{ $counts['resolved'] }})</span>
        </a>
    </div>

    {{-- Search Bar --}}
    <form action="{{ route('admin.contacts.index') }}" method="GET" class="flex gap-4 mb-10">
        <input type="text" name="search" class="neo-input flex-1 p-4 font-bold text-sm" placeholder="Cari nama, email, atau layanan..." value="{{ request('search') }}">
        <button type="submit" class="btn-neo bg-[#300066] text-[#FFD200] px-10 text-sm">CARI</button>
    </form>

    {{-- Table Section --}}
    <div class="bg-white border-4 border-black shadow-[8px_8px_0px_0px_#000] overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-[#1a1033] text-white border-b-4 border-black">
                <tr class="text-[0.65rem] font-black uppercase tracking-[0.2em]">
                    <th class="p-5 border-r-2 border-white/10 text-left">Pengirim</th>
                    <th class="p-5 border-r-2 border-white/10 text-left">Layanan</th>
                    <th class="p-5 border-r-2 border-white/10 text-left">Status</th>
                    <th class="p-5 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="font-bold text-sm">
                @forelse($submissions as $contact)
                <tr class="border-b-4 border-black hover:bg-gray-50 transition-colors">
                    <td class="p-5 border-r-4 border-black">
                        <div class="text-black uppercase font-black tracking-tight">{{ $contact->name }}</div>
                        <div class="text-[0.6rem] text-gray-400 mt-0.5">{{ $contact->email }}</div>
                    </td>
                    <td class="p-5 border-r-4 border-black">
                        <span class="bg-gray-100 border-2 border-black px-2 py-1 text-[0.6rem] uppercase font-black">
                            {{ $contact->service }}
                        </span>
                    </td>
                    <td class="p-5 border-r-4 border-black">
                        <span class="border-2 border-black px-3 py-1 font-black text-[0.6rem] uppercase {{ $contact->status == 'new' ? 'bg-red-400' : 'bg-emerald-400' }}">
                            {{ $contact->status }}
                        </span>
                    </td>
                    <td class="p-5">
                        <div class="flex justify-center gap-3">
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="btn-neo bg-yellow-400 text-black">DETAIL</a>
                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-neo bg-red-500 text-white">HAPUS</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-20 text-center">
                        <p class="font-black text-gray-300 uppercase italic text-xl tracking-tighter">Tidak Ada Pesan Masuk</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination Custom (Jika Ada) --}}
    @if(method_exists($submissions, 'links'))
    <div class="mt-10">
        {{ $submissions->links() }}
    </div>
    @endif
</div>
@endsection