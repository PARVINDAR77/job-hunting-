@extends('layouts.app')

@section('title', 'Smart Match Algorithm')

@section('content')
<div class="job-detail-header bg-navy parallax-bg" style="padding: 6rem 0; color: white; position: relative; overflow: hidden; text-align: center;">
    <img src="{{ asset('images/jobs_hero_bg.jpg') }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; opacity: 0.35;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(10,25,47,0.95) 0%, rgba(10,25,47,0.6) 100%); z-index: 1;"></div>
    <div style="position: absolute; top: -50px; left: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(99,102,241,0.2) 0%, transparent 70%); border-radius: 50%; z-index: 2;"></div>
    
    <div class="container gs-reveal" style="position: relative; z-index: 10;">
        <h1 style="font-size: 3.5rem; margin-bottom: 1rem; color: white;">Smart Match</h1>
        <p style="color: #94a3b8; font-size: 1.25rem; max-width: 600px; margin: 0 auto;">Select your technical skills and our algorithm will instantly find your perfect job matches.</p>
    </div>
</div>

<div class="section-padding bg-main" style="min-height: 70vh;">
    <div class="container" style="display: flex; gap: 3rem; flex-wrap: wrap; align-items: flex-start;">
        
        <!-- Skill Selector -->
        <aside style="flex: 1; min-width: 320px;" class="gs-reveal">
            <div class="card floating" style="padding: 2.5rem;">
                <h3 style="color: var(--navy); margin-bottom: 0.5rem;">Your Skills</h3>
                <p class="text-muted" style="margin-bottom: 2rem; font-size: 0.9rem;">Select the skills you possess to find matches.</p>
                
                <div class="skills-selector" style="display: flex; flex-wrap: wrap; gap: 0.75rem; margin-bottom: 2.5rem; max-height: 400px; overflow-y: auto; padding-right: 0.5rem;">
                    @foreach($skills as $skill)
                        <div class="skill-tag" data-id="{{ $skill->id }}" style="padding: 0.5rem 1rem; border: 1px solid #cbd5e1; border-radius: 50px; color: var(--text-muted); cursor: pointer; transition: all 0.2s; user-select: none;">
                            {{ $skill->name }}
                        </div>
                    @endforeach
                </div>
                
                <button id="btn-calculate" class="btn btn-primary full-width" style="font-size: 1.1rem; padding: 1rem; display: flex; justify-content: center; align-items: center; gap: 0.5rem;" disabled>
                    <i class="fa-solid fa-microchip"></i> Calculate Match
                </button>
            </div>
        </aside>

        <!-- Results Area -->
        <main style="flex: 2; min-width: 300px;" id="match-results-container">
            <div id="initial-state" class="card text-center" style="padding: 6rem 2rem; border: 2px dashed #cbd5e1; background: transparent; box-shadow: none;">
                <i class="fa-solid fa-wand-magic-sparkles text-muted" style="font-size: 4rem; margin-bottom: 1.5rem; opacity: 0.5;"></i>
                <h3 style="color: var(--navy); margin-bottom: 1rem;">Awaiting Input</h3>
                <p class="text-muted">Select at least one skill and run the Smart Match algorithm to see results here.</p>
            </div>

            <div id="loading-state" class="text-center" style="display: none; padding: 4rem 2rem;">
                <div style="display: inline-block; width: 50px; height: 50px; border: 3px solid rgba(99,102,241,0.3); border-radius: 50%; border-top-color: var(--primary); animation: spin 1s ease-in-out infinite;"></div>
                <h3 style="color: var(--navy); margin-top: 1.5rem;">Running Algorithm...</h3>
            </div>

            <div id="results-list" style="display: flex; flex-direction: column; gap: 1.5rem;">
                <!-- Results injected via JS -->
            </div>
        </main>

    </div>
</div>
@endsection

@section('scripts')
<style>
    @keyframes spin { to { transform: rotate(360deg); } }
    .skill-tag.selected { background: var(--primary); color: white; border-color: var(--primary); box-shadow: 0 4px 10px rgba(99,102,241,0.3); transform: translateY(-2px); }
    
    .match-ring { width: 70px; height: 70px; position: relative; }
    .match-ring svg { transform: rotate(-90deg); width: 100%; height: 100%; }
    .match-ring circle { fill: transparent; stroke-width: 6; }
    .match-ring .bg { stroke: #e2e8f0; }
    .match-ring .progress { stroke: url(#gradient); stroke-linecap: round; transition: stroke-dashoffset 1.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    .match-ring-text { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; font-weight: 700; color: var(--navy); font-size: 1.1rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const tags = document.querySelectorAll('.skill-tag');
    const btnCalc = document.getElementById('btn-calculate');
    const initialState = document.getElementById('initial-state');
    const loadingState = document.getElementById('loading-state');
    const resultsList = document.getElementById('results-list');
    let selectedSkills = [];

    tags.forEach(tag => {
        tag.addEventListener('click', () => {
            const id = tag.getAttribute('data-id');
            tag.classList.toggle('selected');
            
            if(tag.classList.contains('selected')) {
                selectedSkills.push(id);
            } else {
                selectedSkills = selectedSkills.filter(s => s !== id);
            }
            
            btnCalc.disabled = selectedSkills.length === 0;
        });
    });

    btnCalc.addEventListener('click', () => {
        if(selectedSkills.length === 0) return;
        
        // UI State changes
        gsap.to([initialState, resultsList], { opacity: 0, duration: 0.3, onComplete: () => {
            initialState.style.display = 'none';
            resultsList.innerHTML = '';
            loadingState.style.display = 'block';
            gsap.fromTo(loadingState, { opacity: 0 }, { opacity: 1, duration: 0.3 });
            
            // API Call
            fetch('{{ route("discovery.match.calculate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ skills: selectedSkills })
            })
            .then(res => res.json())
            .then(data => {
                setTimeout(() => { // Artificial delay for effect
                    gsap.to(loadingState, { opacity: 0, duration: 0.3, onComplete: () => {
                        loadingState.style.display = 'none';
                        renderResults(data);
                    }});
                }, 800);
            });
        }});
    });

    function renderResults(jobs) {
        if(jobs.length === 0) {
            resultsList.innerHTML = `
                <div class="card text-center" style="padding: 4rem 2rem;">
                    <h3 style="color: var(--navy);">No matches found</h3>
                    <p class="text-muted">Try selecting different skills to find jobs.</p>
                </div>
            `;
            gsap.fromTo(resultsList, { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 0.5 });
            return;
        }

        let html = `
            <svg style="width:0;height:0;position:absolute;" aria-hidden="true" focusable="false">
              <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#4f46e5" />
                <stop offset="100%" stop-color="#ec4899" />
              </linearGradient>
            </svg>
        `;

        jobs.forEach((job, index) => {
            const circumference = 2 * Math.PI * 29; // r=29
            const offset = circumference - (job.match / 100) * circumference;
            
            html += `
                <div class="card floating match-result-card" style="padding: 1.5rem 2rem; display: flex; align-items: center; justify-content: space-between; gap: 2rem;">
                    <div style="display: flex; align-items: center; gap: 1.5rem; flex: 1;">
                        <img src="${job.logo}" style="width: 50px; height: 50px; border-radius: var(--radius-sm); object-fit: cover;">
                        <div>
                            <h3 style="margin: 0 0 0.25rem 0; font-size: 1.25rem;"><a href="${job.url}" style="color: var(--navy); text-decoration: none;">${job.title}</a></h3>
                            <p class="text-muted" style="margin: 0; font-size: 0.9rem;">${job.company} &bull; ${job.location}</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; align-items: center; gap: 2rem;">
                        <div class="match-ring">
                            <svg viewBox="0 0 70 70">
                                <circle class="bg" cx="35" cy="35" r="29"></circle>
                                <circle class="progress" cx="35" cy="35" r="29" stroke-dasharray="${circumference}" stroke-dashoffset="${circumference}" style="--target-offset: ${offset}"></circle>
                            </svg>
                            <div class="match-ring-text">${job.match}%</div>
                        </div>
                        <a href="${job.url}" class="btn btn-outline">View Job</a>
                    </div>
                </div>
            `;
        });

        resultsList.innerHTML = html;
        gsap.set(resultsList, { opacity: 1 });

        // Animate cards in
        gsap.fromTo('.match-result-card',
            { opacity: 0, x: 50 },
            { opacity: 1, x: 0, duration: 0.6, stagger: 0.1, ease: 'power2.out' }
        );

        // Animate rings
        setTimeout(() => {
            document.querySelectorAll('.match-ring .progress').forEach(circle => {
                circle.style.strokeDashoffset = circle.style.getPropertyValue('--target-offset');
            });
        }, 100);
    }
});
</script>
@endsection
