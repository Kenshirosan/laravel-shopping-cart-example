<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name','slug', 'description', 'price', 'image'
    ];

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}
