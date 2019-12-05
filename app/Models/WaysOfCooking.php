<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaysOfCooking extends Model
{
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
        ]
    ];

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function type()
    {
        return $this->product->subcategory;
    }

    public function getWays()
    {
        if(array_key_exists($this->type(), $this->ways)) {
            return $this->ways[$this->type()];
        }

        return null;
    }

}
