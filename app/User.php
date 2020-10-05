<?php

namespace App;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
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
        'confirmed' => 'boolean'
    ];

    protected $fillable = [
        'name',
        'last_name',
        'password',
        'address',
        'address2',
        'zipcode',
        'phone_number',
        'email',
        'confirmation_token',
        'employee',
        'confirmed'
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password',
        'remember_token',
        'theboss',
        'employee'
    ];

    protected $appends = ['addresses'];

    public function getAddressesAttribute()
    {
        return $this->addresses();
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'address_user', 'user_id', 'address_id');
    }

    public function isAdmin()
    {
        return $this->theboss;
    }

    public function isEmployee()
    {
        return $this->employee;
    }

    public function confirm()
    {
        $this->confirmed = true;
        $this->confirmation_token = null;

        $this->save();
    }

    public function orders()
    {
        return $this->hasMany(Order::class)->orderBy('created_at', 'desc');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function pay(Order $order)
    {
        //unused for now (need  to figure out something for cart content..)
        $this->orders()->save($order);
    }

}
