# Quick setup script for Git hooks (Windows PowerShell)
# Run this after cloning the repository

Write-Host "[*] Setting up Git hooks..." -ForegroundColor Cyan

# Configure Git to use .githooks directory
git config core.hooksPath .githooks

if ($LASTEXITCODE -eq 0) {
    Write-Host "[OK] Git hooks configured successfully!" -ForegroundColor Green
    Write-Host ""
    Write-Host "The following hooks are now active:" -ForegroundColor Yellow
    Write-Host "  - pre-commit: Code quality checks (Pint, PHPStan)" -ForegroundColor White
    Write-Host ""
    Write-Host "To verify, try making a commit and the hooks will run automatically." -ForegroundColor White
} else {
    Write-Host "[ERROR] Failed to configure Git hooks" -ForegroundColor Red
    exit 1
}
