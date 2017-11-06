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
        return $request->session()->flash('status', 'Task was successful!');
        // return session()->flash('success_message', 'Event added !');
    }
}
