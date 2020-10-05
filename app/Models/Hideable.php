<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

trait Hideable
{
    public function hidden()
    {
        return $this->morphOne($this, 'hideable');
    }

    public function hide()
    {
        return $this->hidden()->save($this);
    }

    public function unhide()
    {
        return $this->hidden()->update([
            'hideable_id' => null,
            'hideable_type' => null,
        ]);
    }

}
