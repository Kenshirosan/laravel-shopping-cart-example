<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Events\OrderStatusChanged;

class StatusController extends Controller
{
    public function update($id)
    {
        request()->validate([
            'status_id' => 'required|numeric|digits:1'
        ]);

        $order = Order::find($id);

        $order->update([
            'status_id' => request('status_id')
        ]);

        event(new OrderStatusChanged($order));
        return redirect('/customer-orders')->with('success_message', "Order $order->id Successully updated");
    }
}
