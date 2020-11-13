<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;


class SiteController extends Controller
{
    public function index()
    {
        $about = AboutPage::first();

        if (request()->expectsJson()) {
            return response($about, 200);
        }

        return view('layouts.about');
    }
}
