<?php

namespace App\Http\Controllers;

use App\User;
Use App\OptionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OptionGroupController extends Controller
{
    public function index()
    {
        $optionGroups = OptionGroup::all();

        return view('layouts.addOptionGroup', compact('optionGroups'));
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
}
