<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index()
    {
        return view('layouts.search');
    }


    public function show(Request $request)
    {
        if($term = intval($request->term)) {
            $this->validate($request ,[
                'term' => 'required|numeric'
            ]);

            // Dunno which query is better.. let the customer decide ?
            // $orders = Order::where('id', 'LIKE', "%{$term}%")->get();
            $orders = Order::where('id', $term)->get();
            $count = 1;

            return view('layouts.searchresult', compact('orders', 'count'));
        }

        $this->validate($request ,[
            'term' => 'required|string'
        ]);

        $orders = Order::where('last_name', 'LIKE', "%{$request->term}%")->get();
        $count = 1;

        return view('layouts.searchresult', compact('orders', 'count'));
    }
}
