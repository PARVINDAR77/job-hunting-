@extends('layouts.app')

@section('title', 'My Applications')

@section('content')
<div class="job-detail-header bg-navy" style="padding: 4rem 0 3rem; color: white; position: relative; overflow: hidden;">
    <img src="{{ asset('images/jobs_hero_bg.jpg') }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; opacity: 0.35;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(10,25,47,0.95) 0%, rgba(10,25,47,0.6) 100%); z-index: 1;"></div>
    <div class="container text-center" style="position: relative; z-index: 2;">
        <h1 style="font-size: 2.5rem; margin-bottom: 0.5rem; color: white;">My Applications</h1>
        <p class="text-muted">Track the status of jobs you've applied for.</p>
    </div>
</div>

<div class="section-padding bg-main" style="min-height: 60vh;">
    <div class="container" style="max-width: 900px;">
        
        @if($applications->count() > 0)
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                @foreach($applications as $app)
                    <div class="card floating" style="padding: 1.5rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                        
                        <div style="display: flex; gap: 1.5rem; align-items: center; flex: 1; min-width: 250px;">
                            <img src="{{ $app->job->company->logo ?? 'https://ui-avatars.com/api/?name='.urlencode($app->job->company->name).'&background=EBF4FF&color=7F9CF5' }}" style="width: 60px; height: 60px; border-radius: var(--radius-sm); object-fit: cover;">
                            <div>
                                <h3 style="margin: 0 0 0.25rem 0; font-size: 1.25rem;">
                                    <a href="{{ route('jobs.show', $app->job) }}" style="color: var(--navy); text-decoration: none;">{{ $app->job->title }}</a>
                                </h3>
                                <div style="display: flex; gap: 1rem; color: var(--text-muted); font-size: 0.9rem;">
                                    <span><i class="fa-regular fa-building"></i> {{ $app->job->company->name }}</span>
                                    <span><i class="fa-solid fa-calendar-days"></i> Applied {{ $app->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; gap: 1.5rem; align-items: center;">
                            @php
                                $statusColors = [
                                    'pending' => ['bg' => 'rgba(245, 158, 11, 0.1)', 'color' => '#d97706'],
                                    'viewed' => ['bg' => 'rgba(59, 130, 246, 0.1)', 'color' => '#2563eb'],
                                    'shortlisted' => ['bg' => 'rgba(139, 92, 246, 0.1)', 'color' => '#7c3aed'],
                                    'interview' => ['bg' => 'rgba(16, 185, 129, 0.1)', 'color' => '#059669'],
                                    'selected' => ['bg' => 'rgba(34, 197, 94, 0.1)', 'color' => '#16a34a'],
                                    'rejected' => ['bg' => 'rgba(239, 68, 68, 0.1)', 'color' => '#dc2626'],
                                ];
                                $color = $statusColors[$app->status] ?? $statusColors['pending'];
                            @endphp
                            <span style="background: {{ $color['bg'] }}; color: {{ $color['color'] }}; padding: 0.5rem 1rem; border-radius: 2rem; font-size: 0.85rem; font-weight: 600; text-transform: capitalize;">
                                {{ $app->status }}
                            </span>
                            
                            <a href="{{ route('applications.show', $app) }}" style="text-decoration:none;">
                                <x-button variant="outline" style="padding: 0.5rem 1rem;">View Details</x-button>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-5">
                {{ $applications->links() }}
            </div>
        @else
            <div class="card floating text-center" style="padding: 4rem 2rem; max-width: 600px; margin: 0 auto;">
                <div style="font-size: 4rem; color: #cbd5e1; margin-bottom: 1rem;"><i class="fa-solid fa-folder-open"></i></div>
                <h3 style="color: var(--navy); margin-bottom: 1rem;">No Applications Yet</h3>
                <p class="text-muted" style="margin-bottom: 2rem;">You haven't applied to any jobs yet. Start browsing to find your next great opportunity.</p>
                <a href="{{ route('jobs.index') }}" style="text-decoration:none;"><x-button variant="primary">Find Jobs</x-button></a>
            </div>
        @endif

    </div>
</div>
@endsection
