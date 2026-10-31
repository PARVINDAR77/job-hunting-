<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\Skill;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = Job::factory(50)->create();
        
        $skills = Skill::all();
        
        if ($skills->count() > 0) {
            foreach ($jobs as $job) {
                $job->skills()->attach(
                    $skills->random(rand(2, 5))->pluck('id')->toArray()
                );
            }
        }
    }
}
