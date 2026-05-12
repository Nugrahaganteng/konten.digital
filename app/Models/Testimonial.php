<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'position', 'company', 'photo',
        'content', 'rating', 'is_active', 'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating'    => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('id');
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo && file_exists(storage_path('app/public/' . $this->photo))) {
            return asset('storage/' . $this->photo);
        }
        // Placeholder dengan inisial
        $initials = collect(explode(' ', $this->name))
            ->map(fn ($w) => strtoupper($w[0]))
            ->take(2)
            ->implode('');
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=3b0764&color=facc15&bold=true';
    }

    public function getStarsHtmlAttribute(): string
    {
        $filled = str_repeat('★', $this->rating);
        $empty  = str_repeat('☆', 5 - $this->rating);
        return $filled . $empty;
    }
}