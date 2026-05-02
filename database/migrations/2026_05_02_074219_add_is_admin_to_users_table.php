<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false)->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
// NOTE: File ini sengaja dikosongkan karena kolom 'role' sudah ditambahkan
// di migration 2026_05_02_020201_add_role_to_users_table.php
// Jika project Anda sudah punya migration ini sebelumnya dengan isi berbeda,
// HAPUS file ini dan pastikan hanya pakai migration role di atas.
return new class extends Migration
{
    public function up(): void
    {
        // Sudah ditangani oleh migration add_role_to_users_table
        // Tidak perlu aksi tambahan
    }

    public function down(): void
    {
        //
    }
};
