<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'product_id'];

    /**
     * Fetch the model that was favorited.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function favorited()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function name()
    {
        return $this->favorited->name;
    }

    public function url()
    {
        return $this->favorited->product_id;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getFavorites()
    {
        return $this->favorited();
    }

    public function product()
    {
        return Restaurant::where('id', $this->favorited->id);
    }

    public function FavoritesCount()
    {
        return $this->where('id', $id)->get();
    }
}
