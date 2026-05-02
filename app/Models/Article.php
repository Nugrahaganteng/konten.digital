<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'thumbnail',
        'category',
        'content',
        'excerpt',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Auto-generate slug dari title
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            $article->slug = Str::slug($article->title) . '-' . Str::random(5);
            if (empty($article->excerpt)) {
                $article->excerpt = Str::limit(strip_tags($article->content), 160);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail && file_exists(public_path('storage/' . $this->thumbnail))) {
            return asset('storage/' . $this->thumbnail);
        }
        // Placeholder warna random per artikel
        $colors = ['3b82f6', 'e8402a', '00a896', '2d1b4e', 'f5c518'];
        $color  = $colors[$this->id % count($colors)];
        return "https://via.placeholder.com/800x500/{$color}/ffffff?text=" . urlencode($this->title);
    }
}