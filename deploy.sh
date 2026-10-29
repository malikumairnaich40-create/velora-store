#!/bin/bash
# ==============================================================================
# VELORA Store - Hostinger 1-Click Deployment Script
# Domain: velora.rapidservice.org
# ==============================================================================
# Usage on Hostinger SSH:
#   cd domains/velora.rapidservice.org/public_html
#   bash deploy.sh
# ==============================================================================

set -e

echo "🚀 [1/9] Removing Hostinger default placeholder pages..."
rm -f default.php index.html 2>/dev/null || true

echo "📋 [2/9] Checking environment configuration (.env)..."
if [ ! -f .env ]; then
    if [ -f .env.hostinger ]; then
        cp .env.hostinger .env
        echo "   -> Created .env from .env.hostinger"
    else
        cp .env.example .env
        echo "   -> Created .env from .env.example"
    fi
else
    echo "   -> .env already exists, keeping existing settings."
fi

echo "📦 [3/9] Installing Composer production dependencies (creating vendor)..."
composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction

echo "🔑 [4/9] Generating Application Encryption Key..."
php artisan key:generate --force

echo "🔗 [5/9] Linking storage directory..."
php artisan storage:link 2>/dev/null || true

echo "🗄️  [6/9] Running database migrations..."
php artisan migrate --force || echo "   ⚠️ Note: Database migration skipped or failed. Verify DB credentials in .env if needed."

echo "🧹 [7/9] Clearing old cached files..."
php artisan optimize:clear

echo "⚡ [8/9] Compiling and caching Laravel config, routes, and views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "🔒 [9/9] Setting secure directory permissions..."
chmod -R 775 storage bootstrap/cache

echo "=============================================================================="
echo "✅ VELORA Deployment Finished Successfully! Domain: velora.rapidservice.org"
echo "=============================================================================="
