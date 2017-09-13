<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use \Cart as Cart;
use App\Http\Requests;
use App\Mail\Thankyou;
use App\Payments\Payments;
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
        $total = Cart::total();
        $discount = null;
        $code = null;
        return view('layouts.payment_form', compact('total', 'discount', 'code'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        if (Cart::total() == 0) {
            return back()->with(['error_message' => 'Your cart is empty !']);
        }

        if (Cart::total() < 1500) {
            return back()->with(['warning_message' => 'You need to order at least $15 worth of food, Your total is $' . Cart::total() /100 ]);
        }

        try {
            $this->validateOrder($request);
        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        $payment = new Payments();
        try {
            $payment->validateStripePayment($request);
        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        try {
            $this->processOrder($request);
        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        Cart::destroy();

        return redirect('/thankyou')->with(['success_message' => 'Thank You ' . Auth::user()->name . ', Your order is complete, We sent you a detailed email, Please call us if you need to make a change.']);
    }

     private function checkCartIsValid()
    {

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
            'total' => 'nullable',
            'code' => 'nullable',
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
            $options = $row->options;
            echo ($options);
            echo($itemname);
            echo($qty);
            array_push($items, $qty, $itemname, $options);
        }

        if(request('total')){
            $price = request('total');
        }
        else $price = Cart::total();

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
            'price' => $price
        ]);

        if($code = request('code')){
            \Promocodes::apply($code);
            \Promocodes::disable($code);
        }

        //WORK ON EVENTS
        // event(new UserOrdered($order));
        \Mail::to( auth()->user()->email )->send(new Thankyou($order));
    }

    /**
    * delete the specified resource
    */
    public function delete($order) //unused unless someone asks for it, just don't want orders to be deleted. route protection
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back()->with(['error_message' => 'Page not found!']);
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