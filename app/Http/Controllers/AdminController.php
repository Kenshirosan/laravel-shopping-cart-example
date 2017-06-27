<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
Use App\User;
Use App\Order;
Use App\Product;
Use App\Photo;
use DB;
Use Image;


class AdminController extends Controller
{
    public function __construct()
    {

        return $this->middleware('auth');

    }

    public function index()
    {

        $orders = Order::limit(5)->orderBy('created_at', 'desc')->get();

        return view('admin.restaurantindex',compact('orders'));

    }

    public function show()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        $price = Order::sum('price');
        return view('admin.panel', compact('orders', 'price'));
    }



    public function store($slug, Request $request)
    {
        // only the boss and employees can add photos
        if ( !Auth::user()->theboss && !Auth::user()->employee ) {

            return response()->json(['error' => 'You\'re not allowed !'],403);

        }

        $product = Product::where('slug', $slug)->firstOrFail();

        $this->validate($request, [
            'photos' => 'required|mimes:jpg,jpeg,png,bmp'
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
