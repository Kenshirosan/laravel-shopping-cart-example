<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecondOption extends Model
{
    protected $fillable = [
        'name'
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
