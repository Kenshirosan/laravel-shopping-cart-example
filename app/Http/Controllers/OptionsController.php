<?php

namespace App\Http\Controllers;

use App\Option;
use App\OptionGroup;
use Illuminate\Http\Request;
use App\Http\Requests\OptionRequest;
use Illuminate\Support\Facades\Auth;

class OptionsController extends Controller
{
    public function index(Request $request)
    {

        $optionGroups = OptionGroup::with('options')->get();

        $action = $request->path();

        if ($request->wantsJson()) {
            return response([$optionGroups], 200);
        }

        return view('admin.addOptions', compact('action'));
    }

    public function store(OptionRequest $request)
    {
        try {
            $option = Option::create([
                'name' => request('name'),
                'option_group_id' => request('option_group_id'),
            ]);

            return response($option, 200);

        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }
    }

    public function destroy($id)
    {
        $option = Option::where('id', $id)->firstOrFail();

        try {
            $option->delete();

            return response(['ok'], 200);

        } catch (Exception $e) {
            return response(['error_message' => $e->getMessage() ], 400);
        }

    }
}
