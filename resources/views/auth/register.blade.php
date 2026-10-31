@extends('layouts.app')

@section('title', 'Create Your Profile')

@section('content')
<div class="section-padding bg-main" style="min-height: 90vh; display: flex; align-items: center; padding-top: 6rem;">
    <div class="container" style="max-width: 800px;">
        
        <div class="card floating" style="padding: 4rem; background: white; border: 1px solid rgba(0,0,0,0.05); box-shadow: var(--shadow-lg);">
            
            <div class="text-center" style="margin-bottom: 3rem;">
                <h1 style="color: var(--navy); font-size: 2.5rem; margin-bottom: 0.5rem;">Create Your Profile</h1>
                <p class="text-muted" style="font-size: 1.1rem;">Fill in your details below to instantly build your professional profile and unlock all opportunities.</p>
            </div>

            @if($errors->any())
                <div style="background: #fee2e2; color: #b91c1c; padding: 1.5rem; border-radius: var(--radius-sm); margin-bottom: 2rem;">
                    <ul style="padding-left: 1.5rem; margin: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <h3 style="color: var(--navy); margin-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.5rem; font-size: 1.25rem;">Basic Information</h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label for="name" class="form-label">Full Name <span class="text-primary">*</span></label>
                        <input id="name" type="text" class="form-input" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                    <div>
                        <label for="phone" class="form-label">Phone Number</label>
                        <input id="phone" type="text" class="form-input" name="phone" value="{{ old('phone') }}" placeholder="e.g. +1 234 567 8900">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2.5rem;">
                    <div>
                        <label for="job_title" class="form-label">Professional Title</label>
                        <input id="job_title" type="text" class="form-input" name="job_title" value="{{ old('job_title') }}" placeholder="e.g. Senior Developer">
                    </div>
                    <div>
                        <label for="location" class="form-label">Location</label>
                        <input id="location" type="text" class="form-input" name="location" value="{{ old('location') }}" placeholder="e.g. New York, NY">
                    </div>
                </div>
                
                <div style="margin-bottom: 2.5rem;">
                    <label for="bio" class="form-label">Short Bio</label>
                    <textarea id="bio" name="bio" class="form-input" rows="3" placeholder="Tell companies a little about yourself...">{{ old('bio') }}</textarea>
                </div>

                <h3 style="color: var(--navy); margin-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.5rem; font-size: 1.25rem;">Account Security</h3>

                <div style="margin-bottom: 1.5rem;">
                    <label for="email" class="form-label">Email Address <span class="text-primary">*</span></label>
                    <input id="email" type="email" class="form-input" name="email" value="{{ old('email') }}" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 3rem;">
                    <div>
                        <label for="password" class="form-label">Password <span class="text-primary">*</span></label>
                        <input id="password" type="password" class="form-input" name="password" required>
                    </div>
                    <div>
                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-primary">*</span></label>
                        <input id="password_confirmation" type="password" class="form-input" name="password_confirmation" required>
                    </div>
                </div>

                <div style="text-center">
                    <x-button variant="primary" type="submit" class="full-width" style="padding: 1.25rem; font-size: 1.2rem;">Complete Profile & Register</x-button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
