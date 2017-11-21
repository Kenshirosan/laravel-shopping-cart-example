<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class HolidaySpecialController extends Controller
{
    public function index()
    {
        $categories = Category::with(['products' => function ($query) {
            $query->where('holiday_special', true);
        }])->get();

        return view('layouts.shop', compact('categories'));
    }
}
