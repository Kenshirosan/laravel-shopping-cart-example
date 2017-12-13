<?php

namespace App\Http\Controllers;

use App\User;
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

        return view('layouts.addOptions', compact('optionGroups', 'options'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string',
                'option_group_id' => 'required|numeric'
            ]);

        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        try {
            Option::create([
                'name' => request('name'),
                'option_group_id' => request('option_group_id')
            ]);

        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        return back()->with('success_message', 'Option added');

    }
}
