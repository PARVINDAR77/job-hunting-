<header class="admin-navbar">


    <!-- =========================
         LEFT SIDE
    ========================== -->

    <div class="navbar-left">


        <button
            class="sidebar-toggle"
            id="sidebarToggle"
        >

            <i class="fa-solid fa-bars"></i>

        </button>


        <div class="breadcrumb">

            <span>
                {{ $siteSettings['site_name'] ?? 'JobFinder' }}
            </span>


            <i class="fa-solid fa-chevron-right"></i>


            <strong>

                @yield(
                    'page-title',
                    'Dashboard'
                )

            </strong>

        </div>


    </div>



    <!-- =========================
         RIGHT SIDE
    ========================== -->

    <div class="navbar-right">


        <!-- Search -->

        <div class="navbar-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input
                type="text"
                id="adminGlobalSearch"
                placeholder="Search anything... (e.g. jobs, users)"
            >
            <span class="search-shortcut">
                Ctrl /
            </span>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('adminGlobalSearch');
                
                // Shortcut Ctrl + / to focus search
                document.addEventListener('keydown', function(e) {
                    if (e.ctrlKey && e.key === '/') {
                        e.preventDefault();
                        searchInput.focus();
                    }
                });

                // Execute quick navigation on Enter
                searchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const query = this.value.trim().toLowerCase();
                        
                        // Map of valid admin sections
                        const sections = {
                            'job': 'jobs',
                            'jobs': 'jobs',
                            'company': 'companies',
                            'companies': 'companies',
                            'application': 'applications',
                            'applications': 'applications',
                            'candidate': 'candidates',
                            'candidates': 'candidates',
                            'user': 'users',
                            'users': 'users',
                            'category': 'categories',
                            'categories': 'categories',
                            'setting': 'settings',
                            'settings': 'settings'
                        };

                        if (sections[query]) {
                            window.location.href = '/admin/' + sections[query];
                        } else if (query) {
                            // If they type something else, maybe we just search jobs by default
                            window.location.href = '/admin/jobs?search=' + encodeURIComponent(query);
                        }
                    }
                });
            });
        </script>



        <!-- Notifications -->
        <button class="navbar-icon-button">
            <i class="fa-regular fa-bell"></i>
            <span class="navbar-notification-dot" style="box-sizing: content-box; line-height: 1;">
                5
            </span>
        </button>

        <!-- Divider -->
        <div class="navbar-divider"></div>

        <!-- Admin Profile & Dropdown -->
        <div class="navbar-profile-wrapper" style="position: relative; display: flex; align-items: center; height: 100%;">
            <button class="navbar-profile" onclick="document.getElementById('adminDropdown').classList.toggle('show')" style="display: flex; align-items: center; gap: 12px; padding: 0; background: none; border: none; cursor: pointer;">
                <div class="navbar-avatar" style="flex-shrink: 0;">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="navbar-user-info" style="display: flex; flex-direction: column; align-items: flex-start; white-space: nowrap;">
                    <strong style="font-size: 13px; color: #182230;">{{ auth()->user()->name ?? 'Admin' }}</strong>
                    <span style="font-size: 11px; color: #64748b;">Super Admin</span>
                </div>
                <i class="fa-solid fa-chevron-down profile-arrow" style="font-size: 10px; color: #94a3b8; margin-left: 4px;"></i>
            </button>
            
            <div id="adminDropdown" class="profile-dropdown" style="display: none; position: absolute; right: 0; top: 100%; margin-top: 10px; background: white; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border: 1px solid #f1f5f9; width: 180px; z-index: 1000; overflow: hidden;">
                <form action="{{ route('admin.logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="width: 100%; text-align: left; background: none; border: none; padding: 12px 16px; color: #ef4444; cursor: pointer; font-family: inherit; font-size: 14px; font-weight: 500; display: flex; align-items: center; gap: 8px; transition: background 0.2s;">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Sign out
                    </button>
                </form>
            </div>
        </div>

        <script>
            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                var dropdown = document.getElementById('adminDropdown');
                var button = document.querySelector('.navbar-profile');
                if (dropdown && button && !button.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.style.display = 'none';
                }
            });
            // Toggle dropdown
            document.querySelector('.navbar-profile').addEventListener('click', function(e) {
                e.stopPropagation();
                var dropdown = document.getElementById('adminDropdown');
                if(dropdown.style.display === 'none') {
                    dropdown.style.display = 'block';
                } else {
                    dropdown.style.display = 'none';
                }
            });
        </script>
    </div>


</header>