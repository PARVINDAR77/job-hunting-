<aside class="admin-sidebar">


    <!-- =========================
         LOGO
    ========================== -->

    <div class="sidebar-logo">

        <div class="logo-icon">

            <i class="fa-solid fa-briefcase"></i>

        </div>


        <div class="logo-text">

            <h2>{{ $siteSettings['site_name'] ?? 'JobFinder' }}</h2>

            <span>Admin Panel</span>

        </div>

    </div>



    <!-- =========================
         MAIN MENU
    ========================== -->

    <div class="sidebar-section">

        <div class="sidebar-title">
            MAIN MENU
        </div>


        <!-- Dashboard -->

        <a
            href="{{ url('/admin') }}"
            class="sidebar-link {{ request()->is('admin') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-table-cells-large"></i>

            <span>
                Dashboard
            </span>

        </a>


        <!-- Jobs -->

        <a
            href="{{ url('/admin/jobs') }}"
            class="sidebar-link {{ request()->is('admin/jobs*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-briefcase"></i>

            <span>
                Jobs
            </span>

        </a>


        <!-- Candidates -->

        <a
            href="{{ url('/admin/candidates') }}"
            class="sidebar-link {{ request()->is('admin/candidates*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-users"></i>

            <span>
                Candidates
            </span>

        </a>


        <!-- Companies -->

        <a
            href="{{ url('/admin/companies') }}"
            class="sidebar-link {{ request()->is('admin/companies*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-building"></i>

            <span>
                Companies
            </span>

        </a>


        <!-- Applications -->

        <a
            href="{{ url('/admin/applications') }}"
            class="sidebar-link {{ request()->is('admin/applications*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-file-lines"></i>

            <span>
                Applications
            </span>

        </a>


        <!-- Messages -->

        <a
            href="{{ url('/admin/messages') }}"
            class="sidebar-link {{ request()->is('admin/messages*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-envelope"></i>

            <span>
                Messages
            </span>

        </a>


        <!-- Categories -->

        <a
            href="{{ url('/admin/categories') }}"
            class="sidebar-link {{ request()->is('admin/categories*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-layer-group"></i>

            <span>
                Categories
            </span>

        </a>

    </div>


    <!-- =========================
         USER MANAGEMENT
    ========================== -->

    <div class="sidebar-section">

        <div class="sidebar-title">
            USER MANAGEMENT
        </div>


        <a
            href="{{ url('/admin/users') }}"
            class="sidebar-link {{ request()->is('admin/users*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-user-group"></i>

            <span>
                Users
            </span>

        </a>



    </div>



    <!-- =========================
         SETTINGS
    ========================== -->

    <div class="sidebar-section">

        <div class="sidebar-title">
            SETTINGS
        </div>


        <a
            href="{{ url('/admin/settings') }}"
            class="sidebar-link {{ request()->is('admin/settings*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-gear"></i>

            <span>
                Settings
            </span>

        </a>

    </div>



    <!-- =========================
         ADMIN PROFILE
    ========================== -->

    <div class="sidebar-profile">


        <div class="profile-avatar">
            A
        </div>


        <div class="profile-info">

            <strong>
                Admin User
            </strong>

            <span>
                Super Admin
            </span>

        </div>


        <button class="profile-menu">

            <i class="fa-solid fa-ellipsis"></i>

        </button>


        <a
            href="{{ route('profile.show') }}"
            class="profile-button"
        >

            <i class="fa-regular fa-user"></i>

            View Profile

        </a>


    </div>


</aside>