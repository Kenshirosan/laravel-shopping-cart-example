<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'order_id',
        'product_id',
        'option_group_id',
        'option_id',
        'wayofcooking',
        'qty',
        'cart_row_id'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function options()
    {
        return $this->belongsTo(Option::class, 'option_id');
    }
}
