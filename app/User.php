<?php

namespace App;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable; use HasFactory;
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
    /**
     * @var mixed
     */
    protected $employee;
    /**
     * @var mixed
     */
    protected $theboss;
    /**
     * @var bool|mixed
     */
    protected $confirmed;
    /**
     * @var mixed|null
     */
    protected $confirmation_token;

    public function getAddressesAttribute()
    {
        return $this->addresses()->get();
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'address_user', 'user_id', 'address_id')
            ->withTimestamps();
    }

    public function cancelDefaultAddress()
    {
        foreach($this->addresses as $ad) {
            $ad->update([
                'is_primary' => false,
            ]);
        }
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
