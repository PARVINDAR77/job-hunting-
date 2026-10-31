<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Load applications with relations
        $applications = $user->applications()->with('job.company')->latest()->get();
        
        // Count stats
        $savedJobsCount = $user->savedJobs()->count();
        $interviewsCount = $applications->where('status', 'interview')->count();
        
        // Calculate profile completion percentage
        $fields = ['name', 'email', 'phone', 'location', 'bio', 'resume', 'profile_image'];
        $filled = 0;
        foreach ($fields as $field) {
            if (!empty($user->$field)) {
                $filled++;
            }
        }
        if ($user->skills()->count() > 0) $filled++;
        
        $totalFields = count($fields) + 1; // +1 for skills
        $profileCompletion = round(($filled / $totalFields) * 100);

        // Fetch Recommended Jobs based on user's location or random if no location
        $recommendedJobs = Job::with('company')
            ->when($user->location, function($q) use ($user) {
                $q->where('location', 'like', "%{$user->location}%");
            })
            ->latest()
            ->limit(4)
            ->get();

        return view('dashboard', compact(
            'user', 
            'applications', 
            'savedJobsCount', 
            'interviewsCount', 
            'profileCompletion', 
            'recommendedJobs'
        ));
    }
}
