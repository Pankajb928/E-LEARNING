# E-LEARNING Project Setup Guide

This document provides step-by-step instructions on how to set up the E-LEARNING project locally.

## Prerequisites
- Git
- Node.js and npm
- Composer
- PHP
- MySQL or any other compatible database server

## Installation Steps

### 1. Clone the Repository
```bash
git clone https://github.com/Pankajb928/E-LEARNING.git
```

### 2. Install Node.js Packages
Navigate to the project directory and run:
```bash
npm install
```

### 3. Install Composer Dependencies
Navigate to the project directory and run:
```bash
composer install
```

### 4. Configure Environment Variables
- Locate the `.env.example` file in the project root and rename it to `.env`.
- Update the database connection settings in the `.env` file according to your local environment.

### 5. Create Database
- Open your preferred database management tool (e.g., phpMyAdmin).
- Create a new database for the project.

### 6. Migrate Database Schema
Run the following command to create tables in the database:
```bash
php artisan migrate
```

### 7. Run the Application
Start the development server by running:
```bash
php artisan serve
```

### 8. Access the Application
Once the server is running, open your web browser and navigate to:
```
http://localhost:8000
```

You should now be able to access and use the E-LEARNING application locally.

## Additional Notes
- Make sure all prerequisites are installed and properly configured before starting the setup process.
- Ensure that your local development environment meets the requirements specified in the project documentation.
- For more information on Laravel's artisan commands, please refer to the [Laravel Documentation](https://laravel.com/docs).
- For troubleshooting or further assistance, refer to the project's README file or contact the project owner.
