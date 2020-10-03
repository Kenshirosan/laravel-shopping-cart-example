<?php

namespace App\Http\Controllers;

use \Cart as Cart;
use App\Models\Promocode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CouponRequest;
use Gabievi\Promocodes\Facades\Promocodes;

class CouponController extends Controller
{
    public function index()
    {
        $attr = ['expires_at' => null, 'is_disposable' => true];
        $coupons = Promocode::where($attr)->get();

        $couponsForAll = Promocode::where('is_disposable', false)->get();

        if (request()->wantsJson() && request()->path() === 'create-coupon') {
            return response($coupons, 200);
        }

        if (request()->wantsJson() && request()->path() === 'create-disposable-coupon') {
            return response($couponsForAll, 200);
        }

        return view('admin.createCoupon');
    }

    /**
     * Store new coupons
     *
     * @param CouponRequest $request
     * @return json response
     */
    public function store(CouponRequest $request)
    {
        $quantity = request('quantity');
        $reward = request('reward');
        Promocodes::createDisposable($quantity, $reward, $data = [], $expires_in = null);

        $attr = ['expires_at' => null, 'is_disposable' => true];
        $coupons = Promocode::where($attr)->get();

        return response($coupons, 200);
    }

    public function storeCouponsForEveryone(CouponRequest $request)
    {
        $quantity = request('quantity');
        $reward = request('reward');
        Promocodes::create($quantity, $reward, $data = [], $expires_in = null);

        $couponsForAll = Promocode::where('is_disposable', false)->get();

        return response($couponsForAll, 200);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'coupon' => 'required|string|exists:promocodes,code'
        ]);

        $code = request('coupon');

        if (!$validCode = Promocode::where('code', $code)->first()){
            $message = 'This coupon has expired';
            return response()->json(['message' => $message], 403);
        }

        if( ! \Promocodes::check($code) && $validCode->is_disposable){
            $message = 'This coupon has already been used';
            return response()->json(['message' => $message], 403);
        }

        $validCode = Promocode::where('code', $code)->firstOrFail();

        Cart::setGlobalDiscount($validCode->reward);

        $data = [
            'code' => $validCode->code,
            'tax' => Cart::tax(),
            'subtotal' => Cart::subtotal(),
            'total' => Cart::total(),
            'discount' => Cart::discount()
        ];

        return response( compact('data'), 200);
    }

    public function destroy($id)
    {
        $coupon = Promocode::where('id', $id);

        $coupon->user_id = '';

        $coupon->delete();

        if(request()->server('REQUEST_URI') === "/create-coupon/$id") {
            $attr = ['expires_at' => null, 'is_disposable' => true];
            $coupons = Promocode::where($attr)->get();

            return response($coupons, 200);
        }

        $couponsForAll = Promocode::where('is_disposable', false)->get();

        return response($couponsForAll, 200);
    }
}
