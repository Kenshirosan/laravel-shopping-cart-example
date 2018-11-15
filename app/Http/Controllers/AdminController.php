<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Category;
use App\Models\OptionGroup;
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

        $orders = Order::limit(15)->orderBy('created_at', 'desc')->get();

        if (request()->wantsJson()) {
            return response($orders, 200);
        }

        return view('admin.restaurantindex',
            compact('optionGroups', 'categories'));
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