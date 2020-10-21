<?php

namespace App\Policies;

use App\Models\Address;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @return boolean
     */
    public function create()
    {
        return auth()->user()->confirmed;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param \App\Models\Address $address
     * @return mixed
     */
    public function update(User $user, Address $address)
    {
        foreach(auth()->user()->addresses as $ad) {

            if($ad->pivot->address_id === $address->id &&
                $ad->pivot->user_id === $user->id &&
                auth()->user()->id === $user->id)
            {
                return true;
            }
        }
    }

}
