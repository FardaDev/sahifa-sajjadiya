# Developer Setup Guide

This guide helps new team members set up the Laravel project and follow team standards.

---

## 1. Pre-commit Hook (Recommended)

We use a **versioned hook** to enforce code quality checks before commits, including:

* Laravel Pint (code style)
* PHPStan / Larastan (static analysis)
* Trailing whitespace trimming
* Prevent committing `.env` files

### Setup

1. Configure Git to use the repo’s shared hooks:

```bash
git config core.hooksPath .githooks
````

2. Make the hook executable (Linux / WSL / Git Bash):

```bash
chmod +x .githooks/pre-commit
```

> ✅ Once configured, all team members will have the same pre-commit checks.

---

## 2. Running Checks Manually

* **Pint:** `vendor/bin/pint`
* **Pint check only (CI style):** `vendor/bin/pint --test`
* **PHPStan (Larastan):** `vendor/bin/phpstan analyse --configuration=src/phpstan.neon`

---

## 3. Notes

* CI also enforces Pint and PHPStan on every push.
* Always run Pint and PHPStan locally before pushing.
* Do **not commit `.env` files`.
* Pre-commit hook is optional but highly recommended for consistency.