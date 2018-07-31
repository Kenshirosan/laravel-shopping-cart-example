<?php

namespace App\Http\Controllers;

use App\Order;
use App\Hideable;
// use App\Mail\ThankYou;
use Illuminate\Http\Request;

class OrderProcessedController extends Controller
{
    // testing server performance
    // public function index()
    // {
    //     $order = Order::first();

    //     \Mail::to( 'YOUR EMAIL HERE' )->send(new ThankYou($order)); // please uncomment the use statement :)
    //     return back();
    // }

    // we delete a resource but we show a previously hidden item in the view
     public function show($id)
    {
        $order = Hideable::where('order_id', $id)->firstOrFail();

        $order->delete();

        return response(['success_message', 'Success'], 200);
    }

    // we show a resource but we hide a previously visible item in the view
    public function destroy($id)
    {
        $order = Order::where('id', $id)->firstOrFail();

        if($order->isHidden()){
            return back()->with(['error_message' => 'This order is already hidden']);
        }

        Hideable::create([
            'order_id' => request('id')
        ]);

        return response(['success_message', 'Order processed'], 200);
    }
}
