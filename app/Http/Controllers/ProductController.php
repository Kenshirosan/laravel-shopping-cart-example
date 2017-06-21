<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Product;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('layouts.shop')->with('products', $products);
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

        return view('layouts.product')->with(['product' => $product]);
    }

    public function delete($product)
    {
        $product = Product::where('slug', $product)->firstOrFail();
        if ( !Auth::user()->theboss ) {
            return redirect()->back()->with(['error_message' => 'You\'re not allowed !']);
        }
        $product->delete();
        return redirect()->back()->with(['success_message' => 'Successfully deleted!']);
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        $name = $request['name'];
        $slug = $request['slug'];
        $description = $request['description'];
        $price = $request['price'];

        if ($request->hasFile('image')) {
            $avatar = $request->file('image');
            $image = time() . '.' . $avatar->getClientOriginalExtension();
            $path = public_path('img/' . $image);
            Image::make($avatar->getRealPath())->resize(800,500)->save($path);
            // $product->image = $filename;
        }
        // $image = $request['image'];
        $product = new Product();
        $product->name = $name;
        $product->slug = $slug;
        $product->description = $description;
        $product->price = $price;
        $product->image = $image;

        $product->save();


        //redirect to homepage or somewhere else
        return back()->with(['success_message' => 'Product successfully added !']);
    }
}
