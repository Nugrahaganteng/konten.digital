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
    }
}