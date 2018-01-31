# Laravel-shopping-cart
# work in progress

Laravel E-commerce

Almost ready to ship laravel e-commerce application. Uses Crinsane/LaravelShoppingcart

Features :
---
* mail functionality on registration and order.
* order form and order table.
* admin(boss) row in users table, to be set manually directly in database, Admin may add employees
* Add product/Delete Products
* dropzone.js on product page.
* stripe payment, just add your key in .env, and update the public key in CheckoutForm.vue.
* User account with real-time order tracking.
* PDF printing.
* product options.
* coupons / promotion codes.
* backend with adminLTE.
* user must confirm their email.
* [fullcalendar.io](https://fullcalendar.io).
* google analytics by ([Spatie.be](https://spatie.be/en/opensource/postcards)), Don't forget to send them a postcard.

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
and let me know all what's wrong.
