<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use Groupable;

    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function groups()
    {
        return $this->morphToMany(OptionGroup::class, 'groupable');
    }
}
