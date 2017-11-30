<?php

// testing server performance
// Route::get('/', 'OrderProcessedController@index');

Route::get('/', function () {
    return redirect('shop');
})->name('shop');

Auth::routes();

Route::get('/register/confirm', 'Auth\RegisterConfirmationController@index')->name('register.confirm');

// Customers leave messages
Route::get('/contact-us', 'MessageController@index'); // multipurpose index
Route::post('/contact-us', 'MessageController@store');

// ppl playing with shopping cart
Route::resource('shop', 'ShopController', ['only' => ['index', 'show']]);
Route::resource('cart', 'CartController');
Route::delete('emptyCart', 'CartController@emptyCart');

// Holiday menus
Route::get('holidays-special', 'HolidaySpecialController@index');

Route::middleware(['auth', 'must-be-confirmed'])->group(function () {
    Route::get('/edit-profile', 'UserController@index');
    Route::patch('/edit-profile/{user_id}', 'UserController@update');
    Route::get('/erase/{user_id}', 'UserController@show');
    Route::delete('/erase/{account}', 'UserController@destroy');
    //CHECKOUT AND CART ROUTES
    Route::get('/checkout', 'PaymentController@index');
    Route::post('/order', 'PaymentController@store');
    Route::get('/thankyou', 'PaymentController@thankyou');
    Route::post('apply-coupon', 'CouponController@update');
});

Route::middleware(['auth', 'must-be-confirmed', 'employee'])->group(function () {
    Route::get('/calendar', 'CalendarController@index');
    Route::post('/things-to-do', 'CalendarController@store');
    Route::patch('/things-to-do/{id}', 'CalendarController@update');
    Route::delete('/things-to-do/{id}', 'CalendarController@destroy');
    //DEALING WITH ORDERS
    Route::get('/customer-orders', 'CheckController@index');
    Route::get('/order/{id}', 'CheckController@show');
    Route::get('/print/{id}', 'CheckController@create');

    Route::delete('/show-order/{order}', 'OrderProcessedController@show');
    Route::post('/hide-orders/{order}', 'OrderProcessedController@destroy');
});


//ADMIN ROUTES
Route::middleware(['auth', 'must-be-confirmed', 'admin'])->group(function () {
    Route::get('/restaurantpanel', 'AdminController@index');
    Route::get('/add-holiday-title', 'HolidaySpecialController@create');
    Route::post('/add-holiday-title', 'HolidaySpecialController@store');
    Route::delete('/holiday/{id}/delete', 'HolidaySpecialController@destroy');
    Route::get('/panel', 'AdminController@show');
    Route::get('/best-customers', 'BestCustomerController@index');
    Route::post('/insertproduct', 'ProductController@store');
    Route::delete('/delete/{slug}/product', 'ProductController@destroy');
    Route::get('/search-orders', 'SearchController@index');
    Route::get('/livesearch','SearchController@show');
    Route::get('create-coupon', 'CouponController@index');
    Route::post('create-coupon', 'CouponController@store');
    Route::post('/create-disposable-coupon', 'CouponController@storeCouponsForEveryone');
    Route::delete('coupons/{id}/delete', 'CouponController@destroy');
    Route::get('add-option-group', 'OptionGroupController@index');
    Route::post('add-option-group', 'OptionGroupController@store');
    Route::get('add-options', 'OptionsController@index');
    Route::post('add-options', 'OptionsController@store');
    Route::get('add-category', 'CategoriesController@create');
    Route::post('add-category', 'CategoriesController@store');
    // Route::get('/edit-css', 'CssController@index'); Just in case a wordpress guy comes in..
    // Route::post('/edit-css', 'CssController@update');
    Route::get('/message/{id}', 'MessageController@show');
    Route::delete('/delete/{id}', 'MessageController@destroy');
    Route::get('/analytics', 'AnalyticsController@analytics');
    //ADD A BUNCH OF PICS ON PRODUCT VIEW
    Route::post('/shop/{slug}/{photo}','PhotosController@store');
});
// Route::post('/product_type', 'ProductController@getProductType'); hhhhmmmm.......


// WISHLIST ROUTES(took it away from views.. commented out the html in templates)
// Route::post('switchToWishlist/{id}', 'CartController@switchToWishlist');
// Route::resource('wishlist', 'WishlistController');
// Route::delete('emptyWishlist', 'WishlistController@emptyWishlist');
// Route::post('switchToCart/{id}', 'WishlistController@switchToCart');
