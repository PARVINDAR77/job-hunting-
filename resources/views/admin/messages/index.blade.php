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
    .action-btn.delete:hover {
        color: #ef4444;
        background: #fee2e2;
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
</style>

<div class="recent-jobs-header">
    <div>
        <span class="analytics-label">MESSAGES</span>
        <h3>Contact Messages</h3>
        <p>View messages sent from the contact form.</p>
    </div>
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
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date</th>
                <th style="width: 100px; text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $message)
            <tr>
                <td style="color: #6b7280;">{{ $messages->firstItem() + $loop->index }}</td>
                <td><strong>{{ $message->name }}</strong></td>
                <td><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></td>
                <td>{{ Str::limit($message->subject, 30) }}</td>
                <td style="max-width: 250px;">{{ Str::limit($message->message, 50) }}</td>
                <td style="color: #6b7280;">{{ $message->created_at->format('M d, Y') }}</td>
                <td style="text-align: center; white-space: nowrap;">
                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn delete" onclick="return confirm('Delete this message permanently?')" title="Delete Message">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 40px 20px; color: #6b7280;">
                    <i class="fas fa-envelope-open" style="font-size: 32px; color: #d1d5db; margin-bottom: 10px; display: block;"></i>
                    No messages found at the moment.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($messages->hasPages())
    <div class="pagination-wrapper">
        {{ $messages->links('pagination::bootstrap-4') }}
    </div>
    @endif
</div>

@endsection
