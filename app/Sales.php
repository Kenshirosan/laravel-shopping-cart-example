<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    /**
    * @var array
    */
    protected $fillable = [
        'product_id',
        'percentage',
    ];

    public function products()
    {
    	return $this->hasMany(Product::class);
    }
}
