<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    protected $subcategories = ['Eggs', 'Meat'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getSubcategories()
    {
        return $this->subcategories;
    }
}
