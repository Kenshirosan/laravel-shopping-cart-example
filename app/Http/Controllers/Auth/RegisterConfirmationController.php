<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterConfirmationController extends Controller
{

    public function index()
    {
        $user = User::where('confirmation_token', request('token'))->first();
        if(! $user) {
            return redirect(route('shop'))->with('error_message', 'Something wrong happened');
        }

        $user->confirm();

        return redirect('/shop')->with('success_message', 'Your account is now confirmed, you may start ordering !');
    }
}
