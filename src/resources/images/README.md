# Images Directory

This directory contains all image assets for the Laravel Filament Starter Template.

## Directory Structure

```
src/resources/images/
├── flags/                      # Country/language flag icons
│   ├── en.svg                 # English flag
│   └── ir.svg                 # Iran flag (for Farsi)
├── FardaDev-Logo.svg          # Main brand logo
├── FardaDev-typography-en.svg # English typography logo
├── FardaDev-typography-fa.svg # Farsi typography logo
└── avatar-placeholder.webp    # Default avatar placeholder
```

## Usage

### In Blade Templates

Images are compiled by Vite and should be referenced using the `asset()` helper with the `build/images/` path:

```blade
{{-- Logo --}}
<img src="{{ asset('build/images/FardaDev-Logo.svg') }}" alt="{{ config('app.name') }}">

{{-- Flag icons --}}
<img src="{{ asset('build/images/flags/en.svg') }}" alt="English">
<img src="{{ asset('build/images/flags/ir.svg') }}" alt="فارسی">

{{-- Avatar placeholder --}}
<img src="{{ asset('build/images/avatar-placeholder.webp') }}" alt="Avatar">
```

### In CSS

Reference images using relative paths from the CSS file:

```css
.hero {
    background-image: url('/resources/images/FardaDev-Logo.svg');
}
```

### In JavaScript

Import images in your JavaScript files:

```javascript
import logo from '@/images/FardaDev-Logo.svg';

// Use in your code
const img = document.createElement('img');
img.src = logo;
```

## Image Guidelines

### Format Selection

- **SVG**: Use for logos, icons, and graphics that need to scale
  - Advantages: Scalable, small file size, crisp at any resolution
  - Best for: Logos, icons, simple illustrations

- **WebP**: Use for photos and complex images
  - Advantages: Better compression than JPEG/PNG, supports transparency
  - Best for: Photos, screenshots, complex graphics

- **PNG**: Use only when WebP is not supported
  - Advantages: Lossless, supports transparency
  - Best for: Fallback for older browsers

### Optimization

All images should be optimized before adding to the repository:

**SVG Optimization:**
```bash
# Using SVGO
npx svgo input.svg -o output.svg

# Or online: https://jakearchibald.github.io/svgomg/
```

**WebP Conversion:**
```bash
# Using cwebp
cwebp -q 80 input.jpg -o output.webp

# Or online: https://squoosh.app/
```

### Naming Conventions

- Use kebab-case for file names: `my-image.svg`
- Be descriptive: `user-avatar-placeholder.webp` not `img1.webp`
- Include size in name if multiple sizes exist: `logo-small.svg`, `logo-large.svg`
- Use language suffix for localized images: `banner-en.svg`, `banner-fa.svg`

## Adding New Images

1. **Optimize the image** using tools mentioned above
2. **Place in appropriate directory**:
   - Flags → `flags/`
   - Logos → root of `images/`
   - Icons → consider using SVG components in `views/components/svg/` instead
   - Other → create subdirectories as needed (e.g., `banners/`, `products/`)
3. **Update this README** if adding a new category
4. **Test in both light and dark modes** if applicable

## Flag Icons

Flag icons are used in the language switcher component. To add a new language flag:

1. Download or create an SVG flag icon
2. Optimize the SVG
3. Save to `flags/` directory with the locale code (e.g., `de.svg` for German)
4. Update `config/locales.php` to reference the new flag:

```php
'de' => [
    'name' => 'German',
    'native' => 'Deutsch',
    'flag' => asset('build/images/flags/de.svg'),
    'dir' => 'ltr',
],
```

## Logo Variants

The template includes multiple logo variants:

- **FardaDev-Logo.svg**: Main logo (icon + text)
  - Use in: Header, footer, meta tags
  - Size: Scalable

- **FardaDev-typography-en.svg**: English text logo
  - Use in: English language pages, marketing materials
  - Size: Scalable

- **FardaDev-typography-fa.svg**: Farsi text logo
  - Use in: Farsi language pages, RTL layouts
  - Size: Scalable

### Logo Usage Example

```blade
{{-- Responsive logo with language switching --}}
@if(app()->getLocale() === 'fa')
    <img src="{{ asset('build/images/FardaDev-typography-fa.svg') }}"
         alt="{{ config('app.name') }}"
         class="h-8 w-auto">
@else
    <img src="{{ asset('build/images/FardaDev-typography-en.svg') }}"
         alt="{{ config('app.name') }}"
         class="h-8 w-auto">
@endif
```

## Avatar Placeholder

The `avatar-placeholder.webp` is used as a default avatar when users don't have a profile picture.

```blade
{{-- User avatar with fallback --}}
<img src="{{ $user->avatar ?? asset('build/images/avatar-placeholder.webp') }}"
     alt="{{ $user->name }}"
     class="w-10 h-10 rounded-full">
```

## Performance Tips

1. **Lazy Loading**: Add `loading="lazy"` to images below the fold
   ```blade
   <img src="{{ asset('build/images/banner.webp') }}"
        alt="Banner"
        loading="lazy">
   ```

2. **Responsive Images**: Use `srcset` for different screen sizes
   ```blade
   <img src="{{ asset('build/images/hero-small.webp') }}"
        srcset="{{ asset('build/images/hero-small.webp') }} 640w,
                {{ asset('build/images/hero-medium.webp') }} 1024w,
                {{ asset('build/images/hero-large.webp') }} 1920w"
        sizes="(max-width: 640px) 640px, (max-width: 1024px) 1024px, 1920px"
        alt="Hero">
   ```

3. **Preload Critical Images**: Add to layout head for above-the-fold images
   ```blade
   @push('head')
       <link rel="preload"
             as="image"
             href="{{ asset('build/images/FardaDev-Logo.svg') }}">
   @endpush
   ```

## Accessibility

Always include meaningful `alt` text for images:

```blade
{{-- Good --}}
<img src="{{ asset('build/images/FardaDev-Logo.svg') }}"
     alt="FardaDev - Laravel Development">

{{-- Bad --}}
<img src="{{ asset('build/images/FardaDev-Logo.svg') }}" alt="logo">

{{-- Decorative images (use empty alt) --}}
<img src="{{ asset('build/images/decoration.svg') }}" alt="">
```

## Dark Mode Considerations

Some images may need dark mode variants:

```blade
{{-- Image with dark mode variant --}}
<img src="{{ asset('build/images/diagram-light.svg') }}"
     alt="System Diagram"
     class="dark:hidden">
<img src="{{ asset('build/images/diagram-dark.svg') }}"
     alt="System Diagram"
     class="hidden dark:block">
```

## Resources

- [SVG Optimization Tool (SVGOMG)](https://jakearchibald.github.io/svgomg/)
- [Image Compression Tool (Squoosh)](https://squoosh.app/)
- [WebP Converter](https://developers.google.com/speed/webp)
- [Responsive Images Guide](https://developer.mozilla.org/en-US/docs/Learn/HTML/Multimedia_and_embedding/Responsive_images)
- [Image Accessibility](https://www.w3.org/WAI/tutorials/images/)
