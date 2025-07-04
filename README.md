<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Service Request Dashboard

A modern web dashboard for managing users, service requests, technicians, feedback, and payments. Built with **Laravel**, **Tailwind CSS**, and **Bootstrap modals**, the system supports multi-role authentication and a polished dark-themed UI with smooth interactions and modals.

## 🔧 Features

- 🔐 Multi-auth system (Admin, User, Technician)
- 📊 Dashboard overview (user count, request status, payment stats, etc.)
- 🧑‍💼 User & Technician management
- 🧾 Request lifecycle tracking
- 💬 Feedback management with rating display
- 💸 Payment tracking and editing
- 🪟 Custom-styled dropdowns and modals (no Alpine.js or JS frameworks)
- 🎨 Glassy UI using Tailwind + backdrop blur

## 📁 Tech Stack

- **Backend:** Laravel 11+
- **Frontend:** Blade templates, Tailwind CSS, Bootstrap 5 (modals)
- **Database:** MySQL
- **Icons:** Lucide Icons

## 🚀 Getting Started

### Prerequisites

- PHP 8.2+
- Composer
- Node.js + NPM
- MySQL

### Installation

```bash
git clone https://github.com/your-username/your-repo.git
cd your-repo
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
```

### Set up database

Update `.env`:

```
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

Then:

```bash
php artisan migrate
php artisan db:seed --class=AdminSeeder
```

### Run locally

```bash
php artisan serve
```

Open in browser: `http://localhost:8000`

## 📂 Folder Structure Highlights

- `app/Models` — Separate models for Users, Technicians, Requests, etc.
- `resources/views` — Blade files with reusable components and modals
- `public/` — Public assets (optional)
- `routes/web.php` — All route logic

## 🙋 Roles

- **Admin**: Full access to users, requests, feedback, payments, technicians.
- **User**: Can view & submit service requests.
- **Technician**: Sees requests & updates status.

