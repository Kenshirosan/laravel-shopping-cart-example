<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use Stripe\Stripe;
use Stripe\Charge;
use \Cart as Cart;
use Stripe\Customer;
use App\Http\Requests;
use App\Mail\Thankyou;
use App\Events\UserOrdered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('layouts.payment_form');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $this->checkCartIsValid();

         try {
        $this->validateOrder($request);
        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        try {
            $this->validateStripePayment();
        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        try {
        $this->processOrder($request);
        }
        catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        Cart::destroy();

        return redirect('/thankyou')->with(['success_message' => 'Thank You ' . Auth::user()->name . ', Your order is complete, We sent you a detailed email, Please call us if you need to make a change.']);
    }


    private function checkCartIsValid()
    {
        if (Cart::total() == 0) {
            return back()->with(['error_message' => 'Your cart is empty !']);
        }

        if (Cart::total() < 1500) {
            return back()->with(['warning_message' => 'You need to order at least $15 worth of food, Your total is $' . Cart::total() /100 ]);
        }
    }


    /**
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    private function validateOrder(Request $request)
    {
        return $this->validate($request, [
            'name' => 'required|exists:users,name',
            'last_name' => 'required|exists:users,last_name',
            'address' => 'required',
            'address2' => 'nullable',
            'zipcode' => 'required',
            'phone_number' => 'required|exists:users,phone_number',
            'email' => 'required|exists:users,email',
            'Cart::content() => required',
            'Cart::total() => required',
        ]);
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
            echo($itemname);
            echo($qty);
            array_push($items, $qty, $itemname);
        }
        $order = Order::create([
            'user_id' => auth()->id(),
            'name' => request('name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'address' => request('address'),
            'address2' => request('address2'),
            'zipcode' => request('zipcode'),
            'phone_number' => request('phone_number'),
            'items' => implode(': ', $items),
            'price' => Cart::total()
        ]);
        //WORK ON EVENTS
        // event(new UserOrdered($order));
        \Mail::to(auth()->user()->email)->send(new Thankyou($order));
    }

    /**
    * Stripe validation
    */
    private function validateStripePayment()
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $customer = Customer::create([
            'email' => request('stripeEmail'),
            'source' => request('stripeToken')
        ]);

        $price = Cart::total();

        $charge = Charge::create([
            'customer' => $customer->id,
            'amount' => $price,
            'currency' => 'usd'
        ]);
    }

    /**
    * delete the specified resource
    */
    public function delete($order) //unused / just a protection
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back()->with(['error_message' => 'You\'re not allowed !']);
        }
    }

    /**
    * redirect after successful payment
    */
    public function thankyou()
    {
        return view('layouts.thankyou');
    }
}