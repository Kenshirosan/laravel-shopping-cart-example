<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class CheckController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $orders = Order::whereDay('created_at', date('d'))->orderBy('id', 'desc')->get();

        return view('pdf.userorder', compact('orders'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //
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

        $items = explode(':', $order->items);

        return view('pdf.print', compact('order', 'items'));
    }

    public function print($id)
    {
        $order = Order::find($id);
        $items = explode(':', $order->items);
        $pdf = PDF::loadView('pdf.printtest', ['order' =>$order, 'items' => $items]);
        // return $pdf->download('invoice.pdf');
        // $pdf->loadHTML($order, $items);
        return $pdf->stream('order.pdf');
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
    }
}
