<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Order;

class User extends Authenticatable
{
    use Notifiable;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $casts = [
        'theboss' => 'boolean',
        'employee' => 'boolean',
    ];

    protected $fillable = [
        'name','last_name', 'password', 'address','address2', 'zipcode', 'phone_number', 'email'
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token', 'theboss', 'employee'
    ];

    public function isAdmin($user)
    {
        return $this->theboss; // this looks for an theboss(instead of admin) column in your users table
    }

    public function order()
    {
        return $this->hasMany(Orders::class);
    }
}
