@extends('admin.layouts.app')

@section('content')

<style>
    /* Premium Table Styles */
    .admin-data-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        padding: 25px;
        margin-top: 20px;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        font-size: 14px;
    }
    
    .data-table th {
        text-align: left;
        padding: 15px;
        background-color: #f8f9fa;
        color: #6b7280;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e5e7eb;
    }
    
    .data-table td {
        padding: 16px 15px;
        border-bottom: 1px solid #f3f4f6;
        color: #374151;
        vertical-align: middle;
    }
    
    .data-table tbody tr:hover {
        background-color: #f9fafb;
    }
    
    /* Pagination Styles (Bootstrap 4 compatible override) */
    .pagination-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 25px;
        padding-top: 15px;
        border-top: 1px solid #e5e7eb;
    }
    
    .pagination-container nav {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .pagination {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: wrap !important;
        padding-left: 0;
        list-style: none !important;
        gap: 5px;
        margin: 0;
    }
    
    .pagination li.page-item {
        display: inline-flex !important;
        margin: 0 !important;
    }
    
    .pagination li a, .pagination li span {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 36px;
        height: 36px;
        padding: 0 10px;
        border-radius: 6px;
        background-color: #fff;
        border: 1px solid #d1d5db;
        color: #4b5563;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.2s;
    }
    
    .pagination li a:hover {
        background-color: #f3f4f6;
        border-color: #9ca3af;
        color: #111827;
    }
    
    .pagination li.active span {
        background-color: #534ade !important;
        border-color: #534ade !important;
        color: #fff !important;
    }
    
    .pagination li.disabled span {
        color: #9ca3af !important;
        background-color: #f9fafb !important;
        border-color: #e5e7eb !important;
        cursor: not-allowed;
    }
    
    .pagination-container p.small.text-muted {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }
</style>

@if(session('success'))
<div class="alert alert-success" style="padding: 15px; margin-bottom: 20px; border-radius: 8px; background-color: rgba(76, 175, 80, 0.1); border: 1px solid rgba(76, 175, 80, 0.3); color: #4CAF50;">
    {{ session('success') }}
</div>
@endif

<div class="admin-data-card" style="margin-top: 0;">

    <div class="recent-jobs-header" style="margin-bottom: 20px;">
        <div>
            <span class="analytics-label">CANDIDATE MANAGEMENT</span>
            <h3>Manage Candidates</h3>
            <p>View and manage candidate profiles.</p>
        </div>

        <a href="{{ route('admin.candidates.create') }}" class="view-all-button">
            <i class="fas fa-plus"></i> Add New Candidate
        </a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>PHONE</th>
                    <th>LOCATION</th>
                    <th>REGISTERED AT</th>
                    <th style="text-align: right;">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @forelse($candidates as $candidate)
                <tr>
                    <td style="color: #6b7280; font-weight: 500;">#{{ $candidates->firstItem() + $loop->index }}</td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 30px; height: 30px; border-radius: 50%; background: #e0e7ff; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #534ade; font-size: 12px;">
                                {{ strtoupper(substr($candidate->name, 0, 2)) }}
                            </div>
                            <strong style="color: #111827; font-size: 15px;">{{ $candidate->name }}</strong>
                        </div>
                    </td>
                    <td>
                        <a href="mailto:{{ $candidate->email }}" style="color: #4b5563; text-decoration: none;">
                            {{ $candidate->email }}
                        </a>
                    </td>
                    <td>
                        {{ $candidate->phone ?? 'N/A' }}
                    </td>
                    <td>
                        @if($candidate->location)
                            <i class="fas fa-map-marker-alt" style="color: #9ca3af; margin-right: 5px;"></i>
                            {{ $candidate->location }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <span style="color: #6b7280;">{{ $candidate->created_at->format('M d, Y') }}</span>
                    </td>
                    <td style="text-align: right;">
                        <a href="{{ route('admin.candidates.edit', $candidate) }}" class="action-btn" style="color: var(--primary-color); background: rgba(83, 74, 222, 0.1); padding: 8px 12px; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; margin-right: 5px; transition: all 0.2s;" onmouseover="this.style.background='rgba(83, 74, 222, 0.2)'" onmouseout="this.style.background='rgba(83, 74, 222, 0.1)'">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('admin.candidates.destroy', $candidate) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn" style="color: #F44336; background: rgba(244, 67, 54, 0.1); padding: 8px 12px; border-radius: 6px; border: none; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s;" onmouseover="this.style.background='rgba(244, 67, 54, 0.2)'" onmouseout="this.style.background='rgba(244, 67, 54, 0.1)'" onclick="return confirm('Are you sure you want to delete this candidate? This action cannot be undone.')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center" style="text-align: center; padding: 40px 20px; color: #6b7280;">
                        <i class="fas fa-users" style="font-size: 48px; color: #d1d5db; margin-bottom: 15px; display: block;"></i>
                        No candidates found. Start by adding a new one!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $candidates->links('pagination::bootstrap-4') }}
    </div>

</div>

@endsection
