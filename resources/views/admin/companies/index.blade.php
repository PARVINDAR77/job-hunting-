@extends('admin.layouts.app')

@section('content')

<style>
    .recent-jobs-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    .recent-jobs-header h3 {
        font-size: 22px;
        color: #111827;
        margin: 0 0 5px 0;
        font-weight: 700;
    }
    .recent-jobs-header p {
        color: #6b7280;
        margin: 0;
        font-size: 14px;
    }
    .analytics-label {
        color: #534ade;
        font-weight: 700;
        font-size: 11px;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 8px;
        display: block;
    }
    .btn-primary-custom {
        background: #534ade;
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: background 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-primary-custom:hover {
        background: #4338ca;
        color: #ffffff;
    }
    .jobs-table-container {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        overflow-x: auto;
    }
    .jobs-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }
    .jobs-table th {
        background: #f9fafb;
        color: #4b5563;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 15px;
        text-align: left;
        font-weight: 600;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }
    .jobs-table td {
        padding: 18px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f3f4f6;
        color: #374151;
        font-size: 14px;
    }
    .jobs-table tbody tr:hover {
        background-color: #f9fafb;
    }
    .jobs-table tbody tr:last-child td {
        border-bottom: none;
    }
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 6px;
        color: #4b5563;
        background: #f3f4f6;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
        text-decoration: none;
        margin-right: 5px;
    }
    .action-btn:hover {
        background: #e5e7eb;
    }
    .action-btn.edit:hover {
        color: #3b82f6;
        background: #dbeafe;
    }
    .action-btn.delete:hover {
        color: #ef4444;
        background: #fee2e2;
    }
    .company-logo {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        object-fit: cover;
        margin-right: 12px;
        border: 1px solid #e5e7eb;
    }
    .company-placeholder {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: #e0e7ff;
        color: #534ade;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 16px;
        margin-right: 12px;
    }
    
    /* Horizontal Pagination Styling */
    .pagination-wrapper {
        padding: 20px;
        background: #fff;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: center;
    }
    .pagination-wrapper nav {
        display: block !important;
        width: 100%;
        text-align: center;
    }
    .pagination-wrapper ul.pagination {
        display: inline-flex !important;
        padding-left: 0;
        list-style: none;
        border-radius: 0.25rem;
        margin: 0;
        flex-direction: row !important;
        gap: 5px;
    }
    .pagination-wrapper ul.pagination li {
        display: inline-block !important;
        margin: 0 !important;
    }
    .pagination-wrapper ul.pagination li a,
    .pagination-wrapper ul.pagination li span {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #534ade;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        text-decoration: none;
    }
    .pagination-wrapper ul.pagination li.active span {
        z-index: 1;
        color: #fff;
        background-color: #534ade;
        border-color: #534ade;
    }
    .pagination-wrapper ul.pagination li.disabled span {
        color: #6c757d;
        pointer-events: none;
        cursor: auto;
        background-color: #fff;
        border-color: #dee2e6;
    }
    .pagination-wrapper ul.pagination li a:hover {
        z-index: 2;
        color: #4338ca;
        text-decoration: none;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
</style>

<div class="recent-jobs-header">
    <div>
        <span class="analytics-label">COMPANY MANAGEMENT</span>
        <h3>Manage Companies</h3>
        <p>View and manage registered companies.</p>
    </div>
    <a href="{{ route('admin.companies.create') }}" class="btn-primary-custom">
        <i class="fas fa-plus"></i> Add New Company
    </a>
</div>

@if(session('success'))
<div style="background: #d1fae5; color: #065f46; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; font-weight: 500; font-size: 14px;">
    <i class="fas fa-check-circle" style="margin-right: 8px;"></i> {{ session('success') }}
</div>
@endif

<div class="jobs-table-container">
    <table class="jobs-table">
        <thead>
            <tr>
                <th style="width: 50px;">#</th>
                <th>Company</th>
                <th>Industry</th>
                <th>Location</th>
                <th>Employees</th>
                <th style="width: 100px; text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($companies as $company)
            <tr>
                <td>{{ $companies->firstItem() + $loop->index }}</td>
                <td>
                    <div style="display: flex; align-items: center;">
                        @if($company->logo)
                            <img src="{{ Storage::url($company->logo) }}" alt="{{ $company->name }}" class="company-logo">
                        @else
                            <div class="company-placeholder">
                                {{ strtoupper(substr($company->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <strong>{{ $company->name }}</strong>
                            @if($company->website)
                                <br><a href="{{ $company->website }}" target="_blank" style="color: #6b7280; font-size: 12px; text-decoration: none;">{{ $company->website }}</a>
                            @endif
                        </div>
                    </div>
                </td>
                <td>{{ $company->industry ?? '—' }}</td>
                <td>
                    @if($company->location)
                        <i class="fas fa-map-marker-alt" style="color: #9ca3af; margin-right: 4px;"></i> {{ $company->location }}
                    @else
                        —
                    @endif
                </td>
                <td>{{ $company->employee_count ?? '—' }}</td>
                <td style="text-align: center; white-space: nowrap;">
                    <a href="{{ route('admin.companies.edit', $company) }}" class="action-btn edit" title="Edit Company">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form action="{{ route('admin.companies.destroy', $company) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn delete" onclick="return confirm('Delete this company?')" title="Delete Company">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 40px 20px; color: #6b7280;">
                    <i class="fas fa-building" style="font-size: 32px; color: #d1d5db; margin-bottom: 10px; display: block;"></i>
                    No companies found. Start by adding a new one!
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($companies->hasPages())
    <div class="pagination-wrapper">
        {{ $companies->links('pagination::bootstrap-4') }}
    </div>
    @endif
</div>

@endsection
