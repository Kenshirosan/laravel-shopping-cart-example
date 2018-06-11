<?php

namespace App\Http\Controllers;

Use App\OptionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OptionGroupController extends Controller
{
    public function index(Request $request)
    {
        $optionGroups = OptionGroup::all();
        $action = $request->path();
        $deleteMethod = '/delete-option-group/';

        return view('layouts.addOptionGroup', compact('optionGroups', 'action', 'deleteMethod'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string'
            ]);

            OptionGroup::create([
                'name' => request('name')
            ]);

            return back()->with('success_message', 'Option Group added');

        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }
    }

    public function destroy($id)
    {
        $optionGroup = OptionGroup::where('id', $id)->firstOrFail();

        $optionGroup->delete();

        return back()->with('success_message', 'Option Group Deleted.');
    }
}
