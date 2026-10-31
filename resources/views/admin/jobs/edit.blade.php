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
        <span class="analytics-label">JOB MANAGEMENT</span>
        <h3>Edit Job: {{ $job->title }}</h3>
        <p>Update the job posting information.</p>
    </div>
    <a href="{{ route('admin.jobs.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Back to Jobs
    </a>
</div>

<div class="admin-form-container">
    <form action="{{ route('admin.jobs.update', $job) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-grid">
            
            <div class="form-group">
                <label>Job Title <span style="color:red">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $job->title) }}" required>
                @error('title')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>URL Slug <span style="color:red">*</span></label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug', $job->slug) }}" required>
                @error('slug')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Company <span style="color:red">*</span></label>
                <select name="company_id" class="form-control" required>
                    <option value="">Select Company</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id', $job->company_id) == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                    @endforeach
                </select>
                @error('company_id')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Category <span style="color:red">*</span></label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $job->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Location <span style="color:red">*</span></label>
                <input type="text" name="location" class="form-control" value="{{ old('location', $job->location) }}" required>
                @error('location')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Job Type <span style="color:red">*</span></label>
                <select name="job_type" class="form-control" required>
                    <option value="">Select Job Type</option>
                    <option value="full_time" {{ old('job_type', $job->job_type) == 'full_time' ? 'selected' : '' }}>Full Time</option>
                    <option value="part_time" {{ old('job_type', $job->job_type) == 'part_time' ? 'selected' : '' }}>Part Time</option>
                    <option value="contract" {{ old('job_type', $job->job_type) == 'contract' ? 'selected' : '' }}>Contract</option>
                    <option value="freelance" {{ old('job_type', $job->job_type) == 'freelance' ? 'selected' : '' }}>Freelance</option>
                    <option value="internship" {{ old('job_type', $job->job_type) == 'internship' ? 'selected' : '' }}>Internship</option>
                </select>
                @error('job_type')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Experience Required</label>
                <input type="text" name="experience" class="form-control" value="{{ old('experience', $job->experience) }}">
                @error('experience')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Application Deadline</label>
                <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $job->deadline ? $job->deadline->format('Y-m-d') : '') }}">
                @error('deadline')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Minimum Salary (Numeric)</label>
                <input type="number" name="salary_min" class="form-control" value="{{ old('salary_min', $job->salary_min) }}">
                @error('salary_min')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Maximum Salary (Numeric)</label>
                <input type="number" name="salary_max" class="form-control" value="{{ old('salary_max', $job->salary_max) }}">
                @error('salary_max')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group full-width">
                <label>Description <span style="color:red">*</span></label>
                <textarea name="description" class="form-control" rows="5" required>{{ old('description', $job->description) }}</textarea>
                @error('description')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group full-width">
                <label>Responsibilities</label>
                <textarea name="responsibilities" class="form-control" rows="4">{{ old('responsibilities', $job->responsibilities) }}</textarea>
                @error('responsibilities')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group full-width">
                <label>Requirements</label>
                <textarea name="requirements" class="form-control" rows="4">{{ old('requirements', $job->requirements) }}</textarea>
                @error('requirements')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group full-width">
                <label>Benefits</label>
                <textarea name="benefits" class="form-control" rows="3">{{ old('benefits', $job->benefits) }}</textarea>
                @error('benefits')<div class="error-text">{{ $message }}</div>@enderror
            </div>

        </div>

        <button type="submit" class="btn-submit">
            <i class="fas fa-save"></i> Update Job
        </button>
    </form>
</div>

@endsection
