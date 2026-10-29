# Hostinger Deployment Guide for VELORA Store

This guide walks you through deploying the **VELORA Premium Store** (Laravel 10 + Tailwind CSS) onto **Hostinger Shared / Cloud / VPS Hosting**.

---

## 📋 Table of Contents
1. [Pre-Deployment Checklist](#1-pre-deployment-checklist)
2. [Database Setup in Hostinger](#2-database-setup-in-hostinger)
3. [Deployment Method A: Via Git Deployment (Recommended)](#3-deployment-method-a-via-git-deployment-recommended)
4. [Deployment Method B: Via File Manager / ZIP Archive](#4-deployment-method-b-via-file-manager--zip-archive)
5. [Document Root Configuration (`public` Folder)](#5-document-root-configuration-public-folder)
6. [Configuring Environment (`.env`)](#6-configuring-environment-env)
7. [Creating the Storage Symlink](#7-creating-the-storage-symlink)
8. [Production Optimization & Cache](#8-production-optimization--cache)
9. [Cron Jobs & Scheduled Tasks](#9-cron-jobs--scheduled-tasks)
10. [Troubleshooting Common Issues](#10-troubleshooting-common-issues)

---

## 1. Pre-Deployment Checklist

Before deploying, ensure you have:
- A Hostinger account with an active domain and SSL enabled.
- PHP version set to **8.2** in Hostinger hPanel (*Websites > Manage > Advanced > PHP Configuration*).
- Required PHP extensions enabled: `pdo_mysql`, `mbstring`, `fileinfo`, `gd` / `imagick`, `curl`, `zip`, `xml`, `bcmath`, `intl`.

### Local Preparation:
1. Ensure your latest changes are pushed to GitHub:
   ```bash
   git push origin main
   ```
2. Build frontend production assets locally so `public/build` is ready:
   ```bash
   npm run build
   ```

---

## 2. Database Setup in Hostinger

1. Log in to **Hostinger hPanel**.
2. Navigate to **Databases > Management**.
3. Create a new MySQL database:
   - **Database Name**: e.g. `u123456789_velora`
   - **Username**: e.g. `u123456789_velora_user`
   - **Password**: *Create a strong password and save it securely.*
4. Open **phpMyAdmin** for this new database from hPanel.
5. Export your local database (`velstore`) from your local phpMyAdmin (`http://localhost/phpmyadmin`) as a `.sql` file.
6. In Hostinger phpMyAdmin, click **Import** and select the `.sql` file to import all tables and seed data.

---

## 3. Deployment Method A: Via Git Deployment (Recommended)

1. In Hostinger hPanel, search for **Git** under the Advanced menu.
2. In **Git Repository Setup**:
   - **Repository**: `https://github.com/malikumairnaich40-create/velora-store.git`
   - **Branch**: `main`
   - **Install directory**: Leave empty or set to `velora`
3. Click **Create**.
4. Once deployed, open Hostinger **SSH Access** (or **Web Terminal**):
   ```bash
   cd ~/domains/yourdomain.com/public_html   # or your deployment directory
   composer install --optimize-autoloader --no-dev
   php artisan key:generate
   php artisan migrate --force
   php artisan storage:link
   php artisan optimize
   ```

---

## 4. Deployment Method B: Via File Manager / ZIP Archive

If you prefer deploying via ZIP:
1. In your local project directory, create a ZIP file of the project **excluding** `node_modules` and `.git`:
   - Keep: `app`, `bootstrap`, `config`, `database`, `public` (including `public/build`), `resources`, `routes`, `storage`, `vendor`, `artisan`, `composer.json`, `package.json`.
2. Open Hostinger **File Manager**.
3. It is recommended to upload the project files into a directory outside `public_html` (e.g. `/home/u123456789/velora-store`).
4. Move the contents of `public/*` into `public_html/`.

---

## 5. Document Root Configuration (`public` Folder)

Laravel serves applications from the `/public` subfolder for security.

### Option 1: Change Document Root in hPanel (Cloud / VPS / Advanced Plans)
1. Go to **Websites > Domains > Subdomains / Document Root**.
2. Change the Document Root of your domain from `public_html` to `public_html/public`.

### Option 2: Using Root `.htaccess` (Standard Shared Hosting)
If Hostinger does not allow modifying the document root directly, place this `.htaccess` file inside the root of `public_html/`:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

Alternatively, move the contents of `public/` directly into `public_html/`, and edit `public_html/index.php` to point to the correct path:
```php
require __DIR__.'/../velora-store/vendor/autoload.php';
$app = require_once __DIR__.'/../velora-store/bootstrap/app.php';
```

---

## 6. Configuring Environment (`.env`)

1. In File Manager, create or edit the `.env` file in the Laravel root directory.
2. Update the following values for production:
   ```env
   APP_NAME="VELORA"
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=u123456789_velora
   DB_USERNAME=u123456789_velora_user
   DB_PASSWORD=YourStrongDatabasePasswordHere

   SESSION_SECURE_COOKIE=true
   ```

---

## 7. Creating the Storage Symlink

Uploaded images and banners are stored in `storage/app/public` and accessed via `public/storage`.

### Via SSH Terminal:
```bash
php artisan storage:link
```

### Via PHP Script (If SSH is not available):
Create a file named `link.php` inside `public_html/` with the following code:
```php
<?php
$target = __DIR__ . '/../storage/app/public';
$shortcut = __DIR__ . '/storage';
symlink($target, $shortcut);
echo "Symlink created successfully!";
```
Visit `https://yourdomain.com/link.php` in your browser once, then delete `link.php` immediately.

---

## 8. Production Optimization & Cache

Run these commands in Hostinger SSH Terminal or Web Terminal for maximum speed:

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache blade views
php artisan view:cache

# Clear previous temporary files if needed
php artisan optimize
```

---

## 9. Cron Jobs & Scheduled Tasks

In Hostinger hPanel, go to **Advanced > Cron Jobs**:
- Select **Custom**.
- Set interval to **Every Minute** (`* * * * *`).
- Command:
  ```bash
  /usr/bin/php /home/u123456789/domains/yourdomain.com/public_html/artisan schedule:run >> /dev/null 2>&1
  ```

---

## 10. Troubleshooting Common Issues

### Issue 1: "500 Internal Server Error"
- Check storage permissions. Ensure `storage/` and `bootstrap/cache/` directories are writable (`chmod -R 775 storage bootstrap/cache`).
- Verify `APP_KEY` is present in `.env`.
- Check logs in `storage/logs/laravel.log`.

### Issue 2: "Vite Manifest Not Found"
- Ensure you ran `npm run build` and that `public/build/manifest.json` was uploaded to your server.

### Issue 3: Mixed Content / SSL Warning
- Ensure `APP_URL=https://yourdomain.com` in `.env`.
- Force HTTPS via Hostinger hPanel SSL settings or by adding this to `app/Providers/AppServiceProvider.php`:
  ```php
  if (app()->environment('production')) {
      \Illuminate\Support\Facades\URL::forceScheme('https');
  }
  ```
