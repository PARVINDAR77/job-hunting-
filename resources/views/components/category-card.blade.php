@props(['category'])

<a href="{{ route('jobs.index', ['category' => $category->slug]) }}" class="card category-card floating">
    <div class="category-icon-wrapper bg-gradient-blue">
        <i class="{{ $category->icon ?? 'fa-solid fa-briefcase' }}"></i>
    </div>
    <div class="category-info">
        <h4 class="category-name">{{ $category->name }}</h4>
        <p class="category-count">{{ $category->jobs()->count() }} Jobs Available</p>
    </div>
    <div class="category-arrow">
        <i class="fa-solid fa-arrow-right"></i>
    </div>
</a>
