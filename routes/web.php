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
})->name('shop');

Auth::routes();
Route::get('/register/confirm', 'Auth\RegisterConfirmationController@index')->name('register.confirm');

// EDIT/DELETE USER PROFILE
Route::get('/edit-profile', 'UserController@index')->middleware('must-be-confirmed');
Route::post('/edit-profile/{user_id}', 'UserController@edit')->middleware('must-be-confirmed');
Route::get('/erase/{user_id}', 'UserController@show')->middleware('must-be-confirmed');
Route::post('/erase/{account}', 'UserController@destroy')->middleware('must-be-confirmed');

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
Route::get('add-option-group', 'OptionGroupController@index');
Route::get('add-options', 'OptionsController@index');
Route::post('add-option-group', 'OptionGroupController@store');
Route::post('add-options', 'OptionsController@store');
Route::get('add-category', 'CategoriesController@create');
Route::post('add-category', 'CategoriesController@store');
Route::get('/edit-css', 'CssController@index');
Route::post('/edit-css', 'CssController@update');
// Route::post('/product_type', 'ProductController@getProductType');

//DEALING WITH ORDERS
Route::get('/customer-orders', 'CheckController@index');
Route::get('/order/{id}', 'CheckController@show');
Route::get('/print/{id}', 'CheckController@create');
Route::post('/show-order/{order}', 'OrderProcessedController@show');
Route::post('/hide-orders/{order}', 'OrderProcessedController@destroy');

//ADD A BUNCH OF PICS ON PRODUCT VIEW
Route::post('/shop/{slug}/{photo}','PhotosController@store');

//CHECKOUT AND CART ROUTES
Route::get('/checkout', 'PaymentController@index')->middleware('must-be-confirmed');
Route::post('/order', 'PaymentController@store')->middleware('must-be-confirmed');
Route::get('/thankyou', 'PaymentController@thankyou');
Route::post('apply-coupon', 'CouponController@update')->middleware('must-be-confirmed');

// WISHLIST ROUTES(took it away from views.. commented out the html in templates)
// Route::post('switchToWishlist/{id}', 'CartController@switchToWishlist');
// Route::resource('wishlist', 'WishlistController');
// Route::delete('emptyWishlist', 'WishlistController@emptyWishlist');
// Route::post('switchToCart/{id}', 'WishlistController@switchToCart');
