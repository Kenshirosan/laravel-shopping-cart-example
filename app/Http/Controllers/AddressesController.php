<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Address;
use App\Http\Requests\AddressRequest;

class AddressesController extends Controller
{
    public function index()
    {
        return response(auth()->user()->addresses, 200);
    }

    public function store(AddressRequest $request)
    {
        $this->authorize('create', Address::class);
        $user = auth()->user();

        if(request('is_primary') && $user->addresses->count() > 0) {
            $user->cancelDefaultAddress();
        }

        $address = Address::create([
            'name' => $request->name,
            'address' => $request->address,
            'address_2' => $request->address_2,
            'zipcode' => $request->zipcode,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'is_primary' => $request->is_primary,
        ]);

        $address->user($user->id);

        $message = ['success_message' => 'You address has been created'];
        return response(compact('message', 'address'));
    }

    public function update(AddressRequest $request, User $user, Address $address)
    {
        $this->authorize('update', $address);

        if(request('is_primary')) {
            $user->cancelDefaultAddress();
        }

        $address->update([
            'name' => $request->name,
            'address' => $request->address,
            'address_2' => $request->address_2,
            'zipcode' => $request->zipcode,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'is_primary' => $request->is_primary,
        ]);

        if($user->addresses->count() > 1 && ! $request->is_primary) {
            $user->makeDefaultAddress();
        }

        return response(['success_message' => 'Your address has been updated']);
    }

    public function destroy(User $user, Address $address)
    {
        $this->authorize('update', $address);
        $is_primary = $address->is_primary;
        $address->delete();

        if($is_primary) {
            $user->makeDefaultAddress();
        }

        return response(['success_message' => 'Address has been deleted']);
    }
}
