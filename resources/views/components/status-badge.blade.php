@props([
    'type' => 'secondary', // primary, secondary, success, warning, danger
])

@php
    $baseClass = 'status-badge';
    $typeClass = 'badge-' . $type;
    $classes = $baseClass . ' ' . $typeClass;
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
