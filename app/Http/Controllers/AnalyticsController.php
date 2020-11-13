<?php

namespace App\Http\Controllers;

use App\Models\SortOrdersByTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        //TODO: implement private analytics with apache.
        $data = DB::select('
            SELECT COUNT(date) as count, day, date, type
            FROM sort_orders_by_times 
            WHERE date LIKE \'2020%\'
            GROUP BY day, date, type;
        ');

        dd($data);
        $dates = collect(date('Y'));
        $pageviews = collect(1);
        $sessions = collect(1);

        return view('admin.analytics', compact('dates', 'pageviews', 'sessions'));
    }
}
