<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Payment;
use App\Http\Requests;
use \Cart as Cart;
use Illuminate\Http\Request;
// use App\Mail\Order;

class PaymentController extends Controller
{
    public function index()
    {
        return view('layouts.payment_form');
    }

    public function store(Request $request)
    {
        $data = $request->session('cart');

        $this->validate($request, [
            'name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'address2' => 'nullable',
            'zipcode' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            // 'items' => 'required',
            // 'price' => 'required',
        ]);

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
            $itemname = $row->model->slug;
            array_push($items,$qty,$itemname );
        }
        $price = Cart::total();

        //create the User
        // $user = User::create(request([$name, $email, $password]));
        $order = new Payment();
        $order->name = $name;
        $order->last_name = $last_name;
        $order->email = $email;
        $order->address = $address;
        $order->address2 = $address2;
        $order->zipcode = $zipcode;
        $order->phone_number = $phone;
        $order->items = implode(': ',$items);
        $order->price = $price;

        $order->save();
        Cart::destroy();
        return redirect('/thankyou')->with(['success_message' => 'Thank You, Your order is complete, We sent you a detailed email, Please call us if you need to make a change.']);
    }

    public function thankyou()
    {
        $user = Auth::user();
        return view('layouts.thankyou');
    }

}
