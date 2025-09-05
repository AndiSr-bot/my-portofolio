<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Social;
use App\Models\User;

class _UserController extends Controller
{
    public function index()
    {
        $messageCount = Message::where('isRead', null)->count();
        $social = Social::orderBy('id', 'asc')->get();
        $user = Auth::user();
        return view('_admin/_profile/_profile', compact('user', 'messageCount', 'social'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'=> 'required',
            'phone'=> 'required',
            'email'=> 'required',
            'tagline'=> 'required',
            'description'=> 'required',
            'district'=> 'required',
            'regency'=> 'required',
            'province'=> 'required',
            'country'=> 'required',
            
        ]);
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->tagline = $request->input('tagline');
        $user->description = $request->input('description');
        $user->district = $request->input('district');
        $user->regency = $request->input('regency');
        $user->province = $request->input('province');
        $user->country = $request->input('country');
        $user->photo = $user->photo;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('assets/upload/imgs'), $filename);
            $user->photo = '/assets/upload/imgs/' .  $filename;
        } 

        $user->update();
        return redirect('/dashboard/profile')->with('status', 'Profile Updated Successfully');
    }

}
