# Task Manager

Simple CRUD application to manage tasks. Each task belongs to a project. You can change each task's priority by dragging and dropping it where you want.

### Prerequisites 
- Laravel 10.18.0
- PHP 8.1

### How to run locally

clone project repository
```sh
git clone 
```
Install required dependencies
```sh
composer install
```
Create .env and provide required variables (set database info, port, and db name)
```sh
cp .env.example .env
```
Run Migrations
```sh
php artisan migrate
```
Seed the database
```sh
php artisan db:seed --class=DummyDataSeeder
```
Run server locally
```sh
php artisan serve
```


## License
emansamyy79@gmail.com