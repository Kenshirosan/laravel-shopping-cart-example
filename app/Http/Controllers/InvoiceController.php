<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class InvoiceController extends Controller
{
    public function index()
    {
    	$products = Product::all();

    	return view('admin.createInvoice', compact('products'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    	request()->validate([
            'order_type' => 'required|string',
            'pickup_time' => 'nullable|string',
    		'name' => 'required|string',
    		'last_name' => 'required|string',
    		'address' => 'required|string',
            'address2' => 'nullable|string',
    		'zipcode' => 'required|numeric',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
            'total' => 'nullable|numeric',
            'taxes' => 'nullable|numeric',
            'code' => 'nullable|string',
    		'products' => 'required|array'
    	]);

    	dd($request->all());

    	$order = Order::create([

    	]);

        return PDF::loadView('pdf.printtest', compact('order'))
                    ->stream('order.pdf');
    }

    public function show(Request $request)
    {

    }
}