<?php

namespace App\Http\Controllers;

use App\Order;
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
        return back()->with('success_message', 'Successully updated');
    }
}
