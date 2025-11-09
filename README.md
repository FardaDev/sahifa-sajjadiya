# Laravel Filament Starter Template

[![CI Checks](https://github.com/YOUR_USERNAME/laravel-filament-starter-template/workflows/CI%20Checks/badge.svg)](https://github.com/YOUR_USERNAME/laravel-filament-starter-template/actions)
[![codecov](https://codecov.io/gh/YOUR_USERNAME/laravel-filament-starter-template/branch/main/graph/badge.svg)](https://codecov.io/gh/YOUR_USERNAME/laravel-filament-starter-template)
[![PHP Version](https://img.shields.io/badge/PHP-8.3-blue.svg)](https://www.php.net/)
[![Laravel Version](https://img.shields.io/badge/Laravel-12-red.svg)](https://laravel.com/)
[![Filament Version](https://img.shields.io/badge/Filament-4-orange.svg)](https://filamentphp.com/)

A production-ready Laravel 12 + Filament 4 starter template with pre-configured CI/CD workflows, code quality tools, automated backups, and comprehensive documentation. Built to eliminate repetitive setup tasks and prevent common configuration errors.

## Features

- ✨ **Laravel 12** - Latest Laravel framework with modern PHP 8.3
- 🎨 **Filament 4** - Beautiful admin panel pre-configured and ready to use
- 🎨 **Tailwind CSS v4** - Latest Tailwind with new features and improved performance
- ⚡ **Alpine.js** - Lightweight JavaScript framework for interactive components
- 🌍 **Multi-Language Support** - English and Farsi (RTL) included, easy to add more
- 🌙 **Dark Mode** - Built-in dark mode with smooth transitions and localStorage persistence
- 🔄 **RTL Support** - Full RTL support with logical properties for Arabic, Farsi, and Hebrew
- 🧩 **Component Library** - Pre-built, accessible UI components (buttons, cards, inputs, etc.)
- 🚀 **GitHub Actions CI/CD** - Automated testing, security audits, and deployment
- 🔍 **Code Quality Tools** - Laravel Pint, PHPStan (Larastan), and Pest testing
- 💾 **Automated Backups** - Spatie Laravel Backup with daily scheduled backups
- 🔒 **Security First** - Daily security audits, Dependabot updates, and security.txt
- 🛠️ **Development Tools** - Laravel Debugbar and Log Viewer (local only by default)
- 📝 **Pre-commit Hooks** - Automatic code style and quality checks before commits
- 📚 **Comprehensive Documentation** - Detailed setup guides and contribution guidelines
- ⚡ **Developer Experience** - Makefile shortcuts, enhanced Composer scripts, EditorConfig

## Quick Start

### Prerequisites

- PHP 8.3 or higher
- Composer 2.x
- Node.js 18+ and npm
- MySQL 8.0+ or PostgreSQL 13+
- Git

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/YOUR_USERNAME/laravel-filament-starter-template.git
   cd laravel-filament-starter-template
   ```

2. **Run setup**
   ```bash
   make setup
   # or
   cd src && composer setup
   ```

3. **Configure environment**
   ```bash
   cd src
   cp .env.example .env
   # Edit .env with your database credentials and other settings
   ```

4. **Run migrations**
   ```bash
   cd src
   php artisan migrate
   ```

5. **Create admin user**
   ```bash
   cd src
   php artisan make:filament-user
   ```

6. **Start development server**
   ```bash
   make dev
   # or
   cd src && composer dev
   ```

7. **Access the application**
   - Frontend: http://localhost:8000
   - Admin Panel: http://localhost:8000/admin

## Development

### Development Tools

The template includes powerful debugging tools (enabled in local environment by default):

- **Laravel Debugbar** - Shows queries, timeline, memory usage, and more at the bottom of your pages
  - Access: Automatically appears on all pages in local environment
  - View SQL queries, request data, views rendered, and performance metrics

- **Log Viewer** - Web-based log viewer with search and filtering
  - Access: http://localhost:8000/log-viewer
  - View and search application logs without SSH
  - Filter by level, search by content, and download logs

**Security Note:** By default, Log Viewer is only accessible in the `local` environment. To enable in staging or production, update `app/Providers/DevelopmentToolsServiceProvider.php` with proper authentication checks.

### Available Commands

The project includes a Makefile for common development tasks:

```bash
make help          # Show all available commands
make setup         # Initial project setup
make install       # Install dependencies
make test          # Run tests
make lint          # Check code style
make analyze       # Run static analysis
make fix           # Fix code style issues
make quality       # Run all quality checks (lint + analyze + test)
make clean         # Clear Laravel caches
make dev           # Start development server with queue and Vite
```

### Composer Scripts

```bash
composer test              # Run Pest tests
composer test:coverage     # Run tests with coverage report
composer test:arch         # Run architecture tests only
composer pint              # Fix code style
composer pint:test         # Check code style
composer phpstan           # Run static analysis
composer quality           # Run all quality checks
composer fix               # Fix code style (alias)
composer clear-all         # Clear all Laravel caches
```

### Pre-commit Hooks

The project includes pre-commit hooks that automatically run code quality checks before each commit.

> 💡 **Note**: Git hooks run in Git Bash on all platforms. Git for Windows includes Git Bash automatically.

**Quick Setup**:

Linux/Mac/WSL/Git Bash:
```bash
bash .githooks/setup.sh
```

Windows PowerShell:
```powershell
.\.githooks\setup.ps1
```

Or manually:
```bash
git config core.hooksPath .githooks
chmod +x .githooks/pre-commit  # Unix-like systems only
```

The hook will automatically:
- Run Laravel Pint to check code style
- Run PHPStan for static analysis
- Trim trailing whitespace
- Prevent committing `.env` files

### Testing

```bash
# Run all tests
make test

# Run with coverage
composer test:coverage

# Run architecture tests
composer test:arch

# Run specific test file
cd src && vendor/bin/pest tests/Feature/UserTest.php
```

### Code Quality

```bash
# Check code style
make lint

# Fix code style
make fix

# Run static analysis
make analyze

# Run all quality checks
make quality
```

## Deployment

The project includes automated deployment workflows for three environments:

- **Production** (main branch) - Deploys automatically on push
- **Staging** (staging branch) - Deploys automatically on push
- **Development** (dev branch) - Manual deployment via workflow_dispatch

### Environment Variables

Required secrets in GitHub repository settings:

**Production**:
- `HOST` - Production server hostname
- `USERNAME` - SSH username
- `PASSWORD` - SSH password
- `PORT` - SSH port

**Staging**:
- `STAGING_HOST`
- `STAGING_USER`
- `STAGING_PASSWORD`
- `STAGING_PORT`

**Development**:
- `DEV_HOST`
- `DEV_USER`
- `DEV_PASSWORD`
- `DEV_PORT`

### Deployment Process

1. Push to respective branch (main/staging) or trigger manually for dev
2. CI workflow runs automatically (tests, linting, static analysis)
3. If CI passes, deployment workflow triggers
4. Application is deployed via SSH to the target server
5. Deployment script handles migrations, cache clearing, and service restarts

## Backups

The template includes Spatie Laravel Backup pre-configured for automated daily backups.

### Configuration

Edit `src/config/backup.php` to customize:
- Backup destinations (local, S3, etc.)
- Files and directories to include/exclude
- Database connections to backup
- Notification settings

### Environment Variables

```env
BACKUP_NOTIFICATION_EMAIL=admin@example.com
AWS_ACCESS_KEY_ID=your-key
AWS_SECRET_ACCESS_KEY=your-secret
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-backup-bucket
```

### Backup Schedule

- **01:00 UTC** - Clean old backups
- **02:00 UTC** - Run backup
- **03:00 UTC** - Monitor backup health

### Manual Backup

```bash
cd src
php artisan backup:run
php artisan backup:list
php artisan backup:monitor
```

## CI/CD Workflows

### CI Checks
Runs on every push and pull request:
- Laravel Pint (code style)
- PHPStan/Larastan (static analysis)
- Pest (tests)

### Security Audit
Runs daily at 2 AM UTC and on every push to main:
- Composer audit for vulnerabilities
- Fails if vulnerabilities found

### Code Coverage
Runs on push to main:
- Generates coverage reports
- Uploads to Codecov

### Dependabot
Automated dependency updates:
- Composer packages (weekly)
- npm packages (weekly)
- GitHub Actions (weekly)

## Project Structure

```
laravel-filament-starter-template/
├── .github/              # GitHub workflows and configuration
├── .githooks/            # Git hooks for pre-commit checks
├── docs/                 # Documentation
├── src/                  # Laravel application
│   ├── app/              # Application code
│   ├── config/           # Configuration files
│   │   └── locales.php   # Multi-language configuration
│   ├── database/         # Migrations, seeders, factories
│   ├── public/           # Public assets
│   ├── resources/        # Views, CSS, JS, Fonts, Images, Languages
│   │   ├── css/          # Organized CSS architecture
│   │   │   ├── base/     # Foundation styles (variables, animations, typography)
│   │   │   ├── fonts/    # Font configurations (Vazirmatn, Instrument Sans)
│   │   │   ├── filament/ # Filament admin panel styles
│   │   │   ├── laravel/  # Laravel application styles
│   │   │   │   ├── components/ # Component-specific styles
│   │   │   │   └── pages/      # Page-specific styles
│   │   │   ├── app.css   # Main application CSS entry
│   │   │   └── README.md # CSS architecture documentation
│   │   ├── fonts/        # Font files
│   │   │   └── vazirmatn/ # Vazirmatn font (RTL)
│   │   ├── images/       # Image assets
│   │   │   ├── flags/    # Country/language flag icons
│   │   │   │   ├── en.svg
│   │   │   │   └── ir.svg
│   │   │   ├── FardaDev-Logo.svg
│   │   │   ├── FardaDev-typography-en.svg
│   │   │   ├── FardaDev-typography-fa.svg
│   │   │   └── avatar-placeholder.webp
│   │   ├── js/           # JavaScript organization
│   │   │   ├── laravel/  # Laravel-specific JS
│   │   │   │   ├── components/ # Alpine.js components (darkMode, languageSwitcher)
│   │   │   │   └── pages/      # Page-specific JavaScript
│   │   │   └── home.js    # Main JavaScript entry
│   │   ├── lang/         # Multi-language translations
│   │   │   ├── en/       # English translations
│   │   │   │   ├── general.php
│   │   │   │   ├── auth.php
│   │   │   │   └── validation.php
│   │   │   └── fa/       # Farsi translations (RTL example)
│   │   │       ├── general.php
│   │   │       ├── auth.php
│   │   │       └── validation.php
│   │   └── views/        # Blade templates
│   │       ├── components/
│   │       │   ├── layouts/  # Layout components (master.blade.php)
│   │       │   ├── ui/       # UI components (button, card, input)
│   │       │   ├── svg/      # SVG icon components
│   │       │   ├── header.blade.php
│   │       │   ├── footer.blade.php
│   │       │   ├── language-switcher.blade.php
│   │       │   ├── language-switcher-mobile.blade.php
│   │       │   ├── toggle-dark-mode.blade.php
│   │       │   ├── toggle-dark-mode-mobile.blade.php
│   │       │   └── scroll-to-top.blade.php
│   │       ├── pages/        # Page views
│   │       │   └── welcome.blade.php
│   │       ├── livewire/     # Livewire component views
│   │       └── filament/     # Filament customizations
│   │           ├── pages/
│   │           └── widgets/
│   ├── routes/           # Route definitions
│   ├── tests/            # Tests
│   ├── pint.json         # Pint configuration
│   ├── phpstan.neon      # PHPStan configuration
│   ├── vite.config.js    # Vite configuration
│   └── composer.json     # PHP dependencies
├── .editorconfig         # Editor configuration
├── Makefile              # Development commands
└── README.md             # This file
```

## Resources Structure

The template includes a well-organized resources structure with:

### CSS Architecture
- **Base Styles**: Design tokens, animations, typography, and foundation styles
- **Fonts**: Pre-configured Vazirmatn (RTL) font with variable weight support
- **Filament**: Customizable admin panel styles
- **Laravel**: Application-specific styles organized by components and pages
- **Documentation**: Comprehensive CSS README with best practices

See [src/resources/css/README.md](src/resources/css/README.md) for detailed CSS architecture documentation.

### Images
- **Logos**: Brand logos in SVG format (main logo, typography variants for EN/FA)
- **Flags**: Country/language flag icons for language switcher (EN, IR)
- **Placeholders**: Avatar placeholder and other reusable image assets
- **Format**: Optimized SVG and WebP formats for performance

All images are located in `src/resources/images/` and can be referenced using:
```blade
<img src="{{ asset('build/images/FardaDev-Logo.svg') }}" alt="Logo">
```

### View Components
- **Layouts**: Master layout with SEO, RTL/LTR support, and dark mode
- **UI Components**: Reusable button, card, and input components
- **SVG Icons**: Customizable icon components (menu, close, sun, moon, chevron, globe)
- **Header/Footer**: Responsive navigation with language switcher and dark mode toggle
- **Utilities**: Scroll-to-top button and other helper components

### Multi-Language Support
- **English** and **Farsi** (RTL) translations included
- Automatic font switching based on locale direction
- Language switcher component (desktop and mobile) with flag icons
- Configured via `config/locales.php`

### JavaScript Organization
- **Alpine.js** components for dark mode and language switching
- Organized structure for components and page-specific JavaScript
- Integrated with Vite for hot module replacement
- Performance optimizations (lazy loading, scroll animations, idle callbacks)

## Contributing

We welcome contributions! Please see [CONTRIBUTING.md](docs/CONTRIBUTING.md) for details on:
- Code of conduct
- Development process
- Coding standards
- Pull request process

## Documentation

- [Developer Setup Guide](docs/DEV_SETUP.md) - Detailed setup instructions
- [Contributing Guidelines](docs/CONTRIBUTING.md) - How to contribute
- [Changelog](CHANGELOG.md) - Version history

## Tech Stack

- **Backend**: Laravel 12, PHP 8.3
- **Admin Panel**: Filament 4
- **Frontend**: Tailwind CSS 4, Alpine.js, Livewire
- **Testing**: Pest, PHPUnit
- **Code Quality**: Laravel Pint, PHPStan/Larastan
- **Database**: MySQL 8.0+ / PostgreSQL 13+
- **Build Tools**: Vite
- **CI/CD**: GitHub Actions
- **Backups**: Spatie Laravel Backup

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Credits

Built with ❤️ using:
- [Laravel](https://laravel.com/)
- [Filament](https://filamentphp.com/)
- [Pest](https://pestphp.com/)
- [Spatie Laravel Backup](https://spatie.be/docs/laravel-backup)

---

**Need help?** Check out the [Developer Setup Guide](docs/DEV_SETUP.md) or open an issue.
