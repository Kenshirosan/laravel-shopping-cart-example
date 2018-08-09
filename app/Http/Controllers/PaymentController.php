<?php

namespace App\Http\Controllers;

use \Cart as Cart;
use \Carbon\Carbon;
use App\User;
use App\Models\Order;
use App\Mail\ThankYou;
use App\Models\Promocode;
use App\Payments\Payments;
use App\Events\UserOrdered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PaymentRequest;


class PaymentController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $total = Cart::total();
        $discount = null;
        $code = null;
        // $action = auth()->user()->isAdmin() ? '/create-invoice' : '';

        return view('layouts.payment_form', compact('total', 'discount', 'code'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(PaymentRequest $request)
    {
        if (request('order_type') === 'Pick-up') {
            $now =  Carbon::createFromFormat('H:i:s', Carbon::now()->toTimeString())->addMinutes(30);
            $pickup_time = Carbon::createFromFormat('H:i', request('pickup_time'));
            $minTime = Carbon::createFromFormat('H:i', "11:00");
            $maxTime = Carbon::createFromFormat('H:i', "22:00");

            switch ($pickup_time) {
                case $pickup_time < $minTime:
                    return redirect('/checkout')->with('error_message', 'Sorry, this is too early');
                    break;

                case $pickup_time < $now:
                    return redirect('/checkout')->with('error_message', 'Sorry but You can\'t pick up earlier than ' . $now->toTimeString());
                    break;

                case $pickup_time >= $maxTime:
                    return redirect('/checkout')->with('error_message', 'Sorry, this is too late');
                    break;
                default:
                    continue;
                    break;
            }
        }

        try {
            ( new Payments() )->validateStripePayment($request);
        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        try {
            $this->processOrder($request);
        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage()]);
        }

        Cart::destroy();

        return redirect("/edit/profile")->with("success_message", "Thank You " . Auth::user()->name . ", Your order is complete, We sent you a detailed email, Please call us if you need to make a change.");
    }

    /**
    * @param \Illuminate\Http\Request $request
    *
    * @return \Illuminate\Http\Response
    */
    private function processOrder(Request $request)
    {
        $items = [];
        foreach (Cart::content() as $row) {
            $qty = $row->qty;
            $itemname = $row->model->name;
            if($row->options) {
                $options = $row->options;
            }

            array_push($items, $qty, $itemname, $options);
        }

        if(request('total')){
            $price = request('total');
            $taxes = request('total') * 0.08;
        }
        else {
            $price = Cart::total();
            $taxes = Cart::tax();
        }

        if (request('order_type') === 'Pick-up') {
            $pickup_time = Carbon::createFromFormat('H:i', request('pickup_time'))->toTimeString();
        }
        else {
            $pickup_time = null;
        }

        $order = Order::create([
            'order_type' => request('order_type'),
            'pickup_time' => $pickup_time,
            'user_id' => auth()->id(),
            'name' => request('name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'address' => request('address'),
            'address2' => request('address2'),
            'zipcode' => request('zipcode'),
            'phone_number' => request('phone_number'),
            'items' => implode(': ', $items),
            'price' => $price,
            'taxes' => $taxes,
            'comments' => request('comments')
        ]);

        if($code = request('code')) {
            $promocode = Promocode::where('code', $code)->firstOrFail();
            if ($promocode && $promocode->is_disposable) {
                \Promocodes::apply($code);

                \Promocodes::disable($code);
                \Promocodes::clearRedundant();
            }
        }

        event(new UserOrdered($order)); // ready for real-time :) fully working !!

        return Mail::to( auth()->user()->email )->send(new ThankYou($order));
    }

    /**
    * delete the specified resource
    * unused unless someone asks for it, just don't want orders to be deleted. route protection
    */
    public function delete($order)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back()->with(['error_message' => 'Page not found!']);
        }
    }
}