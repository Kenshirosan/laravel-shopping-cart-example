<?php

namespace App\Listeners;

use App\User;
use App\Order;
use App\Mail\ThankYou;
use App\Events\UserOrdered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserOrderedListener implements ShouldQueue
{
    public $order;
    /**
    * Create the event listener.
    *
    * @return void
    */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
    * Handle the event.
    *
    * @param  UserOrdered  $event
    * @return void
    */
    public function handle()
    {

    }
}
