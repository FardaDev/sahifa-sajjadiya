{{--
    Header Component

    Responsive navigation header with desktop and mobile menus,
    language switcher, dark mode toggle, and accessibility features.

    Usage:
    <x-header />
--}}

<header class="sticky top-0 z-40 bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border-b border-gray-200 dark:border-gray-800">
    <nav class="container mx-auto px-4 sm:px-6 lg:px-8" aria-label="{{ __('general.main_navigation') }}">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-bold text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                    {{-- Logo Image (if you have one) --}}
                    {{-- <img src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name') }}" class="h-8 w-auto"> --}}
                    <span>{{ config('app.name') }}</span>
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <div class="hidden md:flex md:items-center md:gap-8">
                {{-- Navigation Links --}}
                <div class="flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors {{ request()->routeIs('home') ? 'text-blue-600 dark:text-blue-400' : '' }}">
                        {{ __('general.home') }}
                    </a>
                    <a href="#" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                        {{ __('general.about') }}
                    </a>
                    <a href="#" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                        {{ __('general.services') }}
                    </a>
                    <a href="#" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                        {{ __('general.contact') }}
                    </a>
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-2">
                    {{-- Dark Mode Toggle --}}
                    <x-ui.toggle-dark-mode />

                    {{-- Language Switcher --}}
                    <x-ui.language-switcher />
                </div>
            </div>

            {{-- Mobile Menu Button --}}
            <div class="flex md:hidden">
                <button
                    x-data="{ open: false }"
                    @click="open = !open; $dispatch('mobile-menu-toggle', { open })"
                    type="button"
                    class="p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors"
                    :aria-expanded="open"
                    aria-label="{{ __('general.toggle_menu') }}"
                >
                    <x-svg.menu class="w-6 h-6" />
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div
            x-data="{ open: false }"
            @mobile-menu-toggle.window="open = $event.detail.open"
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="md:hidden border-t border-gray-200 dark:border-gray-800 py-4"
            style="display: none;"
            x-cloak
        >
            {{-- Mobile Navigation Links --}}
            <div class="space-y-1">
                <a href="{{ route('home') }}" class="block px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors {{ request()->routeIs('home') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400' : '' }}">
                    {{ __('general.home') }}
                </a>
                <a href="#" class="block px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    {{ __('general.about') }}
                </a>
                <a href="#" class="block px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    {{ __('general.services') }}
                </a>
                <a href="#" class="block px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    {{ __('general.contact') }}
                </a>
            </div>

            {{-- Mobile Actions --}}
            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-800">
                <x-ui.toggle-dark-mode-mobile />
                <x-ui.language-switcher-mobile />
            </div>
        </div>
    </nav>
</header>
