<?php

namespace App;

use DB;
use App\Photo;
use App\OptionGroup;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'option_group_id', 'category_id', 'category', 'slug', 'description', 'price', 'image'
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function options()
    {
        return $this->group->options;
    }

    public function group()
    {
        return $this->belongsTo(OptionGroup::class, 'option_group_id');
    }
}
