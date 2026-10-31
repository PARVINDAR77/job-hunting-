@extends('admin.layouts.app')

@section('content')

<style>
    .admin-form-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        padding: 30px;
        margin-top: 20px;
        max-width: 800px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
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
        width: 100%;
        box-sizing: border-box;
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
        <span class="analytics-label" style="color: #534ade; font-weight: 700; font-size: 11px; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 8px; display: block;">CATEGORY MANAGEMENT</span>
        <h3 style="font-size: 22px; color: #111827; margin: 0 0 5px 0; font-weight: 700;">Add New Category</h3>
        <p style="color: #6b7280; margin: 0; font-size: 14px;">Create a new job category.</p>
    </div>
    <a href="{{ route('admin.categories.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Back to Categories
    </a>
</div>

<div class="admin-form-container">
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>Category Name <span style="color:red">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="e.g. Software Development" onkeyup="document.getElementById('slug').value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '')">
            @error('name')<div class="error-text">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label>URL Slug <span style="color:red">*</span></label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" required placeholder="e.g. software-development">
            <small style="color: #6b7280; margin-top: 5px;">This will be used in the URL. Must be unique.</small>
            @error('slug')<div class="error-text">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label>FontAwesome Icon Class</label>
            <input type="text" name="icon" class="form-control" value="{{ old('icon') }}" placeholder="e.g. fas fa-laptop-code">
            <small style="color: #6b7280; margin-top: 5px;">Optional. Enter a FontAwesome icon class.</small>
            @error('icon')<div class="error-text">{{ $message }}</div>@enderror
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Create Category
            </button>
        </div>
    </form>
</div>

@endsection
