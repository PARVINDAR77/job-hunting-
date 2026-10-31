<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'logo' => 'https://ui-avatars.com/api/?name='.urlencode(fake()->company()).'&color=7F9CF5&background=EBF4FF',
            'description' => fake()->paragraphs(3, true),
            'industry' => fake()->randomElement(['Technology', 'Healthcare', 'Finance', 'Education', 'E-commerce', 'Manufacturing']),
            'location' => fake()->randomElement(['Ahmedabad', 'Mumbai', 'Pune', 'Bangalore', 'Hyderabad', 'Delhi', 'Chennai', 'Remote']),
            'website' => fake()->url(),
            'employee_count' => fake()->randomElement(['1-10', '11-50', '51-200', '201-500', '500+']),
        ];
    }
}
