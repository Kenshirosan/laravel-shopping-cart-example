<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{
    protected $fillable = ['name'];

    protected $appends = ['options', 'products'];

    public function getOptionsAttribute()
    {
        return $this->options()->get();
    }

    public function getProductsAttribute()
    {
        return $this->products()->get();
    }

    public function options()
    {
        return $this->morphedByMany(Option::class, 'groupable')->withTimestamps();
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'groupable')->withTimestamps();
    }

}
