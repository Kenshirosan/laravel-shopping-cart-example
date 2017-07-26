<?php

namespace App;

use App\Order;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function isAdmin()
    {
        return $this->theboss; // this looks for an theboss(instead of admin) column in your users table
    }

    public function isEmployee()
    {
        return $this->employee;
    }

    // public function pay(Order $order)
    // {
    //     $this->orders()->save($order); unused for now (need  user_id in orders table..)
    //     return $this->belongsTo(Order::class);
    // }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
