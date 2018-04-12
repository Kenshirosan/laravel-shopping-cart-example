<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Invoice;
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
    	request()->validate([
    		'name' => 'required|string',
    		'last_name' => 'required|string',
    		'address' => 'required|string',
            'address2' => 'nullable|string',
    		'zipcode' => 'required|numeric',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
    		'products' => 'required|array'
    	]);

        $products = request('products');
        $price = null;
        foreach ($products as $id) {
            $product = Product::where('id', $id)->firstOrFail();
            $price += $product->price;
        }
        $taxes = $price;
    	$invoice = Invoice::create([
            'name' => $request['name'],
            'last_name' => $request['last_name'],
            'address' => $request['address'],
            'address2' => $request['address2'],
            'zipcode' => $request['zipcode'],
            'phone_number' => formatPhoneNumber($request['phone_number']),
            'email' => $request['email'],
            'products' => implode(': ', $request['products']),
            'price' => $price,
            'taxes' => $taxes,
            'paid' => false
    	]);

        return PDF::loadView('pdf.invoice', compact('invoice'))
                    ->stream('order.pdf');
    }

    public function show($id)
    {

    }
}