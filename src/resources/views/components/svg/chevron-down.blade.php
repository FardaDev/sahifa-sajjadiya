{{--
    Chevron Down Icon (Dropdown Indicator)

    Usage:
    <x-svg.chevron-down />
    <x-svg.chevron-down class="w-4 h-4 text-gray-500" />
--}}
@props(['class' => 'w-6 h-6'])

<svg {{ $attributes->merge(['class' => $class]) }} fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
</svg>
