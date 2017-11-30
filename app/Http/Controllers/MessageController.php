<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        if(Auth::check() && Auth::user()->isAdmin()) {
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
            'name' => 'required',
            'phone' => 'required|numeric|digits:10',
            'message' => 'required|min:20'
        ]);

        $phone = formatPhoneNumber(request('phone'));

        $user = Message::create([
            'email' => request('email'),
            'name' => request('name'),
            'phone' => $phone,
            'message' => request('message')
        ]);

        return back()->with('success_message', "Thank you $user->name, we'll get back to you very soon");
    }

    public function destroy($id)
    {
        $message = Message::where('id', $id);

        $message->delete();

        return redirect('/contact-us')->with('success_message', 'Message deleted');
    }
}