@extends('layouts.app')

@section('title', 'About Us - JobFinder')

@section('content')
<!-- Hero -->
<div class="job-detail-header bg-navy parallax-bg" style="padding: 7rem 0 5rem; color: white; position: relative; overflow: hidden; text-align: center;">
    <img src="{{ asset('images/jobs_hero_bg.jpg') }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; opacity: 0.35;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(10,25,47,0.95) 0%, rgba(10,25,47,0.6) 100%); z-index: 1;"></div>
    <div style="position: absolute; top: -50px; left: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(99,102,241,0.2) 0%, transparent 70%); border-radius: 50%; z-index: 2;"></div>
    
    <div class="container gs-reveal" style="position: relative; z-index: 10;">
        <span style="color: var(--primary); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 1rem; display: block;">Our Story</span>
        <h1 style="font-size: 4rem; margin-bottom: 1.5rem; color: white; line-height: 1.1;">Connecting Talent with Opportunity</h1>
        <p style="color: #94a3b8; font-size: 1.25rem; max-width: 700px; margin: 0 auto;">We believe that everyone deserves to find a job they love. JobFinder is on a mission to make the hiring process transparent, efficient, and deeply human.</p>
    </div>
</div>

<div class="section-padding bg-main">
    <div class="container">
        
        <!-- Mission & Vision -->
        <div class="grid-2" style="gap: 4rem; margin-bottom: 6rem; align-items: center;">
            <div class="gs-reveal">
                <h2 style="color: var(--navy); font-size: 2.5rem; margin-bottom: 1.5rem;">Our Mission</h2>
                <p style="color: var(--text-muted); font-size: 1.1rem; line-height: 1.8; margin-bottom: 1.5rem;">At JobFinder, our mission is to empower professionals by providing them with the tools, insights, and connections they need to navigate their careers successfully. We aim to break down the barriers between top talent and the world's most innovative companies.</p>
                <p style="color: var(--text-muted); font-size: 1.1rem; line-height: 1.8;">We're not just another job board. We're a career partner designed to support you from your first internship to your executive role.</p>
            </div>
            <div class="gs-reveal" style="position: relative;">
                <div style="position: absolute; inset: -20px; background: var(--gradient-peach); opacity: 0.2; filter: blur(40px); border-radius: 50%;"></div>
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" style="width: 100%; border-radius: var(--radius-md); box-shadow: var(--shadow); position: relative; z-index: 10;">
            </div>
        </div>

        <!-- Career Statistics -->
        <div class="card floating gs-reveal" style="padding: 4rem; background: var(--gradient-blue); color: white; margin-bottom: 6rem; text-align: center;">
            <div class="grid-4" style="gap: 2rem;">
                <div>
                    <h3 style="font-size: 3.5rem; color: white; margin-bottom: 0.5rem;">2M+</h3>
                    <p style="color: rgba(255,255,255,0.8); font-size: 1.1rem; margin: 0;">Active Users</p>
                </div>
                <div>
                    <h3 style="font-size: 3.5rem; color: white; margin-bottom: 0.5rem;">50k+</h3>
                    <p style="color: rgba(255,255,255,0.8); font-size: 1.1rem; margin: 0;">Companies Hiring</p>
                </div>
                <div>
                    <h3 style="font-size: 3.5rem; color: white; margin-bottom: 0.5rem;">150k+</h3>
                    <p style="color: rgba(255,255,255,0.8); font-size: 1.1rem; margin: 0;">Successful Matches</p>
                </div>
                <div>
                    <h3 style="font-size: 3.5rem; color: white; margin-bottom: 0.5rem;">98%</h3>
                    <p style="color: rgba(255,255,255,0.8); font-size: 1.1rem; margin: 0;">Satisfaction Rate</p>
                </div>
            </div>
        </div>

        <!-- Values -->
        <div style="text-align: center; margin-bottom: 4rem;" class="gs-reveal">
            <h2 style="color: var(--navy); font-size: 2.5rem; margin-bottom: 1rem;">Our Values</h2>
            <p style="color: var(--text-muted); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">The principles that guide every feature we build and every decision we make.</p>
        </div>
        
        <div class="grid-3" style="margin-bottom: 6rem;">
            <div class="card floating gs-reveal-card" style="padding: 3rem; text-align: center;">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: rgba(99, 102, 241, 0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 1.5rem;">
                    <i class="fa-solid fa-users"></i>
                </div>
                <h3 style="color: var(--navy); margin-bottom: 1rem;">User First</h3>
                <p style="color: var(--text-muted); line-height: 1.6;">We prioritize the candidate experience above all else, ensuring privacy and respect in the hiring process.</p>
            </div>
            
            <div class="card floating gs-reveal-card" style="padding: 3rem; text-align: center;">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: rgba(236, 72, 153, 0.1); color: #ec4899; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 1.5rem;">
                    <i class="fa-solid fa-handshake"></i>
                </div>
                <h3 style="color: var(--navy); margin-bottom: 1rem;">Transparency</h3>
                <p style="color: var(--text-muted); line-height: 1.6;">No hidden salary ranges or ghosting. We encourage companies to be open, honest, and communicative.</p>
            </div>

            <div class="card floating gs-reveal-card" style="padding: 3rem; text-align: center;">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: rgba(16, 185, 129, 0.1); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 1.5rem;">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <h3 style="color: var(--navy); margin-bottom: 1rem;">Innovation</h3>
                <p style="color: var(--text-muted); line-height: 1.6;">We continuously build smart tools like our Smart Match algorithm to reduce the friction of finding a job.</p>
            </div>
        </div>

        <!-- CTA -->
        <div class="card floating gs-reveal text-center" style="padding: 5rem 2rem; background: var(--navy); color: white;">
            <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: white;">Ready to find your next opportunity?</h2>
            <p style="color: #94a3b8; font-size: 1.1rem; margin-bottom: 2rem;">Join thousands of professionals who have found their dream jobs on JobFinder.</p>
            <div style="display: flex; gap: 1rem; justify-content: center;">
                <a href="{{ route('profile.onboarding') }}" style="text-decoration:none;"><x-button variant="primary" style="padding: 1rem 2rem; font-size: 1.1rem;">Create an Account</x-button></a>
                <a href="{{ route('jobs.index') }}" style="text-decoration:none;"><x-button variant="outline" style="padding: 1rem 2rem; font-size: 1.1rem; border-color: rgba(255,255,255,0.3); color: white;">Explore Jobs</x-button></a>
            </div>
        </div>

    </div>
</div>
@endsection
