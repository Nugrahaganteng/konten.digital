<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSectionHistory extends Model
{
    protected $fillable = [
        'page_section_id',
        'content',
        'is_active',
        'restored_by',
        'saved_at',
    ];

    protected $casts = [
        'content'   => 'array',
        'is_active' => 'boolean',
        'saved_at'  => 'datetime',
    ];

    // ── Relationships ────────────────────────────────────────────────

    public function pageSection()
    {
        return $this->belongsTo(PageSection::class);
    }

    // ── Statics ──────────────────────────────────────────────────────

    /**
     * Simpan snapshot sebelum update, trim ke max N entri.
     */
    public static function snapshot(PageSection $section, int $maxHistory = 5): void
    {
        static::create([
            'page_section_id' => $section->id,
            'content'         => $section->content,
            'is_active'       => $section->is_active,
            'saved_at'        => now(),
        ]);

        $keepIds = static::where('page_section_id', $section->id)
            ->orderByDesc('saved_at')
            ->orderByDesc('id')
            ->take($maxHistory)
            ->pluck('id');

        if ($keepIds->isNotEmpty()) {
            static::where('page_section_id', $section->id)
                ->whereNotIn('id', $keepIds)
                ->delete();
        }
    }
}