@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="section-padding bg-main" style="min-height: 80vh;">
    <div class="container">
        
        <!-- Greeting -->
        <div class="dashboard-greeting mb-4 gs-reveal-dash">
            @php
                $hour = date('H');
                $greeting = 'Good Evening';
                if ($hour < 12) {
                    $greeting = 'Good Morning';
                } elseif ($hour < 17) {
                    $greeting = 'Good Afternoon';
                }
            @endphp
            <h1 style="color: var(--navy); font-size: 2.5rem;">{{ $greeting }}, <span class="text-primary">{{ explode(' ', $user->name)[0] }}</span></h1>
            <p class="text-muted">Here is what's happening with your job search today.</p>
        </div>

        <!-- Stat Cards Grid -->
        <div class="dashboard-stats grid-4 mt-4 gs-reveal-dash">
            
            <div class="stat-card glass floating">
                <div class="stat-icon" style="background: #e0e7ff; color: #4f46e5;">
                    <i class="fa-solid fa-paper-plane"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $applications->count() }}</h3>
                    <p>Total Applications</p>
                </div>
            </div>

            <div class="stat-card glass floating">
                <div class="stat-icon" style="background: #fee2e2; color: #ef4444;">
                    <i class="fa-solid fa-heart"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $savedJobsCount }}</h3>
                    <p>Saved Jobs</p>
                </div>
            </div>

            <div class="stat-card glass floating">
                <div class="stat-icon" style="background: #dcfce7; color: #16a34a;">
                    <i class="fa-solid fa-comments"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $interviewsCount }}</h3>
                    <p>Interviews Scheduled</p>
                </div>
            </div>

            <div class="stat-card glass floating">
                <div class="stat-content" style="width: 100%;">
                    <div style="display:flex; justify-content:space-between; margin-bottom: 0.5rem;">
                        <span style="font-weight: 600; color: var(--navy);">Profile Completion</span>
                        <span class="text-primary font-bold">{{ $profileCompletion }}%</span>
                    </div>
                    <div class="progress-bar-container">
                        <div class="progress-fill" style="width: 0%;" data-target="{{ $profileCompletion }}%"></div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="text-muted" style="font-size: 0.85rem; margin-top: 0.5rem; display:inline-block;">Complete your profile &rarr;</a>
                </div>
            </div>

        </div>

        <div class="dashboard-layout mt-5 pt-4">
            <!-- Left: Recent Applications -->
            <div class="dashboard-main gs-reveal-dash">
                <h3 style="color: var(--navy); margin-bottom: 1.5rem;">Recent Applications</h3>
                
                @if($applications->count() > 0)
                    <div class="applications-list">
                        @foreach($applications as $app)
                            <div class="app-card card">
                                <div class="app-card-header">
                                    <div style="display:flex; gap: 1rem; align-items:center;">
                                        <img src="{{ $app->job->company->logo ?? 'https://ui-avatars.com/api/?name='.urlencode($app->job->company->name).'&background=EBF4FF&color=7F9CF5' }}" style="width: 50px; border-radius: var(--radius-sm);">
                                        <div>
                                            <h4 style="margin:0; font-size: 1.1rem;"><a href="{{ route('jobs.show', $app->job) }}" style="color: var(--navy); text-decoration:none;">{{ $app->job->title }}</a></h4>
                                            <span class="text-muted" style="font-size: 0.9rem;">{{ $app->job->company->name }} &bull; Applied {{ $app->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                    <span class="badge-primary" style="text-transform: capitalize; background: rgba(99, 102, 241, 0.1); color: var(--primary);">{{ $app->status }}</span>
                                </div>
                                
                                <div class="app-card-timeline mt-4">
                                    @php
                                        // Simple logic to map status to timeline progress
                                        $statuses = ['pending', 'viewed', 'shortlisted', 'interview', 'selected'];
                                        $currentIndex = array_search($app->status, $statuses);
                                        if($currentIndex === false) $currentIndex = 0; // Fallback
                                        if($app->status == 'rejected') $currentIndex = -1; // Specific rejected state
                                    @endphp

                                    @foreach(['Applied', 'Viewed', 'Shortlisted', 'Interview', 'Selected'] as $index => $label)
                                        <div class="timeline-node {{ $app->status == 'rejected' ? 'rejected' : ($index <= $currentIndex ? 'active' : '') }}">
                                            <div class="node-dot"></div>
                                            <span class="node-label">{{ $label }}</span>
                                        </div>
                                        @if(!$loop->last)
                                            <div class="timeline-line {{ $app->status != 'rejected' && $index < $currentIndex ? 'active' : '' }}"></div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="card text-center" style="padding: 3rem;">
                        <div style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"><i class="fa-solid fa-folder-open"></i></div>
                        <p class="text-muted">You haven't applied to any jobs yet.</p>
                        <a href="{{ route('jobs.index') }}" style="text-decoration:none;"><x-button variant="primary" class="mt-2">Browse Jobs</x-button></a>
                    </div>
                @endif
            </div>

            <!-- Right: Recommended Jobs -->
            <div class="dashboard-sidebar gs-reveal-dash">
                <h3 style="color: var(--navy); margin-bottom: 1.5rem;">Recommended for You</h3>
                
                @if($recommendedJobs->count() > 0)
                    <div style="display:flex; flex-direction:column; gap: 1.5rem;">
                        @foreach($recommendedJobs as $job)
                            <div class="card floating" style="padding: 1.5rem;">
                                <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                                    <div style="display:flex; gap: 1rem;">
                                        <img src="{{ $job->company->logo ?? 'https://ui-avatars.com/api/?name='.urlencode($job->company->name).'&background=EBF4FF&color=7F9CF5' }}" style="width:40px; height:40px; border-radius:4px;">
                                        <div>
                                            <a href="{{ route('jobs.show', $job) }}" style="color:var(--navy); font-weight:600; text-decoration:none; display:block;">{{ Str::limit($job->title, 25) }}</a>
                                            <span class="text-muted" style="font-size:0.85rem;">{{ $job->company->name }}</span>
                                        </div>
                                    </div>
                                    <span style="font-size: 0.85rem; color: var(--primary); font-weight: 600;">₹{{ number_format($job->salary_min/100000, 1) }}L+</span>
                                </div>
                                <div style="display:flex; gap: 0.5rem; margin-top: 1rem;">
                                    <span class="badge-secondary" style="font-size: 0.75rem;"><i class="fa-solid fa-location-dot"></i> {{ explode(',', $job->location)[0] }}</span>
                                    <span class="badge-secondary" style="font-size: 0.75rem;">{{ $job->job_type }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No recommendations available at the moment. Update your profile location and skills to get personalized matches.</p>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
