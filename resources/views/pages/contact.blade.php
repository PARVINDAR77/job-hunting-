@extends('layouts.app')

@section('title', 'Contact Us - JobFinder')

@section('content')
<div class="job-detail-header bg-navy parallax-bg" style="padding: 5rem 0 3rem; color: white; position: relative; overflow: hidden; text-align: center;">
    <img src="{{ asset('images/jobs_hero_bg.jpg') }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; opacity: 0.35;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(10,25,47,0.95) 0%, rgba(10,25,47,0.6) 100%); z-index: 1;"></div>
    <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(236,72,153,0.15) 0%, transparent 70%); border-radius: 50%; z-index: 2;"></div>
    
    <div class="container gs-reveal" style="position: relative; z-index: 10;">
        <h1 style="font-size: 3.5rem; margin-bottom: 1rem; color: white;">Get in Touch</h1>
        <p style="color: #94a3b8; font-size: 1.25rem; max-width: 600px; margin: 0 auto;">Have a question, feedback, or need support? We're here to help.</p>
    </div>
</div>

<div class="section-padding bg-main" style="min-height: 70vh;">
    <div class="container" style="display: flex; gap: 4rem; flex-wrap: wrap; align-items: flex-start;">
        
        <!-- Contact Info -->
        <aside style="flex: 1; min-width: 300px;" class="gs-reveal">
            <h2 style="color: var(--navy); margin-bottom: 2rem;">Contact Information</h2>
            
            <div style="display: flex; flex-direction: column; gap: 2rem;">
                <div style="display: flex; align-items: flex-start; gap: 1.5rem;">
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: rgba(99, 102, 241, 0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h4 style="color: var(--navy); margin: 0 0 0.25rem 0; font-size: 1.1rem;">Headquarters</h4>
                        <p style="color: var(--text-muted); margin: 0; line-height: 1.6;">{!! nl2br(e($siteSettings['contact_address'] ?? "123 Innovation Drive\nTech Hub District\nSan Francisco, CA 94105")) !!}</p>
                    </div>
                </div>

                <div style="display: flex; align-items: flex-start; gap: 1.5rem;">
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: rgba(99, 102, 241, 0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <h4 style="color: var(--navy); margin: 0 0 0.25rem 0; font-size: 1.1rem;">Email Us</h4>
                        <p style="color: var(--text-muted); margin: 0; line-height: 1.6;">{{ $siteSettings['contact_email'] ?? 'support@jobfinder.com' }}</p>
                    </div>
                </div>

                <div style="display: flex; align-items: flex-start; gap: 1.5rem;">
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: rgba(99, 102, 241, 0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <h4 style="color: var(--navy); margin: 0 0 0.25rem 0; font-size: 1.1rem;">Call Us</h4>
                        <p style="color: var(--text-muted); margin: 0; line-height: 1.6;">{{ $siteSettings['contact_phone'] ?? '+1 (555) 123-4567' }}</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-5 pt-5" style="border-top: 1px solid #e2e8f0;">
                <h4 style="color: var(--navy); margin-bottom: 1rem;">Follow Us</h4>
                <div style="display: flex; gap: 1rem;">
                    <a href="https://twitter.com" target="_blank" style="width: 40px; height: 40px; border-radius: 50%; background: #e2e8f0; color: var(--navy); display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.2s;"><i class="fa-brands fa-twitter"></i></a>
                    <a href="https://linkedin.com" target="_blank" style="width: 40px; height: 40px; border-radius: 50%; background: #e2e8f0; color: var(--navy); display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.2s;"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="https://instagram.com" target="_blank" style="width: 40px; height: 40px; border-radius: 50%; background: #e2e8f0; color: var(--navy); display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.2s;"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </aside>

        <!-- Form -->
        <main style="flex: 1.5; min-width: 300px;" class="gs-reveal">
            <div class="card floating" style="padding: 3rem; position: relative; overflow: hidden;" id="contact-card">
                
                <!-- Success Overlay -->
                <div id="success-overlay" style="position: absolute; inset: 0; background: rgba(255,255,255,0.95); z-index: 50; display: {{ session('success') ? 'flex' : 'none' }}; flex-direction: column; align-items: center; justify-content: center; text-align: center; opacity: {{ session('success') ? '1' : '0' }}; backdrop-filter: blur(5px);">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background: #dcfce7; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 3rem; margin-bottom: 1.5rem;" id="success-icon">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <h2 style="color: var(--navy); margin-bottom: 0.5rem;">Message Sent!</h2>
                    <p class="text-muted" style="font-size: 1.1rem;">Thanks for reaching out. We'll be in touch shortly.</p>
                    <button class="btn btn-outline mt-4" onclick="closeSuccess()">Send Another Message</button>
                </div>

                <h3 style="color: var(--navy); margin-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem;">Send a Message</h3>
                
                @if($errors->any())
                    <div style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 2rem; font-size: 0.9rem;">
                        <ul style="margin: 0; padding-left: 1.5rem;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                        <div>
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" required placeholder="John Doe">
                        </div>
                        <div>
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required placeholder="john@example.com">
                        </div>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label for="subject" class="form-label">Subject</label>
                        <select id="subject" name="subject" class="form-input" required>
                            <option value="">Select a subject...</option>
                            <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                            <option value="Support Request" {{ old('subject') == 'Support Request' ? 'selected' : '' }}>Support Request</option>
                            <option value="Partnership" {{ old('subject') == 'Partnership' ? 'selected' : '' }}>Partnership Opportunity</option>
                            <option value="Feedback" {{ old('subject') == 'Feedback' ? 'selected' : '' }}>Platform Feedback</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 2rem;">
                        <label for="message" class="form-label">Message</label>
                        <textarea id="message" name="message" class="form-input" rows="5" required placeholder="How can we help you?">{{ old('message') }}</textarea>
                    </div>

                    <x-button variant="primary" type="submit" style="width: 100%; padding: 1rem; font-size: 1.1rem; display: flex; justify-content: center; gap: 0.5rem;"><i class="fa-regular fa-paper-plane"></i> Send Message</x-button>
                </form>
            </div>
        </main>

    </div>
</div>
@endsection

@section('scripts')
<script>
    @if(session('success'))
        gsap.fromTo('#success-icon', { scale: 0 }, { scale: 1, duration: 0.5, ease: 'back.out(1.5)', delay: 0.2 });
    @endif

    function closeSuccess() {
        gsap.to('#success-overlay', { opacity: 0, duration: 0.3, onComplete: () => {
            document.getElementById('success-overlay').style.display = 'none';
        }});
    }
</script>
@endsection
