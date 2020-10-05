<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Image;
use App\User;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Category;
use App\Models\OptionGroup;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;


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

        $action = $product->isEightySix() ? "/delete/eighty_six/$product->id" : "/eighty_six/$product->id";
        $method = $product->isEightySix() ? 'DELETE' : 'POST';

        return view('admin.updateProduct', compact('product', 'categories','optionGroups','method', 'action'));
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
            Image::make($avatar->getRealPath())->resize(800, 500)->save($path);

        }

        $product->update([
            'name' => ucfirst(request('name')),
            'holiday_special' => request('holiday_special'),
            'category_id' => request('category_id'),
            'slug' => request('slug'),
            'type' => request('type'),
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
            Image::make($avatar->getRealPath())->resize(800, 500)->save($path);

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

            foreach ($request['option_group_id'] as $id) {
                $group = OptionGroup::where('id', $id)->get();

                $product->groups()->attach($group);
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
                $product->groups()->detach($group);
            }
        }

        $file = $product->image;
        Storage::disk('custom')->delete('img/' . $file);

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

    public function todaySpecial(Product $product)
    {
        $product->update([
            'today' => true
        ]);
        return response(['create' => 'ok'], 200);
    }

    public function deleteTodaySpecial(Product $product)
    {
        $product->update([
            'today' => false
        ]);
        return response(['delete' => 'ok'], 200);
    }
}
