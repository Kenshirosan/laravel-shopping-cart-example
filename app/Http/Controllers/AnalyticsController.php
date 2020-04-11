<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        //TODO: implement private analytics with apache.
        $dates = collect(date('Y'));
        $pageviews = collect(1);
        $sessions = collect(1);

        return view('admin.analytics', compact('dates', 'pageviews', 'sessions'));
    }
}
