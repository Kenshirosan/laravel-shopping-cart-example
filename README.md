# Laravel shopping cart
# Work in progress

Laravel E-commerce

Laravel e-commerce example application. Uses [bumbummen99/shoppingcart](https://github.com/bumbummen99/LaravelShoppingcart)

Features :
---
* Admin can create employees.
* Customizable front page.
* update or 86 product in a blink.
* Mail functionality on registration, order and logging.
* User account with real-time order tracking with pusher, will move to socket.io soon tho.
* Admin row in users table, to be set manually directly in database, Admin may add employees.
* Create/Update/Delete Products, Categories, Options, Sales, Coupons, Specials.
* Dropzone.js on to add more pictures on the product page.
* Stripe payment, just add your key in .env, and update the public key in CheckoutForm.vue.
* PDF printing.
* Users must confirm their email.
* Backend with [adminLTE](https://adminlte.io/themes/AdminLTE/index2.html) for laravel, package by [Jeroen Noten](https://github.com/jeroennoten/Laravel-AdminLTE).
* [fullcalendar.io](https://fullcalendar.io).
* Coupon feature package by [Zura Gabievi](https://github.com/zgabievi/laravel-promocodes)


download or clone then
```sh
cd path/to/app
```
```sh
npm install && npm run dev
```
```sh
composer install
```
```sh
mv .env.example .env && vim .env
```
update database info, stripe keys, pusher keys, mail driver, keys, username.
update pusher key in bootstrap.js (Echo).
update stripe key in CheckoutForm.vue
```sh
php artisan key:generate
```
```sh
php artisan config:cache
```
```sh
php artisan migrate
```
```sh
php artisan serve
```
