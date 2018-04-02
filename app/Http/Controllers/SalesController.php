<?php

namespace App\Http\Controllers;

use App\Sales;
use App\Product;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
    	$products = Product::all();
    	$sales = Sales::with('products')->get();

    	return view('admin.sales', compact('products', 'sales'));
    }

    public function store(Request $request)
    {
    	try {
	    	request()->validate([
	            'percentage' => 'required|digits:2|numeric',
	    		'product_id' => 'required|exists:products,id',
	    	]);

	    	$percentage = request('percentage') / 100;
	    	Sales::create([
	    		'product_id' => request('product_id'),
	    		'percentage' => $percentage
	    	]);

	    	return back()->with("flash", "Success");

    	} catch (\Exception $e) {
    		$e->getMessage();
    	}
    }

    public function destroy($id)
    {
    	$sale = Sales::where('id', $id)->firstOrFail();

    	$sale->delete();

    	return redirect('/sales')->with("flash", "Success");
    }
}
