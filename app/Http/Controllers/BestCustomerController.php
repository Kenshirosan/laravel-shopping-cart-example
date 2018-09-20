<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Order;
use Illuminate\Http\Request;

class BestCustomerController extends Controller
{
    public function index()
    {
        $user_count = User::where(['confirmed' => true, 'employee' => false])->count();

        $bestCustomers = (new Order)->bestCustomers();

        if (request()->wantsJson()) {
            return response($bestCustomers, 200);
        }

        return view('admin.bestcustomers', compact('user_count'));
    }
}
