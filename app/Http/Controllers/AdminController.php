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
    * @return \Illuminate\Http\Response
    */

    public function show()
    {

        $yearlyTotal = Order::selectRaw('year(created_at) year, sum(price) total')
                            ->groupBy('year')
                            ->orderBy('year', 'desc')
                            ->get();



        $totalOrders = Order::selectRaw('year(created_at) year, monthname(created_at) month, sum(price) total')
                            ->groupBy('year', 'month')
                            ->orderBy('year', 'desc')
                            ->get();

        return view('admin.panel', compact('orders', 'totalOrders', 'yearlyTotal'));

    }


    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store($slug, Request $request)
    {
        // only the boss and employees can add photos
        if ( !Auth::user()->isAdmin() && !Auth::user()->isEmployee() ) {

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
