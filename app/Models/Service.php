<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'route_name', 'tab_label', 'description', 'content',
        'image', 'bg_label', 'icon_class', 'whatsapp_number',
        'is_active', 'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Service $service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    // ── Scopes ────────────────────────────────────────────────────────
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('id');
    }

    // ── Accessor: URL gambar ──────────────────────────────────────────
    public function getImageUrlAttribute(): string
    {
        if ($this->image && file_exists(storage_path('app/public/' . $this->image))) {
            return asset('storage/' . $this->image);
        }
        return asset('images/' . ($this->image ?? 'placeholder.png'));
    }

    // ── Helper: URL halaman layanan ───────────────────────────────────
    // Pakai route_name jika ada, fallback ke /layanan/{slug}
    public function getUrlAttribute(): string
    {
        if ($this->route_name) {
            try {
                return route($this->route_name);
            } catch (\Exception $e) {
                // route tidak ada, fallback ke slug
            }
        }
        return url('/layanan/' . $this->slug);
    }
}