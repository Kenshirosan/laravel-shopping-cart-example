<?php

namespace App\Http\Controllers;

Use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CssController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $url = '/home/laurent/public_html/webcreation/public/css/custom.css';

        return view('layouts.css', compact('url'));
    }


    public function update(Request $request)
    {
        $this->validate($request, ['custom-css' => 'nullable']);
        $content = request('custom-css');
        $url = '/home/laurent/public_html/webcreation/public/css/custom.css';

        $file = fopen($url, 'w');
        fwrite($file, $content);
        fclose($file);

        return back()->with('success_message', 'succesfully updated !');
    }
}
