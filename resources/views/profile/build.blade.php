@extends('layouts.app')

@section('title', 'Build Your Profile')

@push('styles')
<style>
    .onboarding-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 4rem 1rem;
    }
    
    .step-indicator {
        display: flex;
        justify-content: space-between;
        margin-bottom: 3rem;
        position: relative;
    }
    
    .step-indicator::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background: #e2e8f0;
        z-index: 0;
        transform: translateY(-50%);
    }
    
    .step-indicator-progress {
        position: absolute;
        top: 50%;
        left: 0;
        height: 2px;
        background: var(--gradient-blue);
        z-index: 0;
        transform: translateY(-50%);
        transition: width 0.5s ease;
    }
    
    .step-item {
        position: relative;
        z-index: 1;
        background: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: var(--text-muted);
        border: 2px solid #e2e8f0;
        transition: all 0.3s;
    }
    
    .step-item.active {
        border-color: #8ec5fc;
        color: #8ec5fc;
    }
    
    .step-item.completed {
        background: var(--gradient-blue);
        color: white;
        border-color: transparent;
    }
    
    .wizard-step {
        display: none;
        animation: fadeIn 0.5s ease;
    }
    
    .wizard-step.active {
        display: block;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .skill-pill {
        display: inline-block;
        padding: 0.5rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.2s;
        margin: 0.25rem;
        user-select: none;
    }
    
    .skill-pill.selected {
        background: var(--gradient-blue);
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 10px rgba(142, 197, 252, 0.4);
    }
</style>
@endpush

@section('content')
<div class="bg-main" style="min-height: 80vh;">
    <div class="onboarding-container gs-reveal">
        
        <div class="text-center" style="margin-bottom: 3rem;">
            <h1 style="color: var(--navy); font-size: 2.5rem; margin-bottom: 0.5rem;">Build Your Profile</h1>
            <p class="text-muted" style="font-size: 1.1rem;">Let's get you set up to discover amazing opportunities.</p>
        </div>
        
        <div class="step-indicator">
            <div class="step-indicator-progress" style="width: 0%;"></div>
            <div class="step-item active" data-step="1">1</div>
            <div class="step-item" data-step="2">2</div>
            <div class="step-item" data-step="3">3</div>
            @guest
            <div class="step-item" data-step="4">4</div>
            @endguest
        </div>
        
        <div class="card floating" style="padding: 3rem; background: white; border: 1px solid rgba(0,0,0,0.05); box-shadow: var(--shadow-lg);">
            <form id="onboarding-form" action="{{ route('profile.onboarding.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                
                <!-- STEP 1: Basic Info -->
                <div class="wizard-step active" id="step-1">
                    <h3 style="color: var(--navy); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-user text-primary"></i> Basic Information
                    </h3>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                        <div>
                            <label class="form-label">Full Name <span class="text-primary">*</span></label>
                            <input type="text" name="name" class="form-input" value="{{ old('name') }}" required autocomplete="off">
                        </div>
                        <div>
                            <label class="form-label">Professional Title</label>
                            <input type="text" name="job_title" class="form-input" value="{{ old('job_title') }}" placeholder="e.g. Senior Developer" autocomplete="off">
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 2rem;">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-input" value="{{ old('location') }}" placeholder="e.g. New York, NY" autocomplete="off">
                    </div>
                    
                    <div style="display: flex; justify-content: flex-end;">
                        <button type="button" class="btn btn-primary btn-next" data-next="2">Next Step <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
                
                <!-- STEP 2: Skills -->
                <div class="wizard-step" id="step-2">
                    <h3 style="color: var(--navy); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-bolt text-primary"></i> Your Skills
                    </h3>
                    <p class="text-muted" style="margin-bottom: 1.5rem;">Select all that apply. This helps our algorithm match you perfectly.</p>
                    
                    <div style="max-height: 300px; overflow-y: auto; padding-right: 1rem; margin-bottom: 2rem; border: 1px solid #e2e8f0; padding: 1rem; border-radius: var(--radius-sm);">
                        @php $userSkills = old('skills', []); @endphp
                        @foreach($allSkills as $skill)
                            <label class="skill-pill {{ in_array($skill->id, $userSkills) ? 'selected' : '' }}">
                                <input type="checkbox" name="skills[]" value="{{ $skill->id }}" style="display: none;" {{ in_array($skill->id, $userSkills) ? 'checked' : '' }} onchange="this.parentElement.classList.toggle('selected', this.checked)">
                                {{ $skill->name }}
                            </label>
                        @endforeach
                    </div>
                    
                    <div style="display: flex; justify-content: space-between;">
                        <button type="button" class="btn btn-outline btn-prev" data-prev="1"><i class="fa-solid fa-arrow-left"></i> Back</button>
                        <button type="button" class="btn btn-primary btn-next" data-next="3">Next Step <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
                
                <!-- STEP 3: Bio & Resume -->
                <div class="wizard-step" id="step-3">
                    <h3 style="color: var(--navy); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-file-lines text-primary"></i> Final Touches
                    </h3>
                    
                    <div style="margin-bottom: 2rem;">
                        <label class="form-label">Short Bio</label>
                        <textarea name="bio" class="form-input" rows="4" placeholder="Tell us a little about your journey..." autocomplete="off">{{ old('bio') }}</textarea>
                    </div>
                    
                    <div style="margin-bottom: 2rem;">
                        <label class="form-label">Resume / CV (Optional)</label>
                        <div style="border: 2px dashed #cbd5e1; border-radius: var(--radius-sm); padding: 2rem; text-align: center; background: #f8fafc; transition: all 0.3s;" id="resume-dropzone">
                            <i class="fa-solid fa-cloud-arrow-up text-primary" style="font-size: 2rem; margin-bottom: 1rem;"></i>
                            <p class="text-muted" style="margin-bottom: 1rem;">Drag and drop or click to upload</p>
                            <input type="file" name="resume" accept=".pdf,.doc,.docx" class="form-input" style="max-width: 300px; margin: 0 auto; display:block;">
                            @if($user->resume)
                                <p class="text-success mt-2" style="font-size: 0.85rem;"><i class="fa-solid fa-check"></i> Resume is currently uploaded.</p>
                            @endif
                        </div>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between;">
                        <button type="button" class="btn btn-outline btn-prev" data-prev="2"><i class="fa-solid fa-arrow-left"></i> Back</button>
                        @guest
                        <button type="button" class="btn btn-primary btn-next" data-next="4">Next Step <i class="fa-solid fa-arrow-right"></i></button>
                        @else
                        <button type="submit" class="btn btn-primary" style="border: none; padding: 1rem 2rem; font-size: 1.1rem;">Complete Profile <i class="fa-solid fa-check"></i></button>
                        @endguest
                    </div>
                </div>

                @guest
                <!-- STEP 4: Account Security -->
                <div class="wizard-step" id="step-4">
                    <h3 style="color: var(--navy); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-lock text-primary"></i> Account Security
                    </h3>
                    <p class="text-muted" style="margin-bottom: 1.5rem;">Create a password to save your profile and start applying for jobs.</p>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label class="form-label">Email Address <span class="text-primary">*</span></label>
                        <input type="email" name="email" class="form-input" value="{{ old('email') }}" required>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 3rem;">
                        <div>
                            <label class="form-label">Password <span class="text-primary">*</span></label>
                            <input type="password" name="password" class="form-input" required minlength="8">
                        </div>
                        <div>
                            <label class="form-label">Confirm Password <span class="text-primary">*</span></label>
                            <input type="password" name="password_confirmation" class="form-input" required minlength="8">
                        </div>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between;">
                        <button type="button" class="btn btn-outline btn-prev" data-prev="3"><i class="fa-solid fa-arrow-left"></i> Back</button>
                        <button type="submit" class="btn btn-primary" style="background: var(--gradient-blue); border: none; padding: 1rem 2rem; font-size: 1.1rem;">Create Account <i class="fa-solid fa-check"></i></button>
                    </div>
                </div>
                @endguest
                
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nextBtns = document.querySelectorAll('.btn-next');
        const prevBtns = document.querySelectorAll('.btn-prev');
        const steps = document.querySelectorAll('.wizard-step');
        const indicators = document.querySelectorAll('.step-item');
        const progress = document.querySelector('.step-indicator-progress');
        
        function updateStep(stepNum) {
            steps.forEach(s => s.classList.remove('active'));
            document.getElementById('step-' + stepNum).classList.add('active');
            
            indicators.forEach(i => {
                const s = parseInt(i.dataset.step);
                i.classList.remove('active', 'completed');
                if (s < stepNum) i.classList.add('completed');
                if (s === parseInt(stepNum)) i.classList.add('active');
            });
            
            // Update progress bar
            const totalSteps = document.querySelectorAll('.step-item').length;
            const percentage = ((stepNum - 1) / (totalSteps - 1)) * 100;
            progress.style.width = percentage + '%';
        }
        
        nextBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const nextStep = btn.dataset.next;
                updateStep(nextStep);
            });
        });
        
        prevBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const prevStep = btn.dataset.prev;
                updateStep(prevStep);
            });
        });
    });
</script>
@endpush
