<?php

namespace App\Http\Controllers;

use DB;
use Image;
use App\User;
use App\Order;
use App\Photo;
use App\Option;
use App\Product;
use App\Hideable;
use App\OptionGroup;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index()
    {
        if(!Auth::user()->isAdmin()){
            return redirect('/shop');
        }

        $options = Option::all();
        $optionGroups = OptionGroup::all();
        $orders = Order::limit(5)->orderBy('created_at', 'desc')->get();

        return view('admin.restaurantindex', compact('orders', 'options', 'optionGroups'));
    }

    /**
    * Display the specified resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function show()
    {
        if(!Auth::user()->isAdmin()){
            return redirect('/shop');
        }

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
