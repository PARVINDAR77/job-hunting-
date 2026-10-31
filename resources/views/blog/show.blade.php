@extends('layouts.app')

@section('title', $post->title . ' - JobFinder Blog')

@section('content')
<!-- Hero Image Header -->
<div class="parallax-bg" style="height: 60vh; min-height: 400px; background: linear-gradient(to bottom, rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.9)), url('{{ $post->image ?? "https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" }}') center/cover; position: relative; display: flex; align-items: flex-end; padding-bottom: 4rem;">
    <div class="container gs-reveal">
        <a href="{{ route('blog.index') }}" class="text-muted" style="display:inline-block; margin-bottom: 2rem; text-decoration:none; color: rgba(255,255,255,0.7) !important;"><i class="fa-solid fa-arrow-left"></i> Back to Blog</a>
        
        <div style="max-width: 800px;">
            <span style="display: inline-block; background: var(--primary); color: white; padding: 0.25rem 1rem; border-radius: 20px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1.5rem;">{{ $post->category }}</span>
            <h1 style="color: white; font-size: 3.5rem; line-height: 1.2; margin-bottom: 1.5rem;">{{ $post->title }}</h1>
            
            <div style="display: flex; align-items: center; gap: 1rem; color: rgba(255,255,255,0.8);">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($post->author) }}&background=EBF4FF&color=4F46E5" style="width: 45px; height: 45px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.2);">
                <div>
                    <p style="margin: 0; font-weight: 600; color: white; font-size: 1.1rem;">{{ $post->author }}</p>
                    <p style="margin: 0; font-size: 0.9rem;">{{ $post->published_at ? $post->published_at->format('F d, Y') : 'Recently' }} &bull; 5 min read</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-padding bg-main">
    <div class="container">
        
        <div class="card floating gs-reveal" style="max-width: 800px; margin: -100px auto 4rem; padding: 4rem; position: relative; z-index: 20; background: white;">
            
            <p style="font-size: 1.25rem; line-height: 1.8; color: var(--text-muted); font-style: italic; border-left: 4px solid var(--primary); padding-left: 1.5rem; margin-bottom: 3rem;">
                {{ $post->excerpt }}
            </p>

            <div class="blog-content" style="color: var(--navy); font-size: 1.15rem; line-height: 1.9;">
                @if($post->content)
                    {!! nl2br(e($post->content)) !!}
                @else
                    <p>In today's fast-paced job market, staying ahead of the curve requires more than just a polished resume. It demands continuous learning, strategic networking, and a proactive approach to career development.</p>
                    <h3 style="margin: 2rem 0 1rem;">The Importance of Networking</h3>
                    <p>Building a robust professional network is arguably the most valuable investment you can make in your career. Many opportunities are never publicly advertised, and are instead filled through referrals and direct connections.</p>
                    <ul style="margin-bottom: 2rem; padding-left: 1.5rem;">
                        <li style="margin-bottom: 0.5rem;">Attend industry-specific conferences and local meetups</li>
                        <li style="margin-bottom: 0.5rem;">Engage thoughtfully with peers on professional social networks</li>
                        <li style="margin-bottom: 0.5rem;">Always send a personalized follow-up message after an interview</li>
                    </ul>
                    <p>Ultimately, your career trajectory is defined by the relationships you build and the value you consistently deliver to your teams and organizations.</p>
                @endif
            </div>
            
            <div style="display: flex; gap: 1rem; align-items: center; border-top: 1px solid #e2e8f0; padding-top: 3rem; margin-top: 3rem;">
                <span class="text-muted font-bold">Share this article:</span>
                <a href="https://twitter.com" target="_blank" class="btn btn-outline" style="border-radius: 50%; width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;"><i class="fa-brands fa-twitter"></i></a>
                <a href="https://linkedin.com" target="_blank" class="btn btn-outline" style="border-radius: 50%; width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="https://facebook.com" target="_blank" class="btn btn-outline" style="border-radius: 50%; width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;"><i class="fa-brands fa-facebook-f"></i></a>
            </div>

        </div>

        @if($related->count() > 0)
            <div style="max-width: 1000px; margin: 0 auto;">
                <h3 style="color: var(--navy); margin-bottom: 2rem; text-align: center;">Related Articles</h3>
                <div class="grid-3">
                    @foreach($related as $rel)
                        <a href="{{ route('blog.show', $rel) }}" class="card floating gs-reveal-card" style="text-decoration: none; color: inherit; padding: 0; overflow: hidden; display: flex; flex-direction: column; height: 100%;">
                            <div style="height: 150px; background: url('{{ $rel->image ?? "https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" }}') center/cover;"></div>
                            <div style="padding: 1.5rem; display: flex; flex-direction: column; flex: 1;">
                                <h4 style="color: var(--navy); font-size: 1.1rem; margin-bottom: 0.5rem; line-height: 1.3;">{{ Str::limit($rel->title, 50) }}</h4>
                                <p style="color: var(--text-muted); font-size: 0.85rem; margin: 0;">{{ $rel->published_at ? $rel->published_at->format('M d, Y') : 'Recently' }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
@endsection

@section('scripts')
<style>
    .blog-content h2, .blog-content h3 { color: var(--navy); margin-top: 2.5rem; margin-bottom: 1rem; }
    .blog-content p { margin-bottom: 1.5rem; }
    .blog-content a { color: var(--primary); text-decoration: none; border-bottom: 1px solid transparent; transition: border-color 0.2s; }
    .blog-content a:hover { border-bottom-color: var(--primary); }
</style>
@endsection
