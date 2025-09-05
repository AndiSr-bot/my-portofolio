<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Message;
use App\Models\Service;
use App\Models\Tool;
use App\Models\User;
use App\Models\Social;

class HomeController extends Controller
{
    public function index()
    {
        $social = Social::orderBy('id', 'asc')->get();
        $language = Language::orderBy('id', 'asc')->get();
        $service = Service::orderBy('id', 'asc')->get();
        $tool = Tool::orderBy('counter', 'desc')->get();
        $social = Social::orderBy('id', 'asc')->get();
        $language = Language::orderBy('id', 'asc')->get();
        $service = Service::orderBy('id', 'asc')->get();
        $tool = Tool::orderBy('counter', 'desc')->get();
        $user = User::where('email', 'andisr131117@gmail.com')->first();
        return view('home/index/index', compact('language', 'service', 'tool', 'user', 'social'));
    }
    public function about()
    {
        $social = Social::orderBy('id', 'asc')->get();
        $user = User::where('email', 'andisr131117@gmail.com')->first();
        $language = Language::orderBy('id', 'asc')->get();
        $tool = Tool::orderBy('counter', 'desc')->get();
        return view('home/aboutUs/about-us', compact('user', 'language', 'tool', 'social'));
    }
    public function services()
    {
        $social = Social::orderBy('id', 'asc')->get();
        $service = Service::orderBy('id', 'asc')->get();
        return view('home/service/services', compact('service', 'social'));
    }
    public function orderService($id)
    {        
        $social = Social::orderBy('id', 'asc')->get();
        $user = User::where('email', 'andisr131117@gmail.com')->first();
        $service = Service::where('id', $id)->first();
        $subjectOrder = 'Order Service '. $service->name;
        $messageOrder = 'Saya tertarik untuk memesan service <b>'. $service->name .'</b>. Bolehkah saya mendapatkan penawaran harga dan informasi lebih lanjut mengenai detail serta persyaratan yang diperlukan?';
        return redirect()->route('contact', compact('messageOrder', 'user', 'social', 'subjectOrder'));
    }
    public function contact(Request $request)
    {
        $social = Social::orderBy('id', 'asc')->get();
        $user = User::where('email', 'andisr131117@gmail.com')->first();
        $messageOrder = $request->query('messageOrder') ? $request->query('messageOrder') : null;
        $subjectOrder = $request->query('subjectOrder') ? $request->query('subjectOrder') : null;
        return view('home/contact/contact', compact('messageOrder', 'user', 'social', 'subjectOrder'));
    }
}

