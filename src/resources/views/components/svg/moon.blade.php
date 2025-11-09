{{--
    Moon Icon (Dark Mode)

    Usage:
    <x-svg.moon />
    <x-svg.moon class="w-5 h-5 text-indigo-600" />
--}}
@props(['class' => 'w-6 h-6'])

<svg {{ $attributes->merge(['class' => $class]) }} fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
</svg>
