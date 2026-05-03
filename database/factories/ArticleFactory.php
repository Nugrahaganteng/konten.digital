<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence(6);

        return [
            'user_id'      => User::factory(),
            'title'        => $title,
            'slug'         => Str::slug($title) . '-' . Str::random(4),
            'thumbnail'    => null,
            'category'     => $this->faker->randomElement([
                'Digital Marketing', 'Social Media', 'SEO',
                'Content Strategy', 'Branding', 'Tips & Trick',
            ]),
            'content'      => $this->faker->paragraphs(5, true),
            'excerpt'      => $this->faker->sentence(20),
            'status'       => $this->faker->randomElement(['draft', 'published']),
            'published_at' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function published(): static
    {
        return $this->state(fn () => [
            'status'       => 'published',
            'published_at' => now(),
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn () => [
            'status'       => 'draft',
            'published_at' => null,
        ]);
    }
}