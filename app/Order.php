<?php

namespace App;

use App\User;
use \Cart as Cart;
use App\Http\Requests;
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

    public function numberOfOrdersToday()
    {
        $attribute = 'created_at';
        $when =  date('Y-m-d');

        return Hideable::whereDate($attribute, $when)->count();
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
}
