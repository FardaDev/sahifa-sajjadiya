# Contributing to Laravel Filament Starter Template

Thank you for considering contributing to this project! This document outlines the process and guidelines for contributing.

---

## Table of Contents

1. [Code of Conduct](#code-of-conduct)
2. [How to Contribute](#how-to-contribute)
3. [Development Process](#development-process)
4. [Code Standards](#code-standards)
5. [Testing Requirements](#testing-requirements)
6. [Pull Request Process](#pull-request-process)

---

## Code of Conduct

### Our Pledge

We are committed to providing a welcoming and inspiring community for all. Please be respectful and constructive in your interactions.

### Expected Behavior

- Use welcoming and inclusive language
- Be respectful of differing viewpoints and experiences
- Gracefully accept constructive criticism
- Focus on what is best for the community
- Show empathy towards other community members

### Unacceptable Behavior

- Trolling, insulting/derogatory comments, and personal or political attacks
- Public or private harassment
- Publishing others' private information without explicit permission
- Other conduct which could reasonably be considered inappropriate

---

## How to Contribute

### Reporting Bugs

Before creating a bug report, please check existing issues to avoid duplicates.

**When reporting a bug, include:**

- Clear and descriptive title
- Steps to reproduce the issue
- Expected behavior
- Actual behavior
- Screenshots (if applicable)
- Environment details (PHP version, OS, browser, etc.)
- Error messages or logs

**Example:**

```markdown
**Bug**: User cannot login to admin panel

**Steps to Reproduce:**
1. Navigate to /admin
2. Enter valid credentials
3. Click "Login"

**Expected**: User should be logged in and redirected to dashboard
**Actual**: Page refreshes with no error message

**Environment:**
- PHP 8.3.0
- Laravel 12.0
- Filament 4.0
- Browser: Chrome 120
```

### Suggesting Features

We welcome feature suggestions! Please provide:

- Clear and descriptive title
- Detailed description of the proposed feature
- Use cases and benefits
- Possible implementation approach (optional)
- Examples from other projects (if applicable)

---

## Development Process

### Branching Strategy

We use a three-branch workflow:

- **`main`** - Production-ready code
- **`staging`** - Pre-production testing
- **`dev`** - Active development

### Creating a Feature Branch

```bash
# Update your local repository
git checkout dev
git pull origin dev

# Create a feature branch
git checkout -b feature/your-feature-name

# Or for bug fixes
git checkout -b fix/bug-description
```

### Branch Naming Conventions

- **Features**: `feature/short-description`
- **Bug Fixes**: `fix/bug-description`
- **Hotfixes**: `hotfix/critical-issue`
- **Documentation**: `docs/what-changed`
- **Refactoring**: `refactor/what-changed`

### Pre-commit Hooks

This project uses automated pre-commit hooks to maintain code quality. The hooks will run automatically before each commit.

> 💡 **Technical Note**: Git hooks are shell scripts executed by Git Bash (included with Git for Windows), so they work identically on all platforms.

**First-time setup:**

```bash
# Quick setup (recommended)
bash .githooks/setup.sh  # Linux/Mac/WSL/Git Bash
# or
.\.githooks\setup.ps1    # Windows PowerShell

# Or use Makefile
make setup
```

**What the hooks do:**

- ✂️ Auto-trim trailing whitespace
- 🎨 Run Laravel Pint (code style)
- 🔍 Run PHPStan (static analysis)
- 🔒 Prevent committing `.env` files

If Pint auto-fixes your code, simply stage the changes and commit again:

```bash
git add .
git commit -m "your message"
```

> 💡 **Tip**: The hooks ensure your code meets quality standards before it reaches CI, saving you time.

### Commit Message Format

We follow [Conventional Commits](https://www.conventionalcommits.org/) format:

```
<type>: <description>

[optional body]

[optional footer]
```

**Types:**

- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation changes
- `style`: Code style changes (formatting, missing semicolons, etc.)
- `refactor`: Code refactoring
- `test`: Adding or updating tests
- `chore`: Maintenance tasks (dependencies, build, etc.)
- `perf`: Performance improvements
- `ci`: CI/CD changes

**Examples:**

```bash
feat: add user profile page

fix: resolve login redirect issue

docs: update installation instructions

chore: update dependencies
```

**Good Commit Messages:**

```bash
feat: add export functionality to user table
fix: prevent duplicate email registration
docs: add API documentation for user endpoints
test: add unit tests for UserService
refactor: simplify authentication logic
```

**Bad Commit Messages:**

```bash
update stuff
fix bug
changes
wip
asdf
```

---

## Code Standards

### Code Style

We use **Laravel Pint** for code style enforcement.

**Before committing:**

```bash
# Check code style
make lint
# or
cd src && vendor/bin/pint --test

# Fix code style issues
make fix
# or
cd src && vendor/bin/pint
```

### Static Analysis

We use **PHPStan/Larastan** for static analysis at level 6.

**Before committing:**

```bash
# Run static analysis
make analyze
# or
cd src && vendor/bin/phpstan analyse
```

### Code Quality Checklist

Before submitting a pull request:

- [ ] Code follows Laravel conventions
- [ ] Code passes Pint style checks
- [ ] Code passes PHPStan analysis
- [ ] All tests pass
- [ ] New features have tests
- [ ] Documentation is updated
- [ ] Commit messages follow conventions
- [ ] No debugging code (dd, dump, var_dump, console.log)
- [ ] No commented-out code
- [ ] Environment variables are documented in `.env.example`

### Architecture Guidelines

**Models:**
- Extend `Illuminate\Database\Eloquent\Model`
- Use proper relationships
- Define fillable/guarded properties
- Add appropriate casts

**Controllers:**
- Keep thin (business logic in services)
- Use proper HTTP status codes
- Return consistent response formats
- Validate input using Form Requests

**Filament Resources:**
- Follow Filament naming conventions
- Use proper form components
- Implement proper table columns
- Add appropriate filters and actions

**Services:**
- Single responsibility principle
- Dependency injection
- Return types defined
- Proper error handling

---

## Testing Requirements

### Test Coverage

- **Minimum**: 70% overall coverage
- **Target**: 80% overall coverage
- **Critical paths**: 90%+ coverage

### Writing Tests

We use **Pest** for testing.

**Test Structure:**

```php
<?php

use App\Models\User;
use function Pest\Laravel\{get, post, actingAs};

test('user can view dashboard', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get('/dashboard')
        ->assertOk()
        ->assertSee('Dashboard');
});

test('guest cannot view dashboard', function () {
    get('/dashboard')
        ->assertRedirect('/login');
});
```

### Test Types

**Unit Tests** (`tests/Unit/`):
- Test individual classes/methods
- Mock dependencies
- Fast execution
- No database interactions (use fakes)

**Feature Tests** (`tests/Feature/`):
- Test HTTP endpoints
- Test integrations
- Use RefreshDatabase trait
- Test user workflows

**Architecture Tests** (`tests/Pest.php`):
- Enforce structural conventions
- Prevent architectural violations
- Run automatically with test suite

### Running Tests

```bash
# All tests
make test

# With coverage
cd src && composer test:coverage

# Architecture tests only
cd src && composer test:arch

# Specific test
cd src && vendor/bin/pest tests/Feature/UserTest.php

# Watch mode
cd src && vendor/bin/pest --watch
```

### Test Requirements for PRs

- All existing tests must pass
- New features must have tests
- Bug fixes should include regression tests
- Maintain or improve code coverage

---

## Pull Request Process

### Before Submitting

1. **Update your branch**
   ```bash
   git checkout dev
   git pull origin dev
   git checkout your-feature-branch
   git rebase dev
   ```

2. **Run quality checks**
   ```bash
   make quality
   ```

3. **Ensure tests pass**
   ```bash
   make test
   ```

4. **Update documentation**
   - Update README if needed
   - Add/update code comments
   - Update CHANGELOG.md

### Creating a Pull Request

1. **Push your branch**
   ```bash
   git push origin your-feature-branch
   ```

2. **Open PR on GitHub**
   - Base branch: `dev` (not `main`)
   - Clear title following commit conventions
   - Detailed description

3. **PR Description Template**

   ```markdown
   ## Description
   Brief description of changes

   ## Type of Change
   - [ ] Bug fix
   - [ ] New feature
   - [ ] Breaking change
   - [ ] Documentation update

   ## Changes Made
   - Change 1
   - Change 2
   - Change 3

   ## Testing
   - [ ] Unit tests added/updated
   - [ ] Feature tests added/updated
   - [ ] Manual testing performed

   ## Checklist
   - [ ] Code follows style guidelines
   - [ ] Self-review performed
   - [ ] Comments added for complex code
   - [ ] Documentation updated
   - [ ] No new warnings generated
   - [ ] Tests added and passing
   - [ ] Dependent changes merged

   ## Screenshots (if applicable)
   Add screenshots here

   ## Related Issues
   Closes #123
   ```

### Review Process

1. **Automated Checks**
   - CI workflow must pass
   - Code style checks
   - Static analysis
   - Tests

2. **Code Review**
   - At least one approval required
   - Address all review comments
   - Keep discussions professional

3. **Addressing Feedback**
   ```bash
   # Make changes based on feedback
   git add .
   git commit -m "refactor: address review feedback"
   git push origin your-feature-branch
   ```

4. **Merging**
   - Squash and merge (preferred)
   - Rebase and merge (for clean history)
   - Never force push to `dev` or `main`

### After Merge

1. **Delete your branch**
   ```bash
   git checkout dev
   git pull origin dev
   git branch -d your-feature-branch
   git push origin --delete your-feature-branch
   ```

2. **Update CHANGELOG.md** (if not done already)

---

## Development Workflow Example

```bash
# 1. Create feature branch
git checkout dev
git pull origin dev
git checkout -b feature/add-user-export

# 2. Make changes
# ... code changes ...

# 3. Run quality checks
make quality

# 4. Commit changes
git add .
git commit -m "feat: add user export functionality"

# 5. Push and create PR
git push origin feature/add-user-export
# Open PR on GitHub

# 6. Address review feedback
# ... make changes ...
git add .
git commit -m "refactor: improve export performance"
git push origin feature/add-user-export

# 7. After merge, cleanup
git checkout dev
git pull origin dev
git branch -d feature/add-user-export
```

---

## Questions?

If you have questions about contributing:

1. Check existing documentation
2. Search closed issues and PRs
3. Open a discussion on GitHub
4. Ask in team communication channels

---

## License

By contributing, you agree that your contributions will be licensed under the MIT License.

---

**Thank you for contributing! 🎉**
