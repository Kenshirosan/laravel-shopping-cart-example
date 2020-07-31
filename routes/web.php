<?php

Route::get('/config', function () {
    try {
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('view:cache');
        return 'ok';
    } catch (\Exception $e) {
        dd($e->getMessage());
    }
});

Route::get('/register/confirm', 'Auth\RegisterConfirmationController@index')->name('register.confirm');

Route::get('/', function () {
    return redirect('/shop');
})->name('shop');

Route::get('/home', function () {
    return redirect('/shop');
})->name('shop');

Route::get('/customized-page-infos', 'FrontPageController@index');
Route::get('/about', 'SiteController@index');
Auth::routes();


// Customers leave messages
Route::get('/contact-us', 'MessageController@index'); // multipurpose index
Route::post('/contact-us', 'MessageController@store');

// Cart counter
Route::get('/count', function() {
    return response(Cart::count(), 200);
});


Route::get('/alternate', 'ShopController@alternate');
Route::get('today', 'ShopController@today');
Route::post('/today/{product}', 'ProductController@todaySpecial');
Route::delete('/today/{product}/delete', 'ProductController@deleteTodaySpecial');
// ppl playing with shopping cart
Route::resource('/shop', 'ShopController', ['only' => ['index', 'show']]);
Route::resource('/cart', 'CartController');
Route::resource('/cart/{rowId}', 'CartController@destroy', ['only' => ['delete']]);
Route::patch('/cart/{rowId}', 'CartController@update');
Route::get('/cart', 'CartController@index');
Route::post('/cart', 'CartController@store');
Route::get('/cartcontent', 'CartController@index');
Route::delete('/emptyCart', 'CartController@emptyCart');
Route::get('/holidays-special', 'HolidaySpecialController@index');

// SIGNED IN USERS ROUTES
require_once('usersRoutes.php');

// EMPLOYEES ROUTES
require_once('employeesRoutes.php');

// ADMIN ROUTES
require_once('adminRoutes.php');

