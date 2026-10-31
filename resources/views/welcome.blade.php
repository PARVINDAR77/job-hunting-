@extends('layouts.app')

@section('title', 'Design System Preview')

@section('content')
<div class="hero-section section-padding">
    <div class="container">
        <h1 class="text-center">Find your next <span class="text-primary">dream job</span></h1>
        <p class="text-center text-muted">Discover thousands of remote & local jobs in tech, design, and marketing.</p>
        
        <div style="margin-top: 3rem;">
            <x-search-bar />
        </div>
    </div>
</div>

<div class="container section-padding">
    <div class="components-preview">
        <h2>Buttons</h2>
        <div class="component-row" style="display: flex; gap: 1rem; margin-bottom: 2rem;">
            <x-button variant="primary">Primary Button</x-button>
            <x-button variant="secondary">Secondary Button</x-button>
            <x-button variant="outline">Outline Button</x-button>
            <x-button variant="ghost">Ghost Button</x-button>
        </div>

        <h2>Badges</h2>
        <div class="component-row" style="display: flex; gap: 1rem; margin-bottom: 2rem;">
            <x-status-badge type="primary">Full-time</x-status-badge>
            <x-status-badge type="secondary">Remote</x-status-badge>
            <x-status-badge type="success">Active</x-status-badge>
            <x-status-badge type="warning">Pending</x-status-badge>
        </div>

        <h2>Forms</h2>
        <div class="component-row" style="max-width: 400px; margin-bottom: 2rem;">
            <x-form-input name="email" label="Email Address" type="email" placeholder="john@example.com" icon="fa-regular fa-envelope" />
        </div>

        <h2>Cards</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-bottom: 2rem;">
            @php
                $job = App\Models\Job::with('company')->first() ?? App\Models\Job::factory()->make();
                $company = App\Models\Company::first() ?? App\Models\Company::factory()->make();
                $category = App\Models\Category::first() ?? App\Models\Category::factory()->make();
            @endphp
            
            <div>
                <h3>Job Card</h3>
                <x-job-card :job="$job" />
            </div>
            <div>
                <h3>Company Card</h3>
                <x-company-card :company="$company" />
            </div>
            <div>
                <h3>Category Card</h3>
                <x-category-card :category="$category" />
            </div>
        </div>

        <h2>Modals & Empty States</h2>
        <div class="component-row" style="margin-bottom: 2rem;">
            <x-button variant="outline" onclick="openModal('exampleModal')">Open Modal</x-button>
            
            <x-modal id="exampleModal" title="Apply for this job">
                <p style="margin-bottom: 1rem;">Are you sure you want to submit your application?</p>
                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <x-button variant="ghost" onclick="closeModal('exampleModal')">Cancel</x-button>
                    <x-button variant="primary">Submit Application</x-button>
                </div>
            </x-modal>
        </div>
        
        <div style="background: white; padding: 2rem; border-radius: var(--radius-lg); margin-bottom: 2rem;">
            <x-empty-state title="No saved jobs" description="You haven't saved any jobs to your profile yet." actionText="Browse Jobs" />
        </div>
    </div>
</div>
@endsection
