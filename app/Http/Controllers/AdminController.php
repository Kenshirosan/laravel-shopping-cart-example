<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
Use App\User;
Use App\Orders;
Use App\Product;
Use App\Photo;
Use Image;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Orders::orderBy('created_at', 'desc')->get();

         return view('admin.restaurantindex',compact('orders'));

    }

    public function store($slug, Request $request)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $this->validate($request, [
            'photos' => 'require|mimes:jpg,jpeg,png,bmp'
        ]);

        $file = $request->file('photos');
        $name = time() . $file->getClientOriginalName();
        $path = 'meals/photos/' . $name;
        $file = Image::make($file->getRealPath())->resize(800,500)->save($path);

        $photo = new Photo();
        $photo->product_id = $product->id;
        $photo->photos = $path;
        $photo->save();
    }
}
