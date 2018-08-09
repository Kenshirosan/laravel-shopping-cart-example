<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return $allOrders = Order::whereRaw("user_id = $user->id and created_at < curdate()")
                        ->orderBy('created_at', 'desc')
                        ->paginate(8);
    }

    public function show($id)
    {
        $order = Order::where('id', $id)->firstOrFail();

        $items = collect(regex($order->items));

        return PDF::loadView('pdf.printtest', compact('order', 'items'))
                    ->stream('order.pdf');
    }
}
