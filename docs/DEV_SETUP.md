# Developer Setup Guide

This comprehensive guide helps new team members set up the Laravel + Filament starter template and follow team standards.

---

## Table of Contents

1. [System Requirements](#1-system-requirements)
2. [Installation Steps](#2-installation-steps)
3. [Pre-commit Hooks](#3-pre-commit-hooks)
4. [IDE Configuration](#4-ide-configuration)
5. [Running the Application](#5-running-the-application)
6. [Troubleshooting](#6-troubleshooting)

---

## 1. System Requirements

Before starting, ensure your system meets these requirements:

### Required Software

- **PHP 8.3 or higher**
  - Extensions: mbstring, bcmath, intl, pdo_mysql, xml, curl, zip
  - Check version: `php -v`
  - Check extensions: `php -m`

- **Composer 2.x**
  - Check version: `composer --version`
  - Install from: https://getcomposer.org/

- **Node.js 18+ and npm**
  - Check versions: `node -v` and `npm -v`
  - Install from: https://nodejs.org/

- **Database**
  - MySQL 8.0+ or PostgreSQL 13+
  - Ensure database server is running

- **Git**
  - Check version: `git --version`

### Optional but Recommended

- **Make** (for Makefile commands)
  - Windows: Install via Chocolatey `choco install make` or use Git Bash
  - Linux/Mac: Usually pre-installed

---

## 2. Installation Steps

Follow these steps to set up the project:

### Step 1: Clone the Repository

```bash
git clone https://github.com/YOUR_USERNAME/laravel-filament-starter-template.git
cd laravel-filament-starter-template
```

### Step 2: Install Dependencies

**Option A: Using Makefile (Recommended)**
```bash
make setup
```

**Option B: Manual Installation**
```bash
cd src
composer install
npm install
```

### Step 3: Environment Configuration

```bash
cd src
cp .env.example .env
```

Edit `.env` file with your settings:

```env
APP_NAME="Laravel Filament Starter"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

# Backup Configuration (Optional)
BACKUP_NOTIFICATION_EMAIL=admin@example.com
```

### Step 4: Generate Application Key

```bash
cd src
php artisan key:generate
```

### Step 5: Run Database Migrations

```bash
cd src
php artisan migrate
```

### Step 6: Create Admin User

```bash
cd src
php artisan make:filament-user
```

Follow the prompts to create your admin account.

### Step 7: Build Frontend Assets

```bash
cd src
npm run build
```

### Step 8: Verify Installation

```bash
cd src
php artisan about
```

This command shows your application's configuration and environment.

---

## 3. Pre-commit Hooks

We use **versioned hooks** stored in `.githooks/` at the project root to enforce code quality checks before commits, including:

- **Laravel Pint** - Automatic code style fixing
- **PHPStan/Larastan** - Static analysis for type safety
- **Trailing whitespace trimming** - Automatic cleanup
- **Prevent committing `.env` files** - Security check

> 💡 **Note**: Git hooks are shell scripts that run in Git Bash on all platforms (Windows, Linux, Mac). Git for Windows includes Git Bash, so the hooks work identically everywhere.

### One-Time Setup

Configure Git to use the project's hooks directory.

**Option A: Using Setup Script (Recommended)**

Linux / Mac / WSL / Git Bash:
```bash
bash .githooks/setup.sh
```

Windows PowerShell:
```powershell
.\.githooks\setup.ps1
```

**Option B: Manual Setup**

Linux / Mac / WSL / Git Bash:
```bash
git config core.hooksPath .githooks
chmod +x .githooks/pre-commit
```

Windows PowerShell:
```powershell
git config core.hooksPath .githooks
```

Windows CMD:
```cmd
git config core.hooksPath .githooks
```

> ✅ **Important**: This is a one-time setup per developer. Once configured, all team members will have the same pre-commit checks automatically.

### What Happens on Commit?

When you run `git commit`, the hook will:

1. **Auto-trim whitespace** - Removes trailing spaces from staged files
2. **Run Pint** - Checks code style, auto-fixes if needed
3. **Run PHPStan** - Performs static analysis
4. **Check for .env files** - Prevents accidental commits

If Pint auto-fixes your code, you'll need to stage the changes and commit again:

```bash
git add .
git commit -m "your message"
```

### Testing the Hook

Verify the hook is working:

```bash
# Create a test file with style issues
echo "<?php echo 'test'  ;  " > src/app/TestFile.php
git add src/app/TestFile.php
git commit -m "test commit"
```

You should see:
- ✂️ Trimming trailing whitespace
- 🔍 Running Laravel Pint
- ✅ Code style OK (or auto-fixed)
- 🔍 Running PHPStan
- ✅ All checks passed

### Bypassing the Hook (Emergency Only)

In rare emergencies, you can skip the hook:

```bash
git commit --no-verify -m "emergency fix"
```

⚠️ **Warning**: Only use `--no-verify` for critical hotfixes. Your CI pipeline will still enforce all checks, so any issues will be caught there.

### Troubleshooting Hooks

**Hook not running?**
```bash
# Check configuration
git config core.hooksPath
# Should output: .githooks

# Verify hook exists
ls -la .githooks/pre-commit
```

**Permission denied (Linux/Mac/Git Bash)?**
```bash
chmod +x .githooks/pre-commit
```

**Hook fails with "vendor not found"?**
```bash
cd src
composer install
```

**Hook fails on Windows?**

Make sure you have Git for Windows installed (includes Git Bash). The hooks are shell scripts that require Git Bash to run, which is included with Git for Windows.

Download from: https://git-scm.com/download/win

---

## 4. IDE Configuration

### PhpStorm

**Recommended Plugins:**
- Laravel Idea
- Pest
- Tailwind CSS
- EditorConfig

**Configuration:**

1. **PHP Interpreter**
   - Settings → PHP → CLI Interpreter
   - Set to PHP 8.3

2. **Composer**
   - Settings → PHP → Composer
   - Set path to `src/composer.json`

3. **Code Style**
   - Settings → PHP → Quality Tools → PHP CS Fixer
   - Enable and set to use Pint: `src/vendor/bin/pint`

4. **PHPStan**
   - Settings → PHP → Quality Tools → PHPStan
   - Configuration file: `src/phpstan.neon`

5. **Test Framework**
   - Settings → PHP → Test Frameworks
   - Add Pest configuration
   - Default configuration file: `src/tests/Pest.php`

### VS Code

**Recommended Extensions:**
- PHP Intelephense
- Laravel Extension Pack
- Pest Snippets
- Tailwind CSS IntelliSense
- EditorConfig for VS Code

**Configuration (`.vscode/settings.json`):**

```json
{
  "php.validate.executablePath": "/path/to/php8.3",
  "intelephense.environment.phpVersion": "8.3.0",
  "editor.formatOnSave": true,
  "files.associations": {
    "*.blade.php": "blade"
  },
  "[php]": {
    "editor.defaultFormatter": "open-southeners.laravel-pint"
  }
}
```

---

## 5. Running the Application

### Development Server

**Option A: Using Makefile**
```bash
make dev
```

This starts:
- Laravel development server (http://localhost:8000)
- Queue worker
- Vite dev server (hot reload)

**Option B: Using Composer**
```bash
cd src
composer dev
```

**Option C: Manual Start**

Terminal 1 - Laravel Server:
```bash
cd src
php artisan serve
```

Terminal 2 - Queue Worker:
```bash
cd src
php artisan queue:listen --tries=1
```

Terminal 3 - Vite Dev Server:
```bash
cd src
npm run dev
```

### Accessing the Application

- **Frontend**: http://localhost:8000
- **Admin Panel**: http://localhost:8000/admin
- **Login**: Use the admin credentials you created

### Running Tests

```bash
# All tests
make test

# With coverage
cd src && composer test:coverage

# Architecture tests only
cd src && composer test:arch

# Specific test file
cd src && vendor/bin/pest tests/Feature/UserTest.php

# Watch mode (re-run on file changes)
cd src && vendor/bin/pest --watch
```

### Code Quality Checks

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

### Clearing Caches

```bash
# Clear all caches
make clean

# Or manually
cd src
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 6. Troubleshooting

### Common Issues and Solutions

#### Issue: "Class not found" errors

**Solution:**
```bash
cd src
composer dump-autoload
```

#### Issue: Permission denied errors (Linux/Mac)

**Solution:**
```bash
cd src
chmod -R 775 storage bootstrap/cache
chown -R $USER:www-data storage bootstrap/cache
```

#### Issue: Database connection refused

**Solutions:**
1. Verify database server is running
2. Check `.env` database credentials
3. Test connection:
   ```bash
   cd src
   php artisan db:show
   ```

#### Issue: npm install fails

**Solutions:**
1. Clear npm cache:
   ```bash
   npm cache clean --force
   ```
2. Delete `node_modules` and `package-lock.json`:
   ```bash
   cd src
   rm -rf node_modules package-lock.json
   npm install
   ```

#### Issue: Vite not hot reloading

**Solutions:**
1. Check Vite is running: `npm run dev`
2. Clear browser cache
3. Restart Vite server

#### Issue: Pre-commit hook not running

**Solutions:**
1. Verify hook path:
   ```bash
   git config core.hooksPath
   ```
   Should output: `.githooks`

2. Make hook executable (Linux/Mac):
   ```bash
   chmod +x .githooks/pre-commit
   ```

3. Test hook manually:
   ```bash
   .githooks/pre-commit
   ```

#### Issue: PHPStan errors about Laravel facades

**Solution:**
This is normal. PHPStan with Larastan should handle Laravel-specific code. If issues persist:
```bash
cd src
php artisan ide-helper:generate
php artisan ide-helper:models
```

#### Issue: Pest tests fail with "Class not found"

**Solution:**
```bash
cd src
composer dump-autoload
php artisan config:clear
vendor/bin/pest
```

#### Issue: Port 8000 already in use

**Solution:**
```bash
# Use different port
cd src
php artisan serve --port=8001
```

#### Issue: Composer install is slow

**Solution:**
Enable parallel downloads:
```bash
composer global require hirak/prestissimo
```

Or use Composer 2.x which has parallel downloads built-in.

### Getting Help

If you encounter issues not covered here:

1. Check the [main README](../README.md)
2. Review [Laravel documentation](https://laravel.com/docs)
3. Check [Filament documentation](https://filamentphp.com/docs)
4. Open an issue on GitHub
5. Ask the team in your communication channel

---

## Additional Resources

- [Laravel Documentation](https://laravel.com/docs/12.x)
- [Filament Documentation](https://filamentphp.com/docs/4.x)
- [Pest Documentation](https://pestphp.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Contributing Guidelines](CONTRIBUTING.md)

---

**Happy coding! 🚀**
