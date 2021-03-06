<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        if(auth()->check() && auth()->user()->isAdmin()) {
            $messages = Message::latest()->get();

            return view('admin.messages', compact('messages'));
        }

        return view('layouts.messages');
    }

    public function show($id)
    {
        $message = Message::where('id', $id)->firstOrFail();

        return view('admin.message', compact('message'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required|string',
            'phone' => 'required|numeric|digits:10',
            'message' => 'required|min:20'
        ]);

        $message = ( new Message )->send($request->all());

        return response('Your message has been sent', 200);
    }

    public function destroy($id)
    {
        $message = Message::where('id', $id);

        $message->delete();

        return redirect('/contact-us')->with('success_message', 'Message deleted');
    }
}
