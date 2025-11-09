{{--
    Dark Mode Toggle Component (Mobile)

    A mobile menu item version of the dark mode toggle.
    Uses Alpine.js global store ($store.darkMode) for shared state management.

    Usage:
    <x-ui.toggle-dark-mode-mobile />

    Note: This component uses Alpine.store('darkMode') which provides global state
    shared across all components. No x-data needed on the button itself.
--}}

<button
    x-data
    @click="$store.darkMode.toggle()"
    type="button"
    class="w-full flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-300"
>
    <!-- Icon Container -->
    <div class="relative w-5 h-5">
        <!-- Sun Icon (shows when dark mode is ON) -->
        <svg
            x-show="$store.darkMode.on"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-50"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-50"
            class="absolute inset-0 w-5 h-5 text-yellow-500"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>

        <!-- Moon Icon (shows when dark mode is OFF) -->
        <svg
            x-show="!$store.darkMode.on"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-50"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-50"
            class="absolute inset-0 w-5 h-5 text-indigo-600 dark:text-indigo-400"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
        </svg>
    </div>

    <!-- Label -->
    <span class="text-sm font-medium" x-text="$store.darkMode.on ? '{{ __('general.light_mode') }}' : '{{ __('general.dark_mode') }}'"></span>
</button>
