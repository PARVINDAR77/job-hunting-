<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Skill;
use App\Models\Job;
use App\Models\Application;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(10)->create();
        $skills = Skill::all();
        $jobs = Job::all();
        
        foreach ($users as $user) {
            if ($skills->count() > 0) {
                $user->skills()->attach(
                    $skills->random(rand(2, 5))->pluck('id')->toArray()
                );
            }
            
            if ($jobs->count() > 0) {
                // Apply to 1-3 jobs
                $jobsToApply = $jobs->random(rand(1, 3));
                foreach ($jobsToApply as $job) {
                    Application::factory()->create([
                        'user_id' => $user->id,
                        'job_id' => $job->id,
                    ]);
                }
                
                // Save 1-3 jobs
                $user->savedJobs()->attach(
                    $jobs->random(rand(1, 3))->pluck('id')->toArray()
                );
            }
        }
    }
}
