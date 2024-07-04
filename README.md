# Laravel Blog Application

This repository contains a simple blog application built with Laravel, a powerful PHP framework. Follow the steps below to set up and run the project locally.

## Prerequisites

Before you begin, ensure you have the following installed on your local machine:

- PHP (>= 7.4 recommended)
- Composer (Dependency Manager for PHP)
- MySQL or any other database supported by Laravel
- Node.js with npm (for compiling assets if needed)

## Getting Started

1. **Clone the repository:**

   git clone https://github.com/Amalmartin/blog-project.git
   cd blog-project

2. **Install PHP dependencies:**

   composer install

3. **Configure your .env file:**

Create .env file and Copy the .env.example file to .env. Set up your database connection details, including DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD.

4. **Generate an application key::**

   php artisan key:generate

4. **Run database migration:**

php artisan migrate --seed

5. **Compile assets:**

npm install
npm run dev

6. **Start the server:**

php artisan serve

7. **Start the app:**

http://localhost:8000