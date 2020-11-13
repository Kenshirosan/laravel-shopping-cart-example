<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = ['translation', 'language_id'];

    public function storeTranslation($string)
    {
        $lang = Language::where('language', app()->getLocale())->first();

        $translation = self::create([
            'translation' => $string,
            'language_id' => $lang->id,
        ]);

        return $translation;
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'translatable', 'language_translation', 'translation_id');
    }

    public function frontPage()
    {
        return $this->morphedByMany(FrontPage::class, 'translatable', 'language_translation', 'translation_id');
    }

    public function categories()
    {
        return $this->morphedByMany(Category::class, 'translatable', 'language_translation', 'translation_id');
    }

    public function options()
    {
        return $this->morphedByMany(Option::class, 'translatable', 'language_translation', 'translation_id');
    }


}
