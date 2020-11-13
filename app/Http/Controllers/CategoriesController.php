<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Translatable;
use App\Models\Translation;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    use Translatable;
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        if (request()->wantsJson()) {
            return response($categories, 200);
        }

        return view('admin.categories');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string',
        ]);

        $category = Category::create($request->all());

        $translation = (new Translation())->storeTranslation($category->name);

        $category->translate($translation);

        $categories = Category::all();

        return response($categories, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $category = Category::where('id', $id)->firstOrFail();

       $category->deleteTranslations();

       $category->delete();

       $categories = Category::all();

       return response($categories, 200);
    }
}
