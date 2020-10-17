<?php

Route::middleware(['auth', 'must-be-confirmed'])->group(function () {
    Route::get('/user/profile', 'UserController@edit');
    Route::get('/edit/profile', 'UserController@edit');
    Route::get('/user/orders', 'OrderController@index');
    Route::get('/user-order/{order_id}', 'OrderController@show');
    Route::post('/create/address', 'AddressesController@store');
    Route::patch('/edit-profile/{user}', 'UserController@update');
    Route::patch('/address/{user}/{address}/update', 'AddressesController@update');
    Route::get('/erase/{user_id}', 'UserController@show');
    Route::delete('/erase/{account}', 'UserController@destroy');
    //CHECKOUT AND CART ROUTES
    Route::get('/checkout', 'PaymentController@index');
    Route::get('/cart-data', 'PaymentController@index');
    Route::delete('/user-coupons', 'PaymentController@deleteUserCoupon');
    Route::post('/order', 'PaymentController@store');
    Route::post('/apply-coupon', 'CouponController@update');
    Route::post('/product/{id}/favorites', 'FavoritesController@store');
    Route::delete('/product/{id}/favorites', 'FavoritesController@destroy');
});

// WISHLIST ROUTES(took it away from views for now.. commented out the html in templates)
// Route::post('switchToWishlist/{id}', 'CartController@switchToWishlist');
// Route::resource('wishlist', 'WishlistController');
// Route::delete('emptyWishlist', 'WishlistController@emptyWishlist');
// Route::post('switchToCart/{id}', 'WishlistController@switchToCart');
// Route::get('wishlist', function(){
//     return dump(Cart::content());
// });
