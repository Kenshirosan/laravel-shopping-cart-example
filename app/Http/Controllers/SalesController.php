<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Product;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        $products = Product::with('sales')->get();

        if (request()->wantsJson()) {
            return response($products, 200);
        }

    	return view('admin.sales');
    }

    public function store(Request $request)
    {
            request()->validate([
                'percentage' => 'required|digits:2|numeric',
                'product_id' => 'required|exists:products,id',
            ]);

            $percentage = request('percentage') / 100;

            Sales::create([
                'product_id' => request('product_id'),
                'percentage' => $percentage
            ]);

            $products = Product::with('sales')->get();

	    	return response($products, 200);
    }

    public function destroy($id)
    {
    	$sale = Sales::where('id', $id)->firstOrFail();

    	$sale->delete();

        $products = Product::with('sales')->get();

    	return response($products, 200);
    }
}
