<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('layouts.search');
    }


    public function show(Request $request)
    {
        $search = $request->id;

        if (is_null($search)) {
            return view('layouts.search');
        } else {
            $orders = Order::where('id', 'LIKE', "%{$search}%")
                           ->get();

            return view('layouts.searchresult', compact('orders'));
        }
    }
}
