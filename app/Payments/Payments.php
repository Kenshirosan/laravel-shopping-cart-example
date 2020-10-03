<?php

namespace App\Payments;

use Stripe\Stripe;
use Stripe\Charge;
use \Cart as Cart;
use Stripe\Customer;
use Illuminate\Database\Eloquent\Model;


class Payments extends Model
{
    /**
    * Stripe validation
    */
    public function validateStripePayment()
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $customer = Customer::create([
            'email' => request('email'),
            'source' => request('stripeToken')
        ]);

        $price = Cart::total() * 100;

        $charge = Charge::create([
            'customer' => $customer->id,
            'amount' => $price,
            'currency' => 'usd'
        ]);
    }
}
