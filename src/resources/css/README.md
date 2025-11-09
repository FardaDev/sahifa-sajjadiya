# CSS Architecture Documentation

This document outlines the CSS architecture for the Laravel Filament Starter Template. The structure is designed for maintainability, scalability, and developer experience.

## Directory Structure

```
src/resources/css/
├── base/                    # Shared foundation styles
│   ├── _variables.css      # Design tokens, brand colors, gradients
│   ├── _base.css          # Base styles, RTL/LTR fonts, scrollbars
│   ├── _animations.css    # Keyframe animation definitions
│   └── _headings.css      # Typography heading styles
├── fonts/                  # Font configurations
│   ├── vazirmatn/         # Vazirmatn font (RTL)
│   │   ├── index.css      # Main font entry
│   │   ├── vazirmatn-variable.css  # @font-face definitions
│   │   └── utility.css    # Font-specific utility classes
│   ├── instrument-sans/   # Instrument Sans font (LTR)
│   │   ├── index.css      # Main font entry
│   │   ├── instrument-sans-variable.css  # @font-face definitions
│   │   └── utility.css    # Font-specific utility classes
│   └── index.css          # Main font imports
├── filament/              # Filament admin panel styles
│   ├── index.css          # Main Filament CSS entry
│   ├── theme.css          # Filament theme customization
│   └── custom.css         # Additional Filament styles
├── laravel/               # Laravel application styles
│   ├── components/        # Component-specific styles (if needed)
│   └── pages/             # Page-specific CSS files (one per page)
│       └── home.css       # Home page CSS entry point
└── README.md              # This file
```

## Design Philosophy

### 1. Per-Page CSS Architecture

**Each page has its own CSS file** in `laravel/pages/`. This approach:
- Keeps CSS scoped to where it's used
- Allows per-page optimization and code splitting
- Makes it easy to add/remove pages without affecting others
- Enables page-specific customizations

Example: `home.css`, `about.css`, `contact.css`, etc.

### 2. Tailwind-First Approach

Use Tailwind CSS utility classes for most styling needs. Only create custom CSS when:
- Complex animations or transitions are needed
- Reusable patterns that would be verbose with utilities
- Browser-specific fixes or hacks
- Performance-critical optimizations

### 3. Component-Based Architecture

Each major UI component should be self-contained:
- Use Blade components for markup
- Apply Tailwind utilities directly in templates
- Create custom CSS only when necessary
- Keep component styles close to component files

### 4. Design Tokens

All design decisions (colors, spacing, typography) are defined as CSS variables in `base/_variables.css`:

```css
@theme {
    /* Brand Colors */
    --color-brand-primary: #3B82F6;
    --color-brand-secondary: #8B5CF6;

    /* Typography */
    --font-family-rtl: 'Vazirmatn Variable', system-ui, sans-serif;
    --font-family-ltr: 'Inter Variable', system-ui, sans-serif;
}
```

## RTL and LTR Support

### Font Switching

The application automatically switches fonts based on the document direction:

```css
/* In base/_base.css */
html[dir="rtl"] {
    font-family: var(--font-family-rtl);
}

html[dir="ltr"] {
    font-family: var(--font-family-ltr);
}
```

### Logical Properties

Always use Tailwind's logical properties for RTL support:

**DO:**
```html
<div class="ms-4 me-2 ps-6 pe-4">
    <!-- ms = margin-inline-start, me = margin-inline-end -->
    <!-- ps = padding-inline-start, pe = padding-inline-end -->
</div>
```

**DON'T:**
```html
<div class="ml-4 mr-2 pl-6 pr-4">
    <!-- These won't flip in RTL -->
</div>
```

### Common Logical Properties

| Physical | Logical | Description |
|----------|---------|-------------|
| `ml-*` | `ms-*` | Margin start (left in LTR, right in RTL) |
| `mr-*` | `me-*` | Margin end (right in LTR, left in RTL) |
| `pl-*` | `ps-*` | Padding start |
| `pr-*` | `pe-*` | Padding end |
| `left-*` | `start-*` | Position start |
| `right-*` | `end-*` | Position end |
| `text-left` | `text-start` | Text alignment start |
| `text-right` | `text-end` | Text alignment end |

## Dark Mode Support

### Implementation

Dark mode is implemented using Tailwind's `dark:` variant and Alpine.js:

```html
<div class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <!-- Content -->
</div>
```

### Best Practices

1. **Always provide dark mode variants** for background and text colors
2. **Test in both modes** during development
3. **Use semantic color names** from design tokens
4. **Maintain contrast ratios** for accessibility (WCAG AA minimum)

### Dark Mode Classes

```html
<!-- Background -->
<div class="bg-white dark:bg-gray-900">

<!-- Text -->
<p class="text-gray-900 dark:text-gray-100">

<!-- Borders -->
<div class="border-gray-200 dark:border-gray-700">

<!-- Hover states -->
<button class="hover:bg-gray-100 dark:hover:bg-gray-800">
```

## Font Configuration

### Available Fonts

1. **Vazirmatn** (RTL) - Persian/Arabic script
   - Variable font with weights 100-900
   - Includes Persian number variants
   - Tabular number support

2. **Instrument Sans** (LTR) - Latin script
   - Variable font with weights 400-700
   - Modern, clean design

### Adding New Fonts

1. Add font files to `src/resources/fonts/your-font/`
2. Create font configuration in `src/resources/css/fonts/your-font/`
3. Import in `src/resources/css/fonts/index.css`
4. Update design tokens in `base/_variables.css`

Example:

```css
/* fonts/your-font/index.css */
@import './your-font-variable.css';
@import './utility.css';

/* fonts/your-font/your-font-variable.css */
@font-face {
  font-family: 'Your Font';
  src: url('/resources/fonts/your-font/YourFont[wght].woff2') format('woff2-variations');
  font-weight: 100 900;
  font-style: normal;
  font-display: swap;
}
```

## Animations

### Using Animations

Animations are defined in `base/_animations.css` and can be used with Tailwind utilities:

```html
<!-- Fade in animation -->
<div class="animate-fade-in">

<!-- Slide up animation -->
<div class="animate-slide-up">

<!-- Custom animation with animate-on-view class -->
<div class="animate-on-view">
    <!-- Will animate when scrolled into view -->
</div>
```

### Creating Custom Animations

Add keyframes to `base/_animations.css`:

```css
@keyframes your-animation {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@utility your-animation {
    animation: your-animation 0.5s ease-out;
}
```

## Page-Specific Styles

### When to Create Page CSS

Create page-specific CSS files in `laravel/pages/` when:
- Page has unique layout requirements
- Multiple complex components need coordination
- Performance optimization requires critical CSS

## Page-Specific CSS Files

Each page should have its own CSS file in `laravel/pages/`. This is the recommended approach for this template.

### Creating a New Page CSS File

1. Create a new CSS file in `laravel/pages/` (e.g., `about.css`)
2. Import Tailwind and base styles
3. Add page-specific utilities if needed
4. Add the file to Vite configuration
5. Reference it in your layout or page

**Example: `laravel/pages/home.css`**

```css
/**
 * Home Page CSS
 */

@import "tailwindcss";

/* Base Styles */
@import "../../base/_variables.css";
@import "../../base/_base.css";
@import "../../base/_animations.css";
@import "../../base/_headings.css";

/* Fonts */
@import "../../fonts/index.css";

/* Page-specific utilities */
@layer utilities {
  .hero-section {
    @apply min-h-screen flex items-center justify-center;
    @apply bg-gradient-to-br from-blue-50 to-indigo-100;
    @apply dark:from-gray-900 dark:to-gray-800;
  }
}
```

### Adding to Vite Configuration

Update `vite.config.js` to include your new page CSS:

```javascript
input: [
    'resources/css/laravel/pages/home.css',
    'resources/css/laravel/pages/about.css',  // Add new page
    'resources/css/filament/index.css',
    'resources/js/home.js',
],
```

### Using in Blade Templates

Reference the page CSS in your layout:

```blade
{{-- In master layout --}}
@vite('resources/css/laravel/pages/home.css')

{{-- Or push to head stack from a specific page --}}
@push('head')
    @vite('resources/css/laravel/pages/about.css')
@endpush
```

## Component Styles

### When to Create Component CSS

Create component-specific CSS in `laravel/components/` only when:
- Component has complex state-dependent styles
- Styles can't be expressed with Tailwind utilities
- Component is reused across many pages

### Component CSS Pattern

```css
/* laravel/components/custom-dropdown.css */
.custom-dropdown {
    @apply relative inline-block;
}

.custom-dropdown__trigger {
    @apply px-4 py-2 bg-white dark:bg-gray-800 rounded-lg;
    @apply border border-gray-200 dark:border-gray-700;
}

.custom-dropdown__menu {
    @apply absolute top-full mt-2 w-48;
    @apply bg-white dark:bg-gray-800 rounded-lg shadow-lg;
    @apply opacity-0 invisible transition-all duration-200;
}

.custom-dropdown.is-open .custom-dropdown__menu {
    @apply opacity-100 visible;
}
```

## Filament Customization

### Theme Customization

Customize Filament's appearance in `filament/theme.css`:

```css
/* Override Filament colors */
@theme {
    --color-primary-50: #eff6ff;
    --color-primary-500: #3b82f6;
    --color-primary-600: #2563eb;
}
```

### Custom Filament Styles

Add additional Filament styles in `filament/custom.css`:

```css
/* Custom admin panel styles */
.fi-sidebar {
    @apply border-e border-gray-200 dark:border-gray-700;
}
```

## Performance Best Practices

### 1. Minimize Custom CSS

Use Tailwind utilities whenever possible. Custom CSS increases bundle size and maintenance burden.

### 2. Use @layer Directive

Organize custom CSS using Tailwind's layer system:

```css
@layer base {
    /* Base element styles */
}

@layer components {
    /* Component classes */
}

@layer utilities {
    /* Utility classes */
}
```

### 3. Optimize Font Loading

- Use `font-display: swap` for all fonts
- Preload critical fonts in the layout
- Use variable fonts to reduce file size

### 4. Critical CSS

For production, consider extracting critical CSS for above-the-fold content.

## Accessibility Guidelines

### Color Contrast

Maintain WCAG AA contrast ratios:
- Normal text: 4.5:1 minimum
- Large text: 3:1 minimum
- UI components: 3:1 minimum

### Focus States

Always provide visible focus indicators:

```html
<button class="focus:ring-4 focus:ring-blue-500/20 focus:outline-none">
    Button
</button>
```

### Reduced Motion

Respect user preferences for reduced motion:

```css
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
```

## Build Process

### Vite Configuration

CSS is processed through Vite with Tailwind CSS v4:

```javascript
// vite.config.js
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/laravel/pages/home.css',
                'resources/css/filament/index.css',
                'resources/js/home.js',
            ],
            refresh: true,
        }),
    ],
});
```

### Development

```bash
# Start development server with hot reload
npm run dev
```

### Production

```bash
# Build optimized assets
npm run build
```

## Troubleshooting

### Styles Not Applying

1. Check if Vite is running (`npm run dev`)
2. Clear Laravel caches: `php artisan optimize:clear`
3. Verify file imports in your page CSS file (e.g., `home.css`)
4. Check browser console for errors
5. Verify Vite configuration includes your page CSS in the input array
6. Make sure the CSS file path in `@vite()` directive matches the Vite config

### RTL Not Working

1. Verify `dir` attribute on `<html>` element
2. Use logical properties (`ms-*`, `me-*`, etc.)
3. Check font configuration for RTL fonts
4. Test with RTL locale (e.g., `fa`)

### Dark Mode Issues

1. Check localStorage for `theme` key
2. Verify dark mode script in layout
3. Ensure all components have `dark:` variants
4. Test with system preference changes

## Resources

- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Tailwind CSS v4 Beta](https://tailwindcss.com/blog/tailwindcss-v4-beta)
- [CSS Logical Properties](https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Logical_Properties)
- [WCAG Contrast Guidelines](https://www.w3.org/WAI/WCAG21/Understanding/contrast-minimum.html)
