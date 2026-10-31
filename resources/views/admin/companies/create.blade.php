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
        <span class="analytics-label">COMPANY MANAGEMENT</span>
        <h3>Add New Company</h3>
        <p>Create a new company profile.</p>
    </div>
    <a href="{{ route('admin.companies.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Back to Companies
    </a>
</div>

<div class="admin-form-container">
    <form action="{{ route('admin.companies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">
            
            <div class="form-group">
                <label>Company Name <span style="color:red">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="e.g. Acme Corp">
                @error('name')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Industry</label>
                <input type="text" name="industry" class="form-control" value="{{ old('industry') }}" placeholder="e.g. Technology, Finance">
                @error('industry')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" class="form-control" value="{{ old('location') }}" placeholder="e.g. San Francisco, CA">
                @error('location')<div class="error-text">{{ $message }}</div>@enderror
            </div>
            
            <div class="form-group">
                <label>Website URL</label>
                <input type="url" name="website" class="form-control" value="{{ old('website') }}" placeholder="https://example.com">
                @error('website')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group full-width">
                <label>Employee Count</label>
                <select name="employee_count" class="form-control">
                    <option value="">Select size</option>
                    <option value="1-10" {{ old('employee_count') == '1-10' ? 'selected' : '' }}>1-10 Employees</option>
                    <option value="11-50" {{ old('employee_count') == '11-50' ? 'selected' : '' }}>11-50 Employees</option>
                    <option value="51-200" {{ old('employee_count') == '51-200' ? 'selected' : '' }}>51-200 Employees</option>
                    <option value="201-500" {{ old('employee_count') == '201-500' ? 'selected' : '' }}>201-500 Employees</option>
                    <option value="500+" {{ old('employee_count') == '500+' ? 'selected' : '' }}>500+ Employees</option>
                </select>
                @error('employee_count')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group full-width">
                <label>Company Description</label>
                <textarea name="description" class="form-control" rows="5" placeholder="Brief description about the company...">{{ old('description') }}</textarea>
                @error('description')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group full-width">
                <label>Company Logo</label>
                <input type="file" name="logo" class="form-control" accept="image/jpeg,image/png,image/jpg" style="padding: 10px;">
                <small style="color: #6b7280; margin-top: 5px;">Allowed files: .jpg, .png. Max size: 2MB</small>
                @error('logo')<div class="error-text">{{ $message }}</div>@enderror
            </div>

        </div>

        <button type="submit" class="btn-submit">
            <i class="fas fa-save"></i> Create Company
        </button>
    </form>
</div>

@endsection
