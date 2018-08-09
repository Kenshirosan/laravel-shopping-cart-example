<?php

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
    Route::delete('/show-order/{id}', 'OrderProcessedController@show');
    Route::post('/hide-order/{id}', 'OrderProcessedController@destroy');
});