<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@kontendigital.id')->first();

        Article::factory()
            ->count(5)
            ->published()
            ->create(['user_id' => $admin->id]);

        Article::factory()
            ->count(3)
            ->draft()
            ->create(['user_id' => $admin->id]);
    }
}