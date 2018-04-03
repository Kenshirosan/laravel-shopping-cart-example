<?php

namespace App\Http\Controllers;

Use App\SecondOptionGroup;
use Illuminate\Http\Request;

class SecondOptionGroupController extends Controller
{
    public function index()
    {
        $optionGroups = SecondOptionGroup::all();
        $method = '/add-second-option-group';

        return view('layouts.addOptionGroup', compact('optionGroups', 'method'));
    }

    public function store(Request $request)
    {
        try {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        try {
        SecondOptionGroup::create([
            'name' => request('name')
        ]);

        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        return back()->with('success_message', 'Option Group added');

    }
}
