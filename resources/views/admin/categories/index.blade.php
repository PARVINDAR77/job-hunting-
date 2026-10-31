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
        min-width: 700px;
    }
    .jobs-table th {
        background: #f9fafb;
        color: #4b5563;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 15px 20px;
        text-align: left;
        font-weight: 600;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }
    .jobs-table td {
        padding: 18px 20px;
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
    
    .category-icon-box {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: #e0e7ff;
        color: #534ade;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-right: 12px;
    }

    /* Horizontal Pagination */
    .pagination-wrapper {
        padding: 20px;
        background: #fff;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: center;
    }
    .pagination-wrapper nav { width: 100%; text-align: center; display: block !important; }
    .pagination-wrapper ul.pagination {
        display: inline-flex !important;
        flex-direction: row !important;
        padding-left: 0;
        list-style: none;
        margin: 0;
        gap: 5px;
    }
    .pagination-wrapper ul.pagination li { display: inline-block !important; margin: 0 !important; }
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
        background-color: #fff;
        border-color: #dee2e6;
    }
</style>

<div class="recent-jobs-header">
    <div>
        <span class="analytics-label">CATEGORY MANAGEMENT</span>
        <h3>Manage Categories</h3>
        <p>View and manage job categories and industries.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn-primary-custom">
        <i class="fas fa-plus"></i> Add New Category
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
                <th>Category Name</th>
                <th>Slug</th>
                <th>Total Jobs</th>
                <th style="width: 100px; text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td style="color: #6b7280;">{{ $categories->firstItem() + $loop->index }}</td>
                <td>
                    <div style="display: flex; align-items: center;">
                        <div class="category-icon-box">
                            <i class="{{ $category->icon ?? 'fas fa-layer-group' }}"></i>
                        </div>
                        <strong>{{ $category->name }}</strong>
                    </div>
                </td>
                <td style="color: #6b7280;">{{ $category->slug }}</td>
                <td>
                    <span style="background: #f3f4f6; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; color: #4b5563;">
                        {{ $category->jobs_count ?? 0 }} Jobs
                    </span>
                </td>
                <td style="text-align: center; white-space: nowrap;">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="action-btn edit" title="Edit Category">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn delete" onclick="return confirm('Delete this category permanently?')" title="Delete Category">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 40px 20px; color: #6b7280;">
                    <i class="fas fa-tags" style="font-size: 32px; color: #d1d5db; margin-bottom: 10px; display: block;"></i>
                    No categories found at the moment.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($categories->hasPages())
    <div class="pagination-wrapper">
        {{ $categories->links('pagination::bootstrap-4') }}
    </div>
    @endif
</div>

@endsection
