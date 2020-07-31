<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Product;
use App\Models\Category;
use App\Models\OptionGroup;
use \Cart;

class ShopController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response|\Illuminate\View\View
    */
    public function index()
    {
        $categories = Category::with(['products' => function ($query) {
            $query->where('holiday_special', false)->with('sales')->with('groups');
        }])->get();

        if (request()->wantsJson()) {
            header('Content-Type: application/json');
            header("Access-Control-Allow-Origin: *");
            return response($categories, 200);
        }

        return view('layouts.alternate', compact('categories'));
    }

    /**
    * Display the specified resource.
    *
    * @param  string  $slug
    * @return \Illuminate\Http\Response
    */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with('sales')->with('groups')->firstOrFail();

        return view('layouts.product', compact('product'));
    }

    public function alternate()
    {
        $categories = Category::with(['products' => function ($query) {
            $query->where('holiday_special', false)->with('sales')->with('groups');
        }])->get();

        if (request()->wantsJson()) {
            header('Content-Type: application/json');
            header("Access-Control-Allow-Origin: *");
            return response($categories, 200);
        }

        return view('layouts.alternate', compact('categories'));
    }

    public function today() {
        return response(Product::where('today', true)->pluck('image')->toArray(), 200);
    }
}
