@props(['job'])

<div class="card job-card floating job-card-3d">
    <div class="job-card-header">
        <img src="{{ $job->company->logo ?? 'https://ui-avatars.com/api/?name='.urlencode($job->company->name).'&color=7F9CF5&background=EBF4FF' }}" alt="{{ $job->company->name }}" class="company-logo">
        <div class="job-meta">
            <span class="job-company">{{ $job->company->name }}</span>
            <span class="job-location"><i class="fa-solid fa-location-dot"></i> {{ $job->location }}</span>
        </div>
        <button class="save-btn"><i class="fa-regular fa-bookmark"></i></button>
    </div>
    
    <h3 class="job-title"><a href="{{ route('jobs.show', $job) }}">{{ $job->title }}</a></h3>
    
    <div class="job-badges">
        <x-status-badge type="primary">{{ $job->job_type }}</x-status-badge>
        <x-status-badge type="secondary">{{ $job->experience }}</x-status-badge>
    </div>
    
    <p class="job-salary">₹{{ number_format($job->salary_min) }} - ₹{{ number_format($job->salary_max) }} <span class="text-muted">/ year</span></p>
    
    <div class="job-card-footer">
        <span class="job-posted">{{ $job->created_at->diffForHumans() }}</span>
        <a href="{{ route('jobs.show', $job) }}" style="text-decoration:none;"><x-button variant="outline" class="sm">View Job</x-button></a>
    </div>
</div>
