<?php

namespace App;

// use App\Product;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name','slug', 'description', 'price', 'image'
    ];
}
