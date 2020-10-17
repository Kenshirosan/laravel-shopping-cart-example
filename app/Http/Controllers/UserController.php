<?php

namespace App\Http\Controllers;

use App\Mail\Welcome;
use App\Models\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use \Cart as Cart;
use Illuminate\Support\Str;

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

        $users = User::where(['employee' => false, 'theboss' => false])->get();

        return view('admin.employees', compact('employees', 'users'));
    }

    public function show($id)
    {
        if( auth()->user()->isAdmin()) {
            $user = User::where('id', $id)->with('orders')->firstOrFail();

            return view('admin.user', compact('user'));
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
        $user = User::with('addresses')->findOrFail(Auth::user()->id);
        $orders = Order::selectRaw('*')
                        ->whereRaw('day(created_at) = day(curdate())
                                    and year(created_at) = year(curdate())
                                    and month(created_at) = month(curdate())')
                        ->where('user_id', $user->id)
                        ->orderBy('id', 'desc')
                        ->get();

        return view('users.userprofile', compact('user', 'orders'));
    }

    public function update(User $user)
    {
//        $user = User::where('id', $id)->firstOrFail();
//dd(request()->all());
        if(\Hash::check(request('password'), $user->password)) {
            request()->validate([
                'name' => 'required|string',
                'last_name' => 'required|string',
                'address' =>'required|string',
                'address2' => 'nullable|string',
                'zipcode' => 'required',
                'phone_number' => 'required',
                'email' => 'required|email',
                'password' => 'required|string|confirmed'
            ]);

            $user->update([
                'name' => request('name'),
                'last_name' => request('last_name'),
                'address' => request('address'),
                'address2' => request('address_2'),
                'zipcode' => request('zipcode'),
                'phone_number' => formatPhoneNumber(request('phone_number')),
            ]);

            if ($user->email !== request('email')) {
                $email = request('email');
                $user = $user->update([
                    'email' => $email,
                    'confirmed' => false,
                    'confirmation_token' => Str::limit($email . hash('sha256', $email . Str::random()), 100)
                ]);
                Mail::to($email)->send(new Welcome($user));

                return response(['success_message' => 'Credentials successfully updated, You now need to confirm your new email address'], 200);
            }

            return response('ok', 200);

        }

        return response('error_message', 'Something went wrong, Maybe you typed the wrong password');
    }

    public function destroy($id)
    {
        if(auth()->user()->isAdmin()) {
            $employee = User::where(['id'=> $id, 'employee' => true, 'theboss' => false])->firstOrFail();

            if( $employee->isAdmin() ){
                return redirect('/delete-user')->with('error_message', 'Admin can\'t be deleted !');
            }

            if(!$employee->isAdmin() || !$employee->isEmployee()){
                return redirect('/delete-user')->with('error_message', 'You can\'t delete your customers !');
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
