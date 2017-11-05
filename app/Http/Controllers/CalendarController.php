<?php

namespace App\Http\Controllers;

use App\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{

    public function index()
    {
        $thingsToDo = Calendar::all();

        if (request()->wantsJson()) {
            return $thingsToDo;
        }

        return view('admin.calendar', compact('thingsToDo'));
    }
}
