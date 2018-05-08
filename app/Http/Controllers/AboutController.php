<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('admin.add-about-page');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'value' => 'string'
        ]);

        if ($about = About::first()) {
            $about->update([
                'about' => $request['value']
            ]);

            return response('Updated', 200);
        }

        About::create([
            'about' => $request['value']
        ]);

        return response('Created', 200);
    }
}