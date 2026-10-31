$skills = \App\Models\Skill::all();
if ($skills->count() == 0) {
    echo 'No skills found!';
} else {
    \App\Models\Job::all()->each(function($job) use ($skills) {
        $job->skills()->sync($skills->random(rand(2, 5))->pluck('id')->toArray());
    });
    echo 'Skills attached successfully!';
}
