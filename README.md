### **MyAnimeList Dev**

[![PHP](https://img.shields.io/badge/PHP-778BB4?style=plastic&logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=plastic&logo=laravel&logoColor=white)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-06B6D4?style=plastic&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)

A fast, clean anime tracking application built with Laravel. Users can manage their personal watchlists, rate shows, read community reviews, and explore a fully functional modern UI.

---

#### **Preview**

![Preview](docs/screenshot.gif)

---

#### **Database Architecture**
![Full ERD Diagram](docs/erd-full.png)

> **[Click here to read the full Database Documentation & Schema (not updated!)](docs/DATABASE.md)**

---

#### **Instructions**

```bash
# Clone
git clone https://github.com/xoptech/myanimelist.git
cd myanimelist-dev

# Dependencies
composer install
npm install

# Env and keys
cp .env.example .env
php artisan key:generate

# Database
php artisan migrate --force
php artisan db:seed

# Run project (use separate terminal)
npm run dev
php artisan serve
```

> **Note:** Keep `npm run dev` running for Tailwind CSS support.