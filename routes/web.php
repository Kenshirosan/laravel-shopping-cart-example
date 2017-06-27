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

Route::resource('shop', 'ProductController', ['only' => ['index', 'show']]);
Route::resource('cart', 'CartController');
Route::delete('emptyCart', 'CartController@emptyCart');

//ADMIN AND EMPLOYEE ROUTES
Route::get('/restaurantpanel', 'AdminController@index');
Route::get('/delete/{slug}', 'ProductController@delete')->name('/delete');
Route::post('/insertproduct', 'ProductController@store');
Route::get('/panel', 'AdminController@show');

//ADD A BUNCH OF PICS ON PRODUCT VIEW
Route::post('/shop/{slug}/{photo}','AdminController@store');

//CHECKOUT AND CART ROUTES
Route::get('/checkout', 'PaymentController@index');
Route::post('/order', 'PaymentController@store');
Route::get('/thankyou', 'PaymentController@thankyou');



// WISHLIST ROUTES(took it away from views..)
Route::post('switchToWishlist/{id}', 'CartController@switchToWishlist');
Route::resource('wishlist', 'WishlistController');
Route::delete('emptyWishlist', 'WishlistController@emptyWishlist');
Route::post('switchToCart/{id}', 'WishlistController@switchToCart');


/*******
*
* TO DO
*
********/
//STRIPE (or payment route)
