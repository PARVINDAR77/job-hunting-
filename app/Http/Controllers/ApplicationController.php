<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function create(Job $job)
    {
        $user = auth()->user();

        // Prevent duplicate applications
        if ($job->hasApplied($user)) {
            return redirect()->route('jobs.show', $job)->with('error', 'You have already applied for this job.');
        }

        return view('applications.create', compact('job', 'user'));
    }

    public function store(Request $request, Job $job)
    {
        $user = auth()->user();

        // Prevent duplicate applications
        if ($job->hasApplied($user)) {
            return redirect()->route('jobs.show', $job)->with('error', 'You have already applied for this job.');
        }

        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120', // Max 5MB
            'cover_letter' => 'nullable|string|max:5000',
            'experience' => 'required|string',
            'education' => 'required|string',
        ]);

        // Store Resume securely in storage/app/private/resumes
        $resumePath = $request->file('resume')->store('resumes', 'local');

        Application::create([
            'job_id' => $job->id,
            'user_id' => $user->id,
            'resume' => $resumePath,
            'cover_letter' => $request->cover_letter,
            'experience' => $request->experience,
            'education' => $request->education,
            'status' => 'pending',
        ]);

        return redirect()->route('applications.success');
    }

    public function success()
    {
        return view('applications.success');
    }

    public function index()
    {
        $applications = auth()->user()->applications()->with('job.company')->latest()->paginate(10);
        return view('applications.index', compact('applications'));
    }

    public function show(Application $application)
    {
        // AUTHORIZATION: Only the owner can view their application
        abort_if($application->user_id !== auth()->id(), 403, 'Unauthorized action.');

        $application->load('job.company');
        return view('applications.show', compact('application'));
    }
}
