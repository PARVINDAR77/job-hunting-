<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_listings';

    protected $fillable = [
        'company_id',
        'category_id',
        'title',
        'slug',
        'location',
        'salary_min',
        'salary_max',
        'job_type',
        'experience',
        'description',
        'responsibilities',
        'requirements',
        'benefits',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'date',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function savedJobs()
    {
        return $this->hasMany(SavedJob::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_skill');
    }

    public function hasApplied(?User $user)
    {
        if (!$user) return false;
        return $this->applications()->where('user_id', $user->id)->exists();
    }

    public function isSavedBy(?User $user)
    {
        if (!$user) return false;
        return $this->savedJobs()->where('user_id', $user->id)->exists();
    }
}