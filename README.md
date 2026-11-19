# Kaon Ta! Davao - Argoncillo's Food Guide

My name is Sai Winnie Argoncillo, and this is my milestone project for
4-334 CS Elective 2 Full-Stack Development.

## Project Progress

### Part 1: Laravel Project and Database Setup

The first commit set up the Laravel 12 project and prepared the database
foundation.

- Created the Laravel project and enabled Tailwind through Vite.
- Added migrations for districts, eateries, permits, dishes, features,
  reviews, and the eatery-feature pivot table.
- Added the model files for the project tables.
- Added fillable fields and casts for open/closed status, dates, prices, and
  bestseller status.
- Configured SQLite and added working migration `down()` methods.
- Verified that the migrations can be rolled back and run again successfully.

## Personalized Data

| Item | Value |
| --- | --- |
| Full name | Sai Winnie Argoncillo |
| Eatery | Carinderia ni Argoncillo |
| Eatery slug | carinderia-ni-argoncillo |
| Feature | Suki ni Argoncillo |
| Permit number | DVO-2026-1116 |
| Permit expiry | November 16, 2027 |
| User 1 | Sai Winnie Argoncillo / argoncillo@kaonta.test |
| User 2 | Tita Argoncillo / tita.argoncillo@kaonta.test |
| User password | kaonta2026 |

## Setup

Run these commands from the project folder:

```bash
composer install

cp .env.example .env

php artisan key:generate

touch database/database.sqlite

php artisan migrate:fresh --seed

npm install

npm run build

php artisan serve
```
