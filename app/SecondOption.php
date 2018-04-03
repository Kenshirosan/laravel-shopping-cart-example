<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondOption extends Model
{
    protected $fillable = [
        'second_option_group_id', 'name'
    ];

    public function optionGroup()
    {
        return $this->belongsTo(SecondOptionGroup::class, 'second_option_group_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
