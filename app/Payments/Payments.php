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
        Stripe::setApiKey(config('services.stripe.secret'));

        $customer = Customer::create([
            'email' => request('email'),
            'source' => request('stripeToken')
        ]);

        if(request('total')){
            $price = request('total');
        } else {
            $price = \Cart::total() / 100;
        }

        $charge = Charge::create([
            'customer' => $customer->id,
            'amount' => $price,
            'currency' => 'usd'
        ]);
    }
}