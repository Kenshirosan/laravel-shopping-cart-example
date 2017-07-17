<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use \Cart as Cart;
use App\Http\Requests;
use App\Mail\Thankyou;
use App\Events\UserOrdered;
use Illuminate\Http\Request;
use Stripe\{Stripe, Charge, Customer};
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
            $this->validatePayment();

        } catch (\Exception $e){

            return back()->with(['error_message' => $e->getMessage() ]);
        }

        $this->validateOrder($request);

        $this->processOrder($request);


        $user = Auth::user();


        Cart::destroy();
        return redirect('/thankyou')->with(['success_message' => 'Thank You ' . Auth::user()->name . ', Your order is complete, We sent you a detailed email, Please call us if you need to make a change.']);

    }


    private function checkCartIsValid()
    {
        if(Cart::total() == 0)
        {
            return back()->with(['error_message' => 'Your cart is empty !']);
        }

        if(Cart::total() < 1500)
        {
            return back()->with(['warning_message' => 'You need to order at least $15 worth of food, Your total is $' . Cart::total() /100 ]);
        }
    }


    private function validateOrder(Request $request)
    {
        $user = Auth::user();

        if (Auth::user()->email != $request->email || Auth::user()->phone_number != $request->phone_number){

            die('Something went wrong, please check your credentials or update them in the dedicated section' . ' ' .'<a href="/" >back</a>');
        }

        $rules = [
            'name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'address2' => 'nullable',
            'zipcode' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'Cart::content() => required',
            'Cart::total() => required',
        ];

        return $this->validate(request(), $rules);
    }


    private function processOrder(Request $request)
    {
        $user = Auth::user();

        $name = $request['name'];
        $last_name = $request['last_name'];
        $email = $request['email'];
        $address = $request['address'];
        $address2 = $request['address2'];
        $zipcode = $request['zipcode'];
        $phone = $request['phone_number'];
        $items = [];
        foreach(Cart::content() as $row) {
            $qty = $row->qty;
            $itemname = $row->model->name;
            echo($itemname);
            echo($qty);
            array_push($items,$qty,$itemname );
        }

        //create the Order

        $order = new Order();
        $order->user_id = $user->id;
        $order->name = $name;
        $order->last_name = $last_name;
        $order->email = $email;
        $order->address = $address;
        $order->address2 = $address2;
        $order->zipcode = $zipcode;
        $order->phone_number = $phone;
        $order->items = implode(': ',$items);
        $price = Cart::total();
        $order->price = $price;

        $order->save();

        //WORK ON EVENTS
        // event(new UserOrdered($order));
        \Mail::to($user)->send(new Thankyou($order));
    }


    private function validatePayment()
    {
        Stripe::setApiKey(config('services.stripe.secret'));


        $customer = Customer::create([
            'email' => request('stripeEmail'),
            'source' => request('stripeToken')
        ]);

        // try {

        $price = Cart::total();

        $charge = Charge::create([
            'customer' => $customer->id,
            'amount' => $price,
            'currency' => 'usd'
        ]);

        // } catch ( \Exception $e ) {

        // return back();
        // }
    }



    public function delete($order)
    {
        if( !Auth::user()->isAdmin() )
        {
            return redirect()->back()->with(['error_message' => 'You\'re not allowed !']);
        }
    }


    public function thankyou()
    {
        $user = Auth::user();

        return view('layouts.thankyou');
    }

}
