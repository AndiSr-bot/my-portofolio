<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Message;

class _DashboardController extends Controller
{
    public function index()
    {
        $messageCount = Message::where('isRead', null)->count();
        return view('_admin/_dashboard/_index', compact('messageCount'));
    }
}
