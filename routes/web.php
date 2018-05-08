<?php

Route::get('/', function () {
    return redirect('shop');
})->name('shop');

Route::get('/home', function () {
    return redirect('shop');
})->name('shop');

Route::get('/page-infos', 'FrontPageController@indexJson');
Route::get('/about', 'SiteController@index');

Auth::routes();

Route::get('/register/confirm', 'Auth\RegisterConfirmationController@index')->name('register.confirm');

// Customers leave messages
Route::get('/contact-us', 'MessageController@index'); // multipurpose index
Route::post('/contact-us', 'MessageController@store');

// Cart counter
Route::get('/count', function(){
    return Cart::count();
});


// ppl playing with shopping cart
Route::resource('shop', 'ShopController', ['only' => ['index', 'show']]);
Route::resource('cart', 'CartController');
Route::resource('/cart/{rowId}', 'CartController@destroy', ['only' => ['delete']]);
Route::patch('/cart/{rowId}', 'CartController@update');
Route::get('/cart', 'CartController@index');
Route::post('/cart', 'CartController@store');
Route::get('/cartcontent', 'CartController@index');
Route::delete('/emptyCart', 'CartController@emptyCart');
// Holiday menus or specials..
Route::get('holidays-special', 'HolidaySpecialController@index');

Route::middleware(['auth', 'must-be-confirmed'])->group(function () {
    Route::get('/user/{username}/profile', 'UserController@edit');
    Route::get('/user/orders', 'OrderController@index');
    Route::get('/user-order/{order_id}', 'OrderController@show');
    Route::patch('/edit-profile/{id}', 'UserController@update');
    Route::get('/erase/{user_id}', 'UserController@show');
    Route::delete('/erase/{account}', 'UserController@destroy');
    //CHECKOUT AND CART ROUTES
    Route::get('/checkout', 'PaymentController@index');
    Route::post('/order', 'PaymentController@store');
    Route::post('apply-coupon', 'CouponController@update');
    Route::post('/product/{id}/favorites', 'FavoritesController@store');
    Route::delete('/product/{id}/favorites', 'FavoritesController@destroy');
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
    Route::patch('/update/order/{id}/status', 'StatusController@update');
    Route::get('/search-orders', 'SearchController@index');
    Route::get('/livesearch','SearchController@show');
    Route::delete('/show-order/{order}', 'OrderProcessedController@show');
    Route::post('/hide-orders/{order}', 'OrderProcessedController@destroy');
});


//ADMIN ROUTES
Route::middleware(['auth', 'must-be-confirmed', 'employee', 'admin'])->group(function () {
    // testing server performance : send email in a loop
    // Route::get('/test-server', 'OrderProcessedController@index');
    Route::get('add-about-page', 'AboutController@index');
    Route::put('add-about-page', 'AboutController@store');
    Route::get('/add-user', 'UserController@create');
    Route::post('/add-user', 'UserController@store');
    Route::get('/delete-user', 'UserController@index');
    Route::get('/employee/{id}', 'UserController@show');
    Route::get('/user/{id}', 'UserController@show');
    Route::delete('/delete/{id}/user', 'UserController@destroy');
    Route::get('/restaurantpanel', 'AdminController@index');
    Route::get('/add-holiday-title', 'HolidaySpecialController@create');
    Route::post('/add-holiday-title', 'HolidaySpecialController@store');
    Route::delete('/holiday/{id}/delete', 'HolidaySpecialController@destroy');
    Route::get('/panel', 'AdminController@show');
    Route::get('/best-customers', 'BestCustomerController@index');
    Route::post('/insertproduct', 'ProductController@store');
    Route::get('/update/{slug}', 'ProductController@edit');
    Route::patch('/update/{slug}', 'ProductController@update');
    Route::delete('/delete/{slug}/product', 'ProductController@destroy');
    Route::post('/eighty_six/{id}', 'EightySixController@store');
    Route::delete('/delete/eighty_six/{id}', 'EightySixController@destroy');
    Route::get('create-coupon', 'CouponController@index');
    Route::post('create-coupon', 'CouponController@store');
    Route::post('/create-disposable-coupon', 'CouponController@storeCouponsForEveryone');
    Route::delete('coupons/{id}/delete', 'CouponController@destroy');
    Route::get('add-option-group', 'OptionGroupController@index');
    Route::post('add-option-group', 'OptionGroupController@store');
    Route::delete('delete-option-group/{option}', 'OptionGroupController@destroy');
    Route::get('add-options', 'OptionsController@index');
    Route::post('add-options', 'OptionsController@store');
    Route::get('add-second-option-group', 'SecondOptionGroupController@index');
    Route::post('add-second-option-group', 'SecondOptionGroupController@store');
    Route::delete('delete-second-option-group/{option}', 'SecondOptionGroupController@destroy');
    Route::get('add-second-options', 'SecondOptionsController@index');
    Route::post('add-second-options', 'SecondOptionsController@store');
    Route::get('add-category', 'CategoriesController@create');
    Route::post('add-category', 'CategoriesController@store');
    Route::delete('/delete-category/{id}', 'CategoriesController@destroy');
    Route::get('/message/{id}', 'MessageController@show');
    Route::delete('/delete/{id}', 'MessageController@destroy');
    Route::get('/analytics', 'AnalyticsController@index');
    Route::get('/create-invoice', 'InvoiceController@index');
    Route::post('/create-invoice', 'InvoiceController@store');
    //ADD A BUNCH OF PICS ON PRODUCT VIEW
    Route::post('/shop/{slug}/{photo}','PhotosController@store');
    Route::get('/sales', 'SalesController@index');
    Route::post('/sales', 'SalesController@store');
    Route::delete('/delete-sales/{saleId}', 'SalesController@destroy');
    Route::get('/front-page-title', 'FrontPageController@index');
    Route::post('/front-page-title', 'FrontPageController@store');
});


// WISHLIST ROUTES(took it away from views for now.. commented out the html in templates)
// Route::post('switchToWishlist/{id}', 'CartController@switchToWishlist');
// Route::resource('wishlist', 'WishlistController');
// Route::delete('emptyWishlist', 'WishlistController@emptyWishlist');
// Route::post('switchToCart/{id}', 'WishlistController@switchToCart');
// Route::get('wishlist', function(){
//     return dump(Cart::content());
// });