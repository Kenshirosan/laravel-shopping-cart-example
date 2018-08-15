<?php

namespace App\Http\Controllers;

Use App\Models\OptionGroup;
use App\Models\SecondOptionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OptionGroupController extends Controller
{
    public function index(Request $request)
    {
        $optionGroups = OptionGroup::with('options')->get();

        if($request->server('REQUEST_URI') === '/second-option-group') {
            $optionGroups = SecondOptionGroup::with('options')->get();
        }

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

        if($request->server('REQUEST_URI') === '/second-option-group') {
            SecondOptionGroup::create([
                'name' => request('name')
            ]);

            $optionGroups = SecondOptionGroup::with('options')->get();

            return response($optionGroups, 200);
        }

        OptionGroup::create([
            'name' => request('name')
        ]);

        $optionGroups = OptionGroup::with('options')->get();

        return response($optionGroups, 200);
    }

    public function destroy($id)
    {
        if (request()->server('REQUEST_URI') === "/second-option-group/$id") {
            $optionGroup = SecondOptionGroup::where('id', $id)->firstOrFail();
        } else {
            $optionGroup = OptionGroup::where('id', $id)->firstOrFail();
        }

        $optionGroup->delete();

        return response(['success_message', 'Option Group Deleted.'], 200);
    }
}
