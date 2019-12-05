<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'holiday_special',
        'option_group_id',
        'second_option_group_id',
        'category_id',
        'category',
        'subcategory',
        'slug',
        'description',
        'price',
        'image'
    ];

    protected $appends = ['is_on_sale', 'favoritesCount', 'isFavorited'];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    /**
     * Get the number of favorites for the restaurant.
     *
     * @return integer
     */
    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }

    /**
     * Determine if the current restaurant has been favorited.
     *
     * @return boolean
     */
    public function isFavorited()
    {
        return !! $this->favorites->where('user_id', auth()->id())->count();
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function sales()
    {
        return $this->hasOne(Sales::class, 'product_id');
    }

    public function getSalesPercentage()
    {
        return $this->sales->percentage * 100;
    }

    public function getRawSalesPercentage()
    {
        return $this->sales->percentage;
    }

    public function is_on_sale()
    {
        return !! $this->sales()->count();
    }

    public function getIsOnSaleAttribute()
    {
        return $this->is_on_sale();
    }

    public function isHiddenProduct()
    {
        return $this->hasMany(Hideable::class);
    }

    public function is_eighty_six()
    {
        $attributes = ['product_id' => $this->id];

        return $this->isHiddenProduct()->where($attributes)->exists();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function groups()
    {
        return $this->belongsToMany(OptionGroup::class, 'group_product');
    }

    public function regularPrice()
    {
        return money_format('%i', $this->price / 100);
    }

    public function price()
    {
        return $this->is_on_sale
            ?
                $this->regularPrice() - ($this->regularPrice() * $this->getRawSalesPercentage())
            :
                $this->regularPrice();
    }

    public function getWaysOfCooking()
    {
        return json_encode((new WaysOfCooking($this))->getWays());
    }
}
