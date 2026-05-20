<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // route_name: nama route Laravel (contoh: layanan.press.release)
            // Dipakai di navbar dan di halaman layanan untuk link "Pelajari Lebih"
            if (!Schema::hasColumn('services', 'route_name')) {
                $table->string('route_name', 100)->nullable()->after('slug')
                    ->comment('Nama route Laravel, misal: layanan.press.release');
            }
        });

        // Seed route_name untuk data yang sudah ada
        // Mapping berdasarkan slug yang biasanya sudah ada
        $map = [
            'press-release'     => 'layanan.press.release',
            'backlink'          => 'layanan.backlink',
            'backlink-media'    => 'layanan.backlink',
            'press-conference'  => 'layanan.press.conference',
            'penulisan-artikel' => 'layanan.penulisan.artikel',
            'script-video'      => 'layanan.script.video',
            'pelatihan-konten'  => 'layanan.pelatihan.konten',
            'pelatihan-konten-kreator' => 'layanan.pelatihan.konten',
        ];

        foreach ($map as $slug => $route) {
            DB::table('services')
                ->where('slug', $slug)
                ->whereNull('route_name')
                ->update(['route_name' => $route]);
        }
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'route_name')) {
                $table->dropColumn('route_name');
            }
        });
    }
};