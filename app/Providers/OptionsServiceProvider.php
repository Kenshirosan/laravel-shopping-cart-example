<?php

namespace App\Providers;

use App\Option;
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
        //     $options = \Cache::rememberForever('options', function () {
        //         return Option::all();
        //     });

        //     $view->with('options', $options);
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
