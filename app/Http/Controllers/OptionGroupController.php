<?php

namespace App\Http\Controllers;

Use App\OptionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OptionGroupController extends Controller
{
    public function index()
    {
        $optionGroups = OptionGroup::all();
        $action = '/add-option-group';
        $deleteMethod = '/delete-option-group/';

        return view('layouts.addOptionGroup', compact('optionGroups', 'action', 'deleteMethod'));
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
        OptionGroup::create([
            'name' => request('name')
        ]);

        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        return back()->with('success_message', 'Option Group added');

    }

    public function destroy($id)
    {
        $optionGroup = OptionGroup::where('id', $id)->firstOrFail();

        $optionGroup->delete();

        return back()->with('success_message', 'Option Group Deleted.');
    }
}
