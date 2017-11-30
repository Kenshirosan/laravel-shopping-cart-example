<?php

namespace App\Http\Controllers;

use App\Hideable;
use App\Http\Requests;
use App\Mail\Thankyou;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderProcessedController extends Controller
{
    // testing server performance
    // public function index()
    // {
    //      \Mail::to( 'laurent.sama@gmail.com' )->send(new Thankyou($order = null));
    //     return back();
    // }

    // we delete a resource but we show a previously hidden item in the view
     public function show(Request $request, $order)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $order = Hideable::where('order_id', request('id'))->firstOrFail();

        $order->delete();
        return back()->with('success_message', 'Success');
    }

    // we show a resource but we hide a previously visible item in the view
    public function destroy(Request $request, $order)
    {
        $order = Order::where('id', $request->id)->firstOrFail();

        if($order->isHidden()){
            return back()->with(['error_message' => 'This order is already hidden']);
        }

        $this->validate($request, [
            'id' => 'required'
        ]);

        Hideable::create([
            'order_id' => request('id')
        ]);

        return back()->with('success_message', 'Order processed');
    }
}
