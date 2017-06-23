<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
Use App\User;
Use App\Product;
Use App\Photo;
Use Image;


class AdminController extends Controller
{


    public function index()
    {
        return view('admin.restaurantindex');
    }

    public function store($slug, Request $request)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $file = $request->file('file');
        $name = time() . $file->getClientOriginalName();
        $path = 'meals/photos/' . $name;
        $file = Image::make($file->getRealPath())->resize(800,500)->save($path);

        $photo = new Photo();
        $photo->product_id = $product->id;
        $photo->photos = $path;
        $photo->save();
    }
}
