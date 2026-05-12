<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            // type: text | textarea | image | boolean | json | color | number
            $table->string('type')->default('text');
            // group: hero | about | contact | footer | seo | social
            $table->string('group')->default('general');
            $table->string('label')->nullable(); // Label ramah untuk UI admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};