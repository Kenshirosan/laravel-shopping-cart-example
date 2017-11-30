<?php

namespace App\Http\Controllers;

use App\Option;
use App\Product;
use App\Category;
use App\OptionGroup;
use App\HolidayTitle;

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
            $query->where('holiday_special', false);
        }])->get();

        return view('layouts.shop', compact('categories', 'title'));
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
