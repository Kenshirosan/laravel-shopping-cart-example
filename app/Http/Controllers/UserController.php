<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use Carbon\Carbon;
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
        $employees = User::where(['employee' => true, 'theboss' => false])->get();

        return view('admin.employees', compact('employees'));
    }

    public function show($id)
    {
        if( auth()->user()->isAdmin()) {
            $employee = User::where('id', $id)->firstOrFail();

            return view('admin.employee', compact('employee'));
        }

        $user = User::where('id', $id)->firstOrFail();

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
            'last_name' => 'required|string|max:50',
            'phone_number' => 'required|numeric|digits:10',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => request('name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'phone_number' => formatPhoneNumber(request('phone_number')),
            'password' => bcrypt(request('password')),
            'address' => 'restaurant address',
            'address2' => 'restaurant address 2',
            'zipcode' => 'restaurant zipcode',
            'confirmed' => true,
            'employee' => true
        ]);

        return back()->with('success_message', 'Employee added !');
    }

    public function edit()
    {
        $user = Auth::user();

        $orders = Order::selectRaw('*')
                        ->whereRaw('day(created_at) = day(curdate())
                                    and year(created_at) = year(curdate())
                                    and month(created_at) = month(curdate())')
                        ->where('user_id', $user->id)
                        ->get();

        return view('layouts.userprofile', compact('user', 'orders'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if(\Hash::check(request('password'), $user->password)) {
            $this->validate($request, [
                'address' =>'required|string',
                'address2' => 'nullable|string',
                'zipcode' => 'required|numeric',
                'phone_number' => 'required|numeric|digits:10',
                'email' => 'required|email',
                'password' => 'string|confirmed'
            ]);

            $user->address = $request->address;
            $user->address2 = $request->address2;
            $user->zipcode = $request->zipcode;
            $user->phone_number = $request->phone_number;
            $user->email = $request->email;
            $user->save();

            return redirect('/edit-profile')->with(['success_message' => 'Credentials successfully updated']);
        }
        return back()->with('error_message', 'Something went wrong, Maybe you typed the wrong password');
    }

    public function destroy($id)
    {
        if(auth()->user()->isAdmin()) {
            $employee = User::where(['id'=> $id, 'employee' => true, 'theboss' => false])->firstOrFail();

            if( $employee->isAdmin() ){
                return redirect('/delete-user')->with('error_message', 'Admin can\'t be deleted !');
            }

            $employee->delete();
            return redirect('/delete-user')->with('success_message', 'Employee fired !');
        }

        $user = Auth::user();

        if ($user->isAdmin() || $user->isEmployee()) {
            return back()->with(['error_message' =>'Naaaaaahhhhh!']);
        }

        $user->delete();

        return redirect('/register')->with(['success_message' => 'Your account was successfully deleted !, We\'re 😢 to see you go, Please sign up again 😀']);
    }
}
