<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'user_id', 'name','last_name', 'address','address2', 'zipcode', 'phone_number', 'email', 'items', 'price', 'status_id', 'taxes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the status of the order.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function isHidden()
    {
        return Hideable::where('order_id', request('id'))->count();
    }


    public function isHiddenOrder()
    {
        return $this->hasMany(Hideable::class);
    }

    public function hiddenOrder()
    {
        $attributes = ['order_id' => $this->id];

        return $this->isHiddenOrder()->where($attributes)->exists();
    }

    public function numberOfOrdersProcessedToday()
    {
        $when = 'created_at';
        $today =  date('Y-m-d');

        return Hideable::whereDate($when, $today)->count();
    }

    public function todaysOrders()
    {
        $when = 'created_at';
        $today =  date('Y-m-d');

        return $this->whereDate($when, $today)->orderBy('id', 'desc')->get();
    }

    public function todaysOrdersCount()
    {
        return $this->todaysOrders()->count();
    }

    public function price()
    {
        return money_format('$%i', ($this->price / 100));
    }

    public function tax()
    {
        return $this->taxes / 100;
    }

    public function subtotal()
    {
        return money_format('$%i', ($this->price - $this->taxes ) / 100);
    }
}
