{{--
    Master Layout Component

    The main layout template with proper HTML5 structure, SEO meta tags,
    RTL/LTR direction switching, dark mode support, and Alpine.js integration.

    Props:
    - pageTitle: string (required) - Page title
    - pageDescription: string (optional) - Meta description
    - pageKeywords: string (optional) - Meta keywords
    - ogImage: string (optional) - Open Graph image URL

    Usage:
    <x-layouts.master
        page-title="Welcome"
        page-description="Welcome to our application"
        page-keywords="laravel, filament, starter">

        <div class="container">
            <!-- Page content -->
        </div>
    </x-layouts.master>
--}}

@props([
    'pageTitle' => config('app.name'),
    'pageDescription' => '',
    'pageKeywords' => '',
    'ogImage' => asset('build/images/FardaDev-Logo.svg'),
])

@php
$currentLocale = app()->getLocale();
$localeConfig = config("locales.locales.{$currentLocale}", ['dir' => 'ltr']);
$direction = $localeConfig['dir'] ?? 'ltr';
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', $currentLocale) }}" dir="{{ $direction }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Primary Meta Tags --}}
    <title>{{ $pageTitle }} - {{ config('app.name') }}</title>
    <meta name="title" content="{{ $pageTitle }} - {{ config('app.name') }}"/>
    @if($pageDescription)
        <meta name="description" content="{{ $pageDescription }}">
    @endif
    @if($pageKeywords)
        <meta name="keywords" content="{{ $pageKeywords }}">
    @endif
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="robots" content="index, follow"/>
    <meta name="language" content="{{ $currentLocale }}"/>
    <meta name="copyright" content="{{ config('app.name') }}"/>
    <meta name="theme-color" content="#27AE60"/>

    {{-- Open Graph / Facebook --}}
    <meta property="og:locale" content="{{ $currentLocale }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:title" content="{{ $pageTitle }} - {{ config('app.name') }}"/>
    @if($pageDescription)
        <meta property="og:description" content="{{ $pageDescription }}"/>
    @endif
    <meta property="og:image" content="{{ $ogImage }}"/>
    <meta property="og:image:width" content="1200"/>
    <meta property="og:image:height" content="630"/>
    <meta property="og:site_name" content="{{ config('app.name') }}"/>

    {{-- Twitter Card --}}
    <meta property="twitter:card" content="summary_large_image"/>
    <meta property="twitter:url" content="{{ url()->current() }}"/>
    <meta property="twitter:title" content="{{ $pageTitle }} - {{ config('app.name') }}"/>
    @if($pageDescription)
        <meta property="twitter:description" content="{{ $pageDescription }}"/>
    @endif
    <meta property="twitter:image" content="{{ $ogImage }}"/>

    {{-- Favicon --}}
    <meta name="image" content="{{ $ogImage }}"/>
    <link rel="icon" type="image/svg+xml" href="{{ asset('build/images/FardaDev-Logo.svg') }}">
    <link rel="shortcut icon" href="{{ asset('build/images/FardaDev-Logo.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    {{-- Dark Mode Prevention Script (No Flash) --}}
    <script>
        (function() {
            var storedTheme = localStorage.getItem('theme');
            var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (storedTheme === 'dark' || (!storedTheme && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    {{-- Additional Head Content --}}
    @stack('head')

    {{-- Styles and Scripts --}}
    @vite('resources/css/laravel/pages/home.css')
    @vite('resources/js/laravel/pages/home.js')

    {{-- @livewireStyles --}}
</head>
<body
    class="antialiased scroll-smooth min-h-screen bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300 ease-out">

    <div class="flex flex-col min-h-screen">
        {{-- Skip to Main Content (Accessibility) --}}
        <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:start-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-blue-600 focus:text-white focus:rounded-lg">
            {{ __('general.skip_to_content') }}
        </a>

        {{-- Header --}}
        <x-header/>

        {{-- Main Content --}}
        <main class="flex-grow" id="main-content" role="main">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <x-footer/>
    </div>

    {{-- Scroll to Top Button --}}
    <x-ui.scroll-to-top/>

    {{-- Modals Stack --}}
    @stack('modals')

    {{-- Before Scripts Stack --}}
    @stack('before-scripts')

    {{-- After Scripts Stack --}}
    @stack('after-scripts')

    {{-- Performance Enhancements --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Implement lazy loading for images
            if ('loading' in HTMLImageElement.prototype) {
                // Browser supports native lazy loading
                const lazyImages = document.querySelectorAll('img:not([loading])');
                lazyImages.forEach(img => {
                    if (!img.hasAttribute('loading') && !img.closest('.no-lazy')) {
                        img.setAttribute('loading', 'lazy');
                    }
                });
            }

            // Implement scroll animations for elements with animate-on-view class
            if ('IntersectionObserver' in window) {
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate-fade-in-up');
                            entry.target.classList.remove('opacity-0', 'translate-y-8');
                            observer.unobserve(entry.target);
                        }
                    });
                }, observerOptions);

                // Observe all elements with animate-on-view class
                const animateElements = document.querySelectorAll('.animate-on-view');
                animateElements.forEach(el => {
                    // Add initial state
                    el.classList.add('opacity-0', 'translate-y-8', 'transition-all', 'duration-700', 'ease-out');
                    observer.observe(el);
                });
            }

            // Use requestIdleCallback for non-critical operations
            const runNonCritical = window.requestIdleCallback ||
                function(cb) {
                    const start = Date.now();
                    return setTimeout(function() {
                        cb({
                            didTimeout: false,
                            timeRemaining: function() {
                                return Math.max(0, 50.0 - (Date.now() - start));
                            }
                        });
                    }, 1);
                };

            // Run non-critical operations during idle time
            runNonCritical(() => {
                // Add deferred enhancements here
                // For example, init animations, load non-critical resources, etc.
            });
        });
    </script>

    {{-- @livewireScripts --}}
</body>
</html>
