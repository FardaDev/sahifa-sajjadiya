{{--
    Card Component

    A reusable card component with optional padding and full dark mode support.

    Props:
    - padding: boolean (default: true) - Whether to include padding
    - hover: boolean (default: false) - Whether to add hover effect

    Usage:
    <x-ui.card>
        <h3>Card Title</h3>
        <p>Card content goes here</p>
    </x-ui.card>

    <x-ui.card :padding="false">
        <img src="image.jpg" alt="Image">
        <div class="p-6">Content with custom padding</div>
    </x-ui.card>

    <x-ui.card :hover="true">
        Hoverable card
    </x-ui.card>
--}}

@props([
    'padding' => true,
    'hover' => false,
])

@php
$paddingClass = $padding ? 'p-6' : '';
$hoverClass = $hover ? 'hover:shadow-xl hover:-translate-y-1 cursor-pointer' : '';
@endphp

<div {{ $attributes->merge([
    'class' => "bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 {$paddingClass} {$hoverClass}"
]) }}>
    {{ $slot }}
</div>
