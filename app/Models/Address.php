<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'address',
        'address_2',
        'country',
        'state',
        'city',
        'zipcode',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function user($id)
    {
        return $this->users()->save($id);
    }
}
