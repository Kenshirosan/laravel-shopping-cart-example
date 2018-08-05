<?php

namespace App\Http\Controllers;

use App\SecondOption;
use App\SecondOptionGroup;
use Illuminate\Http\Request;
use App\Http\Requests\OptionRequest;

class SecondOptionsController extends Controller
{
    public function index(Request $request)
    {
        $optionGroups = SecondOptionGroup::with('options')->get();

        if ($request->wantsJson()) {
            return response($optionGroups, 200);
        }

        return view('admin.addOptions');
    }

    public function store(OptionRequest $request)
    {
        $option = SecondOption::create([
            'name' => request('name'),
            'second_option_group_id' => request('option_group_id')
        ]);

        return response(['ok'], 200);
    }

    public function destroy($id)
    {
        $option = SecondOption::where('id', $id)->firstOrFail();

        $option->delete();

        return response(['ok'], 200);
    }
}
