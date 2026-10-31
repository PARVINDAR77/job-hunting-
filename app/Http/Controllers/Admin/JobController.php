<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::orderBy('id', 'desc')->paginate(10);

        return view('admin.jobs.index', compact('jobs'));
    }


    public function create()
    {
        $companies = \App\Models\Company::all();
        $categories = \App\Models\Category::all();
        return view('admin.jobs.create', compact('companies', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:job_listings,slug',
            'company_id' => 'required|exists:companies,id',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string|max:255',
            'job_type' => 'required|string|max:100',
            'experience' => 'nullable|string|max:100',
            'salary_min' => 'nullable|numeric',
            'salary_max' => 'nullable|numeric',
            'description' => 'required|string',
            'responsibilities' => 'nullable|string',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'deadline' => 'nullable|date',
        ]);

        Job::create($validated);

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', 'Job created successfully.');
    }

    public function edit(Job $job)
    {
        $companies = \App\Models\Company::all();
        $categories = \App\Models\Category::all();
        return view('admin.jobs.edit', compact('job', 'companies', 'categories'));
    }

    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:job_listings,slug,' . $job->id,
            'company_id' => 'required|exists:companies,id',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string|max:255',
            'job_type' => 'required|string|max:100',
            'experience' => 'nullable|string|max:100',
            'salary_min' => 'nullable|numeric',
            'salary_max' => 'nullable|numeric',
            'description' => 'required|string',
            'responsibilities' => 'nullable|string',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'deadline' => 'nullable|date',
        ]);

        $job->update($validated);

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', 'Job updated successfully.');
    }


    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', 'Job deleted successfully.');
    }
}