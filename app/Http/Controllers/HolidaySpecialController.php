<?php

namespace App\Http\Controllers;

use App\Category;
use App\HolidayTitle;
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
            return $titles;
        }

        return view('admin.add-holiday-title', compact('titles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'holiday_page_title' => 'required|string|max:50'
        ]);

        HolidayTitle::create([
            'holiday_page_title' => request('holiday_page_title')
        ]);

        return response(['Status: ok'], 200);
    }

    public function destroy($id)
    {
        $title = HolidayTitle::where('id', $id)->firstOrFail();

        if ($title) {

            $title->delete();

            return response(['ok'], 200);
        }

        return response('something went wrong', 500);

    }
}
