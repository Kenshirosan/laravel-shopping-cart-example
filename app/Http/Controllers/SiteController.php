<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $about = About::first();

        if (request()->expectsJson()) {
            return response($about, 200);
        }

        return view('layouts.about');
    }
}
