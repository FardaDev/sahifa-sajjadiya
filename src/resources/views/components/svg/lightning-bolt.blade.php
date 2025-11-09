{{--
    Lightning Bolt Icon (Outline)

    Usage:
    <x-svg.lightning-bolt />
    <x-svg.lightning-bolt class="w-6 h-6 text-blue-600" />
--}}
@props(['class' => 'w-6 h-6'])

<svg {{ $attributes->merge(['class' => $class]) }} fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
</svg>
