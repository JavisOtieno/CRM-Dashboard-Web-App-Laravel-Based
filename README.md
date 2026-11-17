# CRM Dashboard – Laravel + Inertia + Vue

A modern Customer Relationship Management (CRM) web application for managing leads, deals, contacts, accounts, tasks, meetings, calls, visits, and field activities. Built with Laravel 10, Inertia.js, Vue 3, and Tailwind CSS.

---

## Overview

**CRM Dashboard** provides a centralized platform for sales teams and administrators to:

- Manage the full sales pipeline (Leads → Deals)
- Track contacts and accounts
- Schedule and record calls, meetings, visits, and tasks
- Monitor field locations and activities
- Manage products, sellers, and admin users
- View analytics on an interactive dashboard

The system is designed to work alongside the companion **CRM Android App** for mobile field operations.

---

## Key Features

### Dashboard
- Overview of key CRM metrics
- Interactive charts (ApexCharts)
- Recent activity summaries

### Sales Pipeline
- **Leads** – Capture and manage potential customers
- **Deals** – Track opportunities through the sales process
- **Accounts** – Company/organization management
- **Contacts** – Individual contact records

### Activities
- **Calls** – Log and track phone interactions
- **Meetings** – Schedule and manage meetings
- **Visits** – Record field visits
- **Tasks** – Assign and track follow-up tasks

### Operations
- **Locations** – Manage and map customer/field locations
- **Products** – Product catalog management
- **Sellers** – Sales representative management
- **Admins** – Administrative user management

### Authentication & Profiles
- Login, signup, and password reset
- User profile management
- Role-based access (admins, sellers)

---

## Tech Stack

| Layer          | Technology                          |
|----------------|-------------------------------------|
| Backend        | PHP 8.1+ · Laravel 10               |
| Frontend       | Vue 3 · Inertia.js · Tailwind CSS   |
| Charts         | ApexCharts                          |
| State          | Pinia                               |
| Auth           | Laravel Sanctum + Breeze            |
| Build          | Vite                                |
| Database       | MySQL / MariaDB                     |

---

## Installation

### Prerequisites
- PHP ≥ 8.1
- Composer
- Node.js & npm
- MySQL / MariaDB

### Setup Steps

```bash
# 1. Clone the repository
git clone https://github.com/JavisOtieno/CRM-Dashboard-Web-App-Laravel-Based.git
cd CRM-Dashboard-Web-App-Laravel-Based

# 2. Install PHP dependencies
composer install

# 3. Copy environment file
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Configure your database in .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=crm
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Run migrations
php artisan migrate

# 7. (Optional) Seed the database
# php artisan db:seed

# 8. Install frontend dependencies
npm install

# 9. Build frontend assets
npm run build
# Or for development with hot reload:
# npm run dev

# 10. Start the development server
php artisan serve
