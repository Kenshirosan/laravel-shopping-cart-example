<?php

namespace App\Http\Controllers;

use App\SecondOption;
use App\SecondOptionGroup;
use Illuminate\Http\Request;

class SecondOptionsController extends Controller
{
    public function index()
    {
        $optionGroups = SecondOptionGroup::all();
        $options = SecondOption::all();
        $action = 'add-second-options';

        return view('layouts.addOptions', compact('optionGroups', 'options', 'action'));
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
            SecondOption::create([
                'name' => request('name'),
                'second_option_group_id' => request('option_group_id')
            ]);

        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        return back()->with('success_message', 'Option added');
    }
}
