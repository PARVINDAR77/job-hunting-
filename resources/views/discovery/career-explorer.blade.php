@extends('layouts.app')

@section('title', 'Career Explorer')

@section('content')
<div class="job-detail-header bg-navy parallax-bg" style="padding: 6rem 0; color: white; position: relative; overflow: hidden; text-align: center;">
    <img src="{{ asset('images/jobs_hero_bg.jpg') }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; opacity: 0.35;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(10,25,47,0.95) 0%, rgba(10,25,47,0.6) 100%); z-index: 1;"></div>
    <div style="position: absolute; top: -50px; left: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(99,102,241,0.2) 0%, transparent 70%); border-radius: 50%; z-index: 2;"></div>
    <div style="position: absolute; bottom: -100px; right: -50px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(236,72,153,0.15) 0%, transparent 70%); border-radius: 50%; z-index: 2;"></div>
    
    <div class="container gs-reveal" style="position: relative; z-index: 10;">
        <h1 style="font-size: 3.5rem; margin-bottom: 1rem; color: white;">Career Explorer</h1>
        <p style="color: #94a3b8; font-size: 1.25rem; max-width: 600px; margin: 0 auto;">Discover your ideal career path based on your passions.</p>
    </div>
</div>

<div class="section-padding bg-main" style="min-height: 70vh;">
    <div class="container">
        
        <!-- Step 1: Select Interest -->
        <div id="step-1-interests">
            <h2 class="text-center gs-reveal" style="color: var(--navy); margin-bottom: 3rem;">What are you interested in?</h2>
            
            <div class="grid-4" style="perspective: 1000px;">
                @foreach($interests as $name => $data)
                    <div class="interest-card category-3d-card gs-reveal-card" data-interest="{{ Str::slug($name) }}" style="cursor: pointer;">
                        <div class="card floating text-center" style="padding: 3rem 1.5rem; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; border: 2px solid transparent;">
                            <div style="width: 70px; height: 70px; border-radius: 50%; background: {{ $data['color'] }}; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.75rem; margin-bottom: 1.5rem; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                                <i class="fa-solid {{ $data['icon'] }}"></i>
                            </div>
                            <h3 style="color: var(--navy); margin: 0; font-size: 1.25rem;">{{ $name }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Step 2: Recommendations (Hidden Initially) -->
        <div id="step-2-results" style="display: none; opacity: 0;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
                <div>
                    <h2 style="color: var(--navy); margin-bottom: 0.5rem;">Recommended Careers</h2>
                    <p class="text-muted" id="selected-interest-label">Based on your interest in Technology</p>
                </div>
                <button id="btn-back-interests" class="btn btn-outline"><i class="fa-solid fa-arrow-rotate-left"></i> Start Over</button>
            </div>

            @foreach($interests as $name => $data)
                <div class="interest-result-group" id="result-{{ Str::slug($name) }}" style="display: none;">
                    <div class="grid-2">
                        @foreach($data['careers'] as $career)
                            <div class="card floating" style="padding: 2.5rem; display: flex; flex-direction: column; height: 100%; border-top: 4px solid {{ explode(' ', $data['color'])[2] ?? 'var(--primary)' }};">
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                                    <h3 style="color: var(--navy); margin: 0; font-size: 1.5rem;">{{ $career['title'] }}</h3>
                                    <span class="badge-primary" style="background: rgba(16, 185, 129, 0.1); color: #059669;">{{ $career['demand'] }} Demand</span>
                                </div>
                                <p style="color: var(--text-muted); line-height: 1.6; margin-bottom: 2rem; flex: 1;">
                                    {{ $career['desc'] }}
                                </p>
                                <a href="{{ route('jobs.index', ['search' => $career['title']]) }}" style="text-decoration:none;">
                                    <x-button variant="primary" style="width: 100%;">View Available Jobs <i class="fa-solid fa-arrow-right ml-2"></i></x-button>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const interestCards = document.querySelectorAll('.interest-card');
    const step1 = document.getElementById('step-1-interests');
    const step2 = document.getElementById('step-2-results');
    const btnBack = document.getElementById('btn-back-interests');
    const selectedLabel = document.getElementById('selected-interest-label');
    const resultGroups = document.querySelectorAll('.interest-result-group');

    interestCards.forEach(card => {
        card.addEventListener('click', () => {
            const interestId = card.getAttribute('data-interest');
            const interestName = card.querySelector('h3').innerText;
            
            // Fade out step 1
            gsap.to(step1, { opacity: 0, y: -20, duration: 0.4, onComplete: () => {
                step1.style.display = 'none';
                
                // Prepare step 2
                selectedLabel.innerText = `Based on your interest in ${interestName}`;
                resultGroups.forEach(g => g.style.display = 'none');
                document.getElementById(`result-${interestId}`).style.display = 'block';
                
                // Fade in step 2
                step2.style.display = 'block';
                gsap.fromTo(step2, 
                    { opacity: 0, y: 30 }, 
                    { opacity: 1, y: 0, duration: 0.6, ease: 'power2.out' }
                );
                
                // Stagger animate the result cards
                gsap.fromTo(`#result-${interestId} .card`,
                    { opacity: 0, scale: 0.9, y: 20 },
                    { opacity: 1, scale: 1, y: 0, duration: 0.5, stagger: 0.15, ease: 'back.out(1.2)', delay: 0.2 }
                );
            }});
        });
    });

    btnBack.addEventListener('click', () => {
        gsap.to(step2, { opacity: 0, y: 20, duration: 0.4, onComplete: () => {
            step2.style.display = 'none';
            step1.style.display = 'block';
            gsap.fromTo(step1,
                { opacity: 0, y: -30 },
                { opacity: 1, y: 0, duration: 0.5, ease: 'power2.out' }
            );
        }});
    });
});
</script>
@endsection
