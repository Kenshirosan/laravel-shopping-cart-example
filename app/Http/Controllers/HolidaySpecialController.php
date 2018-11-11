<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HolidayTitle;
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

    public function create()
    {
        $titles = HolidayTitle::all();

        if (request()->wantsJson()) {
            return response($titles, 200);
        }

        return view('admin.add-holiday-title');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'holiday_page_title' => 'required|string|max:50'
        ]);

        if ($title = HolidayTitle::create([
            'holiday_page_title' => request('holiday_page_title')
        ])) {
            return response($title, 200);
        }

        return response(['error' => 'Something went wrong'], 400);
    }

    public function destroy($id)
    {
        $title = HolidayTitle::where('id', $id)->firstOrFail();

        $title->delete();

        return response(['ok'], 200);
    }

}
