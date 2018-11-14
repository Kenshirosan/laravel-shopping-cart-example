<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{
    use Groupable;

    protected $fillable = ['name'];

    protected $appends = ['options'];
    /*public function options()
    {
        return $this->hasMany(Option::class);
    }*/

    // public function option($option)
    // {
    //     return $this->options()->attach($option);
    // }

    // public function options()
    // {
    //     return $this->morphedByMany(Option::class, 'groupable')->withTimestamps();
    // }

    public function getOptionsAttribute()
    {
        return $this->options()->pluck('name');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'group_product', 'option_group_id', 'product_id');
    }

    public function product($product)
    {
        return $this->products()->attach($product);
    }

}
