## Installation

Make sure you have composer installed in your computer, then do following steps.

```bash
$ cp .env.example .env
```

Edit file `.env` then configure database to match with your system.

```bash
$ composer install
$ php artisan jwt:secret
$ php artisan migrate
$ php artisan db:seed
$ php artisan serve
```

When run seeder the data is randomly created, which they are has auction that already closed or open, and was bidded with exisisting user.

## Configuration

Users are hardcoded in the auth config file `config/auth.php` and stored in array key `hard_coded_users`.