<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressesController extends Controller
{
    public function index()
    {
        return response(auth()->user()->addresses, 200);
    }

    public function store()
    {
        $this->authorize('create', Address::class);

        request()->validate([
            'name' => 'required',
            'address' => 'required',
            'address_2' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'is_primary' => 'required'
        ]);

        $address = Address::create([
            'name' => request('name'),
            'address' => request('address'),
            'address_2' => request('address_2'),
            'zipcode' => request('zipcode'),
            'city' => request('city'),
            'state' => request('state'),
            'country' => request('country'),
            'is_primary' => request('is_primary'),
        ]);

        $address->user(auth()->user()->id);

        return response(['success_message' => 'You address has been created']);
    }

    public function update(User $user, Address $address)
    {
        $this->authorize('update', $address);

        request()->validate([
            'name' => 'required',
            'address' => 'required',
            'address_2' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'is_primary' => 'required'
        ]);

        if(request('is_primary') === 1) {
            $user->cancelDefaultAddress();
        }

        $address->update([
            'name' => request('name'),
            'address' => request('address'),
            'address_2' => request('address_2'),
            'zipcode' => request('zipcode'),
            'city' => request('city'),
            'state' => request('state'),
            'country' => request('country'),
            'is_primary' => request('is_primary'),
        ]);


        return response(['success_message' => 'You address has been updated']);
    }

    public function destroy(Address $address)
    {
        $this->authorize('update', $address);
    }
}
