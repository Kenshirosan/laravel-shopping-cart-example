<?php

namespace App\Http\Controllers;

use App\Order;
// use App\Option;
use App\Category;
use App\OptionGroup;
use App\SecondOptionGroup;
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
        // $options = Option::all();
        $optionGroups = OptionGroup::all();
        // $secondOptions = SecondOption::all();
        $secondOptionGroups = SecondOptionGroup::all();
        $orders = Order::limit(5)->orderBy('created_at', 'desc')->get();

        return view('admin.restaurantindex', compact('orders', 'optionGroups', 'secondOptionGroups', 'categories'));
    }

    /**
    * Display the specified resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function show()
    {
        $yearlyTotal = Order::selectRaw('year(created_at) year, sum(price / 100) total')
                            // ->whereRaw('year(created_at) = year(curdate())') let our customer pick
                            ->groupBy('year')
                            ->orderBy('year', 'desc')
                            ->get();

        $totalOrders = Order::selectRaw('monthname(created_at) months, year(created_at) year, sum(price / 100) total')
                            ->whereRaw('year(created_at) = year(curdate())')
                            ->groupBy('months', 'year')
                            ->orderBy('created_at')
                            ->pluck('total', 'months', 'year');

        $taxcollection = [];
        foreach($totalOrders->values() as $taxes){
            array_push($taxcollection, $taxes * 0.08);
        };
        $taxcollection = collect($taxcollection);

        $totalOrdersYearBefore = Order::selectRaw('monthname(created_at) months, year(created_at) year, sum(price / 100) total')
                            ->whereRaw('year(created_at) = year(curdate()) - 1')
                            ->groupBy('months', 'year')
                            ->orderBy('created_at')
                            ->pluck('total', 'months', 'year');

        $taxcollectionYearBefore = [];
        foreach($totalOrdersYearBefore->values() as $taxes){
            array_push($taxcollectionYearBefore, $taxes * 0.08);
        };
        $taxcollectionYearBefore = collect($taxcollectionYearBefore);

        $averageOrder = Order::selectRaw('avg(price) Average, monthname(created_at) month, year(created_at) year' )
                            ->whereRaw('year(created_at) = year(curdate())')
                            ->groupBy('month', 'year')
                            ->orderBy('created_at' )
                            ->get();

        return view('admin.panel', compact('yearlyTotal', 'totalOrders', 'taxcollection', 'totalOrdersYearBefore', 'taxcollectionYearBefore', 'averageOrder'));
    }
}