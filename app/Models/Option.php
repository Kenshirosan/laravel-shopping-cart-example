<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use Groupable;

    protected $fillable = [
        'option_group_id', 'name'
    ];

    // public function optionGroup()
    // {
    //     return $this->belongsTo(OptionGroup::class, 'option_group_id');
    // }

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function groups()
    {
        return $this->morphToMany(OptionGroup::class, 'groupable');
    }
}
