<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user()->load('skills');
        
        $fields = ['name', 'email', 'phone', 'location', 'bio', 'resume', 'profile_image'];
        $filled = 0;
        foreach ($fields as $field) {
            if (!empty($user->$field)) {
                $filled++;
            }
        }
        if ($user->skills()->count() > 0) $filled++;
        
        $totalFields = count($fields) + 1;
        $profileCompletion = round(($filled / $totalFields) * 100);

        return view('profile.show', compact('user', 'profileCompletion'));
    }

    public function edit()
    {
        $user = auth()->user()->load('skills');
        $allSkills = \App\Models\Skill::orderBy('name')->get();
        return view('profile.edit', compact('user', 'allSkills'));
    }

    public function onboarding()
    {
        $user = auth()->user() ? auth()->user()->load('skills') : new \App\Models\User();
        $allSkills = \App\Models\Skill::orderBy('name')->get();
        return view('profile.build', compact('user', 'allSkills'));
    }

    public function storeOnboarding(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'skills' => 'nullable|array',
            'bio' => 'nullable|string',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ];

        if (!auth()->check()) {
            $rules['email'] = 'required|string|email|max:255|unique:users';
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $request->validate($rules);

        $data = $request->only(['name', 'location', 'job_title', 'bio']);

        if (!auth()->check()) {
            $user = \App\Models\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'location' => $request->location,
                'job_title' => $request->job_title,
                'bio' => $request->bio,
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            ]);
            auth()->login($user);
        } else {
            $user = auth()->user();
            $user->update($data);
        }

        if ($request->hasFile('resume')) {
            if ($user->resume) {
                Storage::disk('public')->delete($user->resume);
            }
            $user->update(['resume' => $request->file('resume')->store('resumes', 'public')]);
        }

        if ($request->has('skills')) {
            $user->skills()->sync($request->skills);
        } else {
            $user->skills()->detach();
        }

        return redirect()->route('dashboard')->with('success', 'Profile built successfully!');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'education' => 'nullable|string',
            'experience' => 'nullable|string',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'skills' => 'nullable|array',
        ]);

        $data = $request->only(['name', 'phone', 'location', 'job_title', 'education', 'experience', 'bio']);

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('profiles', 'public');
        }

        if ($request->hasFile('resume')) {
            if ($user->resume) {
                Storage::disk('public')->delete($user->resume);
            }
            $data['resume'] = $request->file('resume')->store('resumes', 'public');
        }

        $user->update($data);

        if ($request->has('skills')) {
            $user->skills()->sync($request->skills);
        } else {
            $user->skills()->detach();
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

    public function savedJobs()
    {
        $jobs = auth()->user()->savedJobs()->with('company')->latest()->paginate(12);
        return view('profile.saved-jobs', compact('jobs'));
    }

    public function removeSavedJob(Request $request, Job $job)
    {
        auth()->user()->savedJobs()->detach($job->id);
        return response()->json(['status' => 'success']);
    }
}
