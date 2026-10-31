@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="job-detail-header bg-navy" style="padding: 4rem 0 3rem; color: white; position: relative; overflow: hidden;">
    <img src="{{ asset('images/jobs_hero_bg.jpg') }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; opacity: 0.35;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(10,25,47,0.95) 0%, rgba(10,25,47,0.6) 100%); z-index: 1;"></div>
    <div class="container text-center" style="position: relative; z-index: 2;">
        <h1 style="font-size: 2.5rem; margin-bottom: 0.5rem; color: white;">My Profile</h1>
    </div>
</div>

<div class="section-padding bg-main">
    <div class="container" style="display: flex; gap: 3rem; align-items: flex-start; flex-wrap: wrap;">
        
        <!-- SIDEBAR -->
        <aside class="job-detail-sidebar" style="width: 320px; flex-shrink: 0;">
            <div class="card floating text-center" style="padding: 2rem;">
                
                <div style="position: relative; width: 120px; height: 120px; margin: 0 auto 1.5rem;">
                    @if($user->profile_image)
                        <img src="{{ Storage::url($user->profile_image) }}" style="width:100%; height:100%; border-radius:50%; object-fit:cover; border: 4px solid white; box-shadow: var(--shadow);">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=EBF4FF&color=4F46E5&size=120" style="width:100%; height:100%; border-radius:50%; border: 4px solid white; box-shadow: var(--shadow);">
                    @endif
                </div>

                <h3 style="color:var(--navy); margin-bottom: 0.25rem;">{{ $user->name }}</h3>
                <p class="text-primary" style="font-weight: 600; margin-bottom: 1rem;">{{ $user->job_title ?? 'Job Title Not Set' }}</p>
                <p class="text-muted" style="font-size: 0.9rem; margin-bottom: 1.5rem;"><i class="fa-solid fa-location-dot"></i> {{ $user->location ?? 'Location Not Set' }}</p>

                <div style="width: 100%; height: 1px; background: #e2e8f0; margin: 1.5rem 0;"></div>

                <div style="text-align: left; margin-bottom: 1.5rem;">
                    <div style="display:flex; justify-content:space-between; margin-bottom: 0.5rem; font-size: 0.85rem;">
                        <span style="font-weight: 600; color: var(--navy);">Profile Completion</span>
                        <span class="text-primary font-bold">{{ $profileCompletion }}%</span>
                    </div>
                    <div class="progress-bar-container">
                        <div class="progress-fill" style="width: {{ $profileCompletion }}%;"></div>
                    </div>
                </div>

                <a href="{{ route('profile.edit') }}" style="text-decoration:none;"><x-button variant="outline" class="full-width">Edit Profile</x-button></a>
            </div>

            <!-- Links Card -->
            <div class="card floating mt-4" style="padding: 1rem;">
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <a href="{{ route('dashboard') }}" class="nav-link" style="padding: 0.75rem 1rem; border-radius: 4px;"><i class="fa-solid fa-chart-pie" style="width: 24px;"></i> Dashboard</a>
                    <a href="{{ route('applications.index') }}" class="nav-link" style="padding: 0.75rem 1rem; border-radius: 4px;"><i class="fa-solid fa-paper-plane" style="width: 24px;"></i> My Applications</a>
                    <a href="{{ route('profile.saved_jobs') }}" class="nav-link" style="padding: 0.75rem 1rem; border-radius: 4px;"><i class="fa-solid fa-heart" style="width: 24px;"></i> Saved Jobs</a>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="job-detail-main" style="flex: 1; min-width: 300px;">
            
            @if(session('success'))
                <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 2rem; font-weight: 600;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            <div class="card floating" style="padding: 3rem; margin-bottom: 2rem;">
                <h3 style="color: var(--navy); margin-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem;">About Me</h3>
                @if($user->bio)
                    <p style="color: var(--text-muted); line-height: 1.8;">{!! nl2br(e($user->bio)) !!}</p>
                @else
                    <p class="text-muted" style="font-style: italic;">No bio added yet.</p>
                @endif
            </div>

            <div class="card floating" style="padding: 3rem; margin-bottom: 2rem;">
                <h3 style="color: var(--navy); margin-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem;">Skills</h3>
                @if($user->skills->count() > 0)
                    <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                        @foreach($user->skills as $skill)
                            <span class="badge-primary" style="background: rgba(99, 102, 241, 0.1); color: var(--primary);">{{ $skill->name }}</span>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted" style="font-style: italic;">No skills added yet.</p>
                @endif
            </div>

            <div class="grid-2 mt-4" style="gap: 2rem; display: grid; grid-template-columns: 1fr 1fr;">
                <div class="card floating" style="padding: 2rem;">
                    <h3 style="color: var(--navy); margin-bottom: 1.5rem;">Experience</h3>
                    @if($user->experience)
                        <p style="color: var(--text-muted); line-height: 1.8;">{!! nl2br(e($user->experience)) !!}</p>
                    @else
                        <p class="text-muted" style="font-style: italic;">No experience details added.</p>
                    @endif
                </div>

                <div class="card floating" style="padding: 2rem;">
                    <h3 style="color: var(--navy); margin-bottom: 1.5rem;">Education</h3>
                    @if($user->education)
                        <p style="color: var(--text-muted); line-height: 1.8;">{!! nl2br(e($user->education)) !!}</p>
                    @else
                        <p class="text-muted" style="font-style: italic;">No education details added.</p>
                    @endif
                </div>
            </div>

            @if($user->resume)
                <div class="card floating mt-4" style="padding: 2rem; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display:flex; align-items:center; gap: 1rem;">
                        <div style="width: 50px; height: 50px; background: #fee2e2; color: #ef4444; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                            <i class="fa-solid fa-file-pdf"></i>
                        </div>
                        <div>
                            <h4 style="margin: 0; color: var(--navy);">Resume Uploaded</h4>
                            <span class="text-muted" style="font-size: 0.85rem;">Stored securely</span>
                        </div>
                    </div>
                </div>
            @endif

        </main>
    </div>
</div>
@endsection
