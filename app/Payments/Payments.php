<?php

namespace App\Payments;

use Stripe\Stripe;
use Stripe\Charge;
use \Cart as Cart;
use Stripe\Customer;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;


class Payments extends Model
{
    /**
    * Stripe validation
    */
    public function validateStripePayment(Request $request)
    {
        // dd(request('total'));
        Stripe::setApiKey(config('services.stripe.secret'));

        $customer = Customer::create([
            'email' => request('stripeEmail'),
            'source' => request('stripeToken')
        ]);

        if(request('total')){
            $price = request('total');
        } else $price = \Cart::total();

        $charge = Charge::create([
            'customer' => $customer->id,
            'amount' => $price,
            'currency' => 'usd'
        ]);
    }
}