<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Deal with users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( auth()->user()->isAdmin() ) {
            $employees = User::where(['employee' => true, 'theboss' => false])->get();

            return view('admin.employees', compact('employees'));
        }
    }

    public function show($id)
    {
        $user = Auth::user();

        if ($user->isAdmin() || $user->isEmployee()) {
            return back()->with(['error_message' =>'This account can\'t be deleted']);
        }

        return view('auth.deleteaccount', compact('user'));
    }

    public function create()
    {
        return view('admin.addUser');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'last_name' => 'required|string|max:50',
            'address' => 'required|string|max:100',
            'address2' => 'nullable|string|max:100',
            'zipcode' => 'required|numeric|digits:5',
            'phone_number' => 'required|numeric|digits:10',
        ]);

        $phone = formatPhoneNumber(request('phone_number'));

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'last_name' => request('last_name'),
            'address' => request('address'),
            'address2' => request('address2'),
            'zipcode' => request('zipcode'),
            'phone_number' => $phone,
            'confirmed' => true,
            'employee' => true
        ]);

        return back()->with('success_message', 'Employee added !');
    }

    public function edit()
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

    public function destroy($id)
    {
        if(auth()->user()->isAdmin()) {
            $user = User::where('id', $id)->firstOrFail();

            if( $user->isAdmin() ){
                return redirect('/delete-user')->with('error_message', 'Admin can\'t be deleted !');
            }

            $user->delete();
            return redirect('/delete-user')->with('success_message', 'Employee fired !');
        }

        $user = Auth::user();

        if ($user->isAdmin() || $user->isEmployee()) {
            return back()->with(['error_message' =>'This account can\'t be deleted']);
        }

        $user->delete();

        return redirect('/register')->with(['success_message' => 'Your account was successfully deleted !, We\'re 😢 to see you go, sign up again 😀']);
    }
}
