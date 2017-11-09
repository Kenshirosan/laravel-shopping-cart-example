# laravel-shopping-cart
# work in progress
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
* user must confirm their email
* [fullcalendar.io](https://fullcalendar.io)
* google analytics

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
mv .env.example .env && vim .env
```
update database info, stripe key, and mail driver
```
php artisan key:generate
```
```
php artisan migrate
```
if there's any problem with migrations, try deleting the boot method in the AppServiceProvider file.
If you're using mariadb leave it alone tho.
```
php artisan serve
```
and let me know all what's wrong.
