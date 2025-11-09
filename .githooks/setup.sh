#!/bin/bash
# Quick setup script for Git hooks
# Run this after cloning the repository

set -e

echo "[*] Setting up Git hooks..."

# Configure Git to use .githooks directory
git config core.hooksPath .githooks

# Make hooks executable (Unix-like systems)
if [ -f ".githooks/pre-commit" ]; then
    chmod +x .githooks/pre-commit
    echo "[OK] Made pre-commit hook executable"
fi

echo "[OK] Git hooks configured successfully!"
echo ""
echo "The following hooks are now active:"
echo "  - pre-commit: Code quality checks (Pint, PHPStan)"
echo ""
echo "To verify, try making a commit and the hooks will run automatically."
