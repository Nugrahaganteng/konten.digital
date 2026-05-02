// database/factories/ArticleFactory.php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence(6);
        return [
            'title'        => $title,
            'category'     => $this->faker->randomElement(['Tech', 'Bisnis', 'Kesehatan', 'Pendidikan', 'Travel']),
            'content'      => $this->faker->paragraphs(5, true),
            'excerpt'      => $this->faker->paragraph(2),
            'thumbnail'    => null,
            'status'       => 'published',
            'published_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}