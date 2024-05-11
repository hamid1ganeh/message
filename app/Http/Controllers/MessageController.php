<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;

class MessageController extends Controller
{
    public  function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'text' => 'required',
        ]);

        Message::create(['title'=> $request->title,
                         'text'=> $request->text,
                         'fullname'=> $request->fullname,
                         'user_id'=> $request->user_id]);

      return response()->json(['message'=>"New message is added"],201);

    }
}
