<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('_admin/_auth/_login');
    }
    public function login(Request $request)
    {
        $credentials = [
            'email'=> $request->email,
            'password'=> $request->password,
        ];
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            session(['user' => $user]); 
            return redirect()->route('dashboard', compact('user'));
        }
        return back()->with('error', 'Email atau password salah');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
