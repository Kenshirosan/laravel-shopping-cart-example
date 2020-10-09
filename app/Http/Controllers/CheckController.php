<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class CheckController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
    */
    public function index()
    {
        $orders = ( new Order() )->todaysOrders();

        if (request()->wantsJson()) {
            return response($orders, 200);
        }

        return view('pdf.userorder');
    }

    public function processed()
    {
        return (new Order() )->numberOfOrdersProcessedToday();
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Order $order)
    {
        $currentStatus = $order->status_id;
        $statuses = Status::all();

        return view('pdf.print', compact('order', 'statuses', 'currentStatus'));
    }

    /**
     * create a pdf of orders
     *
     * @param Order $order
     * @return DOMpdf instance
     */
    public function create(Order $order)
    {
        $items = $order->getProducts();
        return PDF::loadView('pdf.printtest', compact('order', 'items'))
                    ->stream('order.pdf');
    }
}
