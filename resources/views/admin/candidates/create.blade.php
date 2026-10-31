@extends('admin.layouts.app')

@section('content')

<style>
    .admin-form-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        padding: 30px;
        margin-top: 20px;
    }
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }
    .form-group.full-width {
        grid-column: 1 / -1;
    }
    .form-group label {
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
        font-size: 14px;
    }
    .form-control {
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #fdfdfd;
        font-family: inherit;
    }
    .form-control:focus {
        border-color: #534ade;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(83, 74, 222, 0.15);
        outline: none;
    }
    .btn-submit {
        background: #534ade;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
        font-size: 15px;
    }
    .btn-submit:hover {
        background: #4338ca;
    }
    .btn-back {
        background: #f3f4f6;
        color: #4b5563;
        padding: 10px 18px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-back:hover {
        background: #e5e7eb;
    }
    .error-text {
        color: #ef4444;
        font-size: 12px;
        margin-top: 5px;
    }
</style>

<div class="recent-jobs-header" style="display:flex; justify-content: space-between; align-items: center;">
    <div>
        <span class="analytics-label">CANDIDATE MANAGEMENT</span>
        <h3>Add New Candidate</h3>
        <p>Create a new candidate profile.</p>
    </div>
    <a href="{{ route('admin.candidates.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Back to Candidates
    </a>
</div>

<div class="admin-form-container">
    <form action="{{ route('admin.candidates.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">
            
            <div class="form-group">
                <label>Full Name <span style="color:red">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="e.g. John Doe">
                @error('name')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Professional Title</label>
                <input type="text" name="job_title" class="form-control" value="{{ old('job_title') }}" placeholder="e.g. Senior Developer">
                @error('job_title')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Email Address <span style="color:red">*</span></label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="e.g. john@example.com">
                @error('email')<div class="error-text">{{ $message }}</div>@enderror
            </div>
            
            <div class="form-group">
                <label>Password <span style="color:red">*</span></label>
                <input type="password" name="password" class="form-control" required placeholder="Minimum 8 characters">
                @error('password')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="e.g. +1 234 567 8900">
                @error('phone')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" class="form-control" value="{{ old('location') }}" placeholder="e.g. New York, NY">
                @error('location')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group full-width">
                <label>Skills (Select all that apply)</label>
                <div style="max-height: 200px; overflow-y: auto; padding: 15px; border: 1px solid #e0e0e0; border-radius: 8px; background: #fdfdfd; display: flex; flex-wrap: wrap; gap: 10px;">
                    @php $userSkills = old('skills', []); @endphp
                    @foreach($allSkills as $skill)
                        <label style="display: inline-flex; align-items: center; background: #fff; padding: 6px 12px; border: 1px solid #d1d5db; border-radius: 20px; font-weight: normal; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.borderColor='#534ade'" onmouseout="this.style.borderColor='#d1d5db'">
                            <input type="checkbox" name="skills[]" value="{{ $skill->id }}" {{ in_array($skill->id, $userSkills) ? 'checked' : '' }} style="margin-right: 8px;">
                            {{ $skill->name }}
                        </label>
                    @endforeach
                </div>
                @error('skills')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group full-width">
                <label>Bio / About</label>
                <textarea name="bio" class="form-control" rows="5" placeholder="Brief description about the candidate...">{{ old('bio') }}</textarea>
                @error('bio')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group full-width">
                <label>Resume / CV (Optional)</label>
                <input type="file" name="resume" class="form-control" accept=".pdf,.doc,.docx" style="padding: 10px;">
                <small style="color: #6b7280; margin-top: 5px;">Allowed files: .pdf, .doc, .docx. Max size: 2MB</small>
                @error('resume')<div class="error-text">{{ $message }}</div>@enderror
            </div>

        </div>

        <button type="submit" class="btn-submit">
            <i class="fas fa-save"></i> Create Candidate
        </button>
    </form>
</div>

@endsection
