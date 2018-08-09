<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view('admin.search');
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

            return view('admin.searchresult', compact('orders', 'count'));
        }

        $this->validate($request ,[
            'term' => 'required|string'
        ]);

        $orders = Order::where('last_name', 'LIKE', "%{$request->term}%")->get();
        $count = 1;

        return view('admin.searchresult', compact('orders', 'count'));
    }
}
