# VELORA - Premium Luxury Store

<p align="center">
  <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?auto=format&fit=crop&w=1200&q=80" alt="VELORA Premium Luxury Store Banner" width="100%" style="border-radius: 16px; max-height: 400px; object-fit: cover;">
</p>

**VELORA** is an open-source, multi-vendor, multilingual luxury eCommerce solution built with **Laravel 10**, **Tailwind CSS**, and **Blade**. Inspired by modern runway fashion houses and high-converting Daraz-style e-commerce interfaces, VELORA delivers a responsive shopping experience with dark/light mode, real-time AJAX interactions, and full catalog management.

---

## ✨ Features & Highlights

- **Haute Couture Aesthetic**: Designed with *Playfair Display* and *Poppins* typography, luxury golden accents, and glassmorphic navigation.
- **HD Fashion Hero Slider**: Dynamic banner slider featuring high-definition runway collections with direct call-to-actions.
- **Daraz-Style Layout**:
  - Top VIP announcement ribbon with live language and currency switchers.
  - Promotional cards, flash deal timer, and service guarantees (*100% Authentic, Express Dispatch, 30-Day Returns, VIP Concierge*).
  - Popular category round icons and official atelier spotlights (*VELORA Couture, Milano Tailors, Genève Horlogerie, Atelier Paris*).
- **Interactive E-Commerce Capabilities**:
  - **Wishlist**: Toggle products with active heart styling and live count badge.
  - **Quick View Modal**: Instant AJAX-powered product preview modal with attribute options, stock, ratings, and gallery.
  - **Ajax Add to Cart & Side Cart Drawer**: Slide-out offcanvas shopping bag displaying items, subtotal, quantity updates, and instant checkout link.
  - **Catalog Filtering**: Filter by category, brand atelier, and real-time dual-handle price range slider.
  - **Dark / Light Mode**: Instant mode toggle with `localStorage` state persistence.
  - **Floating WhatsApp Concierge**: Animated bottom-right WhatsApp button with pre-filled VIP inquiry message.
- **Multi-Vendor & Dedicated Portals**:
  - Customer Storefront
  - Dedicated Seller / Vendor Dashboard
  - Centralized Admin Management Panel
- **Multi-Currency & Multilingual**: Supports 19 global languages and dynamic currency exchange rate calculations.

---

## 🔐 Default Login Credentials

| Role | Portal URL | Email | Password |
| :--- | :--- | :--- | :--- |
| **Super Admin** | `/login` | `admin@example.com` | `abc123` |
| **Seller / Vendor** | `/vendor/login` | `seller@example.com` | `abc123` |
| **Customer** | `/customer/login` | `customer@example.com` (or self-register) | `abc123` |

---

## 🚀 Local Installation & Setup

### Requirements
- **PHP**: `^8.1` or `8.2` (with PDO, OpenSSL, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath, Fileinfo)
- **Composer**: `v2+`
- **Node.js & NPM**: `v18+`
- **MySQL**: `v5.7+` or `MariaDB 10.4+`

### Step-by-Step Setup

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/malikumairnaich40-create/velora-store.git
   cd velora-store
   ```

2. **Install PHP Dependencies**:
   ```bash
   composer install
   ```

3. **Configure Environment File**:
   ```bash
   cp .env.example .env
   ```
   Update `.env` database parameters:
   ```env
   APP_NAME="VELORA"
   APP_URL=http://localhost:8000

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=velstore
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations & Luxury Catalog Seeders**:
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Create Public Storage Symlink**:
   ```bash
   php artisan storage:link
   ```

7. **Compile Frontend Assets**:
   ```bash
   npm install
   npm run build
   ```

8. **Start Local Development Server**:
   ```bash
   php artisan serve
   ```
   Open your browser at: **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## 🛠 Tech Stack

- **Backend Framework**: Laravel 10 (PHP 8.2)
- **Frontend / Styling**: Tailwind CSS, Bootstrap 5.3, Blade Templates, Sass
- **Carousels & UI**: Slick Carousel, Font Awesome 6.7, Toastr.js
- **Database**: MySQL / MariaDB (InnoDB)
- **Asset Bundler**: Vite 5
- **Authentication**: Laravel Multi-Guard (Admin, Vendor, Customer)

---

## 📜 Deployment Guide
For complete step-by-step instructions on deploying VELORA to production (such as Hostinger, cPanel, or VPS), refer to the [DEPLOY.md](DEPLOY.md) file included in this repository.

---

## 📄 License
This project is open-source software licensed under the [MIT license](LICENSE).
