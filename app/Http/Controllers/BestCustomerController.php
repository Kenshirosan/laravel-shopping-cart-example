<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BestCustomerController extends Controller
{
    public function index()
    {
        $user_count = User::where('confirmed', true)->count();

        $bestCustomers = Order::selectRaw('year(created_at) year, sum(price) total,user_id, name, last_name, email')
                            ->whereRaw('year(created_at) = year(curdate())')
                            ->groupBy('user_id','email', 'last_name','name', 'year')
                            ->orderBy('total', 'desc')
                            ->get();

        return view('admin.bestcustomers', compact('user_count', 'bestCustomers'));
    }
}
