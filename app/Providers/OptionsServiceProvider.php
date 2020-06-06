<?php

namespace App\Providers;

use App\Models\HolidayTitle;
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
        \View::composer(['includes.header', 'includes.altheader'], function ($view) {

            $title = HolidayTitle::first();

            if (!is_null($title)) {
                $title = $title->pluck('holiday_page_title')->toArray()[0];
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
