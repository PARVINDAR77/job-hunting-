@extends('layouts.app')

@section('title', 'Browse Companies')

@section('content')
<!-- Parallax Header -->
<div class="job-detail-header bg-navy parallax-bg gs-reveal" style="padding: 6rem 0; color: white; position: relative; overflow: hidden;">
    <img src="{{ asset('images/jobs_hero_bg.jpg') }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; opacity: 0.35;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(10,25,47,0.95) 0%, rgba(10,25,47,0.6) 100%); z-index: 1;"></div>
    <div style="position: absolute; top: -50px; left: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(99,102,241,0.2) 0%, transparent 70%); border-radius: 50%; z-index: 2;"></div>
    <div style="position: absolute; bottom: -100px; right: -50px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(236,72,153,0.15) 0%, transparent 70%); border-radius: 50%;"></div>
    
    <div class="container text-center" style="position: relative; z-index: 10;">
        <h1 style="font-size: 3.5rem; margin-bottom: 1rem; color: white;">Top Companies Hiring Now</h1>
        <p style="color: #94a3b8; font-size: 1.25rem; max-width: 600px; margin: 0 auto 3rem;">Discover the best places to work and find your next career opportunity.</p>
        
        <form action="{{ route('companies.index') }}" method="GET" class="search-bar glass" style="max-width: 800px; margin: 0 auto; display: flex; gap: 1rem; padding: 1rem; border-radius: 100px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);">
            <div style="flex: 2; position: relative;">
                <i class="fa-solid fa-building text-muted" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search companies..." class="form-input" style="padding-left: 2.5rem; border-radius: 50px; border: none; background: white;">
            </div>
            <div style="flex: 1; position: relative;">
                <i class="fa-solid fa-briefcase text-muted" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); z-index: 10;"></i>
                <select name="industry" class="form-input" style="padding-left: 2.5rem; border-radius: 50px; border: none; background: white; appearance: none;">
                    <option value="">All Industries</option>
                    @foreach($industries as $ind)
                        <option value="{{ $ind }}" {{ request('industry') == $ind ? 'selected' : '' }}>{{ $ind }}</option>
                    @endforeach
                </select>
            </div>
            <x-button variant="primary" type="submit" style="border-radius: 50px; padding: 0 2rem;">Search</x-button>
        </form>
    </div>
</div>

<div class="section-padding bg-main" style="min-height: 60vh;">
    <div class="container">
        
        @if($companies->count() > 0)
            <div class="grid-3" style="gap: 2rem;">
                @foreach($companies as $company)
                    <div class="card floating gs-reveal-card" style="padding: 2rem; display: flex; flex-direction: column; height: 100%; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
                        <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1.5rem;">
                            <div style="width: 70px; height: 70px; border-radius: var(--radius-sm); overflow: hidden; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; background: white;">
                                <img src="{{ $company->logo ?? 'https://ui-avatars.com/api/?name='.urlencode($company->name).'&background=EBF4FF&color=7F9CF5' }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            </div>
                            <div>
                                <h3 style="margin: 0 0 0.25rem 0; color: var(--navy); font-size: 1.25rem;"><a href="{{ route('companies.show', $company) }}" style="color: inherit; text-decoration: none;">{{ Str::limit($company->name, 25) }}</a></h3>
                                <p style="margin: 0; color: var(--primary); font-weight: 500; font-size: 0.9rem;">{{ $company->industry ?? 'Various' }}</p>
                            </div>
                        </div>
                        
                        <p style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem; flex: 1;">
                            {{ Str::limit($company->description ?? 'No description available for this company.', 100) }}
                        </p>

                        <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #e2e8f0; padding-top: 1.5rem;">
                            <div style="color: var(--text-muted); font-size: 0.85rem;">
                                <i class="fa-solid fa-location-dot"></i> {{ explode(',', $company->location)[0] ?? 'Remote' }}
                            </div>
                            <span class="badge-primary" style="background: rgba(99, 102, 241, 0.1); color: var(--primary);">{{ $company->jobs_count }} Open Jobs</span>
                        </div>
                        
                        <a href="{{ route('companies.show', $company) }}" class="mt-4" style="text-decoration:none;">
                            <x-button variant="outline" class="full-width">View Company</x-button>
                        </a>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-5">
                {{ $companies->links('components.pagination') }}
            </div>
        @else
            <div class="card floating text-center" style="padding: 4rem 2rem; max-width: 600px; margin: 0 auto;">
                <div style="font-size: 4rem; color: #cbd5e1; margin-bottom: 1rem;"><i class="fa-regular fa-building"></i></div>
                <h3 style="color: var(--navy); margin-bottom: 1rem;">No Companies Found</h3>
                <p class="text-muted" style="margin-bottom: 2rem;">We couldn't find any companies matching your search criteria. Try adjusting your filters.</p>
                <a href="{{ route('companies.index') }}" style="text-decoration:none;"><x-button variant="primary">Clear Filters</x-button></a>
            </div>
        @endif

    </div>
</div>
@endsection
