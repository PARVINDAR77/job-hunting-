@extends('layouts.app')

@section('title', 'Application Details')

@section('content')
<div class="job-detail-header bg-navy" style="padding: 4rem 0 3rem; color: white; position: relative; overflow: hidden;">
    <img src="{{ asset('images/jobs_hero_bg.jpg') }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; opacity: 0.35;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(10,25,47,0.95) 0%, rgba(10,25,47,0.6) 100%); z-index: 1;"></div>
    <div class="container" style="position: relative; z-index: 2;">
        <a href="{{ route('applications.index') }}" class="text-muted" style="display:inline-block; margin-bottom: 2rem; text-decoration:none;"><i class="fa-solid fa-arrow-left"></i> Back to Applications</a>
        
        <div style="display: flex; gap: 2rem; align-items: center;">
            <div class="company-logo-large glass" style="width: 80px; height: 80px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; background: white; padding: 1rem;">
                <img src="{{ $application->job->company->logo ?? 'https://ui-avatars.com/api/?name='.urlencode($application->job->company->name).'&background=EBF4FF&color=7F9CF5' }}" style="max-width: 100%; max-height: 100%;">
            </div>
            
            <div>
                <h1 style="font-size: 2rem; margin-bottom: 0.25rem; color: white;">Application for {{ $application->job->title }}</h1>
                <p style="color: #94a3b8; font-size: 1.1rem; margin: 0;">{{ $application->job->company->name }}</p>
            </div>
        </div>
    </div>
</div>

<div class="section-padding bg-main">
    <div class="container" style="max-width: 800px;">
        
        <!-- Status Timeline -->
        <div class="card floating" style="padding: 3rem; margin-bottom: 2rem;">
            <h3 style="color: var(--navy); margin-bottom: 2.5rem;">Application Status</h3>
            
            <div class="app-card-timeline">
                @php
                    $statuses = ['pending', 'viewed', 'shortlisted', 'interview', 'selected'];
                    $currentIndex = array_search($application->status, $statuses);
                    if($currentIndex === false) $currentIndex = 0;
                    if($application->status == 'rejected') $currentIndex = -1;
                @endphp

                @foreach(['Applied', 'Viewed', 'Shortlisted', 'Interview', 'Selected'] as $index => $label)
                    <div class="timeline-node {{ $application->status == 'rejected' ? 'rejected' : ($index <= $currentIndex ? 'active' : '') }}">
                        <div class="node-dot"></div>
                        <span class="node-label" style="font-size: 0.85rem;">{{ $label }}</span>
                    </div>
                    @if(!$loop->last)
                        <div class="timeline-line {{ $application->status != 'rejected' && $index < $currentIndex ? 'active' : '' }}"></div>
                    @endif
                @endforeach
            </div>

            @if($application->status == 'rejected')
                <div style="margin-top: 3rem; padding: 1.5rem; background: #fee2e2; border-radius: var(--radius-sm); border-left: 4px solid #ef4444;">
                    <h4 style="color: #b91c1c; margin: 0 0 0.5rem 0;">Application Unsuccessful</h4>
                    <p style="color: #991b1b; margin: 0;">Unfortunately, the company has decided to move forward with other candidates for this position. Don't be discouraged, keep applying!</p>
                </div>
            @endif
        </div>

        <!-- Details -->
        <div class="card floating" style="padding: 3rem;">
            <h3 style="color: var(--navy); margin-bottom: 2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem;">Submission Details</h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2.5rem;">
                <div>
                    <span class="text-muted" style="display:block; font-size: 0.9rem; margin-bottom: 0.25rem;">Date Applied</span>
                    <strong style="color: var(--navy); font-size: 1.1rem;">{{ $application->created_at->format('F d, Y') }}</strong>
                </div>
                <div>
                    <span class="text-muted" style="display:block; font-size: 0.9rem; margin-bottom: 0.25rem;">Job Type</span>
                    <strong style="color: var(--navy); font-size: 1.1rem;">{{ $application->job->job_type }}</strong>
                </div>
            </div>

            <div style="margin-bottom: 2.5rem;">
                <span class="text-muted" style="display:block; font-size: 0.9rem; margin-bottom: 0.5rem;">Cover Letter</span>
                @if($application->cover_letter)
                    <div style="padding: 1.5rem; background: #f8fafc; border-radius: var(--radius-sm); border: 1px solid #e2e8f0; color: var(--navy); line-height: 1.7;">
                        {!! nl2br(e($application->cover_letter)) !!}
                    </div>
                @else
                    <p class="text-muted" style="font-style: italic;">No cover letter provided.</p>
                @endif
            </div>

            <div>
                <span class="text-muted" style="display:block; font-size: 0.9rem; margin-bottom: 0.5rem;">Attached Resume</span>
                <div style="display:flex; align-items:center; gap: 1rem; padding: 1.5rem; background: #f1f5f9; border-radius: var(--radius-sm);">
                    <div style="width: 40px; height: 40px; background: #fee2e2; color: #ef4444; border-radius: 4px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                        <i class="fa-solid fa-file-pdf"></i>
                    </div>
                    <div style="flex: 1;">
                        <h4 style="margin: 0; color: var(--navy); font-size: 1rem;">Submitted_Resume</h4>
                        <span class="text-muted" style="font-size: 0.85rem;">Stored securely</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
