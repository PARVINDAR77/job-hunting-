@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="job-detail-header bg-navy" style="padding: 4rem 0 3rem; color: white; position: relative; overflow: hidden;">
    <img src="{{ asset('images/jobs_hero_bg.jpg') }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; opacity: 0.35;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(10,25,47,0.95) 0%, rgba(10,25,47,0.6) 100%); z-index: 1;"></div>
    <div class="container text-center" style="position: relative; z-index: 2;">
        <h1 style="font-size: 2.5rem; margin-bottom: 0.5rem; color: white;">Edit Profile</h1>
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

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <h3 style="color: var(--navy); margin-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem;">Personal Information</h3>
                
                <div style="margin-bottom: 2rem; display:flex; gap: 2rem; align-items: center;">
                    <div style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; background: #e2e8f0; flex-shrink: 0;">
                        @if($user->profile_image)
                            <img src="{{ Storage::url($user->profile_image) }}" style="width:100%; height:100%; object-fit:cover;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=EBF4FF&color=4F46E5" style="width:100%; height:100%;">
                        @endif
                    </div>
                    <div style="flex: 1;">
                        <label for="profile_image" class="form-label">Profile Image (Optional)</label>
                        <input type="file" id="profile_image" name="profile_image" class="form-input" accept="image/*">
                        <span class="text-muted" style="font-size: 0.85rem;">Max 2MB. Jpeg, Png, Jpg, Gif.</span>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label class="form-label" for="name">Full Name <span class="text-primary">*</span></label>
                        <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div>
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-input" value="{{ $user->email }}" disabled style="background: #f1f5f9; cursor: not-allowed;">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" id="phone" name="phone" class="form-input" value="{{ old('phone', $user->phone) }}">
                    </div>
                    <div>
                        <label for="location" class="form-label">Location</label>
                        <input type="text" id="location" name="location" class="form-input" value="{{ old('location', $user->location) }}" placeholder="e.g. New York, USA">
                    </div>
                </div>

                <div style="margin-bottom: 2rem;">
                    <label for="job_title" class="form-label">Professional Job Title</label>
                    <input type="text" id="job_title" name="job_title" class="form-input" value="{{ old('job_title', $user->job_title) }}" placeholder="e.g. Senior Software Engineer">
                </div>

                <div style="margin-bottom: 2.5rem;">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea id="bio" name="bio" class="form-input" rows="4" placeholder="Tell companies a little about yourself...">{{ old('bio', $user->bio) }}</textarea>
                </div>

                <h3 style="color: var(--navy); margin-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem;">Professional Details</h3>

                <div style="margin-bottom: 2rem;">
                    <label class="form-label">Skills (Ctrl/Cmd click to select multiple)</label>
                    <select name="skills[]" class="form-input" multiple size="6">
                        @foreach($allSkills as $skill)
                            <option value="{{ $skill->id }}" {{ in_array($skill->id, old('skills', $user->skills->pluck('id')->toArray())) ? 'selected' : '' }}>
                                {{ $skill->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 2rem;">
                    <label for="experience" class="form-label">Experience Summary</label>
                    <textarea id="experience" name="experience" class="form-input" rows="4">{{ old('experience', $user->experience) }}</textarea>
                </div>

                <div style="margin-bottom: 2rem;">
                    <label for="education" class="form-label">Education Summary</label>
                    <textarea id="education" name="education" class="form-input" rows="4">{{ old('education', $user->education) }}</textarea>
                </div>

                <h3 style="color: var(--navy); margin-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem;">Documents</h3>

                <div style="margin-bottom: 2.5rem;">
                    <label for="resume" class="form-label">Upload New Resume (PDF, DOC, DOCX)</label>
                    <div style="border: 2px dashed #cbd5e1; border-radius: var(--radius-sm); padding: 2rem; text-align: center; background: #f8fafc;">
                        <i class="fa-solid fa-cloud-arrow-up text-primary" style="font-size: 2rem; margin-bottom: 1rem;"></i>
                        <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" class="form-input" style="max-width: 300px; margin: 0 auto; display:block;">
                        @if($user->resume)
                            <p class="text-muted mt-2" style="font-size: 0.85rem;"><i class="fa-solid fa-check text-primary"></i> You currently have a resume uploaded. Uploading a new one will replace it.</p>
                        @endif
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; justify-content: flex-end; align-items: center; border-top: 1px solid #e2e8f0; padding-top: 2rem;">
                    <a href="{{ route('profile.show') }}" class="text-muted" style="text-decoration:none; font-weight:600;">Cancel</a>
                    <x-button variant="primary" type="submit" style="padding: 1rem 2.5rem; font-size: 1.1rem;">Save Profile</x-button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
