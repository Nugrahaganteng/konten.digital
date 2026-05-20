<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_section_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_section_id')
                  ->constrained('page_sections')
                  ->cascadeOnDelete();
            $table->json('content');
            $table->json('hidden_fields')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('saved_at')->useCurrent();

            $table->index(['page_section_id', 'saved_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_section_histories');
    }
};