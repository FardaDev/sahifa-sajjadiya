/**
 * Main Application JavaScript Entry Point
 *
 * This file imports Bootstrap, Alpine.js, and registers all Alpine components.
 */

import Alpine from 'alpinejs';

// Import Alpine.js components
import languageSwitcher from '../components/languageSwitcher.js';

// Make Alpine available globally
window.Alpine = Alpine;

// Initialize dark mode state
const initialDarkMode = localStorage.getItem('theme') === 'dark' ||
    (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches);

// Register dark mode as a global store (shared state across all components)
Alpine.store('darkMode', {
    on: initialDarkMode,

    toggle() {
        this.on = !this.on;
        if (this.on) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        localStorage.setItem('theme', this.on ? 'dark' : 'light');
    }
});

// Register language switcher as a component (each instance can have its own state)
Alpine.data('languageSwitcher', languageSwitcher);

// Start Alpine.js
Alpine.start();

// Apply initial theme
if (initialDarkMode) {
    document.documentElement.classList.add('dark');
}
