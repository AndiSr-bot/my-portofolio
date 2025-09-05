<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;
use App\Models\Message;

class _ToolController extends Controller
{
    public function index()
    {
        $messageCount = Message::where('isRead', null)->count();
        $tool = Tool::orderBy('counter', 'desc')->get();
        return view('_admin/_tool/_tool', compact('tool', 'messageCount'));
    }
    public function getById($id)
    {
        $tool = Tool::find($id);
        // return view('_admin/_tool/_tool', compact('tool'));
        return response()->json($tool);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'counter' => 'required|numeric',
        ]);
        $tool = new Tool();
        $tool->name = $request->input('name');
        $tool->counter = $request->input('counter');
        $tool->save();
        return redirect('/dashboard/tool')->with('status', 'Tool Added Successfully');
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'counter' => 'required|numeric',
        ]);
        $tool = Tool::find($id);
        $tool->name = $request->input('name');
        $tool->counter = $request->input('counter');
        $tool->update();
        return redirect('/dashboard/tool')->with('status', 'Tool Updated Successfully');
    }
}
