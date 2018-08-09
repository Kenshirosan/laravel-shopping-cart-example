<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'name', 'email', 'message', 'phone'
    ];

    public function send($request)
    {
        $phone = formatPhoneNumber($request['phone']);

        return Message::create([
            'email' => $request['email'],
            'name' => $request['name'],
            'phone' => $phone,
            'message' => $request['message']
        ]);
    }
}
