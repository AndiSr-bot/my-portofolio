<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Message;

class _DashboardController extends Controller
{
    public function index()
    {
        $messageCount = Message::where('isRead', null)->count();
        return response()->json([
            'status' => 'Ok',
            'messageCount' => $messageCount,
            'token' => csrf_token(),
        ]);
        // return view('_admin/_dashboard/_index', compact('messageCount'));
    }
}
