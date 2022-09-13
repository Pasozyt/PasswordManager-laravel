@props(['active' => false])

@php
if ($active) {            
    $attributes = $attributes->merge([
        'class' => 'nav-link link-dark active',
        'aria-current' => 'page'
    ]);
} else {
    $attributes = $attributes->merge([
        'class' => 'nav-link link-dark'
    ]);
}
@endphp

<a {{ $attributes }}>
    {{ $slot }}
</a>


