{{--
    Button Component

    A reusable button component with variants, sizes, and full dark mode support.

    Props:
    - variant: 'primary' | 'secondary' | 'outline' | 'ghost' (default: 'primary')
    - size: 'sm' | 'md' | 'lg' (default: 'md')
    - type: 'button' | 'submit' | 'reset' (default: 'button')

    Usage:
    <x-ui.button>Click Me</x-ui.button>
    <x-ui.button variant="secondary" size="lg">Large Secondary</x-ui.button>
    <x-ui.button variant="outline" type="submit">Submit Form</x-ui.button>
--}}

@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
])

@php
$variantClasses = match($variant) {
    'primary' => 'bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white border-transparent',
    'secondary' => 'bg-gray-600 hover:bg-gray-700 dark:bg-gray-500 dark:hover:bg-gray-600 text-white border-transparent',
    'outline' => 'border-2 border-blue-600 dark:border-blue-500 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 bg-transparent',
    'ghost' => 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 border-transparent bg-transparent',
    default => 'bg-blue-600 hover:bg-blue-700 text-white border-transparent',
};

$sizeClasses = match($size) {
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-4 py-2 text-base',
    'lg' => 'px-6 py-3 text-lg',
    default => 'px-4 py-2 text-base',
};
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => "inline-flex items-center justify-center gap-2 rounded-lg font-medium cursor-pointer transition-all duration-300 focus:ring-4 focus:ring-blue-500/20 focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed border {$variantClasses} {$sizeClasses}"
    ]) }}
>
    {{ $slot }}
</button>
