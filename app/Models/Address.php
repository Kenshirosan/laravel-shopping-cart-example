<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'name',
        'address',
        'address_2',
        'country',
        'state',
        'city',
        'zipcode',
        'is_primary'
    ];

    protected $casts = ['is_primary' => 'boolean'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'address_user', 'address_id', 'user_id')->withTimestamps();
    }

    public function user($id)
    {
        return $this->users()->attach($id);
    }

    public function delete()
    {
        return Address::destroy($this->id);
    }
}
