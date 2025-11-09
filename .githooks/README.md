# Git Hooks

This directory contains versioned Git hooks that enforce code quality standards across the team.

> 💡 **How Git Hooks Work**: Git hooks are shell scripts executed by Git Bash (or sh/bash). On Windows, Git for Windows includes Git Bash, so hooks run identically on all platforms.

## Setup

Configure Git to use these hooks (one-time setup):

```bash
git config core.hooksPath .githooks
```

On Linux/Mac/WSL/Git Bash, also make the hooks executable:

```bash
chmod +x .githooks/pre-commit
```

## Available Hooks

### pre-commit

Runs before each commit to ensure code quality:

1. **Auto-trim whitespace** - Removes trailing spaces from staged files
2. **Laravel Pint** - Checks and auto-fixes code style issues
3. **PHPStan** - Performs static analysis for type safety
4. **Security check** - Prevents committing `.env` files

## How It Works

When you run `git commit`, the pre-commit hook will:

- ✅ Pass: Commit proceeds normally
- ⚠️ Auto-fix: Pint fixes code style, you need to stage and commit again
- ❌ Fail: PHPStan found issues, fix them before committing

## Bypassing Hooks

In emergencies only:

```bash
git commit --no-verify -m "emergency fix"
```

⚠️ **Warning**: CI will still enforce all checks.

## Troubleshooting

**Hook not running?**

Check your Git configuration:

```bash
git config core.hooksPath
# Should output: .githooks
```

**Permission denied?**

Make the hook executable:

```bash
chmod +x .githooks/pre-commit
```

## Best Practices

1. ✅ **DO** run hooks on every commit
2. ✅ **DO** fix issues reported by hooks
3. ✅ **DO** keep hooks fast (< 10 seconds)
4. ❌ **DON'T** bypass hooks unless absolutely necessary
5. ❌ **DON'T** commit broken code

## More Information

See [docs/DEV_SETUP.md](../docs/DEV_SETUP.md) for detailed setup instructions.
