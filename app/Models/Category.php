<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use hasFactory; use Translatable;

    protected $fillable = ['name'];

    protected $subcategories = ['Eggs', 'Meat', 'Chicken', 'Fish', 'Seafood', 'Game', 'Side'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getSubcategories()
    {
        return $this->subcategories;
    }
}
