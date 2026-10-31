@props([
    'title' => 'No Data Found',
    'description' => 'We could not find any matching records.',
    'icon' => 'fa-regular fa-folder-open',
    'actionText' => null,
    'actionUrl' => '#'
])

<div class="empty-state">
    <div class="empty-icon-wrapper">
        <i class="{{ $icon }}"></i>
    </div>
    <h3 class="empty-title">{{ $title }}</h3>
    <p class="empty-description">{{ $description }}</p>
    
    @if($actionText)
        <a href="{{ $actionUrl }}" class="btn btn-primary mt-4">{{ $actionText }}</a>
    @endif
</div>
