<?php

namespace App\Http\Controllers;


use DB;
Use Image;
Use App\User;
Use App\Order;
Use App\Photo;
Use App\Product;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function __construct()
    {

        return $this->middleware('auth');

    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index()
    {

        $orders = Order::limit(5)->orderBy('created_at', 'desc')->get();

        return view('admin.restaurantindex',compact('orders'));

    }

    /**
    * Display the specified resource.
    *
    * @param  string  $slug
    * @return \Illuminate\Http\Response
    */

    public function show()
    {
        $yearlyTotal = Order::selectRaw('year(created_at) year, sum(price) total')->groupBy('year')->get();
        $orders = Order::orderBy('created_at', 'desc')->paginate(15);
        $totalOrders = Order::selectRaw('year(created_at) year, monthname(created_at) month, sum(price) total')
        ->groupBy('year', 'month')
        ->get();

        return view('admin.panel', compact('orders', 'totalOrders', 'yearlyTotal'));
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
