<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Job;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('jobs')->orderBy('name')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * AJAX: return jobs for a specific category (by slug).
     */
    public function jobs(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $jobs = Job::with('company')
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(8);

        // Build a clean array for the JSON response
        $items = $jobs->map(function ($job) {
            return [
                'id'          => $job->id,
                'title'       => $job->title,
                'job_type'    => $job->job_type,
                'experience'  => $job->experience,
                'location'    => $job->location,
                'salary_min'  => $job->salary_min,
                'salary_max'  => $job->salary_max,
                'posted_at'   => $job->created_at->diffForHumans(),
                'url'         => route('jobs.show', $job),
                'company'     => [
                    'name' => $job->company->name ?? 'Unknown',
                    'logo' => $job->company->logo
                        ?? 'https://ui-avatars.com/api/?name=' . urlencode($job->company->name ?? 'Co') . '&color=7F9CF5&background=EBF4FF',
                ],
            ];
        });

        return response()->json([
            'category'    => $category->name,
            'total'       => $jobs->total(),
            'jobs'        => $items,
            'has_more'    => $jobs->hasMorePages(),
            'browse_url'  => route('jobs.index', ['category' => $category->slug]),
        ]);
    }
}

