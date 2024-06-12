Banking System
This is a Laravel-based banking system developed by Mediusware, designed to facilitate deposit and withdrawal operations for two types of users: Individual and Business.

Features
User registration and login
Deposit and withdrawal transactions
Different fee structures for Individual and Business accounts
Free withdrawal conditions for Individual accounts
Adjustable fee rates for Business accounts based on withdrawal amounts
Requirements
PHP >= 8.1.0
Composer
MySQL
Installation
Clone the repository:

bash
Copy code
git clone https://github.com/rak-ahsan/laravel-test
cd mediusware_exam
Install dependencies:

bash
Copy code
composer install
npm install
npm run dev
Set up environment variables:

bash
Copy code
cp .env.example .env
Generate the application key:

bash
Copy code
php artisan key:generate
Run database migrations:

bash
Copy code
php artisan migrate
Start the development server:

bash
Copy code
php artisan serve
API Endpoints
User Management
Create a new user:
