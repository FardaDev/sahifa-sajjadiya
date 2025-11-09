import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            // CSS and JavaScript entry points
            input: [
                'resources/css/filament/index.css',     // Filament admin panel CSS

                'resources/css/laravel/pages/home.css', // Home page CSS
                'resources/js/laravel/pages/home.js',   // Main application JavaScript
            ],
            // Enable hot reload for development
            refresh: true,
        }),
        // Tailwind CSS v4 plugin
        tailwindcss(),
    ],
});
