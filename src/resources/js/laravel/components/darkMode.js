/**
 * Dark Mode Alpine.js Store
 *
 * Global store for dark mode state with localStorage persistence and system preference detection.
 * Uses Alpine.store() for global state management across all components.
 *
 * Registered in: resources/js/laravel/pages/home.js
 * Alpine.store('darkMode', darkMode);
 *
 * Usage in Blade:
 * <button @click="$store.darkMode.toggle()">
 *     <span x-show="!$store.darkMode.isDark">🌙</span>
 *     <span x-show="$store.darkMode.isDark">☀️</span>
 * </button>
 *
 * Access in JavaScript:
 * Alpine.store('darkMode').toggle();
 * Alpine.store('darkMode').isDark;
 */

export default {
    // Initialize dark mode state from localStorage or system preference
    isDark: localStorage.getItem('theme') === 'dark' ||
           (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),

    /**
     * Toggle dark mode
     */
    toggle() {
        this.isDark = !this.isDark;
        this.applyTheme();
        localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
    },

    /**
     * Apply theme to document
     */
    applyTheme() {
        if (this.isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    },

    /**
     * Set theme explicitly
     * @param {boolean} dark - Whether to enable dark mode
     */
    setTheme(dark) {
        this.isDark = dark;
        this.applyTheme();
        localStorage.setItem('theme', dark ? 'dark' : 'light');
    }
};
