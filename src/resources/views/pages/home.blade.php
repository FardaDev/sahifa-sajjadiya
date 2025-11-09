{{--
    Welcome Page

    Example page demonstrating the use of the master layout,
    components, SEO meta tags, and multi-language content.
--}}

<x-layouts.master
    page-title="{{ __('general.welcome', ['app' => config('app.name')]) }}"
    page-description="A modern Laravel + Filament starter template with Tailwind CSS v4, Alpine.js, RTL support, and dark mode."
    page-keywords="laravel, filament, tailwind, alpine, starter, template, rtl, dark mode"
>
    {{-- Hero Section --}}
    <section class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 overflow-hidden">
        {{-- Decorative Background Elements --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -end-40 w-80 h-80 bg-blue-400/20 dark:bg-blue-600/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -start-40 w-80 h-80 bg-purple-400/20 dark:bg-purple-600/10 rounded-full blur-3xl"></div>
        </div>

        {{-- Content --}}
        <div class="relative container mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="max-w-4xl mx-auto text-center space-y-8">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-full text-sm font-medium animate-fade-in-down">
                    <x-svg.lightning class="w-4 h-4" />
                    <span>{{ __('general.starter_template_badge') }}</span>
                </div>

                {{-- Heading --}}
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 dark:text-white leading-tight animate-fade-in-up">
                    {{ __('general.welcome', ['app' => config('app.name')]) }}
                </h1>

                {{-- Description --}}
                <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-400 leading-relaxed max-w-3xl mx-auto animate-fade-in-up" style="animation-delay: 0.1s;">
                    {{ __('general.welcome_description') }}
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up" style="animation-delay: 0.2s;">
                    <x-ui.button variant="primary" size="lg" class="w-full sm:w-auto">
                        {{ __('general.get_started') }}
                    </x-ui.button>
                    <x-ui.button variant="outline" size="lg" class="w-full sm:w-auto">
                        {{ __('general.learn_more') }}
                    </x-ui.button>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    {{ __('general.features') }}
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400">
                    {{ __('general.features_description') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Feature 1 --}}
                <x-ui.card :hover="true">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                            <x-svg.lightning-bolt class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                {{ __('general.feature_tailwind_title') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ __('general.feature_tailwind_desc') }}
                            </p>
                        </div>
                    </div>
                </x-ui.card>

                {{-- Feature 2 --}}
                <x-ui.card :hover="true">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 p-3 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                            <x-svg.moon class="w-6 h-6 text-purple-600 dark:text-purple-400" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                {{ __('general.feature_darkmode_title') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ __('general.feature_darkmode_desc') }}
                            </p>
                        </div>
                    </div>
                </x-ui.card>

                {{-- Feature 3 --}}
                <x-ui.card :hover="true">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 p-3 bg-green-100 dark:bg-green-900/30 rounded-lg">
                            <x-svg.globe class="w-6 h-6 text-green-600 dark:text-green-400" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                {{ __('general.feature_rtl_title') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ __('general.feature_rtl_desc') }}
                            </p>
                        </div>
                    </div>
                </x-ui.card>

                {{-- Feature 4 --}}
                <x-ui.card :hover="true">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 p-3 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg">
                            <x-svg.palette class="w-6 h-6 text-yellow-600 dark:text-yellow-400" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                {{ __('general.feature_components_title') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ __('general.feature_components_desc') }}
                            </p>
                        </div>
                    </div>
                </x-ui.card>

                {{-- Feature 5 --}}
                <x-ui.card :hover="true">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 p-3 bg-red-100 dark:bg-red-900/30 rounded-lg">
                            <x-svg.shield-check class="w-6 h-6 text-red-600 dark:text-red-400" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                {{ __('general.feature_filament_title') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ __('general.feature_filament_desc') }}
                            </p>
                        </div>
                    </div>
                </x-ui.card>

                {{-- Feature 6 --}}
                <x-ui.card :hover="true">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 p-3 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                            <x-svg.adjustments class="w-6 h-6 text-indigo-600 dark:text-indigo-400" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                {{ __('general.feature_alpine_title') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ __('general.feature_alpine_desc') }}
                            </p>
                        </div>
                    </div>
                </x-ui.card>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-20 bg-gradient-to-br from-blue-600 to-purple-600 dark:from-blue-700 dark:to-purple-700">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center space-y-8">
                <h2 class="text-3xl md:text-4xl font-bold text-white">
                    {{ __('general.ready_to_start') }}
                </h2>
                <p class="text-xl text-blue-100">
                    {{ __('general.start_building') }}
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <x-ui.button variant="secondary" size="lg" class="w-full sm:w-auto !bg-white dark:!bg-gray-100 !text-blue-600 dark:!text-blue-700 hover:!bg-gray-50 dark:hover:!bg-gray-200">
                        {{ __('general.get_started') }}
                    </x-ui.button>
                    <x-ui.button variant="ghost" size="lg" class="w-full sm:w-auto !text-white !border-white/30 hover:!bg-white/10 hover:!border-white/50">
                        {{ __('general.view_documentation') }}
                    </x-ui.button>
                </div>
            </div>
        </div>
    </section>
</x-layouts.master>
