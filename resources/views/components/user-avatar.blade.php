@props(['name', 'size' => 'md'])

@php
$sizes = [
    'sm' => 'w-12 h-12 text-lg',
    'md' => 'w-20 h-20 text-2xl',
    'lg' => 'w-32 h-32 text-5xl',
];

$sizeClass = $sizes[$size] ?? $sizes['md'];

// Extraire les initiales du nom
$words = explode(' ', trim($name));
$initials = '';
if (count($words) >= 2) {
    $initials = strtoupper(substr($words[0], 0, 1) . substr($words[count($words) - 1], 0, 1));
} else {
    $initials = strtoupper(substr($name, 0, 2));
}
@endphp

<div {{ $attributes->merge(['class' => "user-avatar {$sizeClass}"]) }}>
    <span>{{ $initials }}</span>
</div>
