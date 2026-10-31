@extends('layouts.app')

@section('title', 'Saved Jobs')

@section('content')
<div class="job-detail-header bg-navy" style="padding: 4rem 0 3rem; color: white; position: relative; overflow: hidden;">
    <img src="{{ asset('images/jobs_hero_bg.jpg') }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; opacity: 0.35;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(10,25,47,0.95) 0%, rgba(10,25,47,0.6) 100%); z-index: 1;"></div>
    <div class="container text-center" style="position: relative; z-index: 2;">
        <h1 style="font-size: 2.5rem; margin-bottom: 0.5rem; color: white;">Saved Jobs</h1>
        <p class="text-muted">Opportunities you're keeping an eye on.</p>
    </div>
</div>

<div class="section-padding bg-main" style="min-height: 60vh;">
    <div class="container">
        
        @if($jobs->count() > 0)
            <div class="grid-3">
                @foreach($jobs as $job)
                    <div class="job-card card floating job-card-3d" id="saved-job-{{ $job->id }}">
                        <div class="job-card-header">
                            <img src="{{ $job->company->logo ?? 'https://ui-avatars.com/api/?name='.urlencode($job->company->name).'&background=EBF4FF&color=7F9CF5' }}" alt="{{ $job->company->name }}" class="company-logo">
                            <div class="job-card-title">
                                <h3><a href="{{ route('jobs.show', $job) }}">{{ Str::limit($job->title, 40) }}</a></h3>
                                <p>{{ $job->company->name }}</p>
                            </div>
                        </div>
                        
                        <div class="job-card-tags mt-3">
                            <span class="badge-secondary"><i class="fa-solid fa-location-dot"></i> {{ explode(',', $job->location)[0] }}</span>
                            <span class="badge-secondary">{{ $job->job_type }}</span>
                        </div>
                        
                        <div class="job-card-footer mt-4" style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('jobs.show', $job) }}" style="flex:1; text-decoration:none;">
                                <x-button variant="primary" class="full-width" style="font-size: 0.85rem; padding: 0.5rem;">View Job</x-button>
                            </a>
                            <button onclick="removeSavedJob({{ $job->id }})" class="btn btn-outline" style="font-size: 0.85rem; padding: 0.5rem; color: #ef4444; border-color: #fca5a5;">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-5">
                {{ $jobs->links() }}
            </div>
        @else
            <div class="card floating text-center" style="padding: 4rem 2rem; max-width: 600px; margin: 0 auto;">
                <div style="font-size: 4rem; color: #cbd5e1; margin-bottom: 1rem;"><i class="fa-regular fa-heart"></i></div>
                <h3 style="color: var(--navy); margin-bottom: 1rem;">No Saved Jobs</h3>
                <p class="text-muted" style="margin-bottom: 2rem;">Your saved opportunities will appear here. Start browsing and save jobs you're interested in applying for later.</p>
                <a href="{{ route('jobs.index') }}" style="text-decoration:none;"><x-button variant="primary">Browse Jobs</x-button></a>
            </div>
        @endif

    </div>
</div>
@endsection

@section('scripts')
<script>
    function removeSavedJob(jobId) {
        if(confirm('Are you sure you want to remove this job from your saved list?')) {
            fetch(`/saved-jobs/${jobId}/remove`, {
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
                    const card = document.getElementById(`saved-job-${jobId}`);
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.9)';
                    setTimeout(() => {
                        card.remove();
                        // If empty, we could reload to show empty state
                        if(document.querySelectorAll('.job-card').length === 0) {
                            window.location.reload();
                        }
                    }, 300);
                }
            })
            .catch(error => console.error('Error removing job:', error));
        }
    }
</script>
@endsection
