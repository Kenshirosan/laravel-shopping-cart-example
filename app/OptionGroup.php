<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{
    protected $fillables = [
        'name'
    ];

    public function options()
    {
        return $this->hasMany(Option::class);
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
