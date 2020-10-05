<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Hideable;
use Illuminate\Http\Request;

class EightySixController extends Controller
{
    public function store($id)
    {
    	request()->validate([
    		'eighty_six' => 'required|boolean'
    	]);

    	$product = Product::where('id', $id)->firstOrFail();

        $product->hide();

		return back()->with('success_message', "$product->name is 86");
    }

    public function destroy($id)
    {
    	request()->validate([
    		'eighty_six' => 'required|boolean'
    	]);

    	$product = Product::where('id', $id)->firstOrFail();

    	$product->unhide();

    	return back()->with('success_message', 'Success');
    }
}
