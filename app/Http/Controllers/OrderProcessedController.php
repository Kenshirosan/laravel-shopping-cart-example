<?php

namespace App\Http\Controllers;

use App\Models\Order;
// use App\Mail\ThankYou;

class OrderProcessedController extends Controller
{
    // testing server performance
    // public function index()
    // {
    //     $order = Order::first();

    //     \Mail::to( 'YOUR EMAIL HERE' )->send(new ThankYou($order)); // please uncomment the use statement :)
    //     return back();
    // }

    public function create(Order $order)
    {
        $order->unhide();

        $orders = ( new Order() )->todaysOrders();

        return response($orders, 200);
    }

     public function destroy(Order $order)
    {
        if($order->isHidden()){
            return back()->with(['error_message' => 'This order is already hidden']);
        }

        $order->hide();

        $orders = ( new Order() )->todaysOrders();

        return response($orders, 200);
    }
}
