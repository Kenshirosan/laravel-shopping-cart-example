<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Order;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $orders = new Order();
        $orders = $orders->todaysOrders();

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

        $items = explode(':[\']', $order->items);
        $items = preg_replace('/[]["]/ ', '', $items);

        return view('pdf.print', compact('order', 'items'));
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

        $items = explode(':', $order->items);
        $items = preg_replace('/[]["]/ ', '', $items);

        return PDF::loadView('pdf.printtest', ['order' =>$order, 'items' => $items])
                    ->stream('order.pdf');
    }
}
