<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => fake()->paragraph(),
            'content' => fake()->paragraphs(5, true),
            'image' => 'https://ui-avatars.com/api/?name='.urlencode('Blog Post').'&color=7F9CF5&background=EBF4FF',
            'category' => fake()->randomElement(['Career Advice', 'Company News', 'Tech Trends']),
            'author' => fake()->name(),
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
