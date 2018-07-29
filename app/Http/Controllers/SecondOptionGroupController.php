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

        if ($request->wantsJson()) {
            return response([$optionGroups, $deleteMethod], 200);
        }

        return view('admin.addOptionGroup', compact('action'));
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

            return response(['success_message', 'Option Group added'], 200);

        } catch (\Exception $e) {
            return response(['error_message' => $e->getMessage() ], 400);
        }

        return back()->with('success_message', 'Option Group added');
    }

    public function destroy($id)
    {
        $optionGroup = SecondOptionGroup::where('id', $id)->firstOrFail();

        $optionGroup->delete();

        return response(['success_message', 'Option Group Deleted.'], 200);
    }
}
