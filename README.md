# laravel-shopping-cart-example
Inspired by drehimself/laravel-shopping-cart-example
Laravel Shopping Cart Example

Almost ready to ship laravel e-commerce application. Uses Crinsane/LaravelShoppingcart  

Features :
---
* added user registration, reworked everything to match laravel 5.4 folder structure
* mail functionality on registration an order. (make sure you have postfix installed and properly configured)
* order form and order table
* admin(boss)and employee rows in users table, to be set manually directly in database
* a form to add product(employees and admin)
* a delete product button on the shop view when logged in as an admin(boss)
* dropzone.js on product page(must be admin)
* stripe payment functionnal, just add your key in .env
* basic user account
* pdf printing
* product options
* coupons / promotion codes
* backend with adminLTE

download or clone then
```
cd path/to/app
```
```
npm install
```
```
composer install
```
```
php artisan key:generate
```
```
mv .env.example .env && vim .env
```
update database info and stripe key
```
php artisan serve
```
and let me know all what's wrong.
