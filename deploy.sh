#!/bin/bash
# ==============================================================================
# VELORA Store - Hostinger Git Deployment Script
# ==============================================================================
# Usage on Hostinger SSH:
#   cd domains/yourdomain.com/public_html  (or cd public_html)
#   bash deploy.sh
# ==============================================================================

set -e

echo "🚀 [1/6] Pulling latest changes from GitHub (main)..."
git pull origin main

echo "📦 [2/6] Installing/updating Composer dependencies (production)..."
composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction

echo "🗄️  [3/6] Running database migrations..."
php artisan migrate --force

echo "🔗 [4/6] Creating storage symlink..."
php artisan storage:link 2>/dev/null || true

echo "⚡ [5/6] Clearing & optimizing caches..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "🔒 [6/6] Setting correct directory permissions..."
chmod -R 775 storage bootstrap/cache

echo "=============================================================================="
echo "✅ VELORA Deployment completed successfully!"
echo "=============================================================================="
