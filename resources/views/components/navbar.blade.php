<nav class="navbar glass">
    <div class="container navbar-container">
        <a href="/" class="brand">
            <span class="logo-icon"><i class="fa-solid fa-briefcase"></i></span>
            <span class="logo-text">JobFinder</span>
        </a>
        
        <div class="nav-links desktop-only">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
            <a href="{{ route('jobs.index') }}" class="nav-link">Find Jobs</a>
            <a href="{{ route('companies.index') }}" class="nav-link">Companies</a>
            <a href="{{ route('categories.index') }}" class="nav-link">Categories</a>
            <a href="{{ route('locations.index') }}" class="nav-link">Locations</a>
            <a href="{{ route('discovery.explorer') }}" class="nav-link">Career Explorer</a>
            <a href="{{ route('profile.onboarding') }}" class="nav-link text-primary font-bold"><i class="fa-solid fa-user-pen"></i> Build Profile</a>
        </div>
        
        <div class="nav-actions desktop-only">
            @auth
                <a href="{{ route('dashboard') }}" class="nav-link font-bold" style="color: var(--primary);">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="nav-link" style="background:none; border:none; cursor:pointer; font-family:inherit; font-size:inherit;">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-link">Sign In</a>
                <a href="{{ route('profile.onboarding') }}" style="text-decoration:none;"><x-button variant="primary">Get Started</x-button></a>
            @endauth
        </div>

        <!-- Mobile Menu Toggle -->
        <button id="mobile-menu-toggle" class="mobile-menu-toggle">
            <i class="fa-solid fa-bars"></i>
        </button>

        <!-- Mobile Navigation Panel -->
        <div id="mobile-menu" class="mobile-menu">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
            <a href="{{ route('jobs.index') }}" class="nav-link">Find Jobs</a>
            <a href="{{ route('companies.index') }}" class="nav-link">Companies</a>
            <a href="{{ route('categories.index') }}" class="nav-link">Categories</a>
            <a href="{{ route('locations.index') }}" class="nav-link">Locations</a>
            <a href="{{ route('discovery.explorer') }}" class="nav-link">Career Explorer</a>
            <a href="{{ route('profile.onboarding') }}" class="nav-link text-primary font-bold"><i class="fa-solid fa-user-pen"></i> Build Profile</a>
            <hr style="margin: 1rem 0; border: none; border-top: 1px solid #e2e8f0;">
            @auth
                <a href="{{ route('dashboard') }}" class="nav-link font-bold" style="color: var(--primary);">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link" style="background:none; border:none; cursor:pointer; font-family:inherit; font-size:inherit; padding:0;">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-link">Sign In</a>
                <a href="{{ route('profile.onboarding') }}" class="nav-link" style="color: var(--primary); font-weight: bold;">Get Started</a>
            @endauth
        </div>
    </div>
</nav>
