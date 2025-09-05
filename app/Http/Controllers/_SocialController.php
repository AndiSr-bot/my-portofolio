<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Social;

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
        ]);
        $social = new Social();
        $social->name = $request->input('name');
        $social->link = $request->input('link');
        $social->img = 'http://ui-avatars.com/api/?name=' . $request->input('name');
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $uid = substr(md5(time()), 0, 16);
            $imgName = time() . '-' . $uid . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('assets/upload/imgs'), $imgName);
            $social->img = '/assets/upload/imgs/' . $imgName;
        }
        $social->save();
        return redirect('/dashboard/profile')->with('status', 'Social Added Successfully');
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'link' => 'required',
        ]);
        $social = new Social();
        $social->name = $request->input('name');
        $social->link = $request->input('link');
        $social->img = 'http://ui-avatars.com/api/?name=' . $request->input('name');
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $uid = substr(md5(time()), 0, 16);
            $imgName = time() . '-' . $uid . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('assets/upload/imgs'), $imgName);
            $social->img = '/assets/upload/imgs/' . $imgName;
        }
        $social->update();
        return redirect('/dashboard/profile')->with('status', 'Social Added Successfully');
    }
}
