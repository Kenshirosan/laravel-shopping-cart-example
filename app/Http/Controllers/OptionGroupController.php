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
        $deleteMethod = '/delete-option-group/';
        $action = $request->path();

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

            OptionGroup::create([
                'name' => request('name')
            ]);

            return response(['success_message', 'Option Group added'], 200);

        } catch (\Exception $e) {
            return response(['error_message' => $e->getMessage() ], 400);
        }
    }

    public function destroy($id)
    {
        $optionGroup = OptionGroup::where('id', $id)->firstOrFail();

        $optionGroup->delete();

        return response(['success_message', 'Option Group Deleted.'], 200);
    }
}
