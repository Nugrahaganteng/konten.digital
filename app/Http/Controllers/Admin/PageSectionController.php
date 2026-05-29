<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use App\Models\PageSectionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageSectionController extends Controller
{
    private array $availablePages = [
        'home', 'about', 'contact', 'cara-order', 'syarat-ketentuan',
        'layanan-press-release', 'layanan-backlink', 'layanan-press-conference',
        'layanan-penulisan-artikel', 'layanan-script-video',
        'layanan-pelatihan-konten', 'footer',
        'services-navbar',
    ];

    // ── Index ────────────────────────────────────────────────────────

    public function index(Request $request, string $page = 'home')
    {
        if (!in_array($page, $this->availablePages)) {
            $page = 'home';
        }

        $this->seedMissingSection($page);

        $sections = PageSection::forPage($page)->ordered()->get();

        $historyCounts = PageSectionHistory::whereIn('page_section_id', $sections->pluck('id'))
            ->selectRaw('page_section_id, count(*) as total')
            ->groupBy('page_section_id')
            ->pluck('total', 'page_section_id');

        return view('admin.cms.page-sections.index', [
            'sections'       => $sections,
            'page'           => $page,
            'availablePages' => $this->availablePages,
            'historyCounts'  => $historyCounts,
        ]);
    }

    // ── Edit ─────────────────────────────────────────────────────────

    public function edit(PageSection $pageSection)
    {
        $fields    = $pageSection->getFields();
        $histories = PageSectionHistory::where('page_section_id', $pageSection->id)
            ->orderByDesc('saved_at')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return view('admin.cms.page-sections.form', [
            'section'   => $pageSection,
            'fields'    => $fields,
            'histories' => $histories,
        ]);
    }

    // ── Update ───────────────────────────────────────────────────────

    public function update(Request $request, PageSection $pageSection)
    {
        // Simpan snapshot sebelum update
        PageSectionHistory::snapshot($pageSection, 5);

        $fields  = $pageSection->getFields();
        $content = $pageSection->content ?? [];

        foreach ($fields as $field) {
            $key  = $field['key'];
            $type = $field['type'];

            if ($type === 'image') {
                if ($request->hasFile($key) && $request->file($key)->isValid()) {
                    // Hapus file lama jika ada
                    if (!empty($content[$key])) {
                        Storage::disk('public')->delete($content[$key]);
                    }
                    $content[$key] = $request->file($key)
                        ->store('sections/' . $pageSection->page, 'public');
                }
                // Jika tidak ada file baru, biarkan nilai lama
            } else {
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

    // ── Toggle Hidden Field ──────────────────────────────────────────
    // Route: PATCH /cms/page-sections/section/{pageSection}/toggle-field

    public function toggleField(Request $request, PageSection $pageSection)
    {
        $request->validate(['field_key' => 'required|string']);

        $key    = $request->input('field_key');
        $hidden = $pageSection->hidden_fields ?? [];

        // ── Validasi field_key ───────────────────────────────────────
        // Prioritas 1: cek di schema (getFields)
        // Prioritas 2: jika schema kosong/tidak ada, fallback ke keys yang
        //              ada di content — ini menangani section lama / section
        //              yang belum terdaftar di schema tapi sudah ada di DB.
        $schemaFields = $pageSection->getFields();

        if (!empty($schemaFields)) {
            // Schema tersedia → validasi ketat dari schema
            $validKeys = array_column($schemaFields, 'key');
            if (!in_array($key, $validKeys)) {
                return response()->json([
                    'error'   => 'Field tidak valid: ' . $key,
                    'success' => false,
                ], 422);
            }
        } else {
            // Schema kosong (section legacy / belum di-schema-kan)
            // → validasi longgar: field harus ada di content ATAU string valid
            $contentKeys = array_keys($pageSection->content ?? []);
            // Izinkan toggle selama key adalah string non-empty yang valid
            // (tidak mengandung karakter berbahaya)
            if (empty($key) || !preg_match('/^[a-zA-Z0-9_\-]+$/', $key)) {
                return response()->json([
                    'error'   => 'Field key tidak valid',
                    'success' => false,
                ], 422);
            }
            // Jika key tidak ada di content sama sekali, tetap izinkan
            // (admin mungkin ingin pre-hide field yang belum diisi)
        }

        if (in_array($key, $hidden)) {
            // Aktifkan kembali — hapus dari array hidden
            $hidden   = array_values(array_diff($hidden, [$key]));
            $isHidden = false;
        } else {
            // Sembunyikan — tambah ke array hidden
            $hidden[] = $key;
            $isHidden = true;
        }

        $pageSection->update(['hidden_fields' => $hidden]);

        return response()->json([
            'success'      => true,
            'is_hidden'    => $isHidden,
            'field_key'    => $key,
            'hidden_count' => count($hidden),
        ]);
    }

    // ── Restore ──────────────────────────────────────────────────────

    public function restore(PageSection $pageSection, PageSectionHistory $history)
    {
        if ($history->page_section_id !== $pageSection->id) {
            abort(403, 'History tidak milik section ini.');
        }

        // Snapshot versi saat ini sebelum di-restore
        PageSectionHistory::snapshot($pageSection, 5);

        $pageSection->update([
            'content'   => $history->content,
            'is_active' => $history->is_active,
        ]);

        return redirect()
            ->route('admin.cms.page-sections.edit', $pageSection)
            ->with('success', 'Section berhasil dikembalikan ke versi ' . $history->saved_at->format('d M Y, H:i') . '!');
    }

    // ── Histories (AJAX) ─────────────────────────────────────────────

    public function histories(PageSection $pageSection)
    {
        $fields    = $pageSection->getFields();
        $histories = PageSectionHistory::where('page_section_id', $pageSection->id)
            ->orderByDesc('saved_at')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return response()->json([
            'section' => [
                'id'          => $pageSection->id,
                'label'       => $pageSection->label,
                'section_key' => $pageSection->section_key,
                'page'        => $pageSection->page,
            ],
            'histories' => $histories->map(function ($h) use ($fields) {
                $preview = [];
                foreach (array_slice($fields, 0, 3) as $field) {
                    $val = $h->content[$field['key']] ?? null;
                    if ($val && !in_array($field['type'], ['image', 'color'])) {
                        $preview[] = [
                            'label' => $field['label'],
                            'value' => mb_substr(strip_tags($val), 0, 50),
                        ];
                    }
                }
                return [
                    'id'         => $h->id,
                    'saved_at'   => $h->saved_at->format('d M Y, H:i:s'),
                    'saved_diff' => $h->saved_at->diffForHumans(),
                    'is_active'  => $h->is_active,
                    'preview'    => $preview,
                ];
            }),
        ]);
    }

    // ── Toggle Active ────────────────────────────────────────────────

    public function toggleActive(PageSection $pageSection)
    {
        $pageSection->update(['is_active' => !$pageSection->is_active]);
        return back()->with('success', 'Status section "' . $pageSection->label . '" berhasil diubah.');
    }

    // ── Reorder ──────────────────────────────────────────────────────

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

    // ── Seed Missing ─────────────────────────────────────────────────

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
                    'page'          => $page,
                    'section_key'   => $sectionKey,
                    'label'         => $sectionDef['label'],
                    'order'         => $order,
                    'is_active'     => true,
                    'content'       => [],
                    'hidden_fields' => [],
                ]);
            }
        }
    }
}