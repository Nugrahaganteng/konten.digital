<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin default
        User::firstOrCreate(
            ['email' => 'admin@kontendigital.id'],
            [
                'name'     => 'Admin KontenDigital',
                'password' => Hash::make('admin123456'),
                'role'     => 'admin',
            ]
        );

        // Buat user biasa untuk testing
        User::firstOrCreate(
            ['email' => 'user@kontendigital.id'],
            [
                'name'     => 'User Demo',
                'password' => Hash::make('password'),
                'role'     => 'user',
            ]
        );

        // Tidak ada Article::factory — tidak ada dummy artikel
    }
}