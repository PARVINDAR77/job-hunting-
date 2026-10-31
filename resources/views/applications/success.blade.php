@extends('layouts.app')

@section('title', 'Application Successful')

@section('content')
<div class="section-padding bg-main" style="min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <div class="card floating text-center" style="width: 100%; max-width: 600px; padding: 4rem 3rem;">
        
        <div style="width: 80px; height: 80px; border-radius: 50%; background: #dcfce7; color: #166534; font-size: 2.5rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
            <i class="fa-solid fa-check"></i>
        </div>

        <h2 style="color: var(--navy); margin-bottom: 1rem; font-size: 2rem;">Application Submitted Successfully</h2>
        <p class="text-muted" style="font-size: 1.1rem; margin-bottom: 3rem; line-height: 1.6;">
            Your application has been sent to the company. We've also sent a confirmation email with the details. The hiring team will review your profile and get back to you soon.
        </p>

        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('jobs.index') }}" style="text-decoration: none;">
                <x-button variant="outline" style="padding: 1rem 2rem;">Browse More Jobs</x-button>
            </a>
            <a href="{{ route('home') }}" style="text-decoration: none;">
                <!-- Typically this would go to a user dashboard, but we use home for now -->
                <x-button variant="primary" style="padding: 1rem 2rem;">View My Applications</x-button>
            </a>
        </div>
        
    </div>
</div>
@endsection
