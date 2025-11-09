{{--
    Hamburger Menu Icon

    Usage:
    <x-svg.menu />
    <x-svg.menu class="w-8 h-8 text-blue-600" />
--}}
@props(['class' => 'w-6 h-6'])

<svg {{ $attributes->merge(['class' => $class]) }} fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
</svg>
