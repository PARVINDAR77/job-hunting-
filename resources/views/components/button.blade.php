@props([
    'variant' => 'primary', // primary, secondary, outline, ghost
    'type' => 'button',
    'class' => ''
])

@php
    $baseClass = 'btn';
    $variantClass = 'btn-' . $variant;
    $classes = $baseClass . ' ' . $variantClass . ' ' . $class;
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
