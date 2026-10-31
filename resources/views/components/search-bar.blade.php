<div class="search-bar-wrapper glass floating">
    <form action="{{ route('jobs.index') ?? '#' }}" method="GET" class="search-form">
        <div class="search-input-group">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" name="q" placeholder="Job title, keywords, or company" class="search-input" value="{{ request('q') }}">
        </div>
        <div class="search-divider"></div>
        <div class="search-input-group">
            <i class="fa-solid fa-location-dot search-icon"></i>
            <input type="text" name="location" placeholder="City, state, or zip code" class="search-input" value="{{ request('location') }}">
        </div>
        <x-button variant="primary" type="submit" class="search-btn">Search Jobs</x-button>
    </form>
</div>
