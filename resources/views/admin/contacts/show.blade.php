@extends('layouts.admin')

@section('title', 'Detail Pesan')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
<style>.font-anton { font-family: 'Anton', sans-serif; }</style>
@endpush

@section('content')
<div class="p-6 max-w-4xl">
    <a href="{{ route('admin.contacts.index') }}" class="font-anton text-xs mb-4 inline-block hover:underline">← KEMBALI KE DAFTAR</a>
    
    <div class="bg-white border-4 border-[#0e0b14] shadow-[12px_12px_0_#0e0b14] p-8">
        <div class="flex justify-between items-start border-b-4 border-[#0e0b14] pb-6 mb-6">
            <div>
                <h2 class="font-anton text-4xl uppercase text-[#2d1b4e]">{{ $contact->name }}</h2>
                <p class="font-bold text-gray-500">{{ $contact->email }} | {{ $contact->whatsapp }}</p>
            </div>
            <div class="text-right">
                <p class="font-anton text-xs text-gray-400 uppercase">Tanggal Masuk</p>
                <p class="font-bold">{{ $contact->created_at->format('d F Y') }}</p>
            </div>
        </div>

        <div class="mb-8">
            <h3 class="font-anton text-lg uppercase mb-2 text-[#e8402a]">Layanan Yang Diminati:</h3>
            <div class="bg-yellow-100 border-2 border-[#0e0b14] p-3 font-black uppercase inline-block">
                {{ $contact->service }}
            </div>
        </div>

        <div class="mb-8">
            <h3 class="font-anton text-lg uppercase mb-2 text-[#e8402a]">Isi Pesan:</h3>
            <div class="bg-gray-50 border-2 border-[#0e0b14] p-6 font-bold leading-relaxed text-[#0e0b14]">
                {{ $contact->message }}
            </div>
        </div>

        <div class="pt-6 border-t-4 border-[#0e0b14] flex flex-wrap gap-4 items-center justify-between">
            <form action="{{ route('admin.contacts.updateStatus', $contact) }}" method="POST" class="flex items-center gap-3">
                @csrf @method('PATCH')
                <span class="font-anton text-xs uppercase">Update Status:</span>
                <select name="status" class="border-2 border-[#0e0b14] p-2 font-bold text-xs uppercase outline-none">
                    <option value="new" {{ $contact->status == 'new' ? 'selected' : '' }}>BARU</option>
                    <option value="in_progress" {{ $contact->status == 'in_progress' ? 'selected' : '' }}>PROSES</option>
                    <option value="resolved" {{ $contact->status == 'resolved' ? 'selected' : '' }}>SELESAI</option>
                </select>
                <button type="submit" class="bg-[#2d1b4e] text-[#f5c518] font-anton px-4 py-2 border-2 border-[#0e0b14] text-xs">UPDATE</button>
            </form>

            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Hapus pesan permanen?')">
                @csrf @method('DELETE')
                <button class="bg-[#e8402a] text-white font-anton px-4 py-2 border-2 border-[#0e0b14] text-xs shadow-[2px_2px_0_#0e0b14]">HAPUS PESAN</button>
            </form>
        </div>
    </div>
</div>
@endsection