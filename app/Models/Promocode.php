<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    /**
    * @var bool
    */
    public $timestamps = false;

    /**
    * @var array
    */
    protected $fillable = [
        'code',
        'is_used',
    ];

    /**
    * @var array
    */
    protected $casts = [
        'is_used' => 'boolean',
    ];
}
