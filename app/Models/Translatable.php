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
        $lang = Language::where('language', app()->getLocale())->first();

        return $this->translated()->where('language_id', $lang->id)->pluck('translation')->first();
    }

    public function translations()
    {
        return $this->translated();
    }

    public function translate($translation)
    {
        $this->translated()->attach($translation);
    }

    public function deleteTranslations()
    {
        if($this->has('translations')) {
            foreach($this->translations as $translation) {
                $this->deleteTranslation($translation);
                $translation->delete();
            }
        }
    }

    public function deleteTranslation($translation)
    {
        $this->translated()->detach($translation);
    }



}
