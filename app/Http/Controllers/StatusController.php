<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

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

        return back()->with('success_message', 'Successully updated');
    }
}
