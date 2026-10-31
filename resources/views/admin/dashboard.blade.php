@extends('admin.layouts.app')


@section('page-title', 'Dashboard')


@section('content')


<!-- ==================================================
     DASHBOARD HEADER
=================================================== -->

<div class="dashboard-header">

    <div class="dashboard-welcome">

        <span class="welcome-label">
            ADMIN DASHBOARD
        </span>

        <h1>
            Good morning, Admin
            <span class="welcome-emoji">👋</span>
        </h1>

        <p>
            Here's what's happening with your JobFinder portal today.
        </p>

    </div>


    <div class="dashboard-date">

        <div class="date-icon">
            <i class="fa-regular fa-calendar"></i>
        </div>

        <div class="date-info">

            <span>Today</span>

            <strong>
                {{ now()->format('M d, Y') }}
            </strong>

        </div>

    </div>

</div>



<!-- ==================================================
     STATISTICS CARDS
=================================================== -->

<div class="stats-grid">


    <!-- Total Jobs -->

    <div class="stat-card">
        <div class="stat-icon jobs-icon">
            <i class="fas fa-briefcase"></i>
        </div>

        <div class="stat-content">
            <h3>{{ $totalJobs }}</h3>
            <p>Total Jobs</p>
        </div>
    </div>



    <!-- Candidates -->

    <div class="stat-card">
        <div class="stat-icon candidates-icon">
            <i class="fas fa-users"></i>
        </div>

        <div class="stat-content">
            <h3>{{ $totalUsers }}</h3>
            <p>Total Users</p>
        </div>
    </div>



    <!-- Companies -->

    <div class="stat-card">
        <div class="stat-icon companies-icon">
            <i class="fas fa-building"></i>
        </div>

        <div class="stat-content">
            <h3>{{ $totalCompanies }}</h3>
            <p>Total Companies</p>
        </div>
    </div>



    <!-- Applications -->

    <div class="stat-card">
        <div class="stat-icon applications-icon">
            <i class="fas fa-file-alt"></i>
        </div>

        <div class="stat-content">
            <h3>{{ $totalApplications }}</h3>
            <p>Total Applications</p>
        </div>
    </div>



    <!-- Pending Jobs -->

    <div class="stat-card">

        <div class="stat-card-top">

            <div class="stat-icon pending-icon">
                <i class="fa-solid fa-clock"></i>
            </div>

            <span class="stat-change warning">
                <i class="fa-solid fa-arrow-up"></i>
                4.2%
            </span>

        </div>

        <div class="stat-content">

            <span class="stat-label">
                Pending Jobs
            </span>

            <h2>{{ $pendingJobs }}</h2>

            <p>
                <strong>{{ $newPendingJobsYesterday }} new</strong>
                since yesterday
            </p>

        </div>

    </div>


</div>



<!-- ==================================================
     ANALYTICS
=================================================== -->

<div class="analytics-grid">


    <!-- JOB CHART -->

    <div class="analytics-card">

        <div class="analytics-header">

            <div>

                <span class="analytics-label">
                    JOB MANAGEMENT
                </span>

                <h3>
                    Job Posting Overview
                </h3>

                <p>
                    Number of jobs posted over the last 6 months.
                </p>

            </div>


            <select class="analytics-filter">

                <option>Last 6 Months</option>
                <option>Last 12 Months</option>
                <option>This Year</option>

            </select>

        </div>


        <div class="chart-container">

            <div class="chart-y-axis">

                <span>400</span>
                <span>300</span>
                <span>200</span>
                <span>100</span>
                <span>0</span>

            </div>


            <div class="chart-area">

                <div class="chart-grid">

                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>

                </div>


                <div class="chart-bars">

                    @foreach($jobsChartData as $index => $val)
                    <div class="bar-column">
                        <div
                            class="chart-bar {{ $loop->last ? 'active' : '' }}"
                            style="height:{{ $maxJobs > 0 ? round(($val / $maxJobs) * 100) : 0 }}%;"
                            data-value="{{ $val }}"
                        ></div>
                        <span>{{ $chartMonths[$index] }}</span>
                    </div>
                    @endforeach

                </div>

            </div>

        </div>


        <div class="chart-footer">

            <div class="chart-legend">

                <span class="legend-dot jobs-dot"></span>

                <span>
                    Jobs Posted
                </span>

            </div>


            <div class="chart-total">

                <strong>1,540</strong>

                <span>
                    total jobs
                </span>

            </div>

        </div>

    </div>



    <!-- APPLICATION CHART -->

    <div class="analytics-card">

        <div class="analytics-header">

            <div>

                <span class="analytics-label">
                    APPLICATIONS
                </span>

                <h3>
                    Application Overview
                </h3>

                <p>
                    Candidate applications over the last 6 months.
                </p>

            </div>


            <select class="analytics-filter">

                <option>Last 6 Months</option>
                <option>Last 12 Months</option>
                <option>This Year</option>

            </select>

        </div>


        <div class="chart-container">

            <div class="chart-y-axis">

                <span>2000</span>
                <span>1500</span>
                <span>1000</span>
                <span>500</span>
                <span>0</span>

            </div>


            <div class="chart-area">

                <div class="chart-grid">

                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>

                </div>


                <div class="chart-bars">

                    @foreach($appsChartData as $index => $val)
                    <div class="bar-column">
                        <div
                            class="chart-bar {{ $loop->last ? 'active' : '' }}"
                            style="height:{{ $maxApps > 0 ? round(($val / $maxApps) * 100) : 0 }}%;"
                            data-value="{{ $val }}"
                        ></div>
                        <span>{{ $chartMonths[$index] }}</span>
                    </div>
                    @endforeach

                </div>

            </div>

        </div>


        <div class="chart-footer">

            <div class="chart-legend">

                <span class="legend-dot applications-dot"></span>

                <span>
                    Applications
                </span>

            </div>


            <div class="chart-total">

                <strong>8,541</strong>

                <span>
                    total applications
                </span>

            </div>

        </div>

    </div>


</div>



<!-- ==================================================
     RECENT JOBS
=================================================== -->

<div class="recent-jobs-card">


    <!-- HEADER -->

    <div class="recent-jobs-header">


        <div>

            <span class="analytics-label">
                JOB MANAGEMENT
            </span>

            <h3>
                Recent Jobs
            </h3>

            <p>
                Latest jobs posted by companies on your platform.
            </p>

        </div>


        <a
            href="{{ url('/admin/jobs') }}"
            class="view-all-button"
        >

            View All

            <i class="fa-solid fa-arrow-right"></i>

        </a>


    </div>



    <!-- TABLE -->

    <div class="jobs-table-wrapper">

        <table class="jobs-table">


            <thead>

                <tr>

                    <th>
                        JOB
                    </th>

                    <th>
                        COMPANY
                    </th>

                    <th>
                        LOCATION
                    </th>

                    <th>
                        TYPE
                    </th>

                    <th>
                        APPLICATIONS
                    </th>

                    <th>
                        STATUS
                    </th>

                    <th>
                        POSTED
                    </th>

                    <th>
                        ACTION
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($recentJobs as $job)

                <tr>
                    <td>
                        {{ $job->title }}
                    </td>

                    <td>
                        {{ $job->company_name ?? 'N/A' }}
                    </td>

                    <td>
                        {{ $job->location ?? 'N/A' }}
                    </td>

                    <td>
                        <span class="status-badge">
                            {{ ucfirst($job->status ?? 'Active') }}
                        </span>
                    </td>

                    <td>
                        {{ $job->created_at->format('d M Y') }}
                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="5" class="text-center">
                        No jobs found.
                    </td>
                </tr>

                @endforelse

            </tbody>


        </table>

    </div>


</div>

<!-- ==================================================
     RECENT APPLICATIONS
=================================================== -->

<div class="recent-applications-card">


    <!-- HEADER -->

    <div class="recent-applications-header">

        <div>

            <span class="analytics-label">
                APPLICATION MANAGEMENT
            </span>

            <h3>
                Recent Applications
            </h3>

            <p>
                Latest applications submitted by candidates.
            </p>

        </div>


        <a
            href="{{ url('/admin/applications') }}"
            class="view-all-button"
        >

            View All

            <i class="fa-solid fa-arrow-right"></i>

        </a>

    </div>



    <!-- APPLICATION LIST -->

    <div class="applications-list">
        @forelse($recentApplications as $app)
        <div class="application-row">
            <div class="candidate-cell">
                <div class="candidate-avatar avatar-purple">
                    {{ strtoupper(substr($app->user->name ?? 'U', 0, 2)) }}
                </div>
                <div class="candidate-info">
                    <strong>{{ $app->user->name ?? 'Unknown' }}</strong>
                    <span>{{ $app->user->email ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="applied-job">
                <strong>{{ $app->job->title ?? 'N/A' }}</strong>
                <span>{{ $app->job->company->name ?? 'N/A' }}</span>
            </div>

            <div class="application-date">
                <i class="fa-regular fa-calendar"></i>
                <span>{{ $app->created_at->format('M d, Y') }}</span>
            </div>

            <div>
                <span class="resume-status">
                    <i class="fa-solid fa-file-pdf"></i>
                    Resume
                </span>
            </div>

            <div>
                <span class="application-status {{ $app->status == 'pending' ? 'new-status' : ($app->status == 'accepted' ? 'shortlisted-status' : 'rejected-status') }}">
                    <span></span>
                    {{ ucfirst($app->status) }}
                </span>
            </div>

            <a href="{{ route('admin.applications.show', $app) }}" class="application-view-btn" style="text-decoration:none;">
                <i class="fa-regular fa-eye"></i> View
            </a>
        </div>
        @empty
        <div class="text-center py-4">No recent applications found.</div>
        @endforelse
    </div>
</div>

<!-- ==================================================
     TOP COMPANIES
=================================================== -->

<div class="top-companies-card">


    <!-- HEADER -->

    <div class="top-companies-header">

        <div>

            <span class="analytics-label">
                COMPANY MANAGEMENT
            </span>

            <h3>
                Top Companies
            </h3>

            <p>
                Companies with the highest activity on your JobFinder platform.
            </p>

        </div>


        <a
            href="{{ url('/admin/companies') }}"
            class="view-all-button"
        >

            View All

            <i class="fa-solid fa-arrow-right"></i>

        </a>

    </div>



    <!-- COMPANY GRID -->

    <div class="companies-grid">
        @forelse($topCompanies as $company)
        <div class="company-card">
            <div class="company-card-top">
                <div class="large-company-avatar company-tech">
                    {{ strtoupper(substr($company->name, 0, 2)) }}
                </div>
                <button class="company-more-btn"><i class="fa-solid fa-ellipsis"></i></button>
            </div>
            <div class="company-card-info">
                <h4>{{ $company->name }}</h4>
                <span>{{ $company->industry ?? 'Technology' }}</span>
            </div>
            <div class="company-stat-row">
                <div>
                    <strong>{{ $company->jobs_count }}</strong>
                    <span>Jobs</span>
                </div>
                <div>
                    <strong>{{ $company->applications_count ?? 0 }}</strong>
                    <span>Applications</span>
                </div>
            </div>
            <div class="company-card-footer">
                <span class="company-active-status">
                    <span></span>
                    Active
                </span>
                <a href="{{ route('admin.companies.show', $company) }}" class="company-view-btn">
                    View <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="text-center py-4">No top companies found.</div>
        @endforelse
    </div>
</div>

@endsection
