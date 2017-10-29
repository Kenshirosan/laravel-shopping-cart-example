<?php

namespace App\Listeners;

use App\User;
use App\Events\UserOrdered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendThankYouEmail implements ShouldQueue
{
    public $order;
    /**
    * Create the event listener.
    *
    * @return void
    */
    public function __construct()
    {

    }

    /**
    * Handle the event.
    *
    * @param  UserOrdered  $event
    * @return void
    */
    public function handle(UserOrdered $order)
    {
        $order = Auth::user()->order;
        $user = Auth::user();
        \Mail::to($user)->send(new Thankyou($order));
    }
}
