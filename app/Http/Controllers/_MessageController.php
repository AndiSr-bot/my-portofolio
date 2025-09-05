<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class _MessageController extends Controller
{
    public function index()
    {
        $messageCount = Message::where('isRead', null)->count();
        $message = Message::orderBy('isRead', 'desc')->orderBy('id', 'desc')->get();
        return view('_admin/_message/_message', compact('message', 'messageCount'));
    }
    public function getById($id)
    {
        $message = Message::find($id);
        $message->isRead = 'read';
        $message->update();
        return response()->json($message);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        $message = new Message();
        $message->name = $request->input('name');
        $message->email = $request->input('email');
        $message->subject = $request->input('subject');
        $message->message = $request->input('message');
        $message->save();
        return redirect('/contact')->with('status', 'Message Added Successfully');
    }
}
