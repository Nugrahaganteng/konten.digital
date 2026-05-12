@extends('layouts.admin.app')

@section('title', 'CMS Halaman')

@section('content')
<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6 flex-wrap gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">CMS Halaman</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola konten section per halaman tanpa ubah kode.</p>
        </div>

        {{-- Page Switcher --}}
        <div class="flex items-center gap-2 flex-wrap">
            @foreach ($availablePages as $p)
                <a href="{{ route('admin.cms.page-sections.index', ['page' => $p]) }}"
                   class="px-4 py-2 text-sm font-medium rounded-lg capitalize transition
                          {{ $p === $page
                              ? 'bg-blue-600 text-white shadow-sm'
                              : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">
                    {{ ucfirst(str_replace('-', ' ', $p)) }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- Flash --}}
    @if (session('success'))
        <div class="mb-4 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-lg">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Section Cards --}}
    <div id="sortable-sections" class="space-y-3">
        @forelse ($sections as $section)
            <div class="bg-white border border-gray-100 rounded-xl shadow-sm flex items-center gap-4 px-5 py-4 hover:shadow-md transition"
                 data-id="{{ $section->id }}">

                {{-- Drag Handle --}}
                <div class="cursor-grab text-gray-300 hover:text-gray-500 shrink-0">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm8-12a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
                    </svg>
                </div>

                {{-- Order Badge --}}
                <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 text-xs font-bold flex items-center justify-center shrink-0">
                    {{ $section->order }}
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-gray-800">{{ $section->label }}</p>
                    <p class="text-xs text-gray-400 mt-0.5 font-mono">{{ $section->page }} / {{ $section->section_key }}</p>
                </div>

                {{-- Field Count --}}
                <div class="text-xs text-gray-400 shrink-0">
                    {{ count($section->getFields()) }} field
                </div>

                {{-- Status Toggle --}}
                <form action="{{ route('admin.cms.page-sections.toggle', $section) }}" method="POST" class="shrink-0">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium transition
                                   {{ $section->is_active
                                       ? 'bg-green-100 text-green-700 hover:bg-green-200'
                                       : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                        <span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $section->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                        {{ $section->is_active ? 'Aktif' : 'Nonaktif' }}
                    </button>
                </form>

                {{-- Edit --}}
                <a href="{{ route('admin.cms.page-sections.edit', $section) }}"
                   class="shrink-0 inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 hover:text-blue-800
                          border border-blue-200 hover:bg-blue-50 px-4 py-2 rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                    </svg>
                    Edit Konten
                </a>
            </div>
        @empty
            <div class="flex flex-col items-center justify-center py-16 text-gray-400 bg-white rounded-xl border border-gray-100">
                <svg class="w-12 h-12 mb-3 opacity-40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                </svg>
                <p class="text-sm">Tidak ada section ditemukan untuk halaman ini.</p>
            </div>
        @endforelse
    </div>

    <p class="mt-4 text-xs text-gray-400">
        Seret card untuk mengubah urutan section di halaman. Tersimpan otomatis.
    </p>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
    const el = document.getElementById('sortable-sections');
    if (el) {
        Sortable.create(el, {
            animation: 150,
            ghostClass: 'opacity-50',
            handle: '.cursor-grab',
            onEnd() {
                const order = [...el.querySelectorAll('[data-id]')].map(el => el.dataset.id);
                fetch('{{ route('admin.cms.page-sections.reorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ order }),
                }).catch(err => console.error('Reorder error', err));
            }
        });
    }
</script>
@endpush