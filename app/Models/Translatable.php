<?php

namespace App\Models;


trait Translatable
{
    public function translated()
    {
        return $this->morphToMany(Translation::class, 'translatable', 'language_translation');
    }

    public function translation()
    {
        return $this->translated()->first();
    }

    public function translate($translation)
    {
        $this->translated()->attach($translation);
    }

    public function deleteTranslation($translation)
    {
        $this->translated()->detach($translation);
    }

}
