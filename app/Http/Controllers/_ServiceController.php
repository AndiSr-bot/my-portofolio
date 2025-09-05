<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Message;

class _ServiceController extends Controller
{
    public function index()
    {
        // $messageCount = Message::where('isRead', null)->count();
        $service = Service::orderBy('id', 'asc')->get();
        
        return response()->json([
            'status' => 'Ok',
            // 'messageCount' => $messageCount,
            'service' => $service
        ]);
        // return view('_admin/_service/_service', compact('service', 'messageCount'));
    }
    public function getById($id)
    {
        $service = Service::find($id);
        // return view('_admin/_service/_service', compact('service'));
        return response()->json($service);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $service = new Service();
        $service->name = $request->input('name');
        $service->description = $request->input('description');
        $service->save();
        
        return response()->json([
            'status' => 'Service Added Successfully'
        ]);
        // return redirect('/dashboard/service')->with('status', 'Service Added Successfully');
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $service = Service::find($id);
        $service->name = $request->input('name');
        $service->description = $request->input('description');
        $service->update();
        
        return response()->json([
            'status' => 'Service Updated Successfully'
        ]);
        // return redirect('/dashboard/service')->with('status', 'Service Updated Successfully');
    }
}
