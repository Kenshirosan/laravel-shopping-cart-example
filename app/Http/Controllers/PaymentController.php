<?php

namespace App\Http\Controllers;

use App\Events\UserOrdered;
use App\Http\Requests\PaymentRequest;
use App\Mail\ThankYou;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Promocode;
use App\Payments\Payments;
use App\Logger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use \Carbon\Carbon;
use \Cart as Cart;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $total = Cart::total();

        if(request()->wantsJson()) {
            $cartdata = [
                'tax' => Cart::tax(),
                'subtotal' => Cart::subtotal(),
                'total' => Cart::total(),
                'discount' => Cart::discount()
            ];

            return response($cartdata, 200);
        }

        return view('layouts.payment_form', compact('total'));
    }

    /**
     *
     * Checks time validity for pick up order
     */
    private function checkTimeValidity()
    {
        $inThirtyMinutes = Carbon::createFromFormat('H:i:s', Carbon::now()->toTimeString())->addMinutes(30);
        $pickup_time = Carbon::createFromFormat('H:i', request('pickup_time'));
        $minTime = Carbon::createFromFormat('H:i', "11:00");
        $maxTime = Carbon::createFromFormat('H:i', "22:00");

        $error = false;
        $error_message = '';

        if ($pickup_time < $minTime) {
            $error = true;
            $error_message = 'Sorry, this is too early';
        }

        if ($pickup_time < $inThirtyMinutes) {
            $error = true;
            $error_message = 'Sorry but You can\'t pick up earlier than ' . $inThirtyMinutes->toTimeString();
        }

        if ($pickup_time > $maxTime) {
            $error = true;
            $error_message = 'Sorry but You can\'t pick up later than ' . $maxTime->toTimeString();
        }

        return ['error' => $error, 'error_message' => $error_message];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PaymentRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(PaymentRequest $request)
    {
        $errors = $this->checkTimeValidity();

        if ((request('order_type') === 'Pick-up') && ($errors['error'])) {
            return redirect('/checkout')->with('error_message', $errors['error_message']);
        }
// Mettre un double try catch avec une transaction sql
         try {
             (new Payments())->validateStripePayment();
             (new Logger('Payment successful'));
         } catch (\Exception $e) {
             (new Logger('Something wrong happened with the payment of an order', 'Error, please check your site.'));
             return back()->with(['error_message' => $e->getMessage()]);
         }

        try {
            $this->processOrder($request);
        } catch (\Exception $e) {
            (new Logger('Something wrong happened while processing and order', 'Error, please check your site.'));
            return back()->with(['error_message' => $e->getMessage()]);
        }

        Cart::destroy();

        return redirect("/edit/profile")->with("success_message", "Thank You " . Auth::user()->name . ", Your order is complete, We sent you a detailed email, Please call us if you need to make a change.");
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    private function processOrder()
    {
        $cart = Cart::content()->toArray();

        $items = [];
        foreach ($cart as $row) {
            $items[] = json_encode($row);
        }

        $pickup_time = null;

        if (request('order_type') === 'Pick-up') {
            $pickup_time = Carbon::createFromFormat('H:i', request('pickup_time'))->toTimeString();
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
            'items' => json_encode($items),
            'price' => Cart::total() * 100,
            'taxes' => Cart::tax() * 100,
            'comments' => request('comments')
        ]);
// ICI A CHANGER
// TODO: Fix option way of doing this.
        foreach ($cart as $row) {
            $way = null;
            if ($row['options']['options']['way']) {
                $way = $row['options']['options']['way'];
            }
            if ($row['options']['options']['options']) {
                foreach ($row['options']['options']['options'] as $option) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $row['id'],
                        'qty' => $row['qty'],
                        'cart_row_id' => $row['rowId'],
                        'option_group_id' => $option['pivot']['option_group_id'],
                        'option_id' => $option['id'],
                        'wayofcooking' => $way
                    ]);
                }
            }
            else {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $row['id'],
                    'qty' => $row['qty'],
                    'cart_row_id' => $row['rowId'],
                    'wayofcooking' => $way
                ]);
            }
        }


        if ($code = request('code')) {
            $promocode = Promocode::where('code', $code)->firstOrFail();
            if ($promocode && $promocode->is_disposable) {
                \Promocodes::apply($code);

                \Promocodes::disable($code);
                \Promocodes::clearRedundant();
            }
        }

        event(new UserOrdered($order)); // ready for real-time
        (new Logger('Une commande a été passé'));

        $user_email = auth()->user()->email;
        if(env('APP_ENV') == 'local') {
            $user_email = env('MAIL_FROM_ADDRESS');
        }

        return Mail::to($user_email)->send(new ThankYou($order));
    }

    /**
     * delete the specified resource
     * unused unless someone asks for it, don't want orders to be deleted. route protection
     */
    public function delete(Order $order)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back()->with(['error_message' => 'Page not found!']);
        }
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function deleteUserCoupon()
    {
        Cart::setGlobalDiscount(0);

        return response([], 200);
    }
}
