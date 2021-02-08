## Laravel 8 Auth API using Sanctum.
Basic Laravel 6 Authentication API using Sanctum.

----

### Language & Framework Used:
1. PHP
1. Laravel

### Architecture Used:
1. Transformation layer
1. Sanctum Auth - https://laravel.com/docs/8.x/sanctum

### API List:
##### Authentication Module
1. [x] Create New User API
1. [x] Login API
1. [x] Get User List API with Token validation


### How to Run:
1. Clone Project - 

```bash
git clone https://github.com/shawon3719/Laravel_8_Sanctum_Auth_API
```
2. Go to the project drectory by `cd your-directory` & Run the 
2. Create `.env` file & Copy `.env.example` file to `.env` file
3. Create a database called - `laravel_sanctum`.
4. Now migrate and seed database to complete whole project setup by running this-
``` bash
php artisan migrate
```
and then,
 ``` bash
php artisan db:seed
```
after that,
5. Run the server - 
``` bash
php artisan serve
```
6. Open Browser - 
http://127.0.0.1:8000 

API is running now. you can use these API using postman.


