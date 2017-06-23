<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'products_photos';

    protected $fillable = ['photos'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
