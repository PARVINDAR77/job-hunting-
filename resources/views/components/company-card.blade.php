@props(['company'])

<div class="card company-card floating">
    <div class="company-card-header">
        <img src="{{ $company->logo ?? 'https://ui-avatars.com/api/?name='.urlencode($company->name).'&color=7F9CF5&background=EBF4FF' }}" alt="{{ $company->name }}" class="company-logo-lg">
    </div>
    
    <div class="company-card-body">
        <h3 class="company-name"><a href="{{ route('companies.show', $company) }}">{{ $company->name }}</a></h3>
        <p class="company-industry">{{ $company->industry }} &bull; {{ $company->location }}</p>
        <div class="company-stats">
            <span class="stat"><i class="fa-solid fa-users"></i> {{ $company->employee_count }}</span>
            <span class="stat"><i class="fa-solid fa-briefcase"></i> {{ $company->jobs()->count() }} Openings</span>
        </div>
    </div>
    
    <div class="company-card-footer">
        <a href="{{ route('companies.show', $company) }}" class="btn btn-ghost full-width">View Company</a>
    </div>
</div>
