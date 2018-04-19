<?php

namespace App\Http\Controllers;

use App\Promocode;
use \Cart as Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CouponRequest;

class CouponController extends Controller
{
    public function index()
    {
        $attr = ['expires_at' => null, 'is_disposable' => true];
        $coupons = Promocode::where($attr)->get();

        $couponsForAll = Promocode::where('is_disposable', false)->get();

        return view('layouts.createCoupon', compact('coupons', 'couponsForAll'));
    }


    public function store(CouponRequest $request)
    {
        $quantity = request('quantity');
        $reward = request('reward');
        \Promocodes::createDisposable($quantity, $reward, $data = [], $expires_in = null);

        return back()->with('success_message', 'Coupons created');
    }

    public function storeCouponsForEveryone(CouponRequest $request)
    {
        $quantity = request('quantity');
        $reward = request('reward');
        \Promocodes::create($quantity, $reward, $data = [], $expires_in = null);

        return back()->with('success_message', 'Coupons created');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'coupon' => 'required'
        ]);

        $code = request('coupon');

        if (!$validCode = Promocode::where('code', $code)->first()){
            return back()->with('warning_message', 'This coupon has expired');
        }

        if( ! \Promocodes::check($code) &&  $validCode->is_disposable){
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
        // that shit has crached sometimes and I dunno why.. URL related, sent a response code of 1, then started working again.. hhhhhmmmmmmmm
        return view('layouts.payment_form', compact('total', 'discount', 'code'));
        // return redirect('/checkout')->with(compact('total', 'discount', 'code'));
                                    // ->with('success_message', 'Your coupon has been applied');
    }

    public function destroy($id)
    {
        $coupon = Promocode::where('id', $id);

        $coupon->user_id = '';
        $coupon->delete();

        return back()->with('success_message', 'Coupon deleted');
    }
}
