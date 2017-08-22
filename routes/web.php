<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('shop');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
// EDIT/DELETE USER PROFILE
Route::get('/edit-profile', 'UserController@index');
Route::post('/edit-profile/{user_id}', 'UserController@edit');
Route::get('/erase/{user_id}', 'UserController@delete');
Route::post('/erase/{account}', 'UserController@deleteaccount');

Route::resource('shop', 'ProductController', ['only' => ['index', 'show']]);
Route::resource('cart', 'CartController');
Route::delete('emptyCart', 'CartController@emptyCart');

//daily_specials
Route::get('/daily-specials', 'ProductController@dailyspecialIndex');
Route::get('/special/{slug}', 'ProductController@show');

//ADMIN AND EMPLOYEE ROUTES
Route::get('/restaurantpanel', 'AdminController@index');
Route::get('/delete/{slug}', 'ProductController@delete')->name('/delete');
Route::post('/insertproduct', 'ProductController@store');
Route::get('/panel', 'AdminController@show');
Route::get('/search-orders', 'SearchController@search');
Route::get('/livesearch','SearchController@liveSearch');
Route::post('/hide-orders/{order}', 'AdminController@hide');
Route::post('/show-order/{order}', 'AdminController@showOrder');

//VIEW ORDERS AND PRINT
Route::get('/customer-orders', 'CheckController@index');
Route::get('/order/{id}', 'CheckController@show');
Route::get('/print/{id}', 'CheckController@print');

//ADD A BUNCH OF PICS ON PRODUCT VIEW
Route::post('/shop/{slug}/{photo}','AdminController@store');

//CHECKOUT AND CART ROUTES
Route::get('/checkout', 'PaymentController@index');
Route::post('/order', 'PaymentController@store');
Route::get('/thankyou', 'PaymentController@thankyou');

// WISHLIST ROUTES(took it away from views.. for now)
Route::post('switchToWishlist/{id}', 'CartController@switchToWishlist');
Route::resource('wishlist', 'WishlistController');
Route::delete('emptyWishlist', 'WishlistController@emptyWishlist');
Route::post('switchToCart/{id}', 'WishlistController@switchToCart');
