<?php

namespace App\Http\Controllers;

use App\Order;
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
        $optionGroups = OptionGroup::all();
        $secondOptionGroups = SecondOptionGroup::all();
        $orders = Order::limit(5)->orderBy('created_at', 'desc')->get();

        return view('admin.restaurantindex',
            compact('orders', 'optionGroups', 'secondOptionGroups', 'categories'));
    }

    /**
    * Display the specified resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function show()
    {
        $orders = new Order();

        $yearlyTotal = $orders->yearlyTotal();

        $totalOrders = $orders->totalOrders();

        $taxcollection = $orders->taxCollection();

        $totalOrdersYearBefore = $orders->totalOrdersYearBefore();

        $taxcollectionYearBefore = $orders->taxCollectionYearBefore();

        $averageOrder = $orders->averageOrder();

        return view('admin.panel',
            compact('yearlyTotal', 'totalOrders', 'taxcollection', 'totalOrdersYearBefore',
            'taxcollectionYearBefore', 'averageOrder'));
    }
}