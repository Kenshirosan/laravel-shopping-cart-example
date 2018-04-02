<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use App\Favorite;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * Store a new favorite in the database.
     *
     * @param  Restaurant $restaurant
     */
    public function store(Request $request, $id)
    {
        $user = User::where('id', auth()->id())->firstOrFail();

        $this->validate($request, [
            'id' => 'required|numeric',
        ]);

        Favorite::create([
            'user_id' => $user->id,
            'product_id' => $id,
        ]);

        return response('success');
    }

    /**
     * Delete the favorite.
     *
     * @param Restaurant $restaurant
     */
    public function destroy(Request $request, $id)
    {
        $user = User::where('id', auth()->id())->firstOrFail();

        $attr = [
            'product_id'=> $id,
            'user_id' => $user->id
        ];

        $favorite = Favorite::where($attr)->firstOrFail();

        if( ! $favorite->user_id == $user->id) {
            return;
        }

        $favorite->delete();

        return response('success');
    }
}