<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id') ?: User::factory(),
            'job_id' => Job::inRandomOrder()->value('id') ?: Job::factory(),
            'cover_letter' => fake()->paragraphs(2, true),
            'experience' => fake()->randomElement(['1 year', '2 years', '5 years']),
            'education' => fake()->randomElement(['B.Tech', 'M.Tech', 'B.Sc', 'M.Sc']),
            'status' => fake()->randomElement(['pending', 'reviewed', 'shortlisted', 'rejected']),
        ];
    }
}
