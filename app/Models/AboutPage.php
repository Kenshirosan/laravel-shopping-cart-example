<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    use Translatable;

    protected $table = 'abouts';

//    protected $appends = ['translations'];

    protected $fillable = ['about'];

}
