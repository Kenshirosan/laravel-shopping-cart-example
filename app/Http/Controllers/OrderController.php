<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade as PDF;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return Order::whereRaw("user_id = $user->id and created_at < curdate()")
                        ->orderBy('created_at', 'desc')
                        ->paginate(8);
    }

    public function show($id)
    {
        $order = Order::where('id', $id)->firstOrFail();

        return PDF::loadView('pdf.printtest', compact('order'))
                    ->stream('order.pdf');
    }
}
