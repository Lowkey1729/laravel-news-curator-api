------
**News-Curator-API Task**

- Olarewaju Mojeed: **[github.com/Lowkey1729](https://github.com/Lowkey1729)**

## Table of Contents

## Clone Repository

Clone the repository intoyour local environment

```bash
git clone  https://github.com/Lowkey1729/laravel-news-curator-api.git
cd laravel-news-curator-api
```

## Install Dependencies

```bash
composer install
```
## Update the .env from the .env.example.

```bash
cp .env.example .env
```
Update the .env.testing from the .env.example.

```bash
cp .env.example .env.testing
```

Ensure to set the ```APP_ENV=testing``` and set up your database credentials and table

## Run Code Locally

Then run the following command from the root of the application

```bash
php artisan serve
```

## Manage Migrations

```bash
php artisan migrate
```

```bash
php artisan migrate --env=testing
```

## Run test cases

```
./vendor/bin/pest
```

