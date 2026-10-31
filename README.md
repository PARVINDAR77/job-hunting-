# job-hunting-

> **JobFinder** - A modern, responsive Job Hunting & Career Management platform built with Laravel, Blade, and Vanilla CSS/JavaScript.

---

## 🚀 Overview

**JobFinder** is a full-featured recruitment and job exploration web application designed for both candidates and employers. It features interactive job discovery, career exploration tools, smart skill-matching algorithms, and comprehensive application tracking.

## ✨ Key Features

- **🔍 Smart Job Search & Filtering**: Search by job title, location, category, employment type, salary range, and experience level.
- **🎯 Smart Match Algorithm**: Select your technical skills to get instant, percentage-based job matches tailored to your profile.
- **🧭 Career Explorer**: An interactive tool guiding job seekers through industry paths, skill requirements, and high-demand roles.
- **🏢 Company Directory**: Discover employers, browse active openings per company, and explore company profiles.
- **📄 Candidate Dashboard**: Track application statuses (Applied, Reviewed, Shortlisted, Interviewing), manage saved jobs, and track profile completion.
- **📑 Resume Management**: Secure resume uploads and storage with protected downloads.
- **🛡️ Admin Panel**: Comprehensive administrative dashboard for managing users, companies, jobs, categories, applications, and platform analytics.
- **🎨 Modern Visual Design**: Custom responsive design system with smooth micro-interactions and mobile-first layouts.

---

## 🛠️ Tech Stack

- **Backend**: Laravel 11 / PHP 8.2+
- **Frontend**: Blade Templating, Vanilla CSS, Modern JavaScript
- **Database**: MySQL / SQLite
- **Architecture**: MVC (Model-View-Controller) with Eloquent ORM

---

## 📦 Installation & Setup

1. **Clone the repository**:
   ```bash
   git clone https://github.com/PARVINDAR77/job-hunting-.git
   cd job-hunting-
   ```

2. **Install PHP Dependencies**:
   ```bash
   composer install
   ```

3. **Install JavaScript Dependencies**:
   ```bash
   npm install && npm run build
   ```

4. **Environment Configuration**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Run Migrations & Seed Data**:
   ```bash
   php artisan migrate --seed
   ```

6. **Create Storage Symlink**:
   ```bash
   php artisan storage:link
   ```

7. **Start Development Server**:
   ```bash
   php artisan serve
   ```

---

## 📄 License

This project is open-sourced under the [MIT License](LICENSE).
