<?php

namespace App\Http\Controllers;

use App\Order;
use App\Option;
use App\Category;
use App\OptionGroup;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $categories = Category::all();
        $options = Option::all();
        $optionGroups = OptionGroup::all();
        $orders = Order::limit(5)->orderBy('created_at', 'desc')->get();

        return view('admin.restaurantindex', compact('orders', 'options', 'optionGroups', 'categories'));
    }

    /**
    * Display the specified resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function show()
    {
        $yearlyTotal = Order::selectRaw('year(created_at) year, sum(price) total')
                            ->groupBy('year')
                            ->orderBy('year', 'desc')
                            ->get();

        $totalOrders = Order::selectRaw('year(created_at) year, monthname(created_at) month, sum(price) total')
                            ->groupBy('year', 'month')
                            ->orderBy('year', 'desc')
                            ->get();

        $averageOrder = Order::selectRaw('avg(price) Average, monthname(created_at) month, year(created_at) year' )
                            ->whereRaw('year(created_at) = year(curdate())')
                            ->groupBy('month', 'year')
                            ->orderBy('month', 'desc' )
                            ->get();

        return view('admin.panel', compact('totalOrders', 'yearlyTotal', 'averageOrder'));
    }
}