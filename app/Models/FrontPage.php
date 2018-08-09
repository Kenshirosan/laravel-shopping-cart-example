<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontPage extends Model
{
    protected $fillable = [
    	'title',
        'subtitle',
    	'image',
        'color',
    	'background_color',
        'well_color',
    	'categories_title_color'
    ];
}
