<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Response;
use App\User;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Category;
use App\Models\OptionGroup;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;use Intervention\Image\Facades\Image;


class ProductController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {
        try{
            $this->createNewProduct($request);
        }
         catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }
        return redirect('/restaurantpanel')->with('success_message', 'Product successfully added !');
    }


    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->with('groups')->firstOrFail();
        $categories = Category::all();
        $optionGroups = OptionGroup::all();
        $subcategories = (new Category)->getSubcategories();
        $action = $product->isEightySix() ? "/delete/eighty_six/$product->id" : "/eighty_six/$product->id";
        $method = $product->isEightySix() ? 'DELETE' : 'POST';

        return view('admin.updateProduct', compact('product', 'subcategories', 'categories','optionGroups','method', 'action'));
    }

    public function update(StoreProductRequest $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        if (! request('file')) {
            $image = $product->image;
        }

        if ($request->hasFile('image')) {
            $avatar = $request->file('image');
            $image = time() . '.' . $avatar->getClientOriginalExtension();
            $path = public_path('img/' . $image);
            Image::make($avatar->getRealPath())->save($path);
        }

        $product->update([
            'name' => ucfirst(request('name')),
            'holiday_special' => request('holiday_special'),
            'category_id' => request('category_id'),
            'slug' => request('slug'),
            'type' => request('subcategory'),
            'description' => request('description'),
            'price' => request('price'),
            'image' => $image
        ]);

        if($request['option_group_id']) {
            foreach ($request['option_group_id'] as $group) {
                if(!$group) {
                    foreach ($product->groups as $groups) {
                        $product->groups()->detach($groups);
                    }
                }
                if($group !== null) {
                    $product->groups()->sync($request['option_group_id']);
                }
            }
        }

        return redirect('/update/' . $product->slug)->with("success_message", "Successfully Updated $product->name");
    }

    private function createNewProduct(Request $request)
    {
        if ($request->hasFile('image')) {
            $avatar = $request->file('image');
            $image = time() . '.' . $avatar->getClientOriginalExtension();
            $path = public_path('img/' . $image);
            Image::make($avatar->getRealPath())->save($path);

            $product = Product::create([
                'name' => ucfirst(request('name')),
                'holiday_special' => request('holiday_special'),
                'category_id' => request('category_id'),
                'type' => request('subcategory'),
                'slug' => request('slug'),
                'description' => request('description'),
                'price' => request('price'),
                'image' => $image
            ]);

            $lang = Language::where('language', app()->getLocale())->first();

            $translation = Translation::create([
                'translation' => $product->description,
                'language_id' => $lang->id,
            ]);

            $product->translate($translation);

            foreach ($request['option_group_id'] as $id) {
                $group = OptionGroup::where('id', $id)->get();

                $product->group($group);
            }
        }

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param    $product
    * @return RedirectResponse || Response
    */
    public function destroy($product)
    {
        $product = Product::where('slug', $product)->firstOrFail();

        if ($product->groups) {
            foreach ($product->groups as $group) {
                $product->degroup($group);
            }
        }

        $product->deleteTranslations();

        Storage::disk('custom')->delete('img/' . $product->image);

        $files = Photo::where('product_id', $product->id)->get();

        $product->delete();
        foreach($files as $photo) {
            Storage::disk('custom')->delete($photo->photos);
        }

        if (request()->expectsJson()) {
            return response([], 200);
        }

        return back()->with(['success_message' => 'Successfully deleted!']);
    }

    public function toggleTodaySpecial(Product $product)
    {
        $product->toggleTodaySpecial();

        return response(['create' => 'ok'], 200);
    }
}
