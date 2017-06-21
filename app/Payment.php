<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\User;
// use App\Product;
use App\Http\Requests;
use \Cart as Cart;
use Illuminate\Http\Request;
use App\Mail\Order;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class Payment extends Model
{
    // use Notifiable;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name','last_name', 'address','address2', 'zipcode', 'phone_number', 'email', 'items', 'price'
    ];

}
