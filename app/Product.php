<?php

namespace App;

use App\Photo;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'category', 'slug', 'description', 'price', 'image'
    ];

    // protected $with = ['id', 'name', 'price'];

    // public function getIdAttribute()
    // {
    //     return $this->id;
    // }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
