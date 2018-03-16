# Laravel shopping cart
# work in progress

Laravel E-commerce

Almost ready to ship laravel e-commerce application. Uses Crinsane/LaravelShoppingcart

Features :
---
* Mail functionality on registration and order.
* Order form and order table.
* Admin row in users table, to be set manually directly in database, Admin may add employees.
* Add product/Delete Products.
* Dropzone.js on product page.
* Stripe payment, just add your key in .env, and update the public key in CheckoutForm.vue.
* User account with real-time order tracking.
* PDF printing.
* Product options/categories/specials.
* Coupons / promotion codes.
* Users must confirm their email.
* Backend with [adminLTE](https://adminlte.io/themes/AdminLTE/index2.html) for laravel, package by [Jeroen Noten](https://github.com/jeroennoten/Laravel-AdminLTE).
* [fullcalendar.io](https://fullcalendar.io).
* Google analytics package by [Spatie.be](https://spatie.be/en/opensource/postcards), Don't forget to send them a postcard.

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
update database info, stripe keys, pusher keys, mail driver and keys, and analytics key.
update pusher key in bootstrap.js (Echo).
```
php artisan key:generate
```
```
php artisan config:cache
```
```
php artisan migrate
```
if there's any problem with migrations, try deleting the boot method in the AppServiceProvider file.
If you're using mariadb leave it alone tho.
```
php artisan serve
```
