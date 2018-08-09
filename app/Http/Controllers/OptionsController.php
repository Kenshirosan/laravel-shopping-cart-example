<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\OptionGroup;
use Illuminate\Http\Request;
use App\Http\Requests\OptionRequest;
use Illuminate\Support\Facades\Auth;

class OptionsController extends Controller
{
    public function index(Request $request)
    {
        $optionGroups = OptionGroup::with('options')->get();

        if ($request->wantsJson()) {
            return response($optionGroups, 200);
        }

        return view('admin.addOptions');
    }

    public function store(OptionRequest $request)
    {
        $option = Option::create([
            'name' => request('name'),
            'option_group_id' => request('option_group_id'),
        ]);

        return response($option, 200);
    }

    public function destroy($id)
    {
        $option = Option::where('id', $id)->firstOrFail();

        $option->delete();

        return response(['ok'], 200);
    }
}
