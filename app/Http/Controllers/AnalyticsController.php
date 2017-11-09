<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Spatie\Analytics\Period;

class AnalyticsController extends Controller
{
    public function analytics()
    {
        $analyticsData = \Analytics::performQuery(
            Period::years(1),
            'ga:sessions',
            [
                'metrics' => 'ga:sessions, ga:pageviews',
                'dimensions' => 'ga:yearMonth'
            ]
        );

        return view('admin.analytics', compact('analyticsData'));
    }
}
