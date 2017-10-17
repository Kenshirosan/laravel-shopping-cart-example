<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Order;
use App\Hideable;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $orders = Order::whereDate('created_at', date('Y-m-d'))->orderBy('id', 'desc')->get();

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


    public function create($id)
    {
        $order = Order::find($id);

        $items = explode(':', $order->items);
        $items = preg_replace('/[]["]/ ', '', $items);

        $pdf = PDF::loadView('pdf.printtest', ['order' =>$order, 'items' => $items]);

        return $pdf->stream('order.pdf');
    }
}
