<?php

namespace App;

use App\Product;
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
}
