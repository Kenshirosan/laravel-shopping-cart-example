<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Hideable; use Groupable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'holiday_special',
        'today',
        'option_group_id',
        'second_option_group_id',
        'category_id',
        'category',
        'subcategory',
        'slug',
        'description',
        'price',
        'image',
        'hideable_id',
        'hideable_type'
    ];

    /**
     * @array ways of cooking food
     */
    protected $ways = [
        'Meat' => [
            'Rare',
            'Medium Rare',
            'Medium',
            'Medium Well',
            'Well Done'
        ],
        'Eggs' => [
            'Sunny Side',
            'Hard Boiled',
            'Soft Boiled',
            'Scrambled'
        ],
        'Chicken' => [
            'Roasted',
            'Sauteed',
            'Fried'
        ],
        'Fish' => [
            'Pan Seared',
            'Sushi',
            'Roasted',
            'Grilled'
        ]
    ];

    protected $appends = ['is_on_sale', 'favoritesCount', 'isFavorited', 'isTodaySpecial'];

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

    public function is_on_sale()
    {
        return !! $this->sales()->count();
    }

    public function getIsOnSaleAttribute()
    {
        return $this->is_on_sale();
    }

    public function isEightySix()
    {
        $attributes = ['id' => $this->id];

        return $this->hidden()->where($attributes)->exists();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function regularPrice()
    {
        return sprintf('%1.2f', ($this->price / 100));
    }

    public function price()
    {
        if($this->is_on_sale) {
            return $this->getSalePrice();
        }

        return '$' . $this->regularPrice();
    }

    public function getSaleAmount()
    {
        return $this->regularPrice() * $this->getRawSalesPercentage();
    }

    public function getSalePrice()
    {
        return '$' . sprintf('%1.2f', ($this->regularPrice() - $this->getSaleAmount()));
    }

    public function getSalesPercentage()
    {
        return $this->getRawSalesPercentage() * 100;
    }

    public function getRawSalesPercentage()
    {
        return $this->sales->percentage;
    }

    public function getWaysOfCooking()
    {
        $ret = [];

        if(array_key_exists($this->type, $this->ways)) {
            $ret = json_encode($this->ways[$this->type]);
        }

        return $ret;
    }

    public function isHolidaySpecial()
    {
        return $this->where('holiday_special', true)->exists();
    }

    public function getIsTodaySpecialAttribute()
    {
        return $this->today;
    }

}
