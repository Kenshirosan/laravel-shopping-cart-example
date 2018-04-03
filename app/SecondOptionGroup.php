<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondOptionGroup extends Model
{
    protected $fillable = [
        'name'
    ];

    public function options()
    {
        return $this->hasMany(SecondOption::class);
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
