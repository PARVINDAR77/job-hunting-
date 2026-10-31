// Plain JS file

// Mobile Menu Toggle
document.addEventListener('DOMContentLoaded', () => {
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            
            // Hamburger animation
            const spans = mobileMenuBtn.querySelectorAll('span');
            if (mobileMenu.classList.contains('active')) {
                spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(7px, -6px)';
            } else {
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });
    }

    // Navbar Scrolled State
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }
});

// GSAP Animations
document.addEventListener('DOMContentLoaded', () => {
    // Register ScrollTrigger if available
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);

        // Hero Animation Sequence
        const heroTl = gsap.timeline();
        
        // Navbar fade in
        heroTl.from('.navbar', { y: -50, opacity: 0, duration: 0.8, ease: 'power3.out' });
        
        // Heading slide + fade
        heroTl.from('#hero-title', { y: 30, opacity: 0, duration: 0.8, ease: 'power3.out' }, '-=0.4');
        
        // Subtitle fade up
        heroTl.from('#hero-subtitle', { y: 20, opacity: 0, duration: 0.8, ease: 'power3.out' }, '-=0.6');
        
        // Search scale + fade
        heroTl.from('#hero-search', { scale: 0.95, opacity: 0, duration: 0.8, ease: 'power3.out' }, '-=0.6');
        
        // Popular tags stagger
        heroTl.from('.popular-tags .tag', { y: 10, opacity: 0, duration: 0.5, stagger: 0.1, ease: 'power2.out' }, '-=0.4');
        
        // 3D visual fade + scale
        heroTl.from('.hero-3d-img', { scale: 0.9, opacity: 0, duration: 1, ease: 'power3.out' }, '-=1');
        
        // Floating cards appear one by one
        heroTl.from('.float-card', { 
            scale: 0.5, 
            opacity: 0, 
            duration: 0.6, 
            stagger: 0.2, 
            ease: 'back.out(1.5)',
            clearProps: 'transform' // Required so CSS keyframe animations (float) take over
        }, '-=0.5');

        // Scroll Reveal Animations
        gsap.utils.toArray('.gs-reveal').forEach(function(elem) {
            gsap.from(elem, {
                scrollTrigger: {
                    trigger: elem,
                    start: 'top 85%',
                },
                y: 50,
                opacity: 0,
                duration: 0.8,
                ease: 'power3.out'
            });
        });
        
        // Job Cards Stagger
        gsap.from('.job-card-wrapper', {
            scrollTrigger: {
                trigger: '.grid-3',
                start: 'top 80%',
            },
            y: 30,
            opacity: 0,
            duration: 0.6,
            stagger: 0.1,
            ease: 'power2.out'
        });
        
        // Steps Stagger
        gsap.from('.step-card', {
            scrollTrigger: {
                trigger: '.steps-container',
                start: 'top 75%',
            },
            y: 40,
            opacity: 0,
            duration: 0.8,
            stagger: 0.2,
            ease: 'power3.out'
        });
    }
});

// Jobs Page Animations
document.addEventListener('DOMContentLoaded', () => {
    if (typeof gsap !== 'undefined') {
        // Fade in jobs grid
        const jobsGrid = document.querySelector('.jobs-grid');
        if (jobsGrid) {
            gsap.from('.jobs-grid .job-card-wrapper', {
                y: 30,
                opacity: 0,
                duration: 0.5,
                stagger: 0.05,
                ease: 'power2.out'
            });
        }
        
        // Tilt Effect for Job Cards
        const cards = document.querySelectorAll('[data-tilt]');
        cards.forEach(card => {
            card.addEventListener('mousemove', e => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = ((y - centerY) / centerY) * -5;
                const rotateY = ((x - centerX) / centerX) * 5;
                
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)';
            });
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    // Dashboard Animations
    if(document.querySelector('.dashboard-layout')) {
        // Animate profile completion bar
        setTimeout(() => {
            const progressFills = document.querySelectorAll('.progress-fill');
            progressFills.forEach(fill => {
                const target = fill.getAttribute('data-target');
                if(target) {
                    fill.style.width = target;
                }
            });
        }, 300);

        // GSAP Dashboard Reveal
        if(typeof gsap !== 'undefined') {
            gsap.fromTo('.gs-reveal-dash', 
                { y: 30, opacity: 0 }, 
                { y: 0, opacity: 1, duration: 0.8, stagger: 0.15, ease: 'power3.out' }
            );
            
            // Stagger stat cards
            gsap.fromTo('.stat-card',
                { scale: 0.9, opacity: 0 },
                { scale: 1, opacity: 1, duration: 0.6, stagger: 0.1, ease: 'back.out(1.5)', delay: 0.2 }
            );
        }
    }
});

document.addEventListener('DOMContentLoaded', () => {
    // GSAP ScrollTrigger Animations for Discovery Pages
    if(typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);

        // Header reveals
        gsap.utils.toArray('.gs-reveal').forEach(function(elem) {
            gsap.fromTo(elem, 
                { y: 50, opacity: 0 }, 
                { y: 0, opacity: 1, duration: 1, ease: 'power3.out', scrollTrigger: { trigger: elem, start: 'top 90%' } }
            );
        });

        // Staggered card reveals
        const cards = gsap.utils.toArray('.gs-reveal-card');
        if(cards.length > 0) {
            gsap.fromTo(cards,
                { y: 50, opacity: 0 },
                { y: 0, opacity: 1, duration: 0.8, stagger: 0.1, ease: 'power2.out', scrollTrigger: { trigger: cards[0], start: 'top 85%' } }
            );
        }
    }
});

// ==========================================================================
// PART 11: 3D & ANIMATION POLISH
// ==========================================================================

document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Page Entrance Transition
    document.body.classList.add('page-loaded');

    // Check for reduced motion preference
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (!prefersReducedMotion) {
        
        // 2. Mouse Parallax Engine for Hero Sections
        const parallaxLayers = document.querySelectorAll('.parallax-layer');
        if (parallaxLayers.length > 0) {
            document.addEventListener('mousemove', (e) => {
                const x = (e.clientX - window.innerWidth / 2);
                const y = (e.clientY - window.innerHeight / 2);

                parallaxLayers.forEach(layer => {
                    const depth = layer.getAttribute('data-depth') || 0.05;
                    const transX = x * depth;
                    const transY = y * depth;
                    
                    // Use GSAP for smooth interpolation if available, otherwise fallback to CSS transform
                    if (typeof gsap !== 'undefined') {
                        gsap.to(layer, { x: transX, y: transY, duration: 1, ease: 'power2.out' });
                    } else {
                        layer.style.transform = `translate3d(${transX}px, ${transY}px, 0)`;
                    }
                });
            });
        }

        // 3. 3D Job Card Tilt Effect
        const cards3d = document.querySelectorAll('.job-card-3d');
        cards3d.forEach(card => {
            // Wrap card in perspective container if not already wrapped
            if(!card.parentElement.classList.contains('job-card-3d-wrap')) {
                const wrap = document.createElement('div');
                wrap.className = 'job-card-3d-wrap';
                card.parentNode.insertBefore(wrap, card);
                wrap.appendChild(card);
            }

            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left; // x position within the element.
                const y = e.clientY - rect.top;  // y position within the element.
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                // Calculate rotation (max 5 degrees for subtle effect)
                const rotateX = ((y - centerY) / centerY) * -5;
                const rotateY = ((x - centerX) / centerX) * 5;

                card.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
            });
        });

        // 4. Dashboard Animations (Stats & Progress)
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            
            // Animate progress bars
            const progressBars = document.querySelectorAll('.dashboard-progress-fill');
            progressBars.forEach(bar => {
                const targetWidth = bar.getAttribute('data-target-width') || '0%';
                bar.style.width = '0%'; // Reset initially
                
                gsap.to(bar, {
                    width: targetWidth,
                    duration: 1.5,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: bar,
                        start: 'top 90%'
                    }
                });
            });

            // Animate Stat Counters
            const statCounters = document.querySelectorAll('.dashboard-stat-counter');
            statCounters.forEach(counter => {
                const targetVal = parseInt(counter.innerText) || 0;
                
                gsap.fromTo(counter, 
                    { innerText: 0 }, 
                    { 
                        innerText: targetVal, 
                        duration: 2, 
                        ease: 'power2.out',
                        snap: { innerText: 1 },
                        scrollTrigger: {
                            trigger: counter,
                            start: 'top 90%'
                        }
                    }
                );
            });
        }
    }
});

    // 5. Mobile Menu Toggle
    const menuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    if(menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            const icon = menuToggle.querySelector('i');
            if(mobileMenu.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-xmark');
                gsap.fromTo(mobileMenu, { opacity: 0, y: -10 }, { opacity: 1, y: 0, duration: 0.3 });
            } else {
                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-bars');
            }
        });
    }
