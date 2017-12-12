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
        'user_id', 'name','last_name', 'address','address2', 'zipcode', 'phone_number', 'email', 'items', 'price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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
        return $this->whereDate('created_at', date('Y-m-d'))->orderBy('id', 'desc')->get();
    }

    public function todaysOrdersCount()
    {
        return $this->whereDate('created_at', date('Y-m-d'))->orderBy('id', 'desc')->count();
    }

    public function price()
    {
        return money_format('%i', $this->price / 100);
    }

}
