<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionRequest;
use App\Models\Option;
use App\Models\OptionGroup;
use Illuminate\Http\Request;

class OptionsController extends Controller
{
    public function index(Request $request)
    {
        $optionGroups = OptionGroup::all();

        if ($request->wantsJson()) {
            return response($optionGroups, 200);
        }

        return view('admin.addOptions');
    }

    public function store(OptionRequest $request)
    {
        $option = Option::create([
            'name' => request('name')
        ]);

        $option->group($request['option_group_id']);
        $optionGroups = OptionGroup::with('options')->get();

        return response($optionGroups, 200);
    }

    public function destroy($id)
    {
        $option = Option::where('id', $id)->with('groups')->firstOrFail();

        foreach ($option->groups as $group) {
            $group->options()->detach($option);
        }

        $option->delete();

        $optionGroups = OptionGroup::with('options')->get();

        return response($optionGroups, 200);

    }
}
