<?php

namespace App\Providers;

use App\Product;
use Illuminate\Support\ServiceProvider;

class OptionsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // \View::composer('*', function ($view) {

        //     $holidaySpecials = Product::where('holiday_special', true)->get();

        //     $view->with('holidaySpecials', $holidaySpecials);
        // });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
