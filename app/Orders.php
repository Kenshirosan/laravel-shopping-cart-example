<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Http\Requests;
use \Cart as Cart;
use Illuminate\Http\Request;


class Orders extends Model
{
    // use Notifiable;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'user_id', 'name','last_name', 'address','address2', 'zipcode', 'phone_number', 'email', 'items', 'price'
    ];

    public function order()
    {
        return $this->belongsTo(User::class);
    }

}
