@extends('admin.layouts.app')

@section('content')

<style>
    .admin-form-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        padding: 30px;
        margin-top: 20px;
    }
    .btn-back {
        background: #f3f4f6;
        color: #4b5563;
        padding: 10px 18px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-back:hover {
        background: #e5e7eb;
    }
    .details-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }
    .detail-section {
        background: #f9fafb;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }
    .detail-section h4 {
        margin: 0 0 15px 0;
        color: #111827;
        font-size: 16px;
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 10px;
    }
    .info-row {
        margin-bottom: 12px;
        display: flex;
        flex-direction: column;
    }
    .info-row label {
        font-size: 12px;
        text-transform: uppercase;
        color: #6b7280;
        font-weight: 600;
        margin-bottom: 4px;
    }
    .info-row span {
        font-size: 15px;
        color: #111827;
    }
    .status-update-box {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 20px;
        grid-column: 1 / -1;
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .form-control {
        padding: 10px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-size: 15px;
        width: 250px;
    }
    .btn-submit {
        background: #534ade;
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
        font-size: 15px;
    }
    .btn-submit:hover {
        background: #4338ca;
    }
    .resume-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: #e0e7ff;
        color: #4338ca;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
    }
    .resume-link:hover {
        background: #c7d2fe;
    }
    .cover-letter-box {
        background: #fff;
        padding: 15px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        white-space: pre-wrap;
        font-size: 14px;
        color: #374151;
        line-height: 1.6;
    }
</style>

<div style="display:flex; justify-content: space-between; align-items: center;">
    <div>
        <span style="color: #534ade; font-weight: 700; font-size: 11px; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 8px; display: block;">REVIEW APPLICATION</span>
        <h3 style="font-size: 22px; color: #111827; margin: 0 0 5px 0; font-weight: 700;">Application #{{ $application->id }}</h3>
    </div>
    <a href="{{ route('admin.applications.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

@if(session('success'))
<div style="background: #d1fae5; color: #065f46; padding: 12px 20px; border-radius: 8px; margin-top: 20px; font-weight: 500; font-size: 14px;">
    <i class="fas fa-check-circle" style="margin-right: 8px;"></i> {{ session('success') }}
</div>
@endif

<div class="admin-form-container">
    
    <div class="details-grid">
        
        <div class="detail-section">
            <h4><i class="fas fa-user-circle" style="color:#9ca3af; margin-right:5px;"></i> Candidate Information</h4>
            <div class="info-row">
                <label>Name</label>
                <span>{{ $application->user->name ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <label>Email</label>
                <span>{{ $application->user->email ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <label>Phone</label>
                <span>{{ $application->user->phone ?? 'Not provided' }}</span>
            </div>
            <div class="info-row">
                <label>Current Resume</label>
                @if($application->resume)
                    <a href="{{ Storage::url($application->resume) }}" target="_blank" class="resume-link">
                        <i class="fas fa-file-pdf"></i> View Application Resume
                    </a>
                @elseif($application->user && $application->user->resume)
                    <a href="{{ Storage::url($application->user->resume) }}" target="_blank" class="resume-link">
                        <i class="fas fa-file-pdf"></i> View Profile Resume
                    </a>
                @else
                    <span style="color: #9ca3af; font-style: italic;">No resume uploaded</span>
                @endif
            </div>
        </div>

        <div class="detail-section">
            <h4><i class="fas fa-briefcase" style="color:#9ca3af; margin-right:5px;"></i> Job Details</h4>
            <div class="info-row">
                <label>Position</label>
                <span>{{ $application->job->title ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <label>Company</label>
                <span>{{ $application->job->company->name ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <label>Applied On</label>
                <span>{{ $application->created_at->format('F d, Y h:i A') }}</span>
            </div>
            <div class="info-row">
                <label>Current Status</label>
                <span style="text-transform: capitalize; font-weight: bold; color: {{ $application->status == 'accepted' ? '#059669' : ($application->status == 'rejected' ? '#dc2626' : '#2563eb') }};">
                    {{ $application->status ?? 'Pending' }}
                </span>
            </div>
        </div>

        @if($application->cover_letter)
        <div class="detail-section" style="grid-column: 1 / -1;">
            <h4><i class="fas fa-envelope-open-text" style="color:#9ca3af; margin-right:5px;"></i> Cover Letter</h4>
            <div class="cover-letter-box">
                {{ $application->cover_letter }}
            </div>
        </div>
        @endif

        <div class="status-update-box">
            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Update Application Status</label>
                <p style="font-size: 13px; color: #6b7280; margin: 0;">Change the status of this application.</p>
            </div>
            
            <form action="{{ route('admin.applications.update', $application) }}" method="POST" style="display: flex; gap: 15px; margin-left: auto;">
                @csrf
                @method('PUT')
                <select name="status" class="form-control">
                    <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="reviewed" {{ $application->status == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                    <option value="interview" {{ $application->status == 'interview' ? 'selected' : '' }}>Interviewing</option>
                    <option value="accepted" {{ $application->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                <button type="submit" class="btn-submit">Update Status</button>
            </form>
        </div>

    </div>

</div>

@endsection
