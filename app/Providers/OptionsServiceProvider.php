<?php

namespace App\Providers;

use App\HolidayTitle;
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
        \View::composer('*', function ($view) {

            $title = HolidayTitle::first();

            if (! $title == null) {
                $title = $title->toArray();
                $title = $title['holiday_page_title'];
            }

            $view->with('title', $title);
        });
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
