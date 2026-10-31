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
        <span class="analytics-label" style="color: #534ade; font-weight: 700; font-size: 11px; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 8px; display: block;">USER MANAGEMENT</span>
        <h3 style="font-size: 22px; color: #111827; margin: 0 0 5px 0; font-weight: 700;">Add New User</h3>
        <p style="color: #6b7280; margin: 0; font-size: 14px;">Create a new admin, candidate, or standard user.</p>
    </div>
    <a href="{{ route('admin.users.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Back to Users
    </a>
</div>

<div class="admin-form-container">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        
        <div class="form-grid">
            <div class="form-group">
                <label>Full Name <span style="color:red">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="John Doe">
                @error('name')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Email Address <span style="color:red">*</span></label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="john@example.com">
                @error('email')<div class="error-text">{{ $message }}</div>@enderror
            </div>
            
            <div class="form-group full-width">
                <label>User Role</label>
                <select name="role" class="form-control">
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Standard User</option>
                    <option value="candidate" {{ old('role') == 'candidate' ? 'selected' : '' }}>Candidate</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator (Admin Panel Access)</option>
                </select>
                @error('role')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Password <span style="color:red">*</span></label>
                <input type="password" name="password" class="form-control" required placeholder="Min 8 characters">
                @error('password')<div class="error-text">{{ $message }}</div>@enderror
            </div>
            
            <div class="form-group">
                <label>Confirm Password <span style="color:red">*</span></label>
                <input type="password" name="password_confirmation" class="form-control" required placeholder="Repeat password">
            </div>
        </div>

        <div style="margin-top: 10px;">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Create User
            </button>
        </div>
    </form>
</div>

@endsection
