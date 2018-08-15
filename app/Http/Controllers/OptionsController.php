<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionRequest;
use App\Models\Option;
use App\Models\OptionGroup;
use App\Models\SecondOption;
use App\Models\SecondOptionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OptionsController extends Controller
{
    public function index(Request $request)
    {
        $optionGroups = OptionGroup::with('options')->get();

        if ($request->server('REQUEST_URI') === '/add-second-options') {
            $optionGroups = SecondOptionGroup::with('options')->get();
        }

        if ($request->wantsJson()) {
            return response($optionGroups, 200);
        }

        return view('admin.addOptions');
    }

    public function store(OptionRequest $request)
    {
        if ($request->server('REQUEST_URI') === '/add-second-options') {
            SecondOption::create([
                'name' => request('name'),
                'second_option_group_id' => request('option_group_id'),
            ]);

            $optionGroups = SecondOptionGroup::with('options')->get();

            return response($optionGroups, 200);
        }

        Option::create([
            'name' => request('name'),
            'option_group_id' => request('option_group_id'),
        ]);

        $optionGroups = OptionGroup::with('options')->get();

        return response($optionGroups, 200);
    }

    public function destroy($id)
    {
        if (request()->server('REQUEST_URI') === "/add-second-options/$id") {
            $option = SecondOption::where('id', $id)->firstOrFail();

            $option->delete();

            $optionGroups = SecondOptionGroup::with('options')->get();

            return response($optionGroups, 200);
        }

        $option = Option::where('id', $id)->firstOrFail();

        $option->delete();

        $optionGroups = OptionGroup::with('options')->get();

        return response($optionGroups, 200);

    }
}
