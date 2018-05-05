<?php

namespace App\Http\Controllers;

use App\SecondOption;
use App\SecondOptionGroup;
use Illuminate\Http\Request;
use App\Http\Requests\OptionRequest;

class SecondOptionsController extends Controller
{
    public function index()
    {
        $optionGroups = SecondOptionGroup::all();
        $options = SecondOption::all();
        $action = 'add-second-options';

        return view('layouts.addOptions', compact('optionGroups', 'options', 'action'));
    }

    public function store(OptionRequest $request)
    {
        try {
            SecondOption::create([
                'name' => request('name'),
                'second_option_group_id' => request('option_group_id')
            ]);

            return back()->with('success_message', 'Option added');

        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }
    }
}
