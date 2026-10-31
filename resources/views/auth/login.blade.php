@extends('layouts.app')

@section('title', 'Login to JobFinder')

@section('content')
<div class="auth-split-layout">
    <!-- Left: Form -->
    <div class="auth-form-side">
        <div class="auth-form-wrapper">
            <a href="{{ route('home') }}" class="brand" style="margin-bottom: 3rem; display: inline-flex;">
                <span class="logo-icon"><i class="fa-solid fa-briefcase"></i></span>
                <span class="logo-text">JobFinder</span>
            </a>

            <div class="mb-4">
                <h2 style="color: var(--navy); margin-bottom: 0.5rem; font-size: 2.5rem;">Welcome Back</h2>
                <p class="text-muted" style="font-size: 1.1rem;">Enter your details to access your account.</p>
            </div>

            @if(session('status'))
                <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 1.5rem; font-size: 0.9rem;">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 1.5rem; font-size: 0.9rem;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div style="margin-bottom: 1.5rem;">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" class="form-input" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-input" name="password" required>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
                    <label class="custom-checkbox">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                        Remember me
                    </label>
                    <a href="{{ route('password.request') }}" class="text-primary" style="font-size: 0.9rem; font-weight: 600; text-decoration: none;">Forgot Password?</a>
                </div>

                <x-button variant="primary" type="submit" class="full-width" style="padding: 1rem; font-size: 1.1rem;">Log In</x-button>
            </form>

            <div class="text-center mt-4 pt-4">
                <p class="text-muted" style="margin-bottom: 0;">Don't have an account? <a href="{{ route('profile.onboarding') }}" class="text-primary" style="font-weight: 600; text-decoration: none;">Create Account</a></p>
            </div>
        </div>
    </div>
    
    <!-- Right: Visual -->
    <div class="auth-visual-side">
        <img src="{{ asset('images/auth_3d.jpg') }}?v={{ time() }}" alt="Secure Career Growth" class="auth-3d-img">
        <div class="auth-visual-overlay">
            <h3 style="font-size: 2rem; margin-bottom: 1rem;">Secure your future.</h3>
            <p style="font-size: 1.1rem; opacity: 0.9; max-width: 400px; margin: 0 auto;">Join thousands of professionals finding their next big opportunity on JobFinder.</p>
        </div>
    </div>
</div>
@endsection
