<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'option_group_id', 'name'
    ];

    public function optionGroup()
    {
        return $this->belongsTo(OptionGroup::class);
    }

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
