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
            if ($title = implode(HolidayTitle::first()->pluck('holiday_page_title')->toArray())) {
                $view->with('title', $title);
            }
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
