<?php

use Illuminate\Database\Migrations\Migration;

/**
 * Migration ini dikosongkan karena kolom autentikasi admin
 * sudah ditangani oleh migration add_role_to_users_table.
 *
 * Jika project belum pernah dijalankan, HAPUS file ini.
 * Jika sudah pernah di-migrate, biarkan file ini agar tabel
 * migrations tidak error saat rollback.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Sudah ditangani oleh: add_role_to_users_table
    }

    public function down(): void
    {
        // Tidak ada yang perlu di-rollback
    }
};