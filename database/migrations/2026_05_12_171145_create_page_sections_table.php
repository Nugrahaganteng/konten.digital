<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page', 50);         // 'home', 'about', 'footer', dll
            $table->string('section_key', 100); // 'hero', 'stats', 'about_agency', dll
            $table->string('label', 150);       // Label ramah: "Hero Section"
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->json('content');            // Semua field section disimpan di sini
            $table->timestamps();

            $table->unique(['page', 'section_key']);
            $table->index(['page', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};