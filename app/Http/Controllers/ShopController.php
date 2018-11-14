<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Product;
use App\Models\Category;
use App\Models\OptionGroup;

class ShopController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $categories = Category::with(['products' => function ($query) {
            $query->where('holiday_special', false)->with('sales')->with('groups');
        }])->get();

        if (request()->wantsJson()) {
            return response($categories, 200);
        }

        return view('layouts.shop', compact('categories'));
    }

    /**
    * Display the specified resource.
    *
    * @param  string  $slug
    * @return \Illuminate\Http\Response
    */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with('sales')->with('group')->firstOrFail();

        return view('layouts.product', compact('product'));
    }
}
