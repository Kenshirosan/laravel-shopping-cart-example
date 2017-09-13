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
// EDIT/DELETE USER PROFILE
Route::get('/edit-profile', 'UserController@index');
Route::post('/edit-profile/{user_id}', 'UserController@edit');
Route::get('/erase/{user_id}', 'UserController@show');
Route::post('/erase/{account}', 'UserController@destroy');

Route::resource('shop', 'ShopController', ['only' => ['index', 'show']]);
Route::resource('cart', 'CartController');
Route::delete('emptyCart', 'CartController@emptyCart');

//daily_specials

//ADMIN AND EMPLOYEE ROUTES
Route::get('/restaurantpanel', 'AdminController@index');
Route::get('/best-customers', 'BestCustomerController@index');
Route::get('/delete/{slug}', 'ProductController@delete')->name('/delete');
Route::post('/insertproduct', 'ProductController@store');
Route::get('/panel', 'AdminController@show');
Route::get('/search-orders', 'SearchController@index');
Route::get('/livesearch','SearchController@show');
Route::get('create-coupon', 'CouponController@index');
Route::post('create-coupon', 'CouponController@store');

Route::post('apply-coupon', 'CouponController@update');

Route::post('/product_type', 'ProductController@getProductType');

//DEALING WITH ORDERS
Route::get('/customer-orders', 'CheckController@index');
Route::get('/order/{id}', 'CheckController@show');
Route::get('/print/{id}', 'CheckController@create');
Route::post('/show-order/{order}', 'OrderProcessedController@show');
Route::post('/hide-orders/{order}', 'OrderProcessedController@destroy');

//ADD A BUNCH OF PICS ON PRODUCT VIEW
Route::post('/shop/{slug}/{photo}','PhotosController@store');

//CHECKOUT AND CART ROUTES
Route::get('/checkout', 'PaymentController@index');
Route::post('/order', 'PaymentController@store');
Route::get('/thankyou', 'PaymentController@thankyou');

// WISHLIST ROUTES(took it away from views.. commented out the html in templates)
// Route::post('switchToWishlist/{id}', 'CartController@switchToWishlist');
// Route::resource('wishlist', 'WishlistController');
// Route::delete('emptyWishlist', 'WishlistController@emptyWishlist');
// Route::post('switchToCart/{id}', 'WishlistController@switchToCart');
