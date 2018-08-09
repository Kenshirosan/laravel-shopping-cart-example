<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hideable extends Model
{
    protected $fillable = ['order_id', 'product_id'];


    public function isHiddenOrder()
    {
        return $this->hasMany(Order::class);
    }

    public function isHiddenProduct()
    {
    	return $this->hasMany(Product::class);
    }
}
