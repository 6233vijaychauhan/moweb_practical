## About Project
In this project, I have used Laravel Framework Version is 8.75 with Jquery Validation.

## Installation

We need to install composer for all packages.

Here is the complete instruction for how to install the composer.

**[https://getcomposer.org/doc/00-intro.md](https://getcomposer.org/doc/00-intro.md)**

Let's install all packages, by running this command from Terminal

```
composer install
```

## Configuration

For configuring the project please follow the below steps,

Copy .env from the .env.example file using below command

```bash
copy .env.example .env
php artisan key:generate
```

Go to .ENV File, Set DB_USERNAME & DB_PASSWORD of your phpmyadmin login credentials & set Database name in DB_DATABASE

```bash
DB_DATABASE=moweb_practical
DB_USERNAME=root
DB_PASSWORD=
```

Open your terminal OR command prompt and run bellow command in project directory

```bash
php artisan migrate
```

You need to run the following command to run a single seeder for Admin User:

```bash
php artisan db:seed
```

Now we are ready to to run full restful api and also passport api in laravel. so let's run our example so run bellow command for quick run:

```bash
php artisan serve
```


