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
        if(request()->wantsJson()){
            return response($thingsToDo = Calendar::all(), 200);
        }

        return view('admin.calendar');
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

    public function update($id)
    {
        $event = Calendar::where('id', $id)->firstOrFail();

        $this->validate(request(), ['title' => 'nullable', 'start' => 'nullable']);

        $event->update(request(['title', 'start']));

        return response('success', 200);
    }

    public function destroy($id)
    {
         $event = Calendar::where('id', $id)->firstOrFail();

         $event->delete();

         return response('success', 200);
    }
}
