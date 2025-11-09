{{--
    Scroll to Top Button Component

    A floating button that appears when user scrolls down and smoothly scrolls back to top.
    Includes accessibility features and dark mode support.

    Usage:
    <x-scroll-to-top />
--}}

<button
    x-data="{
        show: false,
        init() {
            window.addEventListener('scroll', () => {
                this.show = window.pageYOffset > 300;
            });
        },
        scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-4"
    @click="scrollToTop"
    type="button"
    aria-label="{{ __('general.back') }} {{ __('general.to') }} {{ __('general.home') }}"
    class="fixed bottom-8 end-8 z-50 p-3 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 focus:ring-4 focus:ring-blue-500/20 focus:outline-none group"
    style="display: none;"
    x-cloak
>
    <svg
        class="w-6 h-6 transform group-hover:-translate-y-1 transition-transform duration-300"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2"
    >
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
    </svg>
</button>
