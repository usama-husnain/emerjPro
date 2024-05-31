# Quick Start - Emerj Pro

### Step by step
Clone this Repository
```sh
git clone https://github.com/usama-husnain/lamt.git lamt
```

Create the .env file
```sh
cd emerjPro/
cp .env.example .env
```


Update environment variables in .env

For DB: First create an empty database in mysql and collect Username, Password and Database-name and fill following information.

Note: For Undefined variables you can ask in person.
```dosini
APP_NAME="Emerj Pro"
APP_URL=base_url_here
APP_ENV=Production
APP_DEBUG=false

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=name_you_want_db_here
DB_USERNAME=username_here
DB_PASSWORD=password_here_if_any


```


Install project dependencies
```sh
composer install
```


Generate the Laravel project key
```sh
php artisan key:generate
```

Migrate Database

```sh
php artisan migrate --seed
```
It will generate db tables and necessary data

Start the server
```sh
php artisan serve
```


Access the project api Documentation
[YOUR_BASE_URL/api/documentation](http://127.0.0.1:8000/api/documentation)

Access the project
[YOUR_BASE_URL/login](YOUR_BASE_URL/login)
