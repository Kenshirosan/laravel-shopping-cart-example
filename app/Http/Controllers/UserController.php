<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $this->validate($request, [
            'address' =>'required|string',
            'address2' => 'nullable|string',
            'zipcode' => 'required|numeric',
            'phone_number' => 'required|numeric|digits:10',
            'email' => 'required|email',
        ]);

        $user->address = $request->address;
        $user->address2 = $request->address2;
        $user->zipcode = $request->zipcode;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->save();

        return redirect('/edit-profile')->with(['success_message' => 'Credentials successfully updated']);
    }

    public function show($id)
    {
        $user = Auth::user();

        if ($user->isAdmin() || $user->isEmployee()) {
            return back()->with(['error_message' =>'This account can\'t be deleted']);
        }

        return view('auth.deleteaccount', compact('user'));
    }

    public function destroy()
    {
        $user = Auth::user();

        if ($user->isAdmin() || $user->isEmployee()) {
            return back()->with(['error_message' =>'This account can\'t be deleted']);
        }

        $user->delete();

        return redirect('/register')->with(['success_message' => 'Your account was successfully deleted !, We\'re &#x1f622; to see you go, sign up again :-)']);
    }
}
