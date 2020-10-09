<?php
use App\Http\Controllers\CheckController;

Route::middleware(['auth', 'must-be-confirmed', 'employee'])->group(function () {
    Route::get('/calendar', 'CalendarController@index');
    Route::post('/things-to-do', 'CalendarController@store');
    Route::patch('/things-to-do/{id}', 'CalendarController@update');
    Route::delete('/things-to-do/{id}', 'CalendarController@destroy');
    //DEALING WITH ORDERS
    Route::get('/customer-orders', [CheckController::class, 'index']);
    Route::get('/orders-processed', [CheckController::class, 'processed']);
    Route::get('/order/{order}', [CheckController::class, 'show']);
    Route::get('/print/{order}', [CheckController::class, 'create']);
    Route::patch('/update/order/{id}/status', 'StatusController@update');
    Route::get('/search-orders', 'SearchController@index');
    Route::get('/livesearch','SearchController@show');
    Route::post('/customer-orders/{order}', 'OrderProcessedController@create');
    Route::delete('/customer-orders/{order}', 'OrderProcessedController@destroy');
});
