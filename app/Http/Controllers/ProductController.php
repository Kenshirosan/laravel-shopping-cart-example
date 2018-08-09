<?php

namespace App\Http\Controllers;

use Image;
use App\User;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Category;
use App\Models\OptionGroup;
use App\Models\SecondOptionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;


class ProductController extends Controller
{
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
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
        $product = Product::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $optionGroups = OptionGroup::all();
        $secondOptionGroups = SecondOptionGroup::all();
        $action = $product->is_eighty_six() ? "/delete/eighty_six/$product->id" : "/eighty_six/$product->id";
        $method = $product->is_eighty_six() ? 'DELETE' : 'POST';

        return view('admin.updateProduct', compact('product', 'categories',
                                                    'optionGroups', 'secondOptionGroups',
                                                    'method', 'action'));
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
            'option_group_id' => request('option_group_id'),
            'second_option_group_id' => request('second_option_group_id'),
            'category_id' => request('category_id'),
            'slug' => request('slug'),
            'description' => request('description'),
            'price' => request('price'),
            'image' => $image
        ]);

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
                'option_group_id' => request('option_group_id'),
                'second_option_group_id' => request('second_option_group_id'),
                'category_id' => request('category_id'),
                'slug' => request('slug'),
                'description' => request('description'),
                'price' => request('price'),
                'image' => $image
            ]);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param    $product
    * @return \Illuminate\Http\Response
    */
    public function destroy($product)
    {
        $product = Product::where('slug', $product)->firstOrFail();

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
}