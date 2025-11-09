.PHONY: help setup install test lint analyze fix quality clean dev deploy-prod deploy-staging

help:  ## Show this help message
	@echo 'Usage: make [target]'
	@echo ''
	@echo 'Available targets:'
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[36m%-20s\033[0m %s\n", $$1, $$2}'

setup:  ## Initial project setup
	@echo "🔧 Setting up Git hooks..."
	@git config core.hooksPath .githooks
	@chmod +x .githooks/pre-commit 2>/dev/null || true
	@echo "✅ Git hooks configured"
	@echo ""
	cd src && composer install
	cd src && npm install
	cd src && cp -n .env.example .env || true
	cd src && php artisan key:generate
	cd src && php artisan migrate
	cd src && npm run build
	@echo ""
	@echo "✅ Setup complete! Run 'make dev' to start the development server."

install:  ## Install dependencies
	cd src && composer install
	cd src && npm install

test:  ## Run tests
	cd src && vendor/bin/pest

lint:  ## Check code style
	cd src && vendor/bin/pint --test

analyze:  ## Run static analysis
	cd src && vendor/bin/phpstan analyse

fix:  ## Fix code style issues
	cd src && vendor/bin/pint

quality:  ## Run all quality checks (lint + analyze + test)
	@echo "Running code style checks..."
	@$(MAKE) lint
	@echo ""
	@echo "Running static analysis..."
	@$(MAKE) analyze
	@echo ""
	@echo "Running tests..."
	@$(MAKE) test
	@echo ""
	@echo "All quality checks passed!"

clean:  ## Clean cache and temporary files
	cd src && php artisan cache:clear
	cd src && php artisan config:clear
	cd src && php artisan route:clear
	cd src && php artisan view:clear
	@echo "Caches cleared!"

dev:  ## Start development server (Laravel + Queue + Vite)
	cd src && composer dev

deploy-prod:  ## Deploy to production
	@echo "Deploying to production..."
	@echo "This should be done via GitHub Actions workflow."
	@echo "Push to 'main' branch to trigger automatic deployment."

deploy-staging:  ## Deploy to staging
	@echo "Deploying to staging..."
	@echo "This should be done via GitHub Actions workflow."
	@echo "Push to 'staging' branch to trigger automatic deployment."
