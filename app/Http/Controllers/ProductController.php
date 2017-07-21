<?php

namespace App\Http\Controllers;

use Image;
use App\User;
use App\Product;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $appetizers = Product::all()->where('category', 'Appetizers');
        $main = Product::all()->where('category', 'Main');
        $burgers = Product::all()->where('category', 'Burgers and sandwiches');
        $dessert = Product::all()->where('category', 'Dessert');
        $drinks = Product::all()->where('category', 'Drinks');

        return view('layouts.shop', compact('appetizers', 'main', 'burgers', 'dessert', 'drinks'));
    }

    public function dailyspecialIndex()
    {
        $dailys = Product::all()->where('category', 'Daily Specials');

        return view('layouts.dailySpecials', compact('dailys'));
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


    /**
    * Display the specified resource.
    *
    * @param  string  $slug
    * @return \Illuminate\Http\Response
    */
    public function showDaily($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('layouts.product', compact('product'));
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param    $product
    * @return \Illuminate\Http\Response
    */
    public function delete($product)
    {
        // only the boss can delete stuff
        if (!Auth::user()->isAdmin()) {
            return redirect()->back()->with(['error_message' => 'You\'re not allowed !']);
        }

        $product = Product::where('slug', $product)->firstOrFail();

        $product->delete();
        return redirect()->back()->with(['success_message' => 'Successfully deleted!']);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        // only the boss and employee can add products
        if (!Auth::user()->isEmployee() && !Auth::user()->isAdmin()) {
            return redirect()->back()->with(['error_message' => 'You\'re not allowed !']);
        }

        $this->validateRequest($request);

        $this->createNewProduct($request);
        
        return back()->with(['success_message' => 'Product successfully added !']);
    }


    private function validateRequest(Request $request)
    {
        $rules = [
            'name' => 'required',
            'category' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
        ];

        return $this->validate($request, $rules);
    }

    private function createNewProduct(Request $request)
    {
        $name = $request['name'];
        $category = $request['category'];
        $slug = $request['slug'];
        $description = $request['description'];
        $price = $request['price'];

        if ($request->hasFile('image')) {
            $avatar = $request->file('image');
            $image = time() . '.' . $avatar->getClientOriginalExtension();
            $path = public_path('img/' . $image);
            Image::make($avatar->getRealPath())->resize(800, 500)->save($path);

            $product = new Product();
            $product->name = $name;
            $product->category = $category;
            $product->slug = $slug;
            $product->description = $description;
            $product->price = $price;
            $product->image = $image;

            $product->save();
        }
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
