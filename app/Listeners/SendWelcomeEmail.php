<?php

namespace App\Listeners;

use App\User;
use App\Mail\Welcome;
use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail implements ShouldQueue
{
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $user)
    {
        // dd($user->user->email);
        \Mail::to($user->user->email)->send(new Welcome($user));
    }
}
