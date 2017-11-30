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

        return view('layouts.shop', compact('title', 'categories'));
    }

    public function create()
    {
        $titles = HolidayTitle::all();

        return view('admin.add-holiday-title', compact('titles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'holiday_page_title' => 'required'
        ]);

        HolidayTitle::create([
            'holiday_page_title' => request('holiday_page_title')
        ]);

        return back()->with('success_message', 'Title added !');
    }

    public function destroy($id)
    {
        $title = HolidayTitle::where('id', $id);

        $title->delete();

        return back()->with('success_message', 'Successfully deleted');
    }
}
