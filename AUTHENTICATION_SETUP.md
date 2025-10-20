# Authentication Setup Guide

## Overview
This Laravel application has been configured with dual authentication system:
- **Admin Authentication** - Separate login for administrators
- **User Authentication** - Standard user login and registration

## Default Login Credentials

### Admin Login
- **URL**: http://localhost:8000/admin/login
- **Email**: admin@gmail.com
- **Password**: password

### User Login
- **URL**: http://localhost:8000/login
- **Email**: user@gmail.com
- **Password**: password

### User Registration
- **URL**: http://localhost:8000/register
- Create new user accounts directly from the registration page

## Quick Setup Commands

### 1. Reset Database and Create Test Accounts
```bash
php artisan migrate:fresh --seed
```
This will:
- Drop all tables and recreate them
- Create admin account (admin@gmail.com / password)
- Create test user account (user@gmail.com / password)

### 2. Create Test Accounts Only (Without Resetting Database)
```bash
php artisan auth:create-test-accounts
```
This command will:
- Create admin and user accounts if they don't exist
- Display all login credentials
- Show the login URLs

## Authentication Guards

This application uses two authentication guards:

1. **web** (default) - For regular users
2. **admins** - For admin users

## Important Files

### Models
- `app/Models/User.php` - Standard user model
- `app/Models/Admin.php` - Admin user model

### Controllers
- `app/Http/Controllers/AdminController.php` - Admin authentication logic

### Routes
- `routes/web.php` - Contains all authentication routes

### Seeders
- `database/seeders/AdminSeeder.php` - Creates admin test account
- `database/seeders/DatabaseSeeder.php` - Main seeder, calls AdminSeeder and creates user account

### Migrations
- `database/migrations/0001_01_01_000000_create_users_table.php` - Users table
- `database/migrations/2025_10_03_033924_create_admins_table.php` - Admins table
- `database/migrations/2025_10_02_190936_add_two_factor_columns_to_users_table.php` - 2FA for users
- `database/migrations/2025_10_20_040441_add_two_factor_columns_to_admins_table.php` - 2FA for admins

## Troubleshooting

### Can't Login?

1. **Check if database is migrated**:
   ```bash
   php artisan migrate:status
   ```

2. **Reset database and seed**:
   ```bash
   php artisan migrate:fresh --seed
   ```

3. **Verify accounts exist**:
   ```bash
   php artisan auth:create-test-accounts
   ```

4. **Clear cache**:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan route:clear
   php artisan view:clear
   ```

### Wrong Credentials Error?

Make sure you're using the correct credentials:
- Admin: admin@gmail.com / password
- User: user@gmail.com / password

### Can't Access Admin Dashboard?

Make sure you're logging in at the admin login page:
- Admin Login: http://localhost:8000/admin/login
- NOT the regular user login page

## Features

### Admin Side
- Separate login page
- Access to admin dashboard
- Manage clients
- Manage suppliers
- Protected admin routes

### User Side
- User registration
- User login
- User dashboard
- Student management

## Security Features

- Password hashing using bcrypt
- CSRF protection
- Session-based authentication
- Two-factor authentication support (can be enabled)
- Remember me functionality
- Rate limiting on login attempts

## Additional Commands

### Create a new admin manually:
```bash
php artisan tinker
```
Then in tinker:
```php
\App\Models\Admin::create([
    'name' => 'Your Name',
    'email' => 'your@email.com',
    'password' => bcrypt('your-password'),
    'email_verified_at' => now(),
]);
```

### Create a new user manually:
```bash
php artisan tinker
```
Then in tinker:
```php
\App\Models\User::create([
    'name' => 'Your Name',
    'email' => 'your@email.com',
    'password' => bcrypt('your-password'),
    'email_verified_at' => now(),
]);
```

## What Was Fixed

1. ✅ Fixed duplicate route name issue in `routes/web.php`
2. ✅ Updated `AdminSeeder` to properly create admin accounts
3. ✅ Updated `DatabaseSeeder` to create both admin and user test accounts
4. ✅ Created custom Artisan command `auth:create-test-accounts`
5. ✅ Added two-factor authentication columns to admins table
6. ✅ Ran migrations and seeders to set up the database
7. ✅ Verified both authentication guards are working

## Notes

- Always use `admin@gmail.com` for admin login
- Always use `user@gmail.com` for user login
- Default password for both is `password`
- Change these credentials in production!
- The admin dashboard is at `/admin/DashboardHome` after login
- Regular users are redirected to the welcome page after login

