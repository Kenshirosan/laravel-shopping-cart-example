# Laravel shopping cart
# work in progress

Laravel E-commerce

Laravel e-commerce example application. Uses Crinsane/LaravelShoppingcart

Features :
---
* Mail functionality on registration and order.
* Almost 'Real time' tracking with pusher, will move to socket.io soon tho.
* Admin row in users table, to be set manually directly in database, Admin may add employees.
* Create/Update/Delete Products, Categories, Options, Sales, Coupons, Specials.
* Dropzone.js on to add more pictures on the product page.
* Stripe payment, just add your key in .env, and update the public key in CheckoutForm.vue.
* User account with real-time order tracking.
* PDF printing.
* Users must confirm their email.
* Backend with [adminLTE](https://adminlte.io/themes/AdminLTE/index2.html) for laravel, package by [Jeroen Noten](https://github.com/jeroennoten/Laravel-AdminLTE).
* [fullcalendar.io](https://fullcalendar.io).
* Google analytics package by [Spatie.be](https://spatie.be/en/opensource/postcards), Don't forget to send them a postcard.

download or clone then
```
cd path/to/app
```
```
npm install && npm run dev
```
```
composer install
```
```
mv .env.example .env && vim .env
```
update database info, stripe keys, pusher keys, mail driver and keys, and analytics key.
update pusher key in bootstrap.js (Echo).
update stripe key in CheckoutForm.vue
```
php artisan key:generate
```
```
php artisan config:cache
```
You will face problems with migrations, just change the dates on migration files to match the error message, Didn't do it yet... :/
```
php artisan migrate
```
```
php artisan serve
```