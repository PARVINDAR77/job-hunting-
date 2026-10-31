@extends('layouts.app')

@section('title', $company->name . ' - Jobs & Careers')

@section('content')
<!-- Company Header -->
<div class="job-detail-header bg-navy gs-reveal" style="padding: 5rem 0 4rem; color: white; position: relative; overflow: hidden;">
    <img src="{{ asset('images/jobs_hero_bg.jpg') }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; opacity: 0.35;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(10,25,47,0.95) 0%, rgba(10,25,47,0.6) 100%); z-index: 1;"></div>
    <div class="container" style="display: flex; gap: 3rem; align-items: center; flex-wrap: wrap; position: relative; z-index: 2;">
        <div class="glass" style="width: 140px; height: 140px; border-radius: var(--radius-md); background: white; padding: 1.5rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
            <img src="{{ $company->logo ?? 'https://ui-avatars.com/api/?name='.urlencode($company->name).'&background=EBF4FF&color=7F9CF5' }}" style="max-width: 100%; max-height: 100%;">
        </div>
        <div style="flex: 1; min-width: 300px;">
            <h1 style="font-size: 3rem; margin-bottom: 0.5rem; color: white;">{{ $company->name }}</h1>
            <p style="color: #94a3b8; font-size: 1.25rem; margin-bottom: 1.5rem;">{{ $company->industry ?? 'Technology' }}</p>
            <div style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
                <span class="badge-secondary" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2);"><i class="fa-solid fa-location-dot"></i> {{ $company->location ?? 'Global' }}</span>
                <span class="badge-secondary" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2);"><i class="fa-solid fa-users"></i> {{ $company->employee_count ?? '100-500' }} Employees</span>
                @if($company->website)
                    <a href="{{ $company->website }}" target="_blank" class="badge-secondary" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); text-decoration: none; transition: background 0.3s;"><i class="fa-solid fa-globe"></i> Visit Website</a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="section-padding bg-main">
    <div class="container" style="display: flex; gap: 3rem; align-items: flex-start; flex-wrap: wrap;">
        
        <main style="flex: 2; min-width: 300px;">
            <div class="card floating gs-reveal-card" style="padding: 3rem; margin-bottom: 3rem;">
                <h3 style="color: var(--navy); margin-bottom: 1.5rem;">About {{ $company->name }}</h3>
                <div style="color: var(--text-muted); line-height: 1.8; font-size: 1.05rem;">
                    @if($company->description)
                        {!! nl2br(e($company->description)) !!}
                    @else
                        <p>No description has been provided for this company yet.</p>
                    @endif
                </div>
            </div>

            <div class="gs-reveal-card">
                <h3 style="color: var(--navy); margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
                    Open Positions
                    <span class="badge-primary" style="font-size: 0.9rem;">{{ $company->jobs_count }} Jobs</span>
                </h3>

                @if($jobs->count() > 0)
                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                        @foreach($jobs as $job)
                            <div class="job-card card floating job-card-3d" style="display: flex; justify-content: space-between; align-items: center; padding: 2rem;">
                                <div>
                                    <h4 style="margin: 0 0 0.5rem 0; font-size: 1.25rem;"><a href="{{ route('jobs.show', $job) }}" style="color: var(--navy); text-decoration: none;">{{ $job->title }}</a></h4>
                                    <div style="display: flex; gap: 1rem; color: var(--text-muted); font-size: 0.9rem;">
                                        <span><i class="fa-solid fa-location-dot"></i> {{ $job->location }}</span>
                                        <span><i class="fa-solid fa-briefcase"></i> {{ $job->job_type }}</span>
                                        <span><i class="fa-regular fa-clock"></i> {{ $job->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('jobs.show', $job) }}" style="text-decoration:none;"><x-button variant="outline">View Job</x-button></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $jobs->links() }}
                    </div>
                @else
                    <div class="card text-center" style="padding: 4rem 2rem; background: #f8fafc;">
                        <i class="fa-solid fa-inbox text-muted" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                        <h4 style="color: var(--navy); margin-bottom: 0.5rem;">No Openings Right Now</h4>
                        <p class="text-muted" style="margin: 0;">{{ $company->name }} does not currently have any active job listings.</p>
                    </div>
                @endif
            </div>
        </main>

        <aside style="flex: 1; min-width: 300px;">
            <div class="card floating gs-reveal-card" style="padding: 2rem; background: var(--gradient-blue); color: white;">
                <h3 style="margin-bottom: 1rem; color: white;">Want to work here?</h3>
                <p style="margin-bottom: 2rem; opacity: 0.9;">Sign up for job alerts to get notified when {{ $company->name }} posts a new position.</p>
                <form>
                    <input type="email" placeholder="Your email address" class="form-input" style="margin-bottom: 1rem; background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.3); color: white;">
                    <x-button variant="primary" style="width: 100%; background: white; color: var(--primary);">Subscribe to Alerts</x-button>
                </form>
            </div>
        </aside>

    </div>
</div>
@endsection
