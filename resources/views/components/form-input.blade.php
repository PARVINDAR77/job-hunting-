@props([
    'name',
    'label',
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'icon' => null,
])

<div class="form-group">
    @if($label)
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif
    
    <div class="input-wrapper">
        @if($icon)
            <i class="{{ $icon }} input-icon"></i>
        @endif
        
        @if($type === 'textarea')
            <textarea name="{{ $name }}" id="{{ $name }}" class="form-input {{ $icon ? 'with-icon' : '' }}" placeholder="{{ $placeholder }}" {{ $attributes }}>{{ old($name, $value) }}</textarea>
        @else
            <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-input {{ $icon ? 'with-icon' : '' }}" placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}" {{ $attributes }}>
        @endif
    </div>
    
    @error($name)
        <span class="form-error">{{ $message }}</span>
    @enderror
</div>
