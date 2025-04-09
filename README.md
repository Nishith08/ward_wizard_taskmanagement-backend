# Laravel Backend - Auth & API Server

This is the backend for a full-stack authentication and dashboard system built using **Laravel**. It provides APIs for user registration, login, logout, and protected routes for the frontend (React app).

---

## ⚙️ Tech Stack

- Laravel 12.x
- PHP 8.x
- MySQL
- Laravel Sanctum (for API token authentication)
- RESTful API structure

---

## 📂 Project Structure


Follow the steps below to set up the Laravel backend locally:

### 1. Clone the repository

```bash
git clone [https://github.com/yourusername/your-backend-repo.git](https://github.com/Nishith08/ward_wizard_taskmanagement-backend)
cd your-backend-repo

2. Install PHP dependencies using Composer

composer install

3. Create a copy of the .env file

cp .env.example .env
4. Generate the application key

php artisan key:generate

5. Configure your database in .env
Edit the .env file and set the DB credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=your_password

6. Run database migrations
php artisan migrate

7. (Optional) Seed initial data
php artisan db:seed

8. Serve the application
php artisan serve

The backend API will now be running at:
👉 http://localhost:8000

🔐 Authentication (API)
This app uses Laravel Sanctum for API token-based authentication.

Auth Routes
POST /api/register – Register a new user

POST /api/login – Log in and receive a token

POST /api/logout – Log out (requires Bearer token)

All other routes are protected using the auth:sanctum middleware.
