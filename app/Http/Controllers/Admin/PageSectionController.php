<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageSectionController extends Controller
{
    private array $availablePages = [
        'home',
        'about',
        'contact',
        'cara-order',
        'syarat-ketentuan',
        'layanan-press-release',
        'layanan-backlink',
        'layanan-press-conference',
        'layanan-penulisan-artikel',
        'layanan-script-video',
        'layanan-pelatihan-konten',
    ];

    public function index(Request $request, string $page = 'home')
    {
        if (!in_array($page, $this->availablePages)) {
            $page = 'home';
        }

        $this->seedMissingSection($page);

        $sections = PageSection::forPage($page)->ordered()->get();

        // view: resources/views/admin/cms/page-sections/index.blade.php
        return view('admin.cms.page-sections.index', [
            'sections'       => $sections,
            'page'           => $page,
            'availablePages' => $this->availablePages,
        ]);
    }

    public function edit(PageSection $pageSection)
    {
        $fields = $pageSection->getFields();

        // view: resources/views/admin/cms/page-sections/form.blade.php
        return view('admin.cms.page-sections.form', [
            'section' => $pageSection,
            'fields'  => $fields,
        ]);
    }

    public function update(Request $request, PageSection $pageSection)
    {
        $fields  = $pageSection->getFields();
        $content = $pageSection->content ?? [];

        foreach ($fields as $field) {
            $key  = $field['key'];
            $type = $field['type'];

            if ($type === 'image') {
                if ($request->hasFile($key) && $request->file($key)->isValid()) {
                    if (!empty($content[$key])) {
                        Storage::disk('public')->delete($content[$key]);
                    }
                    $content[$key] = $request->file($key)
                        ->store('sections/' . $pageSection->page, 'public');
                }
                // tidak ada file baru → nilai lama tetap
            } else {
                // text, textarea, color, termasuk maps_embed & maps_url
                $content[$key] = $request->input($key, '');
            }
        }

        $pageSection->update([
            'content'   => $content,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.cms.page-sections.edit', $pageSection)
            ->with('success', 'Section "' . $pageSection->label . '" berhasil diperbarui!');
    }

    public function toggleActive(PageSection $pageSection)
    {
        $pageSection->update(['is_active' => !$pageSection->is_active]);
        return back()->with('success', 'Status section berhasil diubah.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:page_sections,id',
        ]);

        foreach ($request->order as $position => $id) {
            PageSection::where('id', $id)->update(['order' => $position + 1]);
        }

        return response()->json(['success' => true]);
    }

    private function seedMissingSection(string $page): void
    {
        $schema = PageSection::schema();
        if (!isset($schema[$page])) return;

        $existing = PageSection::forPage($page)->pluck('section_key')->toArray();
        $order    = PageSection::forPage($page)->max('order') ?? 0;

        foreach ($schema[$page] as $sectionKey => $sectionDef) {
            if (!in_array($sectionKey, $existing)) {
                $order++;
                PageSection::create([
                    'page'        => $page,
                    'section_key' => $sectionKey,
                    'label'       => $sectionDef['label'],
                    'order'       => $order,
                    'is_active'   => true,
                    'content'     => [],
                ]);
            }
        }
    }
}