<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        $dates = collect(date('Y'));
        $pageviews = collect(1);
        $sessions = collect(1);

        return view('admin.analytics', compact('dates', 'pageviews', 'sessions'));
    }
}
