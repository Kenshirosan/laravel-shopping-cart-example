<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Mail\Welcome;
use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
    * Where to redirect users after registration.
    *
    * @var string
    */
    protected $redirectTo = '/shop';

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'address' => 'required|string|max:200',
            'address2' => 'nullable|string|max:200',
            'zipcode' => 'required|numeric|digits:5',
            'phone_number' => 'required|numeric|digits:10',
        ]);
    }

    /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return User
    */
    protected function create(array $data)
    {
        $phone = formatPhoneNumber($data['phone_number']);

        $user = User::create([
            'name' => ucfirst($data['name']),
            'last_name' => ucfirst($data['last_name']),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'address' => $data['address'],
            'address2' => $data['address2'],
            'zipcode' => $data['zipcode'],
            'phone_number' => $phone,
            'confirmation_token' => str_limit($data['email'] . hash('sha256', $data['email'] . str_random()), 100)
        ]);

        $email = $data['email'];
        $user = User::where('email', $email)->firstOrFail();
        // $event = event(new UserRegistered($user)); working but unecessary ? maybe with a queue delay on email..

        \Mail::to($data['email'])->send(new Welcome($user));
        return $user;
    }
}
