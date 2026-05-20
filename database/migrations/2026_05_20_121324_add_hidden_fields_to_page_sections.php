<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        // ── Tambah hidden_fields ke page_sections ─────────────────────
         Schema::table('page_sections', function (Blueprint $table) {
            $table->json('hidden_fields')->nullable()->after('content');
            // hidden_fields: array of field keys yang disembunyikan dari frontend
            // Contoh: ["badge_text", "image", "cta_url"]
        });
    }

    public function down(): void
    {
        Schema::table('page_sections', function (Blueprint $table) {
            $table->dropColumn('hidden_fields');
        });
    }
};