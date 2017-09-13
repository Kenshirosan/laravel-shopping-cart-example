<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hideable extends Model
{
    protected $fillable = ['order_id'];


    public function isHiddenOrder()
    {
        return $this->hasMany(Order::class);
    }
}
