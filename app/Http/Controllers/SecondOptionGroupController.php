<?php

namespace App\Http\Controllers;

Use App\Models\SecondOptionGroup;
use Illuminate\Http\Request;

class SecondOptionGroupController extends Controller
{
    public function index(Request $request)
    {
        $optionGroups = SecondOptionGroup::with('options')->get();

        if ($request->wantsJson()) {
            return response($optionGroups, 200);
        }

        return view('admin.addOptionGroup');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        SecondOptionGroup::create([
            'name' => request('name')
        ]);

        return response(['success_message', 'Option Group added'], 200);
    }

    public function destroy($id)
    {
        $optionGroup = SecondOptionGroup::where('id', $id)->firstOrFail();

        $optionGroup->delete();

        return response(['success_message', 'Option Group Deleted.'], 200);
    }
}
