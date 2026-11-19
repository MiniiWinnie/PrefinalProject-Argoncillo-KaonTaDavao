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

### Part 2: Relationships and Seeding

The project now includes all required model relationships and complete seed
data.

- Added both directions for district/eatery, eatery/dish, eatery/review,
  user/review, eatery/permit, and eatery/feature relationships.
- Added the district-to-review `hasManyThrough` relationship.
- Added the `EateryFactory` closed state and all required factories.
- Added the five required seeders and populated the exact project totals.

### Part 3: Routes and Read Pages

The project now includes the exact named routes, resource eatery routes, and
read-only pages for the home, eatery, district, and reviewer views.

- Uses `Route::resource('eateries', EateryController::class)` for all seven eatery routes.
- Uses slug-based eatery route-model binding.
- Uses Blade layout, navigation and flash partials, eatery-card component, and rating component.
- Loads eatery, district, feature, permit, dish, review, and reviewer data in controllers.
- Uses combined name/specialty, district, and feature filters with six eateries per page.

| Relationship | Type | Why this type fits |
| --- | --- | --- |
| District - Eatery | HasMany / BelongsTo | Daghan eateries pwede mag exist sa isa ka district murag Jollibee Davao daghan mga branch |
| Eatery - Dish | HasMany / BelongsTo | Daghan dishes kada eatery kay sa menu nila pwede daghan items pero for that one eatery. |
| Eatery - Review | HasMany / BelongsTo | Ang isa ka eatery pwede daghan reviews murag ra 15 google reviews para sa isa ka lugar. |
| User - Review | HasMany / BelongsTo | Ang user pwede magbuhat daghan kada review, pero kada review kay isa ra ka user naghimo. |
| Eatery - Permit | HasOne / BelongsTo | Isa ra ka permit pwede para sa isa ka eatery. (Lain sad daghan unless nag renew? pero isa gihapon) |
| Eatery - Feature | BelongsToMany / BelongsToMany | Many to Many kay multiple features for multiple eateries and vice versa. |
| District - Review | HasManyThrough | A district has reviews through its eateries, so the district page can count all reviews in that district. |

## Seeded Totals

| Table | Count |
| --- | ---: |
| Districts | 6 |
| Features | 6 |
| Users | 12 |
| Eateries | 15 |
| Closed eateries | 3 |
| Permits | 15 |
| Dishes | 50 |
| Reviews | 41 |

## Route List

Run `php artisan route:list --except-vendor` to show:

```text
GET|HEAD        / ............................................................................ home › HomeController
  GET|HEAD        districts ............................................... districts.index › DistrictController@index
  GET|HEAD        districts/{district} ...................................... districts.show › DistrictController@show
  GET|HEAD        eateries ................................................... eateries.index › EateryController@index
  POST            eateries ................................................... eateries.store › EateryController@store
  GET|HEAD        eateries/create .......................................... eateries.create › EateryController@create
  GET|HEAD        eateries/{eatery} ............................................ eateries.show › EateryController@show
  PUT|PATCH       eateries/{eatery} ........................................ eateries.update › EateryController@update
  DELETE          eateries/{eatery} ...................................... eateries.destroy › EateryController@destroy
  GET|HEAD        eateries/{eatery}/edit ....................................... eateries.edit › EateryController@edit
  POST            eateries/{eatery}/reviews .......................... eateries.reviews.store › ReviewController@store
  GET|HEAD        reviewers/{user} .......................................... reviewers.show › ReviewerController@show
  DELETE          reviews/{review} ........................................ reviews.destroy › ReviewController@destroy

Showing [13] routes
```

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
