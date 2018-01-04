<?php

namespace App\Http\Controllers;

use Validator;
use App\Option;
use App\Product;
use \Cart as Cart;
use App\Http\Requests;
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

        if($request->option != null) {
            Cart::add($request->id, $request->name, 1, $request->price, [ $request->option ] )->associate(Product::class);
        } else {
            Cart::add($request->id, $request->name, 1, $request->price )->associate(Product::class);
        }

        if( !$request->expectsJson()) {
            return redirect('/shop')->with('success_message',  "$request->name added !");
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

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,6'
        ]);

        if ($validator->fails()) {
            session()->flash('error_message', 'Quantity must be between 1 and 6.');
            response()->json(['success' => false]);
            return response()->view('layouts.cart', $request, 403);
        }

        Cart::update($id, $request->quantity);
        session()->flash('flash', 'Quantity was updated successfully!');
        response()->json(['success' => true]);
        return response()->view('layouts.cart', $request, 200);
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
