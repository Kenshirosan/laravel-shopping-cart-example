<?php

namespace App\Http\Controllers;

use App\Option;
use App\OptionGroup;
use Illuminate\Http\Request;
use App\Http\Requests\OptionRequest;
use Illuminate\Support\Facades\Auth;

class OptionsController extends Controller
{
    public function index(Request $request)
    {
        $optionGroups = OptionGroup::all();
        $options = Option::all();
        $action = $request->path();

        return view('admin.addOptions', compact('optionGroups', 'options', 'action'));
    }

    public function store(OptionRequest $request)
    {
        try {
            Option::create([
                'name' => request('name'),
                'option_group_id' => request('option_group_id')
            ]);

            return back()->with('success_message', 'Option added');

        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }
    }
}
