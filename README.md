# Loaded.gg Challenge

## About the solution

I tried to keep it as simple as possible, in some cases I left a comment here and there just to explain my thought process and why I didn't follow exactly the instructions. I will list some of the things I did and why I did them vs why I didn't.

-   Countries table: Even if it was noted that countries should be a string I added a countries table to make it more normalized, easier to handle and more scalable.
-   Javascript vs Typescript: I didn't use typescript because I didn't want to take too much time on types and interfaces, I wanted to focus on the logic and the functionality of the app.
-   Scoped Queries: I let the model handle most of the logic as it was mostly querying the database, I didn't feelt the need to use actions, service layers or repositories.
-   API Routes: The example stated a `/dashboard` route, I used `/api/dashboard` instead, I didn't want to mess with the default web routes.
-   Vue Router: I turned all `web.php` file into a single catch-all route and let Vue Router handle the rest, as the whole example is just a table I decided to keep it on a SPA.
-   SPA vs Inertia: I took most of my time thinking about this, I decided to go with a SPA because it gives me the opportunity to shine, I was able to add cool little bits of functionality like updating filters and sorting as soon as they are updated.
-   Pinia: I decided to use state management even if not requested because I wanted to be able to preserve the state of the filters, sorting and current page even if the user navigates/reloads the page.
-   Tailwind: I used Tailwind because it's my go-to CSS framework, I'm very comfortable with it and I can make things look good very quickly.
-   API Resources: I wanted to show exactly the info requested.
-   Pagination: I used the default Laravel pagination, I even set a `per_page` param even if it wasn't gonna be used just to future-proof the app.
-   Sorting: I used the default Laravel sorting, I didn't want to mess with the query too much.
-   Filters: I kinda follow spatie query builder naming conventions, I first wanted to use the package as it really gave me all I needed but then I wouldn't be able to show my skills, so I decided to implement it myself in a very simple way.

## Installation

1. Clone the repository
2. Copy the `.env.example` file to `.env`, or run `cp .env.example .env`
3. Fill new `.env` file with your database credentials
4. Run `composer install`
5. Run `npm install`
6. Run `php artisan key:generate`
7. Run `php artisan migrate --seed`, hang tight, it will take a while since it's seeding a lot of data. Optionally you can go to `database/seeders/UserCommentSeeder.php` and change the `MIN_COMMENTS` and `MAX_COMMENTS` constant values to seed less data.
8. Run `npm run dev`
9. Run `php artisan serve`
10. Visit `http://localhost:8000`

## Final thoughts

I hope you like it, I had a lot of fun doing it. I'm looking forward to your feedback.
