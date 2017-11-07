<?php

namespace App\Http\Controllers;

use App\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('employee');
    }

    public function index()
    {
        return view('admin.calendar');
    }

    public function jsonIndex()
    {
        $thingsToDo = Calendar::all();

        return response($thingsToDo, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'start' => 'required',
            'allDay' => 'required',
            'backgroundColor' => 'required'
        ]);
        Calendar::create([
            'title' => request('title'),
            'start' => request('start'),
            'full_day' => request('allDay'),
            'color' => request('backgroundColor')
        ]);
        return response('success', 200);
    }
}
