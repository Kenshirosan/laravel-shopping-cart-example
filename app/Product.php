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
        'name', 'holiday_special',
        'option_group_id', 'category_id',
        'category', 'slug',
        'description', 'price',
        'image'
    ];

    protected $appends = ['is_on_sale'];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function sales()
    {
        return $this->hasOne(Sales::class, 'product_id');
    }

    public function is_on_sale()
    {
        return !! $this->sales()->count();
    }

    public function getIsOnSaleAttribute()
    {
        return $this->is_on_sale();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function group()
    {
        return $this->belongsTo(OptionGroup::class, 'option_group_id');
    }

    public function options()
    {
        return $this->group->options;
    }

    public function regularPrice()
    {
        return money_format('%i', $this->price / 100);
    }

    public function price()
    {
        return $this->is_on_sale
            ?
                money_format('%i', ($this->price / 100) - (($this->price / 100) * $this->sales->percentage) )
            :
                money_format('%i', $this->price / 100);
    }
}
