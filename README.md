# Laravel Blog Application

A minimalist blog system built with Laravel, Blade templates, and Tailwind CSS.

## Features

- User authentication
- Create, read, update and delete blog posts
- Minimalist dark theme UI
- Responsive design with Tailwind CSS
- PostgreSQL/MySQL/SQLite support

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js and npm
- SQLite or MySQL

## Installation

Clone the repository:

git clone https://github.com/kumowww/laravelNothers.git

Navigate to the project directory:

cd laravel

Install PHP dependencies:

composer install

Install Node dependencies:

npm install

Environment setup

Copy the example environment file:

copy .env.example .env

Generate application key:

php artisan key

Database

Create SQLite database file:

database/database.sqlite

Run migrations:

php artisan migrate

Running the project

Start Vite:

npm run dev

Start Laravel server:

php artisan serve

Open in browser:

http://127.0.0.1:8000

Project structure
routes/ – application routes
app/ – core logic
resources/views/ – Blade templates
public/ – public assets
Future improvements
authentication system
CRUD functionality
admin panel
API endpoints
improved UI
License

This project is open-source and available under the MIT License.
