<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin default
        $admin = User::firstOrCreate(
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

        // Seed artikel asli kamu di sini
        $articles = [
            [
                'title'        => 'Judul Artikel Kamu Di Sini',   // <-- ganti ini
                'category'     => 'Press Release',                 // <-- ganti ini
                'content'      => 'Isi konten artikel kamu...',    // <-- ganti ini
                'status'       => 'published',
                'published_at' => now(),
            ],
            // tambah artikel lain kalau ada...
        ];

        foreach ($articles as $data) {
            Article::firstOrCreate(
                ['title' => $data['title']],
                array_merge($data, ['user_id' => $admin->id])
            );
        }
    }
}