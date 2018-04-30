<?php

namespace App\Http\Controllers;

use App\Option;
use App\OptionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OptionsController extends Controller
{
    public function index()
    {
        $optionGroups = OptionGroup::all();
        $options = Option::all();
        $action = 'add-options';

        return view('layouts.addOptions', compact('optionGroups', 'options', 'action'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string',
                'option_group_id' => 'required|numeric'
            ]);

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
