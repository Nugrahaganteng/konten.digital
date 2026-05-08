<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'whatsapp', 'service', 'message', 'status'];

    /**
     * Cek apakah pesan masih baru/belum dibaca
     */
    public function isRead()
    {
        return $this->status !== 'new';
    }

    /**
     * Helper untuk styling badge berdasarkan status
     */
    public function statusBadge()
    {
        return match($this->status) {
            'new'         => ['label' => 'BARU', 'class' => 'badge-new'],
            'in_progress' => ['label' => 'PROSES', 'class' => 'badge-in_progress'],
            'resolved'    => ['label' => 'SELESAI', 'class' => 'badge-resolved'],
            default       => ['label' => 'UNKNOWN', 'class' => 'bg-gray-500'],
        };
    }
}