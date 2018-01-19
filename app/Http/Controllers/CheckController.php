<?php

namespace App\Http\Controllers;

use App\Order;
use App\Status;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class CheckController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $orders = ( new Order() )->todaysOrders();

        return view('pdf.userorder', compact('orders'));
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        $currentStatus = $order->status_id;
        $items = collect(preg_replace('/[]:["]/ ', '', $order->items));
        $statuses = Status::all();

        return view('pdf.print', compact('order', 'items', 'statuses', 'currentStatus'));
    }

    /**
    * create a pdf of orders
    *
    * @param $id
    * @return DOMpdf instance
    **/
    public function create($id)
    {
        $order = Order::findOrFail($id);

        $items = collect(preg_replace('/[]:["]/', '', $order->items));

        return PDF::loadView('pdf.printtest', compact('order', 'items'))
                    ->stream('order.pdf');
    }
}