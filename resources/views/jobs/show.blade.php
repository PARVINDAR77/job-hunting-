@extends('layouts.app')

@section('title', $job->title . ' at ' . $job->company->name)

@section('content')

<!-- JOB HEADER -->
<div class="job-detail-header bg-navy" style="padding: 6rem 0 3rem; color: white; position: relative; overflow: hidden;">
    <img src="{{ asset('images/jobs_hero_bg.jpg') }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; opacity: 0.35;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(10,25,47,0.95) 0%, rgba(10,25,47,0.6) 100%); z-index: 1;"></div>
    <div class="container" style="position: relative; z-index: 2;">
        <a href="{{ route('jobs.index') }}" class="text-muted" style="display:inline-block; margin-bottom: 2rem; text-decoration:none;"><i class="fa-solid fa-arrow-left"></i> Back to Jobs</a>
        
        <div class="job-header-content" style="display: flex; gap: 2rem; align-items: center;">
            <div class="company-logo-large glass" style="width: 100px; height: 100px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; background: white; padding: 1rem;">
                <img src="{{ $job->company->logo ?? 'https://ui-avatars.com/api/?name='.urlencode($job->company->name).'&background=EBF4FF&color=7F9CF5' }}" alt="{{ $job->company->name }}" style="max-width: 100%; max-height: 100%;">
            </div>
            
            <div class="job-header-text">
                <h1 style="font-size: 2.5rem; margin-bottom: 0.5rem; color: white;">{{ $job->title }}</h1>
                <div style="display: flex; gap: 1.5rem; flex-wrap: wrap; color: #94a3b8; font-size: 1.1rem; align-items: center;">
                    <span><i class="fa-regular fa-building"></i> {{ $job->company->name }}</span>
                    <span><i class="fa-solid fa-location-dot"></i> {{ $job->location }}</span>
                    <span class="badge-primary" style="background: rgba(255,255,255,0.1); color:white;">{{ $job->job_type }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-padding bg-main">
    <div class="container" style="display: flex; gap: 3rem; align-items: flex-start; flex-wrap: wrap;">
        
        <!-- MAIN CONTENT -->
        <main class="job-detail-main card floating" style="flex: 1; min-width: 300px; padding: 3rem;">
            
            @if(session('success'))
                <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 2rem; font-weight: 600;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 2rem; font-weight: 600;">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                </div>
            @endif

            <section class="mb-4">
                <h3 style="color: var(--navy); margin-bottom: 1rem;">About the Job</h3>
                <p style="color: var(--text-muted); line-height: 1.8;">{{ $job->description }}</p>
                <p style="color: var(--text-muted); line-height: 1.8; margin-top: 1rem;">We are looking for a passionate and experienced professional to join our team. In this role, you will be responsible for driving impactful projects and working alongside a talented group of engineers, designers, and product managers to deliver exceptional results.</p>
            </section>

            <div style="width: 100%; height: 1px; background: #e2e8f0; margin: 2rem 0;"></div>

            <section class="mb-4">
                <h3 style="color: var(--navy); margin-bottom: 1rem;">Responsibilities</h3>
                <ul style="color: var(--text-muted); line-height: 1.8; padding-left: 1.5rem; display: flex; flex-direction: column; gap: 0.5rem;">
                    <li>Design, build, and maintain efficient, reusable, and reliable code.</li>
                    <li>Ensure the best possible performance, quality, and responsiveness of applications.</li>
                    <li>Identify bottlenecks and bugs, and devise solutions to mitigate and address these issues.</li>
                    <li>Help maintain code quality, organization, and automatization.</li>
                    <li>Collaborate with cross-functional teams to define, design, and ship new features.</li>
                </ul>
            </section>

            <div style="width: 100%; height: 1px; background: #e2e8f0; margin: 2rem 0;"></div>

            <section class="mb-4">
                <h3 style="color: var(--navy); margin-bottom: 1rem;">Requirements & Skills</h3>
                <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1.5rem;">
                    @foreach($job->skills as $skill)
                        <span class="badge-secondary">{{ $skill->name }}</span>
                    @endforeach
                    @if($job->skills->count() == 0)
                        <span class="badge-secondary">Communication</span>
                        <span class="badge-secondary">Teamwork</span>
                    @endif
                </div>
                <ul style="color: var(--text-muted); line-height: 1.8; padding-left: 1.5rem; display: flex; flex-direction: column; gap: 0.5rem;">
                    <li>Minimum {{ $job->experience }} of relevant work experience.</li>
                    <li>Strong understanding of modern web technologies.</li>
                    <li>Ability to work independently as well as in a collaborative team environment.</li>
                    <li>Excellent problem-solving skills and attention to detail.</li>
                </ul>
            </section>
        </main>

        <!-- SIDEBAR -->
        <aside class="job-detail-sidebar" style="width: 350px; flex-shrink: 0;">
            
            <!-- Actions Card -->
            <div class="card floating" style="padding: 2rem; margin-bottom: 2rem;">
                <div style="margin-bottom: 1.5rem;">
                    <span style="display:block; color:var(--text-muted); font-size:0.9rem; margin-bottom:0.25rem;">Salary Range</span>
                    <strong style="color:var(--navy); font-size: 1.5rem;">₹{{ number_format($job->salary_min) }} - ₹{{ number_format($job->salary_max) }}</strong>
                    <span style="color:var(--text-muted); font-size:0.9rem;">/ year</span>
                </div>

                @if($job->hasApplied(auth()->user()))
                    <x-button variant="secondary" class="full-width" style="margin-bottom: 1rem; opacity: 0.7; cursor: default;">
                        <i class="fa-solid fa-check"></i> Already Applied
                    </x-button>
                @else
                    <a href="{{ route('applications.create', $job) }}" style="text-decoration: none;">
                        <x-button variant="primary" class="full-width" style="margin-bottom: 1rem;">Apply Now</x-button>
                    </a>
                @endif
                
                @php 
                    $isSaved = $job->isSavedBy(auth()->user());
                @endphp
                <x-button variant="outline" class="full-width save-job-btn" data-job-id="{{ $job->id }}" onclick="toggleSaveJob(this)">
                    <i class="{{ $isSaved ? 'fa-solid text-primary' : 'fa-regular' }} fa-heart heart-icon" style="transition: all 0.3s ease;"></i> 
                    <span class="save-text">{{ $isSaved ? 'Saved' : 'Save Job' }}</span>
                </x-button>
            </div>

            <!-- Job Info Card -->
            <div class="card floating" style="padding: 2rem; margin-bottom: 2rem;">
                <h4 style="color:var(--navy); margin-bottom: 1.5rem;">Job Information</h4>
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <div style="display:flex; gap: 1rem;">
                        <div style="width:40px; height:40px; border-radius:50%; background:#f1f5f9; display:flex; align-items:center; justify-content:center; color:var(--primary);">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <div>
                            <span style="display:block; color:var(--text-muted); font-size:0.85rem;">Date Posted</span>
                            <strong style="color:var(--navy);">{{ $job->created_at->diffForHumans() }}</strong>
                        </div>
                    </div>
                    <div style="display:flex; gap: 1rem;">
                        <div style="width:40px; height:40px; border-radius:50%; background:#f1f5f9; display:flex; align-items:center; justify-content:center; color:var(--primary);">
                            <i class="fa-solid fa-briefcase"></i>
                        </div>
                        <div>
                            <span style="display:block; color:var(--text-muted); font-size:0.85rem;">Experience</span>
                            <strong style="color:var(--navy);">{{ $job->experience }}</strong>
                        </div>
                    </div>
                    <div style="display:flex; gap: 1rem;">
                        <div style="width:40px; height:40px; border-radius:50%; background:#f1f5f9; display:flex; align-items:center; justify-content:center; color:var(--primary);">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div>
                            <span style="display:block; color:var(--text-muted); font-size:0.85rem;">Job Type</span>
                            <strong style="color:var(--navy);">{{ $job->job_type }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Company Info Card -->
            <div class="card floating" style="padding: 2rem;">
                <h4 style="color:var(--navy); margin-bottom: 1.5rem;">About Company</h4>
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <img src="{{ $job->company->logo ?? 'https://ui-avatars.com/api/?name='.urlencode($job->company->name).'&background=EBF4FF&color=7F9CF5' }}" alt="{{ $job->company->name }}" style="width: 50px; border-radius: var(--radius-sm);">
                    <strong style="font-size: 1.2rem; color:var(--navy);">{{ $job->company->name }}</strong>
                </div>
                <p style="color:var(--text-muted); font-size:0.95rem; line-height: 1.6; margin-bottom: 1.5rem;">{{ $job->company->description ?? 'A leading company in its sector, dedicated to innovation and excellence.' }}</p>
                <a href="{{ $job->company->website ?? '#' }}" target="_blank" class="text-primary" style="text-decoration:none; font-weight:600;"><i class="fa-solid fa-globe"></i> Visit Website</a>
            </div>

        </aside>
    </div>
</div>

<!-- RELATED JOBS -->
@if($relatedJobs->count() > 0)
<div class="section-padding bg-main" style="padding-top: 0;">
    <div class="container">
        <div class="section-header">
            <h2>Related Jobs</h2>
        </div>
        <div class="grid-3 mt-4">
            @foreach($relatedJobs as $related)
                <div class="job-card-wrapper">
                    <x-job-card :job="$related" />
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@endsection

@section('scripts')
<script>
    function toggleSaveJob(button) {
        // Must be authenticated to save
        @guest
            window.location.href = "{{ route('login') }}";
            return;
        @endguest

        const jobId = button.dataset.jobId;
        const icon = button.querySelector('.heart-icon');
        const text = button.querySelector('.save-text');

        // Add pop animation class
        icon.style.transform = 'scale(1.3)';
        setTimeout(() => icon.style.transform = 'scale(1)', 200);

        fetch(`/jobs/${jobId}/save`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'success') {
                if(data.saved) {
                    icon.classList.remove('fa-regular');
                    icon.classList.add('fa-solid', 'text-primary');
                    text.innerText = 'Saved';
                } else {
                    icon.classList.remove('fa-solid', 'text-primary');
                    icon.classList.add('fa-regular');
                    text.innerText = 'Save Job';
                }
            }
        })
        .catch(error => console.error('Error saving job:', error));
    }
</script>
@endsection
