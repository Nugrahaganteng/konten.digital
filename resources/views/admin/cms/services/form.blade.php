@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-2xl mx-auto">

    {{-- Breadcrumb --}}
    <div class="mb-6">
        <nav class="text-sm text-gray-400 mb-1">
            <a href="{{ route('admin.cms.page-sections.index') }}" class="hover:text-blue-600 transition">CMS Halaman</a>
            <span class="mx-2">/</span>
            <a href="{{ route('admin.cms.page-sections.index', ['page' => $section->page]) }}"
               class="hover:text-blue-600 transition capitalize">{{ ucfirst($section->page) }}</a>
            <span class="mx-2">/</span>
            <span class="text-gray-600">{{ $section->label }}</span>
        </nav>
        <h1 class="text-2xl font-bold text-gray-800">{{ $section->label }}</h1>
        <p class="text-sm text-gray-400 font-mono mt-0.5">{{ $section->page }} / {{ $section->section_key }}</p>
    </div>

    {{-- Form --}}
    <form action="{{ route('admin.cms.page-sections.update', $section) }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Dynamic Fields --}}
        <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-6 space-y-5">

            @forelse ($fields as $field)
                @php $value = $section->get($field['key'], ''); @endphp

                <div>
                    <label for="{{ $field['key'] }}"
                           class="block text-sm font-medium text-gray-700 mb-1">
                        {{ $field['label'] }}
                    </label>

                    {{-- TEXT --}}
                    @if ($field['type'] === 'text')
                        <input type="text"
                               id="{{ $field['key'] }}"
                               name="{{ $field['key'] }}"
                               value="{{ old($field['key'], $value) }}"
                               placeholder="{{ $field['placeholder'] ?? '' }}"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                                      focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">

                    {{-- TEXTAREA --}}
                    @elseif ($field['type'] === 'textarea')
                        <textarea id="{{ $field['key'] }}"
                                  name="{{ $field['key'] }}"
                                  rows="4"
                                  placeholder="{{ $field['placeholder'] ?? '' }}"
                                  class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                                         focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old($field['key'], $value) }}</textarea>

                    {{-- COLOR --}}
                    @elseif ($field['type'] === 'color')
                        <div class="flex items-center gap-3">
                            <input type="color"
                                   id="{{ $field['key'] }}"
                                   name="{{ $field['key'] }}"
                                   value="{{ old($field['key'], $value ?: ($field['placeholder'] ?? '#000000')) }}"
                                   class="w-12 h-10 rounded-lg border border-gray-300 cursor-pointer p-0.5">
                            <input type="text"
                                   id="{{ $field['key'] }}_text"
                                   value="{{ old($field['key'], $value ?: ($field['placeholder'] ?? '#000000')) }}"
                                   placeholder="{{ $field['placeholder'] ?? '#000000' }}"
                                   class="w-36 rounded-lg border border-gray-300 px-3 py-2 text-sm font-mono
                                          focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   oninput="document.getElementById('{{ $field['key'] }}').value = this.value">
                            <script>
                                document.getElementById('{{ $field['key'] }}')
                                    .addEventListener('input', function () {
                                        document.getElementById('{{ $field['key'] }}_text').value = this.value;
                                    });
                            </script>
                        </div>

                    {{-- IMAGE --}}
                    @elseif ($field['type'] === 'image')
                        @if ($value)
                            <div class="mb-3">
                                <img src="{{ Storage::url($value) }}"
                                     alt="{{ $field['label'] }}"
                                     class="h-28 w-auto rounded-lg border border-gray-200 object-contain bg-gray-50"
                                     id="preview_{{ $field['key'] }}">
                                <p class="text-xs text-gray-400 mt-1">Gambar saat ini. Upload baru untuk mengganti.</p>
                            </div>
                        @else
                            <img src="" alt="" id="preview_{{ $field['key'] }}"
                                 class="hidden h-28 w-auto rounded-lg border border-gray-200 object-contain bg-gray-50 mb-3">
                        @endif

                        <input type="file"
                               id="{{ $field['key'] }}"
                               name="{{ $field['key'] }}"
                               accept="image/*"
                               class="block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-lg file:border-0
                                      file:text-sm file:font-medium
                                      file:bg-blue-50 file:text-blue-700
                                      hover:file:bg-blue-100 transition"
                               onchange="previewImage(this, 'preview_{{ $field['key'] }}')">
                    @endif
                </div>

            @empty
                <p class="text-sm text-gray-400">Tidak ada field untuk section ini.</p>
            @endforelse

            {{-- Divider --}}
            <div class="border-t border-gray-100 pt-4">
                <div class="flex items-center gap-3">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" id="is_active" name="is_active" value="1"
                               class="sr-only peer"
                               {{ $section->is_active ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 rounded-full peer
                                    peer-checked:bg-blue-600
                                    peer-checked:after:translate-x-full
                                    after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                    after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all
                                    peer-focus:ring-2 peer-focus:ring-blue-500"></div>
                    </label>
                    <label for="is_active" class="text-sm text-gray-700 cursor-pointer">
                        Section aktif (tampil di website)
                    </label>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.cms.page-sections.index', ['page' => $section->page]) }}"
               class="px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit"
                    class="px-5 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition">
                Simpan Perubahan
            </button>
        </div>
    </form>

</div>
@endsection

@push('scripts')
<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (!input.files.length || !preview) return;
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>
@endpush