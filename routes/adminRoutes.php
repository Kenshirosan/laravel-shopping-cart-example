<?php

Route::middleware(['auth', 'must-be-confirmed', 'employee', 'admin'])->group(function () {
    // testing server performance : send email in a loop
    // Route::get('/test-server', 'OrderProcessedController@index');
    Route::get('/add-about-page', 'AboutController@index');
    Route::put('/add-about-page', 'AboutController@store');
    Route::get('/add-user', 'UserController@create');
    Route::post('/add-user', 'UserController@store');
    Route::get('/delete-user', 'UserController@index');
    Route::get('/employee/{id}', 'UserController@show');
    Route::get('/user/{id}', 'UserController@show');
    Route::delete('/delete/{id}/user', 'UserController@destroy');
    Route::get('/restaurantpanel', 'AdminController@index');
    Route::get('/panel', 'AdminController@show');
    Route::get('/add-holiday-title', 'HolidaySpecialController@create');
    Route::post('/add-holiday-title', 'HolidaySpecialController@store');
    Route::delete('/holiday/{id}/delete', 'HolidaySpecialController@destroy');
    Route::get('/best-customers', 'BestCustomerController@index');
    Route::post('/insertproduct', 'ProductController@store');
    Route::get('/update/{slug}', 'ProductController@edit');
    Route::patch('/update/{slug}', 'ProductController@update');
    Route::delete('/delete/{slug}/product', 'ProductController@destroy');
    Route::post('/eighty_six/{id}', 'EightySixController@store');
    Route::delete('/delete/eighty_six/{id}', 'EightySixController@destroy');
    Route::get('/create-coupon', 'CouponController@index');
    Route::get('/create-disposable-coupon', 'CouponController@index');
    Route::post('/create-coupon', 'CouponController@store');
    Route::post('/create-disposable-coupon', 'CouponController@storeCouponsForEveryone');
    Route::delete('/create-disposable-coupon/{id}', 'CouponController@destroy');
    Route::delete('/create-coupon/{id}', 'CouponController@destroy');
    Route::get('/option-group', 'OptionGroupController@index');
    Route::post('/option-group', 'OptionGroupController@store');
    Route::delete('/option-group/{option}', 'OptionGroupController@destroy');
    Route::get('/add-options', 'OptionsController@index');
    Route::post('/add-options', 'OptionsController@store');
    Route::delete('/add-options/{id}', 'OptionsController@destroy');
    Route::get('/add-category', 'CategoriesController@create');
    Route::post('/add-category', 'CategoriesController@store');
    Route::delete('/add-category/{id}', 'CategoriesController@destroy');
    Route::get('/message/{id}', 'MessageController@show');
    Route::delete('/delete/{id}', 'MessageController@destroy');
    Route::get('/analytics', 'AnalyticsController@index');
    Route::get('/create-invoice', 'InvoiceController@index');
    Route::post('/create-invoice', 'InvoiceController@store');
    //ADD A BUNCH OF PICS ON PRODUCT VIEW
    Route::post('/shop/{slug}/{photo}','PhotosController@store');
    Route::get('/sales', 'SalesController@index');
    Route::post('/sales', 'SalesController@store');
    Route::delete('/sales/{saleId}', 'SalesController@destroy');
    Route::get('/front-page-title', 'FrontPageController@index');
    Route::post('/front-page-title', 'FrontPageController@store');

    Route::get('/logs', function() {
        return App\Logger::readLogs();
    });
});