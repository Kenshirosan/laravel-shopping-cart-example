<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\Translation;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function index()
    {
        return view('admin.add-about-page');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'value' => 'string'
        ]);

        $about = AboutPage::updateOrCreate(
            ['id' => 1],
            ['about' => $request['value']]
        );


        if(!$translation = $about->translations()->first()) {
            $translation = (new Translation())->storeTranslation($about->about);
            $about->translate($translation);
        } else {
            $translation->update([
                'translation' => $about->about
            ]);
//            Update translation
        }


        return response('Created', 200);
    }
}
