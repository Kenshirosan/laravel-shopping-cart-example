<?php

namespace App\Http\Controllers;

use Image;
use App\User;
use App\Product;
use App\OptionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        try{
            $this->validateRequest($request);
        }
         catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        try{
        $this->createNewProduct($request);
        }
         catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }
        return redirect('/restaurantpanel')->with('success_message', 'Product successfully added !');
    }


    private function validateRequest(Request $request)
    {
        return $this->validate($request,[
            'name' => 'required',
            'holiday_special' => 'required|boolean',
            'option_group_id' => 'required',
            'category_id' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);
    }

    private function createNewProduct(Request $request)
    {
        if ($request->hasFile('image')) {
            $avatar = $request->file('image');
            $image = time() . '.' . $avatar->getClientOriginalExtension();
            $path = public_path('img/' . $image);
            Image::make($avatar->getRealPath())->resize(800, 500)->save($path);

            $product = Product::create([
                'name' => request('name'),
                'holiday_special' => request('holiday_special'),
                'option_group_id' => request('option_group_id'),
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

        $product->delete();
        return back()->with(['success_message' => 'Successfully deleted!']);
    }
}