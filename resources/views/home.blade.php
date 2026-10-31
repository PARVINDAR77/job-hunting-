@extends('layouts.app')

@section('title', 'Find Your Next Opportunity')

@section('content')

<!-- HERO SECTION -->
<div class="hero-section" id="hero">
    <div class="container hero-container">
        <div class="hero-content">
            <h1 class="hero-title" id="hero-title">Find Your Next <br><span class="text-primary" id="typewriter">Opportunity</span><span class="cursor text-primary">|</span></h1>
            <p class="hero-subtitle" id="hero-subtitle">Discover jobs that match your skills, passion and future.</p>
            
            <div class="hero-search" id="hero-search">
                <div class="search-bar-wrapper glass" style="padding: 0.5rem; border-radius: 9999px; box-shadow: 0 20px 40px rgba(10, 25, 47, 0.12);">
                    <form action="{{ route('jobs.index') }}" method="GET" class="search-form">
                        <div class="search-input-group">
                            <i class="fa-solid fa-magnifying-glass search-icon"></i>
                            <input type="text" name="q" placeholder="Job title or skill" class="search-input" style="outline: none;">
                        </div>
                        <div class="search-divider"></div>
                        <div class="search-input-group">
                            <i class="fa-solid fa-location-dot search-icon"></i>
                            <input type="text" name="location" placeholder="Location" class="search-input" style="outline: none;">
                        </div>
                        <button type="submit" class="btn btn-primary search-btn">Search Jobs</button>
                    </form>
                </div>
            </div>
            
            <div class="trending-searches" style="display: flex; flex-wrap: wrap; gap: 0.75rem; align-items: center; font-size: 0.9rem;">
                <span class="tags-label">Popular:</span>
                <a href="{{ route('jobs.index', ['search' => 'Designer']) }}" class="trending-badge" style="text-decoration: none; background: rgba(79, 70, 229, 0.1); color: #4f46e5; padding: 0.4rem 1rem; border-radius: 20px; font-weight: 600; display: inline-block;">Designer</a>
                <a href="{{ route('jobs.index', ['search' => 'Web Developer']) }}" class="trending-badge" style="text-decoration: none; background: rgba(79, 70, 229, 0.1); color: #4f46e5; padding: 0.4rem 1rem; border-radius: 20px; font-weight: 600; display: inline-block;">Web Developer</a>
                <a href="{{ route('jobs.index', ['search' => 'Laravel']) }}" class="trending-badge" style="text-decoration: none; background: rgba(79, 70, 229, 0.1); color: #4f46e5; padding: 0.4rem 1rem; border-radius: 20px; font-weight: 600; display: inline-block;">Laravel</a>
                <a href="{{ route('jobs.index', ['search' => 'Manager']) }}" class="trending-badge" style="text-decoration: none; background: rgba(79, 70, 229, 0.1); color: #4f46e5; padding: 0.4rem 1rem; border-radius: 20px; font-weight: 600; display: inline-block;">Manager</a>
                <a href="{{ route('jobs.index', ['search' => 'Marketing']) }}" class="trending-badge" style="text-decoration: none; background: rgba(79, 70, 229, 0.1); color: #4f46e5; padding: 0.4rem 1rem; border-radius: 20px; font-weight: 600; display: inline-block;">Marketing</a>
            </div>
        </div>
        
        <div class="hero-visual" id="hero-visual">
            <div class="hero-3d-wrapper">
                <img src="{{ asset('images/hero_3d.jpg') }}" alt="Professional sitting" class="hero-3d-img" style="border-radius: var(--radius-lg);">
                
                <!-- Floating UI Cards -->
                <div class="float-card float-match glass floating" id="float-1">
                    <div class="match-circle"><i class="fa-solid fa-check"></i></div>
                    <div>
                        <span class="float-label">Match Score</span>
                        <span class="float-value">98% Fit</span>
                    </div>
                </div>
                
                <div class="float-card float-salary glass floating" id="float-2">
                    <div class="icon-sq bg-gradient-blue"><i class="fa-solid fa-money-bill-wave"></i></div>
                    <div>
                        <span class="float-label">Average Salary</span>
                        <span class="float-value">₹15L - ₹25L</span>
                    </div>
                </div>
                
                <div class="float-card float-company glass floating" id="float-3">
                    <div class="company-placeholder">
                        <i class="fa-brands fa-laravel text-primary"></i>
                    </div>
                    <div>
                        <span class="float-label">Top Choice</span>
                        <span class="float-value">NovaTech Inc.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TRUSTED COMPANIES -->
<div class="trusted-section bg-navy">
    <div class="container">
        <h4 class="text-center text-muted trusted-heading">Trusted by growing companies</h4>
        <div class="marquee-wrapper">
            <div class="marquee">
                <span class="marquee-item"><i class="fa-solid fa-laptop-code"></i> TCS</span>
                <span class="marquee-item"><i class="fa-solid fa-code-branch"></i> Infosys</span>
                <span class="marquee-item"><i class="fa-solid fa-globe"></i> Wipro</span>
                <span class="marquee-item"><i class="fa-solid fa-industry"></i> Reliance</span>
                <span class="marquee-item"><i class="fa-solid fa-microchip"></i> Tech Mahindra</span>
                <span class="marquee-item"><i class="fa-solid fa-network-wired"></i> HCLTech</span>
                <span class="marquee-item"><i class="fa-solid fa-cart-shopping"></i> Flipkart</span>
                <!-- Duplicate for seamless scroll -->
                <span class="marquee-item"><i class="fa-solid fa-laptop-code"></i> TCS</span>
                <span class="marquee-item"><i class="fa-solid fa-code-branch"></i> Infosys</span>
                <span class="marquee-item"><i class="fa-solid fa-globe"></i> Wipro</span>
                <span class="marquee-item"><i class="fa-solid fa-industry"></i> Reliance</span>
                <span class="marquee-item"><i class="fa-solid fa-microchip"></i> Tech Mahindra</span>
                <span class="marquee-item"><i class="fa-solid fa-network-wired"></i> HCLTech</span>
                <span class="marquee-item"><i class="fa-solid fa-cart-shopping"></i> Flipkart</span>
            </div>
        </div>
    </div>
</div>

<!-- TOP OPPORTUNITIES -->
<div class="section-padding gs-reveal">
    <div class="container">
        <div class="section-header">
            <h2>Top Opportunities</h2>
            <x-button variant="outline">View All Jobs</x-button>
        </div>

        
        <div class="grid-3 mt-4">
            @foreach($topJobs as $job)
                <div class="job-card-wrapper" data-tilt>
                    <x-job-card :job="$job" />
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- CATEGORIES -->
<div class="bg-main gs-reveal" style="padding: 3rem 0; overflow-x: hidden;">
    <div class="container">
        <div class="section-header text-center" style="justify-content: center; margin-bottom: 2rem;">
            <h2>Explore Career Categories</h2>
        </div>
    </div>
        
    <style>
        .categories-marquee-wrapper {
            width: 100vw;
            margin-left: calc(-50vw + 50%);
            overflow: hidden;
            padding: 0.5rem 0;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        .categories-marquee-track {
            display: flex;
            gap: 1.5rem;
            width: max-content;
            padding: 0 1rem;
        }
        .categories-marquee-track.left {
            animation: scroll-left 40s linear infinite;
        }
        .categories-marquee-track.right {
            animation: scroll-right 40s linear infinite;
        }
        .categories-marquee-track:hover {
            animation-play-state: paused;
        }
        .categories-marquee-item {
            width: 280px;
            flex-shrink: 0;
        }
        @keyframes scroll-left {
            from { transform: translateX(0); }
            to { transform: translateX(calc(-50% - 1rem)); }
        }
        @keyframes scroll-right {
            from { transform: translateX(calc(-50% - 1rem)); }
            to { transform: translateX(0); }
        }
    </style>

    <div class="categories-marquee-wrapper">
        <!-- Row 1: Scrolls Left -->
        <div class="categories-marquee-track left">
            @foreach($categories->take(5) as $category)
                <div class="categories-marquee-item"><x-category-card :category="$category" /></div>
            @endforeach
            <!-- Duplicate for seamless looping -->
            @foreach($categories->take(5) as $category)
                <div class="categories-marquee-item"><x-category-card :category="$category" /></div>
            @endforeach
        </div>

        <!-- Row 2: Scrolls Right -->
        <div class="categories-marquee-track right">
            @foreach($categories->skip(5)->take(5) as $category)
                <div class="categories-marquee-item"><x-category-card :category="$category" /></div>
            @endforeach
            <!-- Duplicate for seamless looping -->
            @foreach($categories->skip(5)->take(5) as $category)
                <div class="categories-marquee-item"><x-category-card :category="$category" /></div>
            @endforeach
        </div>
    </div>
</div>

<!-- HOW IT WORKS -->
<div class="section-padding">
    <div class="container">
        <div class="section-header text-center" style="flex-direction: column; align-items: center; margin-bottom: 4rem;">
            <h2>How It Works</h2>
            <p class="text-muted">Four simple steps to land your dream job.</p>
        </div>
        
        <style>
            .steps-container {
                display: grid !important;
                grid-template-columns: repeat(4, 1fr) !important;
                gap: 2rem !important;
                position: relative !important;
                margin-top: 2rem !important;
            }
            .steps-container::before {
                content: '' !important;
                position: absolute !important;
                top: 4.5rem !important;
                left: 5% !important;
                right: 5% !important;
                height: 2px !important;
                background-image: linear-gradient(90deg, #cbd5e1 50%, transparent 50%) !important;
                background-size: 20px 100% !important;
                z-index: 0 !important;
            }
            .step-card {
                background: var(--bg-card) !important;
                padding: 2.5rem 1.5rem !important;
                border-radius: var(--radius-lg) !important;
                box-shadow: var(--shadow-md) !important;
                text-align: center !important;
                position: relative !important;
                z-index: 1 !important;
                border: 1px solid rgba(0,0,0,0.05) !important;
                background-clip: padding-box !important;
                
                /* Book page flip animation setup */
                opacity: 0;
                transform-origin: left center;
                transform: perspective(1200px) rotateY(-90deg);
                transition: transform 0.8s cubic-bezier(0.2, 0.8, 0.2, 1), opacity 0.8s ease-out;
            }
            .step-card.is-visible {
                opacity: 1 !important;
                transform: perspective(1200px) rotateY(0deg) !important;
            }
            .step-number {
                width: 4rem !important;
                height: 4rem !important;
                background: var(--gradient-blue) !important;
                color: white !important;
                font-size: 1.25rem !important;
                font-weight: 700 !important;
                border-radius: 50% !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                margin: 0 auto 1.5rem !important;
                box-shadow: 0 10px 20px rgba(142, 197, 252, 0.4) !important;
                border: 6px solid white !important;
            }
            @media (max-width: 1024px) {
                .steps-container { grid-template-columns: repeat(2, 1fr) !important; }
                .steps-container::before { display: none !important; }
            }
            @media (max-width: 768px) {
                .steps-container { grid-template-columns: 1fr !important; }
            }
        </style>
        
        <div class="steps-container" id="steps-container">
            <div class="step-card book-page">
                <div class="step-number">01</div>
                <h3>Create Your Profile</h3>
                <p>Sign up and build your profile to showcase your skills and experience to top employers.</p>
            </div>
            <div class="step-card book-page">
                <div class="step-number">02</div>
                <h3>Discover Opportunities</h3>
                <p>Search through thousands of high-quality jobs tailored to your career goals.</p>
            </div>
            <div class="step-card book-page">
                <div class="step-number">03</div>
                <h3>Apply With Confidence</h3>
                <p>Send your application directly to hiring managers with a single click.</p>
            </div>  
            <div class="step-card book-page">
                <div class="step-number">04</div>
                <h3>Track Your Journey</h3>
                <p>Monitor your application status and interview requests on your personal dashboard.</p>
            </div>
        </div>
    </div>
</div>

<!-- CAREER SECTION -->
<div class="section-padding gs-reveal" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); position: relative; overflow: hidden; color: white;">
    <!-- Decorative Glowing Orbs -->
    <div style="position: absolute; top: -150px; right: -100px; width: 400px; height: 400px; background: #4f46e5; filter: blur(120px); opacity: 0.5; border-radius: 50%; z-index: 0;"></div>
    <div style="position: absolute; bottom: -150px; left: -100px; width: 350px; height: 350px; background: #ec4899; filter: blur(120px); opacity: 0.4; border-radius: 50%; z-index: 0;"></div>
    
    <style>
        .career-section {
            display: flex;
            align-items: center;
            gap: 4rem;
            position: relative;
            z-index: 2;
        }
        .career-content {
            flex: 1;
        }
        .career-visual {
            flex: 1;
            display: flex;
            justify-content: center;
            position: relative;
        }
        .career-list {
            list-style: none;
            padding: 0;
            margin-bottom: 2rem;
        }
        .career-list li {
            margin-bottom: 1.25rem;
            font-size: 1.15rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 1rem;
            color: rgba(255,255,255,0.9);
        }
        .career-list-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border-radius: 50%;
            font-size: 0.8rem;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.4);
        }
        .profile-card {
            background: rgba(255, 255, 255, 0.05);
            padding: 2.5rem;
            border-radius: 1.5rem;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            border: 1px solid rgba(255,255,255,0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        .profile-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .profile-header h4 {
            margin: 0;
            font-size: 1.4rem;
            color: white;
            font-weight: 700;
        }
        .profile-header p {
            margin: 0;
            color: rgba(255,255,255,0.7);
        }
        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid rgba(255,255,255,0.2);
        }
        .profile-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .skill-badge {
            background: rgba(255,255,255,0.1);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid rgba(255,255,255,0.05);
        }
        .progress-bar {
            height: 8px;
            background: rgba(255,255,255,0.1);
            border-radius: 4px;
            overflow: hidden;
            width: 100%;
            margin-top: 8px;
        }
        .progress-fill {
            height: 100%;
            width: 100%;
            background: linear-gradient(90deg, #4f46e5 0%, #ec4899 100%);
            box-shadow: 0 0 10px rgba(236, 72, 153, 0.5);
        }
        @media (max-width: 992px) {
            .career-section {
                flex-direction: column;
                text-align: center;
            }
            .career-list li {
                justify-content: center;
            }
        }
    </style>
    <div class="container career-section">
        <div class="career-content">
            <h2 style="font-size: 3rem; margin-bottom: 1.5rem; line-height: 1.2;">Build Your Career<br><span style="background: linear-gradient(135deg, #a78bfa 0%, #f472b6 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">With Confidence</span></h2>
            <p style="color: rgba(255,255,255,0.7); margin-bottom: 2.5rem; font-size: 1.15rem; line-height: 1.8;">
                Create your profile, showcase your skills and discover opportunities that fit your goals. Our platform connects you with the fastest-growing startups and enterprises.
            </p>
            <ul class="career-list">
                <li><span class="career-list-icon"><i class="fa-solid fa-check"></i></span> Stand out to recruiters</li>
                <li><span class="career-list-icon"><i class="fa-solid fa-check"></i></span> Receive real-time job alerts</li>
                <li><span class="career-list-icon"><i class="fa-solid fa-check"></i></span> 1-click lightning fast applications</li>
            </ul>
            <x-button variant="primary" class="mt-4" style="background: linear-gradient(135deg, #4f46e5 0%, #ec4899 100%); border: none; padding: 1rem 2rem; font-size: 1.1rem; box-shadow: 0 10px 25px rgba(236,72,153,0.4); color: white;">Create Your Profile</x-button>
        </div>
        <div class="career-visual">
            <div class="profile-card floating">
                <div class="profile-header">
                    <img src="https://ui-avatars.com/api/?name=Jane+Doe&background=3b82f6&color=fff&size=128" alt="User" class="profile-img">
                    <div>
                        <h4>Jane Doe</h4>
                        <p>Senior UX Designer</p>
                    </div>
                </div>
                <div class="profile-skills mt-4">
                    <span class="skill-badge">Figma</span>
                    <span class="skill-badge">UI Design</span>
                    <span class="skill-badge">Prototyping</span>
                    <span class="skill-badge">User Research</span>
                </div>
                <div class="profile-match mt-4 pt-2">
                    <div style="display:flex; justify-content:space-between; margin-bottom: 5px; color: rgba(255,255,255,0.8); font-size: 0.9rem;">
                        <span>Profile Completion</span>
                        <span style="color: #f472b6; font-weight: bold;">100%</span>
                    </div>
                    <div class="progress-bar"><div class="progress-fill"></div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- COMPANIES -->
<div class="section-padding bg-main gs-reveal" id="companies-section" style="position: relative;">
    <div class="container">
        <div class="section-header text-center" style="justify-content: center;">
            <h2>Explore Top Companies</h2>
        </div>
        
        <style>
            .surprise-box-container {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 20;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 150px;
                transition: all 0.5s;
            }
            .surprise-box {
                font-size: 5rem;
                color: var(--primary);
                filter: drop-shadow(0 10px 15px rgba(255,107,107,0.3));
                transform-origin: bottom center;
                opacity: 0;
                transform: scale(0);
                transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            }
            .surprise-box.show {
                opacity: 1;
                transform: scale(1);
            }
            .surprise-box.shake {
                animation: boxShake 0.6s cubic-bezier(.36,.07,.19,.97) both;
            }
            .surprise-box.open {
                transform: scale(0) translateY(-50px);
                opacity: 0;
            }
            @keyframes boxShake {
                10%, 90% { transform: translate3d(-2px, 0, 0) rotate(-5deg); }
                20%, 80% { transform: translate3d(4px, 0, 0) rotate(5deg); }
                30%, 50%, 70% { transform: translate3d(-6px, 0, 0) rotate(-10deg); }
                40%, 60% { transform: translate3d(6px, 0, 0) rotate(10deg); }
            }
            
            .companies-grid {
                position: relative;
            }
            .company-card-wrapper {
                opacity: 0;
                transform: scale(0.5) translateY(50px);
                transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                pointer-events: none; /* Prevent interaction while hidden */
            }
            .company-card-wrapper.pop-out {
                opacity: 1;
                transform: scale(1) translateY(0);
                pointer-events: auto;
            }
        </style>

        <!-- The Surprise Box -->
        <div class="surprise-box-container" id="surprise-box-container">
            <i class="fa-solid fa-box surprise-box" id="surprise-box"></i>
        </div>
        
        <div class="grid-3 mt-4 companies-grid" id="companies-grid">
            @foreach($companies as $company)
                <div class="company-card-wrapper">
                    <x-company-card :company="$company" />
                </div>
            @endforeach
        </div>
        
        <div class="text-center" style="margin-top: 3rem;">
            <x-button variant="outline" id="view-all-companies" style="display: none; opacity: 0; transition: opacity 0.5s;">View All Companies</x-button>
        </div>
    </div>
</div>

<!-- TESTIMONIALS -->
<div class="section-padding gs-reveal">
    <div class="container text-center">
        <h2>What Our Users Say</h2>
        
        <div class="grid-3 mt-4" style="text-align: left;">
            <div class="card floating" style="padding: 2rem;">
                <div class="text-primary" style="font-size: 1.5rem; margin-bottom: 1rem;"><i class="fa-solid fa-quote-left"></i></div>
                <p style="margin-bottom: 1.5rem;">"JobFinder made it incredibly easy for me to find a remote role that matched my specific skill set. The 1-click application is a game changer!"</p>
                <div style="display:flex; align-items:center; gap: 1rem;">
                    <img src="https://ui-avatars.com/api/?name=Alex+Smith&background=EBF4FF&color=7F9CF5" alt="Alex" style="width:40px; border-radius:50%;">
                    <div>
                        <strong style="display:block; color:var(--navy);">Alex Smith</strong>
                        <span class="text-muted" style="font-size: 0.85rem;">Frontend Developer</span>
                    </div>
                </div>
            </div>
            
            <div class="card floating" style="padding: 2rem;">
                <div class="text-primary" style="font-size: 1.5rem; margin-bottom: 1rem;"><i class="fa-solid fa-quote-left"></i></div>
                <p style="margin-bottom: 1.5rem;">"Within a week of creating my profile, I was contacted by three amazing startups. I accepted an offer two weeks later. Highly recommended platform."</p>
                <div style="display:flex; align-items:center; gap: 1rem;">
                    <img src="https://ui-avatars.com/api/?name=Priya+Patel&background=fecfef&color=ff6b6b" alt="Priya" style="width:40px; border-radius:50%;">
                    <div>
                        <strong style="display:block; color:var(--navy);">Priya Patel</strong>
                        <span class="text-muted" style="font-size: 0.85rem;">Product Manager</span>
                    </div>
                </div>
            </div>
            
            <div class="card floating" style="padding: 2rem;">
                <div class="text-primary" style="font-size: 1.5rem; margin-bottom: 1rem;"><i class="fa-solid fa-quote-left"></i></div>
                <p style="margin-bottom: 1.5rem;">"The category and salary insights helped me negotiate a 20% higher salary than I originally expected. Thank you JobFinder!"</p>
                <div style="display:flex; align-items:center; gap: 1rem;">
                    <img src="https://ui-avatars.com/api/?name=Rahul+Sharma&background=e0c3fc&color=8ec5fc" alt="Rahul" style="width:40px; border-radius:50%;">
                    <div>
                        <strong style="display:block; color:var(--navy);">Rahul Sharma</strong>
                        <span class="text-muted" style="font-size: 0.85rem;">Data Scientist</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- FULL SCREEN: ABOUT US -->
<div class="section-padding" style="background: white;">
    <div class="container">
        <div class="text-center gs-reveal" style="margin-bottom: 4rem;">
            <span style="color: var(--primary); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 1rem; display: block;">About Us</span>
            <h2 style="color: var(--navy); font-size: 3rem; margin-bottom: 1rem;">Our Mission & Vision</h2>
            <p style="color: var(--text-muted); font-size: 1.2rem; max-width: 700px; margin: 0 auto;">We believe that everyone deserves to find a job they love. JobFinder is on a mission to empower professionals globally.</p>
        </div>
        
        <div class="grid-2" style="gap: 4rem; align-items: center;">
            <div class="gs-reveal">
                <h3 style="color: var(--navy); font-size: 2rem; margin-bottom: 1.5rem;">Connecting Talent with Opportunity</h3>
                <p style="color: var(--text-muted); font-size: 1.1rem; line-height: 1.8; margin-bottom: 1.5rem;">At JobFinder, our mission is to empower professionals by providing them with the tools, insights, and connections they need to navigate their careers successfully. We aim to break down the barriers between top talent and the world's most innovative companies.</p>
                <p style="color: var(--text-muted); font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem;">We're not just another job board. We're a career partner designed to support you from your first internship to your executive role.</p>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: var(--gradient-peach); color: white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <strong style="color: var(--navy); display: block; font-size: 1.2rem;">2 Million+</strong>
                        <span class="text-muted">Active Users Worldwide</span>
                    </div>
                </div>
            </div>
            <div class="gs-reveal" style="position: relative;">
                <div style="position: absolute; inset: -20px; background: var(--gradient-peach); opacity: 0.2; filter: blur(40px); border-radius: 50%;"></div>
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" style="width: 100%; border-radius: var(--radius-md); box-shadow: var(--shadow-lg); position: relative; z-index: 10; object-fit: cover; aspect-ratio: 4/3;">
            </div>
        </div>
    </div>
</div>

<!-- FULL SCREEN: CAREERS -->
<div class="section-padding" style="background: var(--navy); color: white; position: relative; overflow: hidden;">
    <!-- Abstract background elements -->
    <div style="position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -50px; left: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, transparent 70%); border-radius: 50%;"></div>

    <div class="container relative z-10">
        <div class="grid-2" style="gap: 4rem; align-items: center;">
            <div class="gs-reveal order-2">
                <div class="grid-2" style="gap: 1.5rem;">
                    <div style="background: rgba(255,255,255,0.05); padding: 2rem; border-radius: var(--radius-sm); border: 1px solid rgba(255,255,255,0.1);">
                        <i class="fa-solid fa-laptop-code text-primary" style="font-size: 2rem; margin-bottom: 1rem;"></i>
                        <h4 style="color: white; margin-bottom: 0.5rem; font-size: 1.2rem;">Engineering</h4>
                        <p style="color: #94a3b8; font-size: 0.95rem;">Build scalable systems that power millions of careers.</p>
                    </div>
                    <div style="background: rgba(255,255,255,0.05); padding: 2rem; border-radius: var(--radius-sm); border: 1px solid rgba(255,255,255,0.1);">
                        <i class="fa-solid fa-pen-nib text-primary" style="font-size: 2rem; margin-bottom: 1rem;"></i>
                        <h4 style="color: white; margin-bottom: 0.5rem; font-size: 1.2rem;">Design</h4>
                        <p style="color: #94a3b8; font-size: 0.95rem;">Craft intuitive, beautiful experiences for our users.</p>
                    </div>
                    <div style="background: rgba(255,255,255,0.05); padding: 2rem; border-radius: var(--radius-sm); border: 1px solid rgba(255,255,255,0.1);">
                        <i class="fa-solid fa-chart-line text-primary" style="font-size: 2rem; margin-bottom: 1rem;"></i>
                        <h4 style="color: white; margin-bottom: 0.5rem; font-size: 1.2rem;">Marketing</h4>
                        <p style="color: #94a3b8; font-size: 0.95rem;">Tell our story and grow the JobFinder community.</p>
                    </div>
                    <div style="background: rgba(255,255,255,0.05); padding: 2rem; border-radius: var(--radius-sm); border: 1px solid rgba(255,255,255,0.1);">
                        <i class="fa-solid fa-headset text-primary" style="font-size: 2rem; margin-bottom: 1rem;"></i>
                        <h4 style="color: white; margin-bottom: 0.5rem; font-size: 1.2rem;">Support</h4>
                        <p style="color: #94a3b8; font-size: 0.95rem;">Ensure every user gets the help they need to succeed.</p>
                    </div>
                </div>
            </div>
            
            <div class="gs-reveal order-1">
                <span style="color: #10b981; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 1rem; display: block;">Careers at JobFinder</span>
                <h2 style="color: white; font-size: 3rem; margin-bottom: 1.5rem; line-height: 1.2;">Shape the Future of Hiring</h2>
                <p style="color: #94a3b8; font-size: 1.2rem; line-height: 1.8; margin-bottom: 2rem;">Want to help us shape the future of hiring? We're a fast-growing team of innovators always looking for passionate people to join our mission. If you are driven by impact, we want to hear from you.</p>
                <x-button variant="primary" style="padding: 1rem 2rem; font-size: 1.1rem; background: #10b981; box-shadow: 0 10px 25px rgba(16,185,129,0.3); border: none;">View Open Positions</x-button>
            </div>
        </div>
    </div>
</div>

<!-- FULL SCREEN: CONTACT US -->
<div class="section-padding" style="background: linear-gradient(135deg, #4f46e5 0%, #ec4899 100%); position: relative; overflow: hidden;">
    <!-- Abstract blobs for extra color -->
    <div style="position: absolute; top: -100px; left: -100px; width: 300px; height: 300px; background: #facc15; filter: blur(80px); opacity: 0.4; border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -50px; right: -50px; width: 400px; height: 400px; background: #38bdf8; filter: blur(100px); opacity: 0.4; border-radius: 50%;"></div>
    
    <div class="container" style="position: relative; z-index: 10;">
        <div class="grid-2" style="gap: 4rem; align-items: center;">
            <div class="gs-reveal">
                <span style="color: #fde047; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 1rem; display: block; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">Contact Us</span>
                <h2 style="color: white; font-size: 3rem; margin-bottom: 1.5rem; line-height: 1.2; text-shadow: 0 4px 12px rgba(0,0,0,0.1);">Get in Touch</h2>
                <p style="color: rgba(255,255,255,0.9); font-size: 1.1rem; line-height: 1.8; margin-bottom: 2.5rem;">Have a question, feedback, or need support? We're here to help. Reach out to our dedicated teams below.</p>
                
                <div style="display: flex; flex-direction: column; gap: 2rem;">
                    <div style="display: flex; align-items: flex-start; gap: 1.5rem;">
                        <div style="width: 60px; height: 60px; border-radius: 50%; background: rgba(255, 255, 255, 0.2); color: white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; backdrop-filter: blur(5px); box-shadow: 0 8px 16px rgba(0,0,0,0.1);">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h4 style="color: white; margin: 0 0 0.5rem 0; font-size: 1.2rem;">Headquarters</h4>
                            <p style="color: rgba(255,255,255,0.8); margin: 0; line-height: 1.6; font-size: 1.1rem;">{!! nl2br(e($siteSettings['contact_address'] ?? "123 Innovation Drive\nTech Hub District\nSan Francisco, CA 94105")) !!}</p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 1.5rem;">
                        <div style="width: 60px; height: 60px; border-radius: 50%; background: rgba(255, 255, 255, 0.2); color: white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; backdrop-filter: blur(5px); box-shadow: 0 8px 16px rgba(0,0,0,0.1);">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <h4 style="color: white; margin: 0 0 0.5rem 0; font-size: 1.2rem;">Email Us</h4>
                            <p style="color: rgba(255,255,255,0.8); margin: 0; line-height: 1.6; font-size: 1.1rem;">{{ $siteSettings['contact_email'] ?? 'support@jobfinder.com' }}</p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 1.5rem;">
                        <div style="width: 60px; height: 60px; border-radius: 50%; background: rgba(255, 255, 255, 0.2); color: white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; backdrop-filter: blur(5px); box-shadow: 0 8px 16px rgba(0,0,0,0.1);">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <h4 style="color: white; margin: 0 0 0.5rem 0; font-size: 1.2rem;">Call Us</h4>
                            <p style="color: rgba(255,255,255,0.8); margin: 0; line-height: 1.6; font-size: 1.1rem;">{{ $siteSettings['contact_phone'] ?? '+1 (555) 123-4567' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="gs-reveal" style="position: relative;">
                <div class="card floating" style="padding: 3rem; background: rgba(255, 255, 255, 0.95); border: 1px solid rgba(255,255,255,0.5); backdrop-filter: blur(10px); box-shadow: 0 30px 60px rgba(0,0,0,0.25); border-radius: 1.5rem;">
                    <h3 style="color: var(--navy); margin-bottom: 1.5rem; font-size: 1.5rem;">Send us a message</h3>
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="subject" value="Home Page Inquiry">
                        <div style="margin-bottom: 1.5rem;">
                            <label class="form-label" style="color: var(--navy);">Name</label>
                            <input type="text" name="name" class="form-input" placeholder="Your Name" required style="background: rgba(0,0,0,0.03); border-color: rgba(0,0,0,0.1);">
                        </div>
                        <div style="margin-bottom: 1.5rem;">
                            <label class="form-label" style="color: var(--navy);">Email</label>
                            <input type="email" name="email" class="form-input" placeholder="you@company.com" required style="background: rgba(0,0,0,0.03); border-color: rgba(0,0,0,0.1);">
                        </div>
                        <div style="margin-bottom: 2rem;">
                            <label class="form-label" style="color: var(--navy);">Message</label>
                            <textarea name="message" class="form-input" rows="4" placeholder="How can we help you?" required style="background: rgba(0,0,0,0.03); border-color: rgba(0,0,0,0.1);"></textarea>
                        </div>
                        <x-button variant="primary" type="submit" class="full-width" style="padding: 1rem; font-size: 1.1rem; background: linear-gradient(135deg, #f59e0b 0%, #ec4899 100%); border: none; box-shadow: 0 10px 25px rgba(236,72,153,0.4); color: white;">Send Message</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="section-padding" style="padding-bottom: 4rem;">
    <div class="container">
        <div class="cta-section text-center" style="background: linear-gradient(135deg, #4f46e5 0%, #ec4899 100%) !important; color: white !important; border-radius: 1.5rem !important; padding: 5rem 2rem !important; box-shadow: 0 20px 40px rgba(10, 25, 47, 0.12) !important; opacity: 1 !important; transform: none !important;">
            <h2 style="font-size: 3rem; margin-bottom: 1.5rem; color: white !important; opacity: 1 !important; transform: none !important; position: relative; z-index: 2; text-shadow: 0 4px 12px rgba(0,0,0,0.15);">Your next opportunity is closer than you think.</h2>
            <div style="display:flex; gap: 1rem; justify-content: center; margin-top: 2rem; position: relative; z-index: 2;">
                <x-button onclick="window.location.href='{{ route('jobs.index') }}'" variant="primary" style="padding: 1rem 2rem; box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3) !important;">Explore Jobs</x-button>
                <x-button onclick="window.location.href='{{ route('profile.onboarding') }}'" variant="secondary" style="padding: 1rem 2rem; background:white !important; color:var(--navy) !important; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05) !important; border: none !important;">Create Profile</x-button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const words = ["Opportunity", "Dream Job", "Career", "Future"];
        let i = 0;
        let timer;
        const typewriter = document.getElementById('typewriter');
        
        if(typewriter) {
            typewriter.innerHTML = "";
            typingEffect();
        }

        function typingEffect() {
            let word = words[i].split("");
            var loopTyping = function() {
                if (word.length > 0) {
                    typewriter.innerHTML += word.shift();
                } else {
                    setTimeout(deletingEffect, 2000);
                    return false;
                };
                timer = setTimeout(loopTyping, 100);
            };
            loopTyping();
        }

        function deletingEffect() {
            let word = words[i].split("");
            var loopDeleting = function() {
                if (word.length > 0) {
                    word.pop();
                    typewriter.innerHTML = word.join("");
                } else {
                    if (words.length > (i + 1)) {
                        i++;
                    } else {
                        i = 0;
                    };
                    setTimeout(typingEffect, 500);
                    return false;
                };
                timer = setTimeout(loopDeleting, 50);
            };
            loopDeleting();
        }

        // Book Page Animation Observer
        const stepsContainer = document.getElementById('steps-container');
        if (stepsContainer) {
            const pages = stepsContainer.querySelectorAll('.book-page');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        pages.forEach((page, index) => {
                            setTimeout(() => {
                                page.classList.add('is-visible');
                            }, index * 200); // 200ms delay between each page flip
                        });
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.2 });
            observer.observe(stepsContainer);
        }

        // Surprise Box Animation Observer
        const compSection = document.getElementById('companies-section');
        const sBox = document.getElementById('surprise-box');
        const sBoxContainer = document.getElementById('surprise-box-container');
        const cGrid = document.getElementById('companies-grid');
        const cCards = document.querySelectorAll('.company-card-wrapper');
        const vBtn = document.getElementById('view-all-companies');
        
        if (compSection && sBox) {
            const compObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // 1. Show the box
                        sBox.classList.add('show');
                        
                        // 2. Shake the box after a small delay
                        setTimeout(() => {
                            sBox.classList.add('shake');
                        }, 600);
                        
                        // 3. Open/Hide the box and reveal grid
                        setTimeout(() => {
                            sBox.classList.replace('fa-box', 'fa-box-open');
                            sBox.classList.add('open');
                            setTimeout(() => {
                                sBoxContainer.style.opacity = '0';
                                sBoxContainer.style.pointerEvents = 'none';
                                
                                // 4. Pop out the cards one by one
                                cCards.forEach((card, index) => {
                                    setTimeout(() => {
                                        card.classList.add('pop-out');
                                    }, index * 150);
                                });
                                
                                // Show button
                                setTimeout(() => {
                                    vBtn.style.display = 'inline-flex';
                                    setTimeout(() => vBtn.style.opacity = '1', 50);
                                }, cCards.length * 150 + 300);
                                
                            }, 300);
                        }, 1200);
                        
                        compObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.3 });
            compObserver.observe(compSection);
        }
    });
</script>
<style>
    .cursor {
        animation: blink 1s infinite;
        font-weight: 300;
        margin-left: 2px;
    }
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0; }
    }
</style>
@endpush

@endsection
