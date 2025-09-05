<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Social;
use App\Models\User;

class _SocialController extends Controller
{
    public function getById($id)
    {
        $social = Social::find($id);
        return response()->json($social);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'link' => 'required',
            'user_id' => 'required|numeric',
        ]);
        $social = new Social();
        $social->name = $request->input('name');
        $social->link = $request->input('link');
        $social->user_id = $request->input('user_id');
        $social->img = 'http://ui-avatars.com/api/?name=' . $request->input('name');
        $social->save();
        
        $user = User::where('id', $social->user_id)->first();   
        $newSocial = Social::where('user_id', $user->id)->get();
        $user->social = $newSocial;
        return response()->json([
            'status' => 'Social Added Successfully',
            'user' => $user
        ]);
        // return redirect('/dashboard/profile')->with('status', 'Social Added Successfully');
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'link' => 'required',
            'user_id' => 'required|numeric',
        ]);
        $social = Social::find($id);
        $social->name = $request->input('name');
        $social->link = $request->input('link');
        $social->user_id = $request->input('user_id');
        $social->img = 'http://ui-avatars.com/api/?name=' . $request->input('name');
        $social->update();
        $user = User::where('id', $social->user_id)->first();   
        $newSocial = Social::where('user_id', $user->id)->get();
        $user->social = $newSocial;
        return response()->json([
            'status' => 'Social Updated Successfully',
            'user' => $user
        ]);
        // return redirect('/dashboard/profile')->with('status', 'Social Added Successfully');
    }
}
