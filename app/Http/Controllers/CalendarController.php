<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        if(request()->wantsJson()){
            return response(Calendar::all(), 200);
        }

        return view('admin.calendar');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|string',
            'start' => 'required|date',
            'allDay' => 'required|boolean',
            'color' => 'required|string'
        ]);
        Calendar::create($request->all());

        return response('success', 200);
    }

    public function update($id)
    {
        $this->validate(request(), ['title' => 'string|nullable', 'start' => 'date|nullable']);

        $event = Calendar::where('id', $id)->firstOrFail();

        $title = request('title');
        $start = request('start');

        if(request('title') == null) {
            $title = $event->title;
        }

        if(request('start') == null) {
            $start = $event->start;
        }

        $event->update(['title' => $title, 'start' => $start]);

        return response('success', 200);
    }

    public function destroy($id)
    {
        $event = Calendar::where('id', $id)->firstOrFail();

        $event->delete();

        return response('success', 200);
    }
}
