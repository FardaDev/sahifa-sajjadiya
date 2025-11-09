{{--
    Input Component

    A reusable input component with label, error support, and full dark mode support.

    Props:
    - label: string (optional) - Input label text
    - error: string (optional) - Error message to display
    - required: boolean (default: false) - Whether the field is required
    - hint: string (optional) - Helper text below the input

    Usage:
    <x-ui.input
        label="Email Address"
        type="email"
        name="email"
        placeholder="you@example.com"
        :required="true"
    />

    <x-ui.input
        label="Password"
        type="password"
        name="password"
        error="Password must be at least 8 characters"
    />

    <x-ui.input
        label="Username"
        name="username"
        hint="Choose a unique username"
    />
--}}

@props([
    'label' => null,
    'error' => null,
    'required' => false,
    'hint' => null,
])

<div class="space-y-2">
    @if($label)
        <label
            @if($attributes->has('id'))
                for="{{ $attributes->get('id') }}"
            @elseif($attributes->has('name'))
                for="{{ $attributes->get('name') }}"
            @endif
            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
        >
            {{ $label }}
            @if($required)
                <span class="text-red-500 dark:text-red-400">*</span>
            @endif
        </label>
    @endif

    <input
        {{ $attributes->merge([
            'class' => 'w-full px-4 py-3 bg-white dark:bg-gray-800 border text-gray-900 dark:text-gray-100 rounded-lg focus:ring-4 focus:ring-blue-500/20 focus:outline-none transition-all disabled:opacity-50 disabled:cursor-not-allowed ' .
            ($error ? 'border-red-500 dark:border-red-400 focus:border-red-500' : 'border-gray-200 dark:border-gray-700 focus:border-blue-500')
        ]) }}
        @if($required) required @endif
    />

    @if($hint && !$error)
        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $hint }}</p>
    @endif

    @if($error)
        <p class="text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            {{ $error }}
        </p>
    @endif
</div>
