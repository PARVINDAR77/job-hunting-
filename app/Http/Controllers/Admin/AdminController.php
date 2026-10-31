<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Job;
use App\Models\Application;
use App\Models\Company;

class AdminController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $this->dashboard();
        }
        return view('admin.auth.login');
    }

    public function dashboard()
    {
        // Statistics
        $totalUsers = User::count();
        $totalJobs = Job::count();
        $totalApplications = Application::count();
        $totalCompanies = Company::count();

        // Pending Jobs (No status column exists in job_listings, setting to 0 for now)
        $pendingJobs = 0;
        $newPendingJobsYesterday = 0;

        // Recent Jobs
        $recentJobs = Job::with('company')->latest()->take(5)->get();

        // Recent Applications
        $recentApplications = Application::with(['job', 'user'])->latest()->take(5)->get();

        // Monthly Data for Charts (Last 6 Months)
        $chartMonths = [];
        $jobsChartData = [];
        $appsChartData = [];
        
        $maxJobs = 0;
        $maxApps = 0;

        for ($i = 5; $i >= 0; $i--) {
            $monthStart = now()->subMonths($i)->startOfMonth();
            $monthEnd = now()->subMonths($i)->endOfMonth();
            
            $chartMonths[] = $monthStart->format('M');
            
            $jobCount = Job::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $appCount = Application::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            
            $jobsChartData[] = $jobCount;
            $appsChartData[] = $appCount;
            
            if ($jobCount > $maxJobs) $maxJobs = $jobCount;
            if ($appCount > $maxApps) $maxApps = $appCount;
        }
        
        // Top Companies (assuming top by job count)
        $topCompanies = Company::withCount('jobs')
            ->orderByDesc('jobs_count')
            ->take(5)
            ->get();
        
        // Ensure max is at least 1 to avoid division by zero
        $maxJobs = max($maxJobs, 10);
        $maxApps = max($maxApps, 10);

        // Send data to dashboard
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalJobs',
            'totalApplications',
            'totalCompanies',
            'recentJobs',
            'recentApplications',
            'pendingJobs',
            'newPendingJobsYesterday',
            'chartMonths',
            'jobsChartData',
            'appsChartData',
            'maxJobs',
            'maxApps',
            'topCompanies'
        ));
    }

    public function settings()
    {
        $settingsPath = storage_path('app/settings.json');
        $settings = [];
        
        if (file_exists($settingsPath)) {
            $settings = json_decode(file_get_contents($settingsPath), true);
        }

        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(\Illuminate\Http\Request $request)
    {
        $data = $request->except(['_token']);
        $settingsPath = storage_path('app/settings.json');
        
        file_put_contents($settingsPath, json_encode($data, JSON_PRETTY_PRINT));
        
        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully.');
    }
}