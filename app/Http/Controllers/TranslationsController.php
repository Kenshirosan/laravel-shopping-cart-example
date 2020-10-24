<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FrontPage;
use App\Models\Option;
use App\Models\Product;
use Illuminate\Http\Request;

class TranslationsController extends Controller
{
    public function index()
    {
        $cat = Category::all()->pluck('name', 'id');
        $products = Product::all();
        $options = Option::all()->pluck('name', 'id');
        $fp = FrontPage::all();

        return view ('admin.translate', compact('cat', 'products', 'options', 'fp'));
    }
}
