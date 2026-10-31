<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = User::where('role', '!=', 'admin')->orWhereNull('role')->orderBy('id', 'desc')->paginate(10);
        return view('admin.candidates.index', compact('candidates'));
    }

    public function create()
    {
        $allSkills = \App\Models\Skill::orderBy('name')->get();
        return view('admin.candidates.create', compact('allSkills'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'job_title' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        $validated['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
        $validated['role'] = 'candidate';

        if ($request->hasFile('resume')) {
            $validated['resume'] = $request->file('resume')->store('resumes', 'public');
        }

        $user = User::create($validated);
        
        if (!empty($validated['skills'])) {
            $user->skills()->sync($validated['skills']);
        }

        return redirect()->route('admin.candidates.index')->with('success', 'Candidate created successfully.');
    }

    public function show(User $candidate)
    {
        return view('admin.candidates.show', compact('candidate'));
    }

    public function edit(User $candidate)
    {
        $allSkills = \App\Models\Skill::orderBy('name')->get();
        return view('admin.candidates.edit', compact('candidate', 'allSkills'));
    }

    public function update(Request $request, User $candidate)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $candidate->id,
            'job_title' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8']);
            $validated['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        if ($request->hasFile('resume')) {
            if ($candidate->resume && \Illuminate\Support\Facades\Storage::disk('public')->exists($candidate->resume)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($candidate->resume);
            }
            $validated['resume'] = $request->file('resume')->store('resumes', 'public');
        }

        $candidate->update($validated);
        
        if (isset($validated['skills'])) {
            $candidate->skills()->sync($validated['skills']);
        } else {
            $candidate->skills()->sync([]);
        }

        return redirect()->route('admin.candidates.index')->with('success', 'Candidate updated successfully.');
    }

    public function destroy(User $candidate)
    {
        $candidate->delete();
        return redirect()->route('admin.candidates.index')->with('success', 'Candidate deleted successfully.');
    }
}
