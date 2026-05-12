<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageSectionController extends Controller
{
    /**
     * Daftar section untuk satu halaman.
     */
    public function index(string $page = 'home')
    {
        $sections      = PageSection::forPage($page)->ordered()->get();
        $schema        = PageSection::schema();
        $availablePages = array_keys($schema);

        // Jika section belum ada di DB, seed otomatis dari schema
        if ($sections->isEmpty()) {
            $this->seedPage($page, $schema[$page] ?? []);
            $sections = PageSection::forPage($page)->ordered()->get();
        }

        return view('admin.cms.page-sections.index', compact('sections', 'page', 'availablePages'));
    }

    /**
     * Form edit satu section.
     */
    public function edit(PageSection $pageSection)
    {
        $fields = $pageSection->getFields();
        return view('admin.cms.page-sections.form', [
            'section' => $pageSection,
            'fields'  => $fields,
        ]);
    }

    /**
     * Simpan perubahan section.
     */
    public function update(Request $request, PageSection $pageSection)
    {
        $fields  = $pageSection->getFields();
        $content = $pageSection->content ?? [];

        foreach ($fields as $field) {
            $key = $field['key'];

            if ($field['type'] === 'image') {
                if ($request->hasFile($key)) {
                    // Hapus gambar lama
                    $old = $content[$key] ?? null;
                    if ($old && Storage::disk('public')->exists($old)) {
                        Storage::disk('public')->delete($old);
                    }
                    $content[$key] = $request->file($key)->store('page-sections', 'public');
                }
                // Jika tidak upload baru, biarkan nilai lama
            } else {
                $content[$key] = $request->input($key);
            }
        }

        $pageSection->update([
            'content'   => $content,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.cms.page-sections.index', ['page' => $pageSection->page])
            ->with('success', "Section \"{$pageSection->label}\" berhasil diperbarui!");
    }

    /**
     * Toggle aktif/nonaktif section.
     */
    public function toggleActive(PageSection $pageSection)
    {
        $pageSection->update(['is_active' => ! $pageSection->is_active]);
        return back()->with('success', 'Status section diperbarui.');
    }

    /**
     * Update urutan via AJAX drag & drop.
     */
    public function reorder(Request $request)
    {
        $request->validate(['order' => 'required|array']);
        foreach ($request->order as $position => $id) {
            PageSection::where('id', $id)->update(['order' => $position + 1]);
        }
        return response()->json(['success' => true]);
    }

    // ── Private ──────────────────────────────────────────────────────────

    private function seedPage(string $page, array $pageSections): void
    {
        $order = 1;
        foreach ($pageSections as $sectionKey => $config) {
            PageSection::firstOrCreate(
                ['page' => $page, 'section_key' => $sectionKey],
                [
                    'label'     => $config['label'],
                    'order'     => $order++,
                    'is_active' => true,
                    'content'   => collect($config['fields'])
                        ->mapWithKeys(fn($f) => [$f['key'] => $f['placeholder'] ?? ''])
                        ->all(),
                ]
            );
        }
    }
}