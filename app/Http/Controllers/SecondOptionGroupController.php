<?php

namespace App\Http\Controllers;

Use App\SecondOptionGroup;
use Illuminate\Http\Request;

class SecondOptionGroupController extends Controller
{
    public function index(Request $request)
    {
        $optionGroups = SecondOptionGroup::all();
        $action = $request->path();
        $deleteMethod = '/delete-second-option-group/';

        return view('admin.addOptionGroup', compact('optionGroups', 'action', 'deleteMethod'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string'
            ]);

            SecondOptionGroup::create([
                'name' => request('name')
            ]);

        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        return back()->with('success_message', 'Option Group added');
    }

    public function destroy($id)
    {
        $optionGroup = SecondOptionGroup::where('id', $id)->firstOrFail();

        $optionGroup->delete();

        return back()->with('success_message', 'Option Group Deleted.');
    }
}
