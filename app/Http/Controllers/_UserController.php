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
        // $messageCount = Message::where('isRead', null)->count();
        $social = Social::orderBy('id', 'asc')->get();
        $user = User::orderBy('id', 'desc')->first();
        
        return response()->json([
            'status' => 'Ok',
            // 'messageCount' => $messageCount,
            'social' => $social,
            'user' => $user
        ]);
        // return view('_admin/_profile/_profile', compact('user', 'messageCount', 'social'));
    }
    public function getUserByEmail($email)
    {
        $user = User::where('email', $email)->first();   
        $social = Social::where('user_id', $user->id)->get();
        $user->social = $social;
        return response()->json([
            'status' => 'Ok',
            'user' => $user,
        ]);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'photo'=> 'required',
            'name'=> 'required',
            'phone'=> 'required',
            'email'=> 'required|email',
            'tagline'=> 'required',
            'description'=> 'required',
            'district'=> 'required',
            'regency'=> 'required',
            'province'=> 'required',
            'country'=> 'required',
            
        ]);
        $user = User::find($id);
        $user->photo = $request->input('photo');
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->tagline = $request->input('tagline');
        $user->description = $request->input('description');
        $user->district = $request->input('district');
        $user->regency = $request->input('regency');
        $user->province = $request->input('province');
        $user->country = $request->input('country');
        // $user->photo = $user->photo;

        // if ($request->hasFile('photo')) {
        //     $file = $request->file('photo');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $extension;
        //     $file->move(public_path('assets/upload/imgs'), $filename);
        //     $user->photo = '/assets/upload/imgs/' .  $filename;
        // } 

        $user->update();
        $social = Social::where('user_id', $user->id)->get();
        $user->social = $social;
        return response()->json([
            'status' => 'Profile Edit Successfully',
            'user' => $user
        ]);
        // return redirect('/dashboard/profile')->with('status', 'Profile Updated Successfully');
    }

}
