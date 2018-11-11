<?php

namespace App\Models;

trait Groupable
{
    public function options()
    {
        return $this->morphedByMany(Option::class, 'groupable')->withTimestamps();
    }

    public function option($option)
    {
        return $this->options()->attach($option);
    }

}