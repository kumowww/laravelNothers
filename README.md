# Laravel Blog Application

A minimalist blog system built with Laravel, Blade templates, and Tailwind CSS. This project is optimized for serverless deployment on the Vercel platform.

Visit the live project: https://laravelblogapplication.vercel.app/

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

cd laravelNothers

Install PHP dependencies:

composer install

Install Node dependencies:

npm install

## Environment Setup

Copy the example environment file:

cp .env.example .env

Generate application key:

php artisan key:generate

## Database

Create SQLite database file:

touch database/database.sqlite

Run migrations:

php artisan migrate

## Running the Project

Start Vite (Frontend):

npm run dev

Start Laravel server:

php artisan serve

Open in browser:

http://127.0.0.1:8000

## Project Structure

- routes/ - application routes
- app/ - core logic
- resources/views/ - Blade templates
- public/ - public assets
- api/ - serverless entry point for Vercel

## Future Improvements

- authentication system
- CRUD functionality
- admin panel
- API endpoints
- improved UI

## License

This project is open-source and available under the MIT License.
