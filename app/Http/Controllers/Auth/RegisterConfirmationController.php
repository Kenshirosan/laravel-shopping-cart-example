<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterConfirmationController extends Controller
{

    public function index()
    {
        $user = User::where('confirmation_token', request('token'))->first();
        if(! $user) {
            return redirect('/shop')->with('error_message', 'Something wrong happened');
        }

        $user->confirm();
        Auth::login($user);

        return redirect('/edit/profile')->with('warning_message', 'Your account is now confirmed, We now need you to complete your profile if you wish to order with us');
    }
}
