<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position')->nullable();      // Jabatan / posisi
            $table->string('company')->nullable();       // Nama perusahaan
            $table->string('photo')->nullable();         // Path ke storage
            $table->text('content');                     // Isi testimoni
            $table->tinyInteger('rating')->default(5);   // 1-5 bintang
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};