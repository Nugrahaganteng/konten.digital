<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSectionHistory extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'page_section_id',
        'content',
        'hidden_fields',
        'is_active',
        'saved_at',
    ];

    protected $casts = [
        'content'       => 'array',
        'hidden_fields' => 'array',
        'is_active'     => 'boolean',
        'saved_at'      => 'datetime',
    ];

    // ── Relationships ────────────────────────────────────────────────

    public function pageSection()
    {
        return $this->belongsTo(PageSection::class);
    }

    // ── Helper: Snapshot ─────────────────────────────────────────────
    // Simpan snapshot section saat ini ke history, batasi max $keep record

    public static function snapshot(PageSection $section, int $keep = 5): void
    {
        static::create([
            'page_section_id' => $section->id,
            'content'         => $section->content ?? [],
            'hidden_fields'   => $section->hidden_fields ?? [],
            'is_active'       => $section->is_active,
            'saved_at'        => now(),
        ]);

        // Ambil $keep ID terbaru, lalu hapus sisanya
        $keepIds = static::where('page_section_id', $section->id)
            ->orderByDesc('saved_at')
            ->orderByDesc('id')
            ->limit($keep)
            ->pluck('id');

        static::where('page_section_id', $section->id)
            ->whereNotIn('id', $keepIds)
            ->delete();
    }
}