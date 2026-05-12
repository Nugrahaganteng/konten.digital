<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('tab_label');                 // Label di tab navigasi
            $table->text('description');                 // Deskripsi pendek di kartu
            $table->longText('content')->nullable();     // Konten halaman detail (HTML/Markdown)
            $table->string('image')->nullable();         // Path ke storage
            $table->string('bg_label')->nullable();      // Teks besar di background visual (NEWS, ART, dll)
            $table->string('icon_class')->nullable();    // Font Awesome class
            $table->string('whatsapp_number')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};