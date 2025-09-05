<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Message;

class _LanguageController extends Controller
{
    public function index()
    {

        $messageCount = Message::where('isRead', null)->count();
        $language = Language::orderBy('id', 'asc')->get();
        return view('_admin/_language/_language', compact('language', 'messageCount'));
    }
    public function getById($id)
    {
        $language = Language::find($id);
        // return view('_admin/_language/_language', compact('language'));
        return response()->json($language);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required',
            'level' => 'required',
        ]);
        $language = new Language();
        $language->name = $request->input('name');
        $language->level = $request->input('level');
        $language->img = '';
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $uid = substr(md5(time()), 0, 16);
            $imgName = time() . '-' . $uid . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('assets/upload/imgs'), $imgName);
            $language->img = '/assets/upload/imgs/' . $imgName;
        }
        $language->save();
        return redirect('/dashboard/language')->with('status', 'Language Added Successfully');
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'img' => 'image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required',
            'level' => 'required',
        ]);
        $language = Language::find($id);
        $language->name = $request->input('name');
        $language->level = $request->input('level');
        $language->img = $language->img;
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $uid = substr(md5(time()), 0, 16);
            $imgName = time() . '-' . $uid . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('assets/upload/imgs'), $imgName);
            $language->img = '/assets/upload/imgs/' . $imgName;
        }
        $language->update();
        return redirect('/dashboard/language')->with('status', 'Language Updated Successfully');
    }
}
