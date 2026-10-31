<footer class="footer bg-navy">
    <div class="container footer-container">
        <div class="footer-col brand-col">
            <a href="/" class="brand footer-brand">
                <span class="logo-icon"><i class="fa-solid fa-briefcase"></i></span>
                <span class="logo-text">{{ $siteSettings['site_name'] ?? 'JobFinder' }}</span>
            </a>
            <p class="footer-desc">{{ $siteSettings['site_description'] ?? 'Your premium platform to discover modern startup jobs and elevate your career.' }}</p>
            <div class="social-icons">
                <a href="{{ $siteSettings['social_twitter'] ?? 'https://twitter.com' }}" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                <a href="{{ $siteSettings['social_linkedin'] ?? 'https://linkedin.com' }}" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
                <a href="{{ $siteSettings['social_instagram'] ?? 'https://instagram.com' }}" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
        
        <div class="footer-col">
            <h4>For Job Seekers</h4>
            <ul>
                <li><a href="{{ route('jobs.index') }}">Find Jobs</a></li>
                <li><a href="{{ route('profile.saved_jobs') }}">Saved Jobs</a></li>
                <li><a href="{{ route('dashboard') }}">Applications</a></li>
                <li><a href="{{ route('discovery.explorer') }}">Career Explorer</a></li>
            </ul>
        </div>
        
        <div class="footer-col">
            <h4>Explore</h4>
            <ul>
                <li><a href="{{ route('companies.index') }}">Companies</a></li>
                <li><a href="{{ route('categories.index') }}">Categories</a></li>
                <li><a href="{{ route('locations.index') }}">Locations</a></li>
                <li><a href="{{ route('blog.index') }}">Blog</a></li>
            </ul>
        </div>
        
        <div class="footer-col">
            <h4>Company</h4>
            <ul>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
                <li><a href="{{ route('jobs.index') }}">Careers</a></li>
            </ul>
        </div>
        
        <div class="footer-col">
            <h4>Legal</h4>
            <ul>
                <li><a href="{{ route('about') }}">Privacy Policy</a></li>
                <li><a href="{{ route('about') }}">Terms of Service</a></li>
            </ul>
        </div>
    </div>
    <div class="container footer-bottom">
        <p>&copy; {{ date('Y') }} {{ $siteSettings['site_name'] ?? 'JobFinder' }}. All rights reserved.</p>
    </div>
</footer>
