<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionRequest;
use App\Models\Option;
use App\Models\OptionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $group = OptionGroup::where('id', $request['option_group_id'])->firstOrFail();

        $group->option($option);
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
