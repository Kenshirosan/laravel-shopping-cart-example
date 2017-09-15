<?php

namespace App\Http\Controllers;

use App\Option;
use App\Product;

class ShopController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $appetizers = Product::where('category', 'Appetizers')->get();
        $main = Product::where('category', 'Main')->get();
        $burgers = Product::where('category', 'Burgers and sandwiches')->get();
        $dessert = Product::where('category', 'Desserts')->get();
        $drinks = Product::where('category', 'Drinks')->get();
        $dailys = Product::where('category', 'Daily Specials')->get();

        return view('layouts.shop', compact('appetizers', 'main', 'burgers', 'dessert', 'drinks', 'dailys'));
    }

    /**
    * Display the specified resource.
    *
    * @param  string  $slug
    * @return \Illuminate\Http\Response
    */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('layouts.product', compact('product'));
    }

    // public function getPrices()
    // {
    //     $prices = Product::all();  //UNUSED, BUT WILL BE ONE DAY....
    //     foreach($prices as $product){
    //         // echo($product->price . ' ');
    //         return number_format(($product->price /100), 2, '.', ' ') . ' ' ;
    //     }
    // }
}
