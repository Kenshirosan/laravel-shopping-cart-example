<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search()
    {
        if ( !Auth::user()->isAdmin() )
        {
            return back()->with(['error_message' => 'You\'re not allowed !']);
        }

        return view('layouts.search');
    }


    public function liveSearch(Request $request)
    {

        if ( !Auth::user()->isAdmin() )
        {
            return back()->with(['error_message' => 'You\'re not allowed !']);
        }
        
        $search = $request->id;

        if (is_null($search))
        {
           return view('layouts.search');
        }
        else
        {
            $orders = Order::where('id','LIKE',"%{$search}%")
                           ->get();

            return view('layouts.searchresult', compact('orders'));
        }

    }
}
