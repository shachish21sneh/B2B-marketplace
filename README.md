# NexTrade B2B — Enterprise Wholesale Marketplace & Manufacturer Portal

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-9.2-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

**NexTrade B2B** is a full-featured, enterprise-grade B2B Marketplace and Manufacturer Sourcing Platform built with **PHP 8.3 / Laravel 11 and MySQL**, inspired by industry leaders like IndiaMART, Alibaba, and TradeIndia.

---

## 🌟 Key Features & Modules

### 1. 🌐 Public Marketplace & Catalog Discovery
- **Mega Search Bar:** Multi-category selector, industrial city selector, and live AJAX autocomplete suggestions (`/api/search/suggestions`).
- **Product Catalog (`/products`):** Multi-faceted left filter sidebar (Categories, Subcategories, Verified Suppliers Only, City hubs, Business Types, Price Range slider, Minimum Star Rating), sort options, and Grid / List view switcher.
- **Product Details (`/products/{slug}`):** Multi-image gallery with zoom thumbnails, wholesale unit pricing, MOQ, stock availability, dynamic key-value specifications table, packaging & delivery terms, sticky supplier trust sidebar with GST/KYC badges, direct WhatsApp contact link, and Schema.org JSON-LD structured data.
- **Supplier Directory & Storefronts (`/suppliers`, `/suppliers/{slug}`):** Multi-tab supplier profile featuring Company Overview, Catalog, OEM/Turnkey Services, 5-Criteria Customer Reviews with star distribution breakdown, and Corporate Contact information.
- **Regional Industrial Hubs (`/city/{city}/suppliers`):** City-based supplier discovery across major industrial hubs (Delhi, Mumbai, Bengaluru, Ahmedabad, Pune, Hyderabad, Coimbatore, etc.).

### 2. 📋 RFQ Lead Marketplace & Quote Comparison
- **Post Buy Requirement (`/requirements/post`):** Comprehensive procurement form supporting technical descriptions, quantity & unit selection, target budget, delivery destination, destination pincode, required-by date, and commercial payment terms.
- **Supplier RFQ Bidding (`/supplier/requirements/{id}`):** Suppliers submit formal bids with offered unit rates, quantity, MOQ, delivery lead time in days, shipping charges, validity dates, and technical proposals.
- **Side-by-Side Quote Comparison Matrix (`/buyer/requirements/{id}/compare`):** Buyers compare multiple supplier quotations side-by-side across unit price, total estimated order cost, lead time, MOQ, supplier trust badge, review score, and accept quotes with one click.

### 3. 💬 Real-Time Communication Engine
- **WhatsApp-Style Live Chat (`/buyer/messages` & `/supplier/messages`):** Real-time two-pane messaging interface with contact search, active thread view, unread badge counters, online status indicators, and instant AJAX message sending.

### 4. 🛡️ Multi-Tier KYC & Trust Verification
- **Supplier KYC Upload (`/supplier/profile`):** Document center for GST Certificates, PAN Cards, Udyam / MSME Licenses, ISO Certificates, and factory photos.
- **Admin Verification Queue (`/admin/verification`):** Compliance review queue to approve/reject documents and assign verified trust levels (**Basic**, **GST Verified**, **Business Verified**, **KYC Verified**, **Premium Gold**).

### 5. 💎 Monetization & Subscriptions
- **Subscription Tiers (`/supplier/subscription`):**
  - *Free Starter:* 5 products catalog, standard listing.
  - *Business Gold:* 50 products catalog, Gold verified badge, priority listing, 50 RFQ quotes/month (₹24,999/year).
  - *Enterprise Platinum:* Unlimited products, Platinum badge, top search placement, unlimited RFQ bidding, dedicated account manager (₹49,999/year).
- Simulated payment gateway checkout with billing transaction history and GST invoice records.

### 6. ⚙️ Super Admin Control Panel (`/admin`)
- Platform KPIs, User management (RBAC), KYC document approval queue, Product catalog moderation, Category & Subcategory taxonomy manager, Banners & Ads manager, and System Settings.

### 7. 🚀 SEO & Discoverability
- Schema.org JSON-LD structured data (Product, Offer, AggregateRating, Organization).
- Dynamic XML sitemap (`/sitemap.xml`) and `robots.txt`.
- Static informative pages: About Us, Contact Us, Terms of Service, Privacy Policy, and FAQ.

---

## 🔑 Demo Accounts for Instant Testing

| Role | Email | Password | Dashboard URL |
| :--- | :--- | :--- | :--- |
| **Super Admin** | `admin@nextrade.com` | `password` | `http://localhost:8000/admin` |
| **Verified Supplier** | `supplier@nextrade.com` | `password` | `http://localhost:8000/supplier/dashboard` |
| **Corporate Buyer** | `buyer@nextrade.com` | `password` | `http://localhost:8000/buyer/dashboard` |

*(1-click demo login buttons are also provided directly on the `/login` page for fast testing).*

---

## 🛠️ Technology Stack

- **Backend:** PHP 8.3 / Laravel 11
- **Database:** MySQL 9.2 (22 Eloquent models, foreign-key relational integrity)
- **Frontend:** Blade Templates, Tailwind CSS, FontAwesome 6, Lucide Icons, Vanilla JavaScript
- **Testing:** PHP Integration Test Suite (`scratch/test_flows.php`)

---

## 🚀 Installation & Local Setup

### 1. Clone the repository
```bash
git clone https://github.com/shachish21sneh/B2B-marketplace.git
cd B2B-marketplace
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Configure Environment Variables
```bash
cp .env.example .env
```

Update your `.env` file with your MySQL database credentials:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nextrade_b2b
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Run Database Migrations & Seed Data
```bash
php artisan migrate:fresh --seed
```

### 6. Start the Development Server
```bash
php artisan serve --port=8000
```

Open [http://localhost:8000](http://localhost:8000) in your browser!

---

## 🧪 Running Automated Tests

Run the built-in integration test suite:
```bash
php scratch/test_flows.php
```

All 10 test suites cover entity counts, view rendering, specifications tables, storefront tabs, quote comparison matrix, chat interfaces, and admin KYC verification queues.

---

## 📄 License

This project is open-sourced software licensed under the [MIT License](LICENSE).
