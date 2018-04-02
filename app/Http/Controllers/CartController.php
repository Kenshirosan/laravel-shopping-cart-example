<?php

namespace App\Http\Controllers;

use App\Option;
use App\Product;
use \Cart as Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        if(request()->expectsJson()) {
            return response([Cart::content(), Cart::total()], 200);
        }

        return view('layouts.cart');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        if(auth()->check() && auth()->user()->isEmployee()){
            return response('You are not allowed', 403);
        }

        request()->validate([
            'id' => 'required|exists:products,id',
            'name' => 'required|string|exists:products,name',
            'quantity' => 'required|numeric|digits:1|max:6',
            'price' => 'required|numeric',
            'option' => 'nullable|string|exists:options,name',
        ]);

        $duplicates = Cart::search(function ($cartItem, $rowQty) use ($request){
            return $cartItem->id === $request->id && $cartItem->qty === 6;
        });

        if (!$duplicates->isEmpty()) {
            return response('You\'ve reached the maximum quantity allowed', 403);
        }

        if($request->option == null) {
            Cart::add($request->id, $request->name, 1, $request->price )->associate(Product::class);
            return response([], 200);
        } else {
            Cart::add($request->id, $request->name, 1, $request->price, [ $request->option ] )->associate(Product::class);
            return response([], 200);
        }

        if(!$request->expectsJson()) {
            return redirect('/cart')->with('success_message',  "$request->name added !");
        }
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\JsonResponse
    */
    public function update(Request $request, $id)
    {
        if(auth()->check() && auth()->user()->isEmployee()){
            return response('You are not allowed', 403);
        }

        try {
            request()->validate([
                'quantity' => 'required|numeric|between:1,6'
            ]);

            Cart::update($id, $request->quantity);
            session()->flash('flash', 'Quantity was updated successfully!');

            if($request->expectsJson()) {
                return response([], 200);
            }
            return redirect('/cart');

        } catch(Exception $e) {
            return redirect('/cart')->with('flash', 'Something wrong happened.');
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        Cart::remove($id);

        return redirect('/cart')->with('flash', 'Item has been removed!');
    }

    /**
    * Remove the resource from storage.
    *
    * @return \Illuminate\Http\Response
    */
    public function emptyCart()
    {
        Cart::destroy();

        if(request()->expectsJson()) {
            return response([], 200);
        }

        return redirect('/cart')->with('flash', 'Your cart has been cleared!');
    }

    /**
    * Switch item from shopping cart to wishlist.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function switchToWishlist($id)
    {
        $item = Cart::get($id);
        // dump($item);
        // Cart::instance('wishlist')->remove($id);

        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });
        // dump($duplicates);
        if (!$duplicates->isEmpty()) {
            return redirect('wishlist')->with('flash', 'Item is already in your Wishlist!');
        }

        // dd(request()->all());
        Cart::instance('wishlist')->add(['id' => $item->id, 'name' => $item->name, 'qty' => 1, 'price' => $item->price, $item->options])
            ->associate('App\Product');

        // Cart::destroy();
        return redirect('wishlist')->with('flash', 'Item has been moved to your Wishlist!');
    }
}
