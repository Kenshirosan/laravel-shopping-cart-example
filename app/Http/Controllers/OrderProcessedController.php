<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Hideable;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderProcessedController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

     public function show(Request $request, $order)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $order = Hideable::where('order_id', request('id'));

        $order->delete();
        return back()->with('success_message', 'Success');
    }

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
