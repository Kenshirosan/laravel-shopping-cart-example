<?php

namespace App\Http\Controllers;

use App\Product;
use App\Hideable;
use Illuminate\Http\Request;

class EightySixController extends Controller
{
    public function store($id)
    {
    	request()->validate([
    		'eighty_six' => 'required|boolean'
    	]);

    	$product = Product::where('id', $id)->firstOrFail();

    	Hideable::create([
    		'product_id' => $product->id
    	]);

		return back()->with('success_message', "$product->name is 86");
    }

    public function destroy($id)
    {
    	request()->validate([
    		'eighty_six' => 'required|boolean'
    	]);

    	$hideable = Hideable::where('product_id', $id)->firstOrFail();

    	$hideable->delete();

    	return back()->with('success_message', 'Success');
    }
}