<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'group', 'label'];

    // ── Helper: ambil 1 nilai by key (cached 1 jam) ───────────────────
    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember("site_setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting?->value ?? $default;
        });
    }

    // ── Helper: set nilai & flush cache ──────────────────────────────
    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
        Cache::forget("site_setting_{$key}");
        Cache::forget('site_settings_all');
    }

    // ── Helper: ambil semua setting sebagai array key => value ────────
    public static function all_settings(): array
    {
        return Cache::remember('site_settings_all', 3600, function () {
            return static::all()->pluck('value', 'key')->toArray();
        });
    }

    // ── Flush semua cache setting (panggil setelah bulk save) ─────────
    public static function flushCache(): void
    {
        Cache::forget('site_settings_all');
        // Flush cache per-key juga
        static::all()->each(fn ($s) => Cache::forget("site_setting_{$s->key}"));
    }
}