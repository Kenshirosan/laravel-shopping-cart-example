<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return $allOrders = Order::whereRaw("user_id = $user->id and created_at < curdate()")
                        ->orderBy('created_at', 'desc')
                        ->paginate(8);
    }
}
