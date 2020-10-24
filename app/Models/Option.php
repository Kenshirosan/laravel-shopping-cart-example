<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use Groupable; use Translatable;

    protected $fillable = [
        'name'
    ];

//    public function products()
//    {
//        return $this->belongsTo(Product::class);
//    }
//
//    public function products()
//    {
//        return $this->hasManyThrough(OptionGroup::class, 'groupable')->withTimestamps();
//    }

}
