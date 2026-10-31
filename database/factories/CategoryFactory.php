<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Software Development', 'Design', 'Marketing', 'Sales', 'Customer Support', 
            'Human Resources', 'Finance', 'Data Science', 'Product Management', 'Operations'
        ]);
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->sentence(),
            'icon' => 'fa-solid fa-briefcase',
        ];
    }
}
