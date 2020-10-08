<?php

namespace App\Models;

trait Groupable
{
    public function groups()
    {
        return $this->morphToMany(OptionGroup::class, 'groupable', 'groupables');
    }

    public function group($group)
    {
        return $this->groups()->attach($group);
    }

}
