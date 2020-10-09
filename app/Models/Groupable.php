<?php

namespace App\Models;

trait Groupable
{
    public function groups()
    {
        return $this->morphToMany(OptionGroup::class, 'groupable', 'groupables')->withTimestamps();
    }

    public function group($group)
    {
        return $this->groups()->attach($group);
    }

    public function degroup($group)
    {
        return $this->groups()->detach($group);
    }

}
