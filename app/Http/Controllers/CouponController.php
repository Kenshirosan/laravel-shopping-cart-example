<?php

namespace App\Http\Controllers;

use App\User;
use App\Promocode;
use \Cart as Cart;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $coupons = Promocode::all();

        return view('layouts.createCoupon', compact('coupons'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'quantity' => 'required',
            'reward' => 'required'
        ]);

        $quantity = request('quantity');
        $reward = request('reward');

        \Promocodes::createDisposable($quantity, $reward, $data = [], $expires_in = null);
        return back()->with('success_message', 'Coupons created');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'coupon' => 'required'
        ]);

        $code = request('coupon');

        if( ! \Promocodes::check($code) ){
            return back()->with('error_message', 'This code has already been used');
        }

        $validCode = Promocode::where('code', $code)->firstOrFail();

        $discount = $validCode->reward / 100;
        $oldTotal =  Cart::subtotal();
        $discountValue = Cart::subtotal() * $discount;

        $subtotal = $oldTotal - $discountValue;
        $taxes = $subtotal * 0.08;
        $total = intval($subtotal + $taxes, 0);

        session()->flash('success_message', 'Your coupon has been applied');
        return view('layouts.payment_form', compact('total', 'discount', 'code'));
    }
}
