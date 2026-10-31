@extends('layouts.app')

@section('title', 'Apply for ' . $job->title)

@section('content')
<div class="job-detail-header bg-navy" style="padding: 4rem 0; color: white; position: relative; overflow: hidden;">
    <img src="{{ asset('images/jobs_hero_bg.jpg') }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; opacity: 0.35;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(10,25,47,0.95) 0%, rgba(10,25,47,0.6) 100%); z-index: 1;"></div>
    <div class="container text-center" style="position: relative; z-index: 2;">
        <h1 style="font-size: 2rem; margin-bottom: 0.5rem; color: white;">Apply for <span class="text-primary">{{ $job->title }}</span></h1>
        <p class="text-muted" style="font-size: 1.1rem;">at {{ $job->company->name }}</p>
    </div>
</div>

<div class="section-padding bg-main">
    <div class="container" style="max-width: 800px;">
        
        <div class="card floating" style="padding: 3rem;">
            
            @if($errors->any())
                <div style="background: #fee2e2; color: #b91c1c; padding: 1.5rem; border-radius: var(--radius-sm); margin-bottom: 2rem;">
                    <h4 style="margin-bottom: 0.5rem;">Please fix the following errors:</h4>
                    <ul style="padding-left: 1.5rem; margin: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('applications.store', $job) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <h3 style="color: var(--navy); margin-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem;">Personal Information</h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-input" value="{{ $user->name }}" disabled style="background: #f1f5f9; cursor: not-allowed;">
                    </div>
                    <div>
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-input" value="{{ $user->email }}" disabled style="background: #f1f5f9; cursor: not-allowed;">
                    </div>
                </div>

                <div style="margin-bottom: 2rem;">
                    <label for="phone" class="form-label">Phone Number (Optional)</label>
                    <input type="text" id="phone" name="phone" class="form-input" value="{{ old('phone') }}">
                </div>

                <h3 style="color: var(--navy); margin-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem;">Professional Details</h3>

                <div style="margin-bottom: 1.5rem;">
                    <label for="experience" class="form-label">Years of Experience <span class="text-primary">*</span></label>
                    <select id="experience" name="experience" class="form-input" required>
                        <option value="">Select your experience</option>
                        <option value="Less than 1 year" {{ old('experience') == 'Less than 1 year' ? 'selected' : '' }}>Less than 1 year</option>
                        <option value="1-3 years" {{ old('experience') == '1-3 years' ? 'selected' : '' }}>1-3 years</option>
                        <option value="3-5 years" {{ old('experience') == '3-5 years' ? 'selected' : '' }}>3-5 years</option>
                        <option value="5-10 years" {{ old('experience') == '5-10 years' ? 'selected' : '' }}>5-10 years</option>
                        <option value="10+ years" {{ old('experience') == '10+ years' ? 'selected' : '' }}>10+ years</option>
                    </select>
                </div>

                <div style="margin-bottom: 2rem;">
                    <label for="education" class="form-label">Highest Education Level <span class="text-primary">*</span></label>
                    <select id="education" name="education" class="form-input" required>
                        <option value="">Select education level</option>
                        <option value="High School" {{ old('education') == 'High School' ? 'selected' : '' }}>High School</option>
                        <option value="Bachelor's Degree" {{ old('education') == "Bachelor's Degree" ? 'selected' : '' }}>Bachelor's Degree</option>
                        <option value="Master's Degree" {{ old('education') == "Master's Degree" ? 'selected' : '' }}>Master's Degree</option>
                        <option value="PhD" {{ old('education') == 'PhD' ? 'selected' : '' }}>PhD</option>
                    </select>
                </div>

                <h3 style="color: var(--navy); margin-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem;">Documents</h3>

                <div style="margin-bottom: 1.5rem;">
                    <label for="resume" class="form-label">Upload Resume (PDF, DOC, DOCX) <span class="text-primary">*</span></label>
                    <div style="border: 2px dashed #cbd5e1; border-radius: var(--radius-sm); padding: 2rem; text-align: center; background: #f8fafc; transition: var(--transition);" id="dropzone">
                        <i class="fa-solid fa-cloud-arrow-up text-primary" style="font-size: 2.5rem; margin-bottom: 1rem;"></i>
                        <p style="margin-bottom: 1rem; color: var(--navy); font-weight: 600;">Drag and drop your resume here</p>
                        <p class="text-muted" style="font-size: 0.9rem; margin-bottom: 1.5rem;">Max file size: 5MB</p>
                        <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" required class="form-input" style="max-width: 300px; margin: 0 auto; display:block;">
                    </div>
                </div>

                <div style="margin-bottom: 2.5rem;">
                    <label for="cover_letter" class="form-label">Cover Letter (Optional)</label>
                    <textarea id="cover_letter" name="cover_letter" class="form-input" rows="6" placeholder="Why are you a good fit for this role?">{{ old('cover_letter') }}</textarea>
                </div>

                <div style="display: flex; gap: 1rem; justify-content: flex-end; align-items: center; border-top: 1px solid #e2e8f0; padding-top: 2rem;">
                    <a href="{{ route('jobs.show', $job) }}" class="text-muted" style="text-decoration:none; font-weight:600;">Cancel</a>
                    <x-button variant="primary" type="submit" style="padding: 1rem 2.5rem; font-size: 1.1rem;">Submit Application</x-button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
