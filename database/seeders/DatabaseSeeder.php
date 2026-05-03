<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Buat akun admin default ──────────────────────────────
        $admin = User::firstOrCreate(
            ['email' => 'admin@kontendigital.id'],
            [
                'name'     => 'Admin KontenDigital',
                'password' => Hash::make('admin123456'),
                'role'     => 'admin',
            ]
        );

        // ── Buat user biasa untuk testing ────────────────────────
        $user = User::firstOrCreate(
            ['email' => 'user@kontendigital.id'],
            [
                'name'     => 'User Demo',
                'password' => Hash::make('password'),
                'role'     => 'user',
            ]
        );

        // ── Artikel dummy ─────────────────────────────────────────
        Article::factory(10)->published()->create(['user_id' => $admin->id]);
        Article::factory(5)->draft()->create(['user_id' => $user->id]);
    }
}