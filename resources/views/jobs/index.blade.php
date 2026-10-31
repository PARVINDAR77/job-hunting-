@extends('layouts.app')

@section('title', 'Search Jobs')

@section('content')

<!-- Header & Search -->
<div class="jobs-header bg-navy" style="position: relative; overflow: hidden;">
    <!-- Background Image -->
    <img src="{{ asset('images/jobs_hero_bg.jpg') }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; opacity: 0.35;">
    
    <!-- Gradient Overlay -->
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(10,25,47,0.95) 0%, rgba(10,25,47,0.6) 100%); z-index: 1;"></div>

    <div class="container text-center" style="position: relative; z-index: 10;">
        <h1 style="color: white; margin-bottom: 2rem;">Find Your Next <span class="text-primary">Opportunity</span></h1>
        
        <div class="search-bar-wrapper glass" style="margin-bottom: -40px;">
            <form action="{{ route('jobs.index') }}" method="GET" class="search-form">
                <div class="search-input-group">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" name="q" placeholder="Job title, keywords, or company" class="search-input" value="{{ request('q') }}">
                </div>
                <div class="search-divider"></div>
                <div class="search-input-group">
                    <i class="fa-solid fa-location-dot search-icon"></i>
                    <input type="text" name="location" placeholder="City, state, or zip" class="search-input" value="{{ request('location') }}">
                </div>
                <div class="search-divider"></div>
                <div class="search-input-group">
                    <i class="fa-solid fa-layer-group search-icon"></i>
                    <select name="category" class="search-input" style="background:transparent; border:none;">
                        <option value="">Any Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <x-button variant="primary" type="submit" class="search-btn">Search Jobs</x-button>
            </form>
        </div>
    </div>
</div>

<div class="section-padding bg-main" style="padding-top: 6rem;">
    <div class="container jobs-layout">
        
        <!-- Mobile Filter Button -->
        <div class="mobile-filter-trigger mobile-only mb-4">
            <x-button variant="outline" class="full-width" onclick="document.getElementById('filter-drawer').classList.add('active')">
                <i class="fa-solid fa-sliders"></i> Show Filters
            </x-button>
        </div>

        <!-- Sidebar Filters -->
        <aside class="jobs-sidebar" id="filter-drawer">
            <div class="filter-header mobile-only">
                <h3>Filters</h3>
                <button onclick="document.getElementById('filter-drawer').classList.remove('active')" class="close-filter"><i class="fa-solid fa-xmark"></i></button>
            </div>
            
            <form action="{{ route('jobs.index') }}" method="GET" id="filter-form">
                <!-- Preserve Search Params -->
                @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif
                @if(request('location')) <input type="hidden" name="location" value="{{ request('location') }}"> @endif
                @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif

                <div class="filter-group">
                    <h4 class="filter-title">Job Type</h4>
                    @php $types = ['Full Time', 'Part Time', 'Internship', 'Contract', 'Freelance', 'Remote']; @endphp
                    @foreach($types as $type)
                        <label class="custom-checkbox">
                            <input type="checkbox" name="type[]" value="{{ $type }}" {{ in_array($type, request('type', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                            <span class="checkmark"></span>
                            {{ $type }}
                        </label>
                    @endforeach
                </div>

                <div class="filter-group mt-4">
                    <h4 class="filter-title">Experience Level</h4>
                    @php $expLevels = ['Entry Level', 'Mid Level', 'Senior Level', 'Lead / Manager', 'Director']; @endphp
                    @foreach($expLevels as $exp)
                        <label class="custom-checkbox">
                            <input type="checkbox" name="experience[]" value="{{ $exp }}" {{ in_array($exp, request('experience', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                            <span class="checkmark"></span>
                            {{ $exp }}
                        </label>
                    @endforeach
                </div>

                <div class="filter-group mt-4">
                    <h4 class="filter-title">Minimum Salary</h4>
                    @php 
                        $salaries = [
                            ['label' => 'Any Salary', 'value' => ''],
                            ['label' => '₹5,00,000+', 'value' => '500000'],
                            ['label' => '₹10,00,000+', 'value' => '1000000'],
                            ['label' => '₹20,00,000+', 'value' => '2000000'],
                            ['label' => '₹30,00,000+', 'value' => '3000000'],
                        ];
                    @endphp
                    @foreach($salaries as $salary)
                        <label class="custom-radio">
                            <input type="radio" name="salary" value="{{ $salary['value'] }}" {{ request('salary') == $salary['value'] ? 'checked' : '' }} onchange="this.form.submit()">
                            <span class="radiomark"></span>
                            {{ $salary['label'] }}
                        </label>
                    @endforeach
                </div>
            </form>
        </aside>

        <!-- Main Results -->
        <main class="jobs-main">
            <div class="results-header">
                <div class="results-count">
                    <strong>{{ $jobs->total() }}</strong> Jobs Found
                </div>
                
                <div class="results-sort">
                    <form action="{{ route('jobs.index') }}" method="GET" class="sort-form">
                        <!-- Preserve Params -->
                        @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif
                        @if(request('location')) <input type="hidden" name="location" value="{{ request('location') }}"> @endif
                        @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                        @foreach(request('type', []) as $t) <input type="hidden" name="type[]" value="{{ $t }}"> @endforeach
                        @foreach(request('experience', []) as $e) <input type="hidden" name="experience[]" value="{{ $e }}"> @endforeach
                        @if(request('salary')) <input type="hidden" name="salary" value="{{ request('salary') }}"> @endif
                        
                        <select name="sort" class="form-input" style="padding: 0.5rem 1rem;" onchange="this.form.submit()">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Most Recent</option>
                            <option value="salary_desc" {{ request('sort') == 'salary_desc' ? 'selected' : '' }}>Salary: High to Low</option>
                            <option value="salary_asc" {{ request('sort') == 'salary_asc' ? 'selected' : '' }}>Salary: Low to High</option>
                        </select>
                    </form>
                </div>
            </div>

            @if($jobs->count() > 0)
                <div class="jobs-grid">
                    @foreach($jobs as $job)
                        <div class="job-card-wrapper">
                            <x-job-card :job="$job" />
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-4">
                    {{ $jobs->links('components.pagination') }}
                </div>
            @else
                <div style="background: white; padding: 3rem; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
                    <x-empty-state 
                        title="No opportunities found" 
                        description="We couldn't find any jobs matching your current filters. Try changing your search or clearing filters." 
                        actionText="Clear Filters" 
                        actionUrl="{{ route('jobs.index') }}" 
                    />
                </div>
            @endif
        </main>
    </div>
</div>

@endsection
