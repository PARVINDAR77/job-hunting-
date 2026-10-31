@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="auth-split-layout">
    <div class="auth-form-side">
        <div class="auth-form-wrapper">
            <a href="{{ route('home') }}" class="brand" style="margin-bottom: 3rem; display: inline-flex;">
                <span class="logo-icon"><i class="fa-solid fa-briefcase"></i></span>
                <span class="logo-text">JobFinder</span>
            </a>

            <div class="mb-4">
                <h2 style="color: var(--navy); margin-bottom: 0.5rem; font-size: 2rem;">Create New Password</h2>
                <p class="text-muted" style="font-size: 1.1rem;">Please enter your new password below.</p>
            </div>

            @if($errors->any())
                <div style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 1.5rem; font-size: 0.9rem;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                
                <input type="hidden" name="token" value="{{ $token }}">

                <div style="margin-bottom: 1.5rem;">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" class="form-input" name="email" value="{{ request()->email ?? old('email') }}" required autofocus readonly style="background: #f1f5f9;">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="password" class="form-label">New Password</label>
                    <input id="password" type="password" class="form-input" name="password" required>
                </div>

                <div style="margin-bottom: 2.5rem;">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input id="password_confirmation" type="password" class="form-input" name="password_confirmation" required>
                </div>

                <x-button variant="primary" type="submit" class="full-width" style="padding: 1rem; font-size: 1.1rem;">Reset Password</x-button>
            </form>
        </div>
    </div>
    
    <div class="auth-visual-side">
        <img src="{{ asset('images/auth_3d.jpg') }}" alt="Secure Recovery" class="auth-3d-img">
        <div class="auth-visual-overlay">
            <h3 style="font-size: 2rem; margin-bottom: 1rem;">Account Recovery.</h3>
            <p style="font-size: 1.1rem; opacity: 0.9; max-width: 400px; margin: 0 auto;">Your data is always secure with JobFinder.</p>
        </div>
    </div>
</div>
@endsection
