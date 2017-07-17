<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('layouts.userprofile', compact('user'));
    }

    public function edit(Request $request, $id)
    {
        $user = Auth::user();

        $this->validate($request, [
            'address' =>'required',
            'address2' => 'nullable',
            'zipcode' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
        ]);

        $user->address = $request->address;
        $user->address2 = $request->address2;
        $user->zipcode = $request->zipcode;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->save();
        return  back()->with(['success_message' => 'Credentials successfully updated']);
    }

    public function delete($id)
    {

        $user = Auth::user();

        if($user->isAdmin() || $user->isEmployee())
        {
            return back()->with(['error_message' =>'This account can\'t be deleted']);
        }

        return view('auth.deleteaccount', compact('user'));

    }

    public function deleteAccount()
    {
        $user = Auth::user();

        if($user->isAdmin() || $user->isEmployee())
        {
            return back()->with(['error_message' =>'This account can\'t be deleted']);
        }

        $user->delete();

        return redirect('/register')->with(['success_message' => 'Your account was successfully deleted !, We\'re &#x1f622; to see you go, sign up again :-)']);
    }
}
