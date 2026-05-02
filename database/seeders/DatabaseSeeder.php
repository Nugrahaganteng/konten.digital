// database/seeders/DatabaseSeeder.php
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
        // Admin
        $admin = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@blog.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // User biasa
        $user = User::create([
            'name'     => 'John Doe',
            'email'    => 'user@blog.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // Artikel dummy
        Article::factory(10)->create(['user_id' => $admin->id, 'status' => 'published']);
        Article::factory(5)->create(['user_id' => $user->id, 'status' => 'draft']);
    }
}