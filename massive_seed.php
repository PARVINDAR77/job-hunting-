\App\Models\Job::truncate();
\App\Models\Company::factory(50)->create();
\App\Models\Job::factory(1200)->create();

$skills = \App\Models\Skill::all();
if ($skills->count() > 0) {
    \App\Models\Job::all()->each(function($job) use ($skills) {
        $job->skills()->sync($skills->random(rand(2, 5))->pluck('id')->toArray());
    });
}
echo "1200+ jobs created and skills attached successfully!\n";
exit;
