/**
 * Language Switcher Alpine.js Component
 *
 * Manages language switching with proper URL handling.
 *
 * Usage in Blade:
 * <div x-data="languageSwitcher">
 *     <button @click="switchLanguage('en')">English</button>
 *     <button @click="switchLanguage('fa')">فارسی</button>
 *     <span x-text="currentLocale"></span>
 * </div>
 */

export default () => ({
    // Get current locale from HTML lang attribute
    currentLocale: document.documentElement.lang || 'en',

    // Available locales (should match config/locales.php)
    availableLocales: ['en', 'fa'],

    /**
     * Initialize the component
     */
    init() {
        // You can add initialization logic here if needed
    },

    /**
     * Switch to a different language
     * @param {string} locale - The locale code to switch to (e.g., 'en', 'fa')
     */
    switchLanguage(locale) {
        if (!this.availableLocales.includes(locale)) {
            console.error(`Locale "${locale}" is not available`);
            return;
        }

        if (locale === this.currentLocale) {
            return; // Already on this locale
        }

        // Use query parameter approach for session-based locale
        const url = new URL(window.location.href);
        url.searchParams.set('lang', locale);

        // Navigate to new URL with lang parameter
        window.location.href = url.toString();
    },

    /**
     * Get the display name for a locale
     * @param {string} locale - The locale code
     * @returns {string} The display name
     */
    getLocaleName(locale) {
        const names = {
            'en': 'English',
            'fa': 'فارسی'
        };
        return names[locale] || locale;
    },

    /**
     * Get the native name for a locale
     * @param {string} locale - The locale code
     * @returns {string} The native name
     */
    getNativeName(locale) {
        const names = {
            'en': 'English',
            'fa': 'فارسی'
        };
        return names[locale] || locale;
    },

    /**
     * Check if a locale is RTL
     * @param {string} locale - The locale code
     * @returns {boolean} Whether the locale is RTL
     */
    isRTL(locale) {
        const rtlLocales = ['fa', 'ar', 'he'];
        return rtlLocales.includes(locale);
    }
});
