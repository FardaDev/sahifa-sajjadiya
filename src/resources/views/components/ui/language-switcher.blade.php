{{--
    Language Switcher Component (Desktop)

    A dropdown menu to switch between available languages.
    Uses Alpine.js languageSwitcher component for state management.

    Usage:
    <x-language-switcher />
--}}

@php
$locales = config('locales.locales', []);
$currentLocale = app()->getLocale();
@endphp

<div
    x-data="{
        open: false,
        ...languageSwitcher()
    }"
    @click.away="open = false"
    class="relative"
>
    <!-- Trigger Button -->
    <button
        @click="open = !open"
        type="button"
        :aria-expanded="open"
        aria-haspopup="true"
        class="flex items-center gap-2 px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors duration-300 focus:ring-4 focus:ring-blue-500/20 focus:outline-none"
    >
        <x-svg.globe class="w-5 h-5" />
        <span class="text-sm font-medium">{{ $locales[$currentLocale]['native'] ?? $currentLocale }}</span>
        <x-svg.chevron-down
            class="w-4 h-4 transition-transform duration-300"
            ::class="{ 'rotate-180': open }"
        />
    </button>

    <!-- Dropdown Menu -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute end-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1 z-50"
        style="display: none;"
        x-cloak
    >
        @foreach($locales as $code => $locale)
            <button
                @click="switchLanguage('{{ $code }}'); open = false"
                type="button"
                class="w-full flex items-center gap-3 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 {{ $code === $currentLocale ? 'bg-blue-50 dark:bg-blue-900/20' : '' }}"
            >
                <span class="text-lg">{{ $locale['flag'] }}</span>
                <span class="flex-1 text-start">{{ $locale['native'] }}</span>
                @if($code === $currentLocale)
                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                @endif
            </button>
        @endforeach
    </div>
</div>
