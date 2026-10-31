@extends('layouts.app')

@section('title', 'JobFinder Blog - Career Advice & Insights')

@section('content')
<div class="job-detail-header bg-navy parallax-bg" style="padding: 6rem 0; color: white; position: relative; overflow: hidden; text-align: center;">
    <img src="{{ asset('images/jobs_hero_bg.jpg') }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; opacity: 0.35;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(10,25,47,0.95) 0%, rgba(10,25,47,0.6) 100%); z-index: 1;"></div>
    <div style="position: absolute; top: -50px; left: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(99,102,241,0.2) 0%, transparent 70%); border-radius: 50%; z-index: 2;"></div>
    <div style="position: absolute; bottom: -100px; right: -50px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(236,72,153,0.15) 0%, transparent 70%); border-radius: 50%; z-index: 2;"></div>
    
    <div class="container gs-reveal" style="position: relative; z-index: 10;">
        <h1 style="font-size: 3.5rem; margin-bottom: 1rem; color: white;">Career Insights</h1>
        <p style="color: #94a3b8; font-size: 1.25rem; max-width: 600px; margin: 0 auto 3rem;">Expert advice, industry trends, and tips to help you land your dream job.</p>
        
        <form action="{{ route('blog.index') }}" method="GET" class="search-bar glass" style="max-width: 800px; margin: 0 auto; display: flex; gap: 1rem; padding: 1rem; border-radius: 100px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);">
            <div style="flex: 2; position: relative;">
                <i class="fa-solid fa-magnifying-glass text-muted" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search articles..." class="form-input" style="padding-left: 2.5rem; border-radius: 50px; border: none; background: white;">
            </div>
            <div style="flex: 1; position: relative;">
                <select name="category" class="form-input" style="border-radius: 50px; border: none; background: white; appearance: none; padding-left: 1.5rem;">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                <i class="fa-solid fa-chevron-down text-muted" style="position: absolute; right: 1.5rem; top: 50%; transform: translateY(-50%); pointer-events: none;"></i>
            </div>
            <x-button variant="primary" type="submit" style="border-radius: 50px; padding: 0 2rem;">Search</x-button>
        </form>
    </div>
</div>

<div class="section-padding bg-main" style="min-height: 70vh;">
    <div class="container">
        
        @if($featured && !request('search') && !request('category'))
            <!-- Featured Article -->
            <a href="{{ route('blog.show', $featured) }}" class="card floating gs-reveal" style="display: flex; flex-wrap: wrap; text-decoration: none; color: inherit; padding: 0; overflow: hidden; margin-bottom: 4rem;">
                <div style="flex: 1; min-width: 300px; min-height: 350px; background: url('{{ $featured->image ?? "https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" }}') center/cover;"></div>
                <div style="flex: 1; padding: 4rem; display: flex; flex-direction: column; justify-content: center; min-width: 300px;">
                    <span style="color: var(--primary); font-weight: 700; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px; margin-bottom: 1rem;">{{ $featured->category }}</span>
                    <h2 style="color: var(--navy); font-size: 2.5rem; margin-bottom: 1.5rem; line-height: 1.2;">{{ $featured->title }}</h2>
                    <p style="color: var(--text-muted); font-size: 1.1rem; line-height: 1.7; margin-bottom: 2rem;">{{ Str::limit($featured->excerpt, 150) }}</p>
                    <div style="display: flex; align-items: center; gap: 1rem; margin-top: auto;">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($featured->author) }}&background=EBF4FF&color=4F46E5" style="width: 40px; height: 40px; border-radius: 50%;">
                        <div>
                            <p style="margin: 0; font-weight: 600; color: var(--navy);">{{ $featured->author }}</p>
                            <p style="margin: 0; font-size: 0.85rem; color: var(--text-muted);">{{ $featured->published_at ? $featured->published_at->format('M d, Y') : 'Recently' }}</p>
                        </div>
                    </div>
                </div>
            </a>
        @endif

        @if($posts->count() > 0)
            <div class="grid-3">
                @foreach($posts as $post)
                    <a href="{{ route('blog.show', $post) }}" class="card floating gs-reveal-card" style="text-decoration: none; color: inherit; padding: 0; overflow: hidden; display: flex; flex-direction: column; height: 100%;">
                        <div style="height: 200px; background: url('{{ $post->image ?? "https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" }}') center/cover;"></div>
                        <div style="padding: 2rem; display: flex; flex-direction: column; flex: 1;">
                            <span style="color: var(--primary); font-weight: 700; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px; margin-bottom: 0.75rem;">{{ $post->category }}</span>
                            <h3 style="color: var(--navy); font-size: 1.35rem; margin-bottom: 1rem; line-height: 1.3;">{{ $post->title }}</h3>
                            <p style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem; flex: 1;">{{ Str::limit($post->excerpt, 100) }}</p>
                            
                            <div style="display: flex; align-items: center; gap: 1rem; border-top: 1px solid #e2e8f0; padding-top: 1.5rem;">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($post->author) }}&background=EBF4FF&color=4F46E5" style="width: 35px; height: 35px; border-radius: 50%;">
                                <div>
                                    <p style="margin: 0; font-weight: 600; font-size: 0.9rem; color: var(--navy);">{{ $post->author }}</p>
                                    <p style="margin: 0; font-size: 0.8rem; color: var(--text-muted);">{{ $post->published_at ? $post->published_at->format('M d, Y') : 'Recently' }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-5">
                {{ $posts->links() }}
            </div>
        @else
            @if(!$featured)
                <div class="card floating text-center gs-reveal" style="padding: 4rem 2rem; max-width: 600px; margin: 0 auto;">
                    <div style="font-size: 4rem; color: #cbd5e1; margin-bottom: 1rem;"><i class="fa-regular fa-newspaper"></i></div>
                    <h3 style="color: var(--navy); margin-bottom: 1rem;">No Articles Found</h3>
                    <p class="text-muted" style="margin-bottom: 2rem;">We couldn't find any articles matching your search criteria.</p>
                    <a href="{{ route('blog.index') }}" style="text-decoration:none;"><x-button variant="primary">Clear Filters</x-button></a>
                </div>
            @endif
        @endif

    </div>
</div>
@endsection
